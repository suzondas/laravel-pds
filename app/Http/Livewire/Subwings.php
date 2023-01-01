<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subwings as Model;


class Subwings extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $wing_id;
    public $name;
    public $name_bangla;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;

    protected $rules = [
        'wing_id' => 'required',
        'name' => 'required',
        'name_bangla' => 'required',

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
        $wings =  \App\Models\Wings::all();
        $model = Model::where('wing_id', 'like', '%' . $this->search . '%')->orWhere('name', 'like', '%' . $this->search . '%')->orWhere('name_bangla', 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        return view('livewire.subwings', [
            'rows' => $model,'wings'=>$wings
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

        $this->wing_id = $model->wing_id;
        $this->name = $model->name;
        $this->name_bangla = $model->name_bangla;


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

        $model->wing_id = $this->wing_id;
        $model->name = $this->name;
        $model->name_bangla = $this->name_bangla;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Record Saved Successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
        $this->wing_id = "";
        $this->name = "";
        $this->name_bangla = "";

    }


    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);

        $model->wing_id = $this->wing_id;
        $model->name = $this->name;
        $model->name_bangla = $this->name_bangla;
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
