<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Foreign_travel as Model;


class Foreign_travel extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $user_id;
    public $country_id;
    public $purpose;
    public $from;
    public $to;
    public $duration;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;

    protected $rules = [
        'user_id' => 'required',
        'country_id' => 'required',
        'purpose' => 'required',
        'from' => 'required',
        'to' => 'required',
        'duration' => 'required',

    ];

    public function changeDuration()
    {
//        if(Carbon::parse($this->from)->greaterThan(Carbon::parse($this->to))){
//           dd('m');
//        }
        $this->duration = Carbon::parse($this->from)->diff(Carbon::parse($this->to))->format('%y -%m-%d');
    }

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->countries = \App\Models\Countries::all()->toArray();
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
            $query->where('country_id', 'like', '%' . $this->search . '%')->orWhere('purpose', 'like', '%' . $this->search . '%')->orWhere('from', 'like', '%' . $this->search . '%')->orWhere('to', 'like', '%' . $this->search . '%')->orWhere('duration', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->paginate);
        return view('livewire.foreign_travel', [
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
        $this->country_id = $model->country_id;
        $this->purpose = $model->purpose;
        $this->from = $model->from;
        $this->to = $model->to;
        $this->duration = $model->duration;


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
        $model->country_id = $this->country_id;
        $model->purpose = $this->purpose;
        $model->from = $this->from;
        $model->to = $this->to;
        $model->duration = $this->duration;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Record Saved Successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
//        $this->user_id = "";
        $this->country_id = "";
        $this->purpose = "";
        $this->from = "";
        $this->to = "";
        $this->duration = "";

    }


    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);

        $model->user_id = $this->user_id;
        $model->country_id = $this->country_id;
        $model->purpose = $this->purpose;
        $model->from = $this->from;
        $model->to = $this->to;
        $model->duration = $this->duration;
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
