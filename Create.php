<?php

namespace App\Http\Livewire\SocialMediaPlanning;

use App\Models\Company;
use App\Models\SocialMediaPlanning;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $createSMP = false;

    public $company, $end_date, $status, $start_date, $executive, $designer, $social_networks, $posts, $designs, $ads, $budget;

    protected $listeners = ['render'];

   protected $rules = [
        'company.value'=>['required','exists:companies,id'],
        /*'start_date'=>['required', 'date'],
        'end_date'=>['required', 'date'],
        'status'=>['required','in:not_done,doing,done,cancelled'],
        'executive'=>['required', 'int', 'exists:users,id'],
        'designer'=>['required', 'int', 'exists:users,id'],
        'posts'=>['required', 'int'],
        'designs'=>['required', 'int'],
        'ads'=>['required', 'int'],
        'budget'=>['required', 'int']*/
    ];


    public function updatedCreateSMP()
    {
        $this->emit('init-choices');
    }
    public function updatedCompany($company){
        $newCompany = Company::where('id', $company)->first();
        $this->company = $newCompany;

        $this->emit('update-choices',['newCompany' => $newCompany->trade_name, 'value'=>$newCompany->id]);
    }
    public function render(): Factory|View|Application
    {
        return view('livewire.social-media-planning.create', [
            'companies' => Company::all(),
            'designers' => User::designers(),
            'executives' => User::executives(),
            'socialNetworks'=>SocialNetwork::all(),
            'statuses'=>SocialMediaPlanning::STATUSES,

        ]);
    }



    public function store($company)
    {
        $newCompany = Company::where('id', $company)->first();
        $this->company = $newCompany;

        $this->emit('update-choices',['newCompany' => $newCompany->trade_name, 'value'=>$newCompany->id]);
        $this->validate();

        $socialMediaPlanningSave = SocialMediaPlanning::create([
            'client_id' => $newCompany->id,
            'end_date' => '20221201',
            'start_date' => '20221201',
            'executive_id' => 3,
            'designer_id' => 2,
            'social_networks' => 2,
            'posts' => 15,
            'designs' => 14,
            'ads' => 12,
            'budget' => 150,
        ]);
       /*$socialMediaPlanning = SocialMediaPlanning::create([
            'client_id' => intval($this->company),
            'end_date' => $this->end_date,
            'start_date' => $this->start_date,
            'executive_id' => $this->executive,
            'designer_id' => $this->designer,
            'social_networks' => 2,
            'posts' => $this->posts,
            'designs' => $this->designs,
            'ads' => $this->ads,
            'budget' => $this->budget,
        ]);
        //$socialMediaPlanning->socialNetworks()->sync($this->social_networks);
        $this->emit('render');
        $this->emit('alert');*/

    }
}
