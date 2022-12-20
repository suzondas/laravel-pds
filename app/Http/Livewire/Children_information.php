<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\children_information as Model;


class Children_information extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $user_id;
    public $name;
    public $name_bangla;
    public $date_of_birth;
    public $sex;
    public $special_child;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;
    public $children_sex_helper = [1 => "Male", 2 => "Female"];
    public $special_child_helper = [1 => "Yes", 2 => "No"];
    protected $rules = [
//        'user_id' => 'required',
        'name' => 'required',
        'name_bangla' => 'required',
        'date_of_birth' => ['required', 'date'],
        'sex' => 'required',
        'special_child' => 'required',

    ];

    public function mount()
    {
        $this->user_id = Auth::id();
//        dd($this->user_id);
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
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('name_bangla', 'like', '%' . $this->search . '%')
                ->orWhere('date_of_birth', 'like', '%' . $this->search . '%')
                ->orWhere('sex', 'like', '%' . $this->search . '%')
                ->orWhere('special_child', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->paginate);
        return view('livewire.children_information', [
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
        $this->name = $model->name;
        $this->name_bangla = $model->name_bangla;
        $this->date_of_birth = $model->date_of_birth;
        $this->sex = $model->sex;
        $this->special_child = $model->special_child;


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
        $model->name = $this->name;
        $model->name_bangla = $this->name_bangla;
        $model->date_of_birth = $this->date_of_birth;
        $model->sex = $this->sex;
        $model->special_child = $this->special_child;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Children Info Saved Successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
        $this->name = "";
        $this->name_bangla = "";
        $this->date_of_birth = "";
        $this->sex = "";
        $this->special_child = "";

    }


    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);

        $model->user_id = $this->user_id;
        $model->name = $this->name;
        $model->name_bangla = $this->name_bangla;
        $model->date_of_birth = $this->date_of_birth;
        $model->sex = $this->sex;
        $model->special_child = $this->special_child;
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
