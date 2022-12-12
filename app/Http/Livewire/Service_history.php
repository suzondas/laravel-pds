<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service_history as Model;


class Service_history extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $user_id;
    public $designation_id;
    public $office_id;
    public $from;
    public $to;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;
    public $designations;
    public $offices;
    protected $rules = [
        'user_id' => 'required',
        'designation_id' => 'required',
        'office_id' => 'required',
        'from' => 'required',
        'to' => 'required',

    ];

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->designations = \App\Models\Designations::all()->toArray();
        $this->offices = \App\Models\Offices::all()->toArray();

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
        $model = Model::where('user_id', $this->user_id)->where(function ($query) {
            $query->where('designation_id', 'like', '%' . $this->search . '%')->orWhere('office_id', 'like', '%' . $this->search . '%')->orWhere('from', 'like', '%' . $this->search . '%')->orWhere('to', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->paginate);
        return view('livewire.service_history', [
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
        $this->designation_id = $model->designation_id;
        $this->office_id = $model->office_id;
        $this->from = $model->from;
        $this->to = $model->to;


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
        $model->designation_id = $this->designation_id;
        $model->office_id = $this->office_id;
        $model->from = $this->from;
        $model->to = $this->to;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Record Saved Successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
//        $this->user_id = "";
        $this->designation_id = "";
        $this->office_id = "";
        $this->from = "";
        $this->to = "";

    }


    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);

        $model->user_id = $this->user_id;
        $model->designation_id = $this->designation_id;
        $model->office_id = $this->office_id;
        $model->from = $this->from;
        $model->to = $this->to;
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
