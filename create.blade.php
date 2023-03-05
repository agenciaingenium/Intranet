<div>
    <x-button
        wire:click="$set('createSMP',true)">{{ucwords(__('new social media planning'))}}</x-button>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <x-modal wire:model.defer="createSMP" class="lg:top-4 lg:right-4 lg:absolute">
        <div class="headers bg-rose">
            <h2 class="text-white">{{ucwords(__('create') .' '. __('social media planning'))}}</h2>
        </div>
        <div class="p-4 mb-1">
            <x-label for="company">Selecciona una opción</x-label>
            <x-select id="company" class="js-choices" wire:model.defer="company" wire:keep>
                @foreach ($companies as $client)
                    <option
                        value={{ $client->id }} @selected(old('company') == $client->id)>{{ $client->trade_name }}</option>
                @endforeach
            </x-select>
            <x-input-error for="company"/>
        </div>
        <div class="p-2 mb-1 flex">
            <div class="px-2 w-1/3">
                <x-label for="start_date">{{ucfirst(__('start date'))}}</x-label>
                <x-input wire:model.defer="start_date" class="w-full" type="date" name="start_date"
                         value="{{old('start_date')}}"></x-input>
                <x-input-error for="start_date"/>
            </div>
            <div class="px-2 w-1/3">
                <x-label for="end_date">{{ucfirst(__('end date'))}}</x-label>
                <x-input wire:model.defer="end_date" class="w-full" type="date" name="end_date"
                         value="{{old('start_date')}}"></x-input>
                <x-input-error for="end_date"/>
            </div>
            <div class="px-2 w-1/3">
                <x-label for="status">{{ucfirst(__('status'))}}</x-label>
                <x-select wire:model.defer="status" class="w-full" id="status">
                    <option value="">{{ucfirst(__('select a status'))}}</option>
                    @foreach($statuses as $status)
                        <option value="{{$status}}" @selected(old('status'== $status))>{{ucwords(__($status))}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="status"/>
            </div>
        </div>
        <div class="px-4 mb-1">
            <x-label for="social_networks">{{ucfirst(__('social networks'))}}</x-label>
            {{var_dump($social_networks)}}
            <x-select wire:model.defer="social_networks" id="social_networks" multiple>
                @foreach($socialNetworks as $network)
                    <option
                        value="{{$network->id}}" @selected(old('social_networks')== $network->id)>{{ucwords($network->name)}}</option>
                @endforeach
            </x-select>
            <x-input-error for="social_networks"/>
        </div>
        <div class="p-2 mb-1 flex">
            <div class="px-2 w-1/2">
                <x-label for="designer">{{ucfirst(__('designer'))}}</x-label>
                <x-select wire:model.defer="designer" class="w-full" id="designer">
                    <option value="">{{ucfirst(__('select a designer'))}}</option>
                    @foreach($designers as $designer)
                        <option
                            value="{{$designer->id}}">{{ucwords($designer->firstname ." ". $designer->lastname)}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="designer"/>
            </div>
            <div class="px-2 w-1/2">
                <x-label for="executive">{{ucfirst(__('executive'))}}</x-label>
                <x-select wire:model.defer="executive" class="w-full" id="executive">
                    <option value="">{{ucfirst(__('select a executive'))}}</option>
                    @foreach($executives as $executive)
                        <option
                            value="{{$executive->id}}">{{ucwords($executive->firstname ." ". $executive->lastname)}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="executive"/>
            </div>
        </div>
        <div class="p-2 mb-1 flex">
            <div class="px-2 w-1/2">
                <x-label for="posts">{{ucfirst(__('posts'))}}</x-label>
                <x-input wire:model.defer="posts" type="number" class="w-full" name="posts"
                         placeholder="{{ucfirst(__('enter a number'))}}"></x-input>
                <x-input-error for="posts"/>
            </div>
            <div class="px-2 w-1/2">
                <x-label for="designs">{{ucfirst(__('designs'))}}</x-label>
                <x-input wire:model.defer="designs" type="number" class="w-full" name="designs"
                         placeholder="{{ucfirst(__('enter a number'))}}"></x-input>
                <x-input-error for="designs"/>
            </div>
        </div>
        <div class="p-2 mb-1 flex">
            <div class="px-2 w-1/2">
                <x-label for="ads">{{ucfirst(__('ads'))}}</x-label>
                <x-input wire:model.defer="ads" type="number" class="w-full" name="ads"
                         placeholder="{{ucfirst(__('enter a number'))}}"></x-input>
                <x-input-error for="ads"/>
            </div>
            <div class="px-2 w-1/2">
                <x-label for="budget">{{ucfirst(__('budget'))}}</x-label>
                <x-input wire:model.defer="budget" type="number" class="w-full" name="budget"
                         placeholder="{{ucfirst(__('enter a number'))}}"></x-input>
                <x-input-error for="budget"/>
            </div>
        </div>
        <div class="right-0 float-right p-4">
            <x-button wire:click="$set('createSMP',false)"
                      class="darkBlue">{{mb_strtoupper(__('close'))}}</x-button>
            <x-button wire:click="store(company)" class="primary">{{mb_strtoupper(__('create'))}}</x-button>
        </div>
    </x-modal>
    @push('scripts')
        <script>
            Livewire.on('init-choices', () => {
                const companySelect = document.getElementById('company');
                companyChoices = new Choices(companySelect, {
                    searchEnabled: true,
                    allowHTML: true,
                });
                const socialNetworksSelect = document.getElementById('social_networks');
                socialChoices = new Choices(socialNetworksSelect, {
                    searchEnabled: true,
                    allowHTML: true,
                });

            });
            Livewire.on('update-choices', (data) => {
                let newCompany = data.newCompany;
                let value = data.value;
                const companySelect = document.getElementById('company');
                let companyChoices = new Choices(companySelect, {
                    searchEnabled: true,
                    allowHTML: true,
                });
                const socialNetworksSelect = document.getElementById('social_networks');
                socialChoices = new Choices(socialNetworksSelect, {
                    searchEnabled: true,
                    allowHTML: true,
                });
                companyChoices.setValue([{value: value, label: newCompany}]);
                console.log(companyChoices.getValue());
            });
            document.addEventListener('livewire:load', function () {
                const socialNetworksSelect = document.getElementById('social_networks');
                const socialChoices = new Choices(socialNetworksSelect, {
                    // Options for Choices.js
                });

                window.addEventListener('init-choices', () => {
                    socialChoices.init();

                });


            });
        </script>

    @endpush
</div>
