<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Publication as Model;


class Publication extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $user_id;
    public $type_of_publication;
    public $description;
    public $date;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;
    public $pubType;
    public $showConfirmDeletePopup = false;

    protected $rules = [
        'user_id' => 'required',
        'type_of_publication' => 'required',
        'description' => 'required',
        'date' => 'required',

    ];

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->pubType = [1 => "Book", 2 => "Journal", 3 => "Periodical", 4 => "Monographs", 5 => "Others"];
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
            $query->where('type_of_publication', 'like', '%' . $this->search . '%')->orWhere('description', 'like', '%' . $this->search . '%')->orWhere('date', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->paginate);
        return view('livewire.publication', [
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
        $this->type_of_publication = $model->type_of_publication;
        $this->description = $model->description;
        $this->date = $model->date;


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
        $model->type_of_publication = $this->type_of_publication;
        $model->description = $this->description;
        $model->date = $this->date;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Record Saved Successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
//        $this->user_id = "";
        $this->type_of_publication = "";
        $this->description = "";
        $this->date = "";

    }


    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);

        $model->user_id = $this->user_id;
        $model->type_of_publication = $this->type_of_publication;
        $model->description = $this->description;
        $model->date = $this->date;
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
