<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Language_information as Model;


class Language_information extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $user_id;
    public $language;
    public $read;
    public $write;
    public $speak;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;
    public $langauge_helper = [1 => "English", 2 => "Bangla", 3 => "Spanish", 4 => "Arabic", 5 => "Hindi"];
    public $langauge_skill_helper = [1 => "Below Average", 2 => "Average", 3 => "Proficient"];
    protected $rules = [
        'user_id' => 'required',
        'language' => 'required',
        'read' => ['required', 'integer'],
        'write' => 'required',
        'speak' => 'required',

    ];

    public function mount()
    {
        $this->user_id = Auth::id();

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
            $query->where('language', 'like', '%' . $this->search . '%')
                ->orWhere('read', 'like', '%' . $this->search . '%')
                ->orWhere('write', 'like', '%' . $this->search . '%')
                ->orWhere('speak', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->paginate);
        return view('livewire.language_information', [
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
        $this->language = $model->language;
        $this->read = $model->read;
        $this->write = $model->write;
        $this->speak = $model->speak;


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
        $model->language = $this->language;
        $model->read = $this->read;
        $model->write = $this->write;
        $model->speak = $this->speak;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Record Saved Successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
//        $this->user_id = "";
        $this->language = "";
        $this->read = "";
        $this->write = "";
        $this->speak = "";

    }


    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);

        $model->user_id = $this->user_id;
        $model->language = $this->language;
        $model->read = $this->read;
        $model->write = $this->write;
        $model->speak = $this->speak;
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
