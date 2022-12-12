<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Designations as Model;


class Designations extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $name_bangla;
    public $name_english;
    public $grade;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;

    protected $rules = [
        'name_bangla' => 'required',
        'name_english' => 'required',
        'grade' => 'required',

    ];


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
        $model = Model::where('name_bangla', 'like', '%' . $this->search . '%')->orWhere('name_english', 'like', '%' . $this->search . '%')->orWhere('grade', 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        return view('livewire.designations', [
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

        $this->name_bangla = $model->name_bangla;
        $this->name_english = $model->name_english;
        $this->grade = $model->grade;


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

        $model->name_bangla = $this->name_bangla;
        $model->name_english = $this->name_english;
        $model->grade = $this->grade;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Record Saved Successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
        $this->name_bangla = "";
        $this->name_english = "";
        $this->grade = "";

    }


    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);

        $model->name_bangla = $this->name_bangla;
        $model->name_english = $this->name_english;
        $model->grade = $this->grade;
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
