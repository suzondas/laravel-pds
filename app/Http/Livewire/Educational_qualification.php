<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Educational_qualification as Model;
use App\Models\Degrees as DegreesModel;

class Educational_qualification extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $user_id;
    public $institute;
    public $principle_subject;
    public $degree_id;
    public $pass_year;
    public $division;
    public $gpa_class;
    public $distinction;
    public $degrees;

    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;

    protected $rules = [
//        'user_id' => 'required',
        'institute' => 'required',
        'principle_subject' => 'required',
        'degree_id' => 'required',
        'pass_year' => 'required',
        'division' => 'required',
        'gpa_class' => 'required',
        'distinction' => 'required',

    ];

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->degrees = DegreesModel::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $model = Model::where(['user_id' => $this->user_id])->where(function ($query) {
            $query->where('institute', 'like', '%' . $this->search . '%')->
            orWhere('principle_subject', 'like', '%' . $this->search . '%')->
            orWhere('degree_id', 'like', '%' . $this->search . '%')->
            orWhere('pass_year', 'like', '%' . $this->search . '%')->
            orWhere('division', 'like', '%' . $this->search . '%')->
            orWhere('gpa_class', 'like', '%' . $this->search . '%')->
            orWhere('distinction', 'like', '%' . $this->search . '%');
        })
            ->latest()->paginate($this->paginate);

        return view('livewire.educational_qualification', [
            'rows' => $model
        ]);
    }


    public function create()
    {
        $this->mode = 'create';
        $this->resetForm();
        $this->showForm = true;
    }


    public function edit($primaryId)
    {
        $this->mode = 'update';
        $this->primaryId = $primaryId;
        $model = Model::find($primaryId);

        $this->user_id = $model->user_id;
        $this->institute = $model->institute;
        $this->principle_subject = $model->principle_subject;
        $this->degree_id = $model->degree_id;
        $this->pass_year = $model->pass_year;
        $this->division = $model->division;
        $this->gpa_class = $model->gpa_class;
        $this->distinction = $model->distinction;


        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function store()
    {
        $this->validate();

        $model = new Model();

        $model->user_id = $this->user_id;
        $model->institute = $this->institute;
        $model->principle_subject = $this->principle_subject;
        $model->degree_id = $this->degree_id;
        $model->pass_year = $this->pass_year;
        $model->division = $this->division;
        $model->gpa_class = $this->gpa_class;
        $model->distinction = $this->distinction;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Record Saved Successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
//        $this->user_id = "";
        $this->institute = "";
        $this->principle_subject = "";
        $this->degree_id = "";
        $this->pass_year = "";
        $this->division = "";
        $this->gpa_class = "";
        $this->distinction = "";

    }


    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);

        $model->user_id = $this->user_id;
        $model->institute = $this->institute;
        $model->principle_subject = $this->principle_subject;
        $model->degree_id = $this->degree_id;
        $model->pass_year = $this->pass_year;
        $model->division = $this->division;
        $model->gpa_class = $this->gpa_class;
        $model->distinction = $this->distinction;
        $model->save();

        $this->resetForm();

        $this->showForm = false;

        session()->flash('message', 'Record Updated Successfully');
    }

    public function confirmDelete($primaryId)
    {
        $this->primaryId = $primaryId;
        $this->showConfirmDeletePopup = true;
    }

    public function destroy()
    {
        Model::find($this->primaryId)->delete();
        $this->showConfirmDeletePopup = false;
        session()->flash('message', 'Record Deleted Successfully');
    }

    public function clearFlash()
    {
        session()->forget('message');
    }

}
