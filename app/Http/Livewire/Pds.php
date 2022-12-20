<?php

namespace App\Http\Livewire;

use App\Helpers\GetDistrict;
use App\Models\Address_information;
//use App\Models\children_information;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Features;
use Livewire\Component;
use App\Models\General_information;
use App\Models\User;
use Livewire\WithFileUploads;
use App\Traits\HasSignature;
use App\Traits\HasProfilePhoto;

class Pds extends Component
{
    use WithFileUploads;
    use HasSignature;
    use HasProfilePhoto;

    //globals
    public $user;
    public $photo;
    public $signature;
    public $date_of_prl;
    public $district_permanent = null;
    public $degrees;
    public $designations;
    public $ranks;
    public $offices;
//    public $cI;
//    public $children_information;
//    public $deleteChildIndex;
    public $confirmingChildDeletion = false;

    protected $rules = [
        'user.name' => ['required'], //whatever rules you want
        'user.name_bangla' => ['required'],
//        'photo' => ['required', 'mimes:jpg,jpeg,png', 'max:1024'],
//        'signature' => ['required', 'mimes:jpg,jpeg,png', 'max:1024'],

        'general_information.fathers_name' => ['required'],
        'general_information.mothers_name' => ['required'],
        'general_information.date_of_birth' => ['required'],
        'general_information.date_of_prl' => ['required'],
        'general_information.rank' => ['required'],
        'general_information.home_dist' => ['required'],
        'general_information.designation' => ['required'],
        'general_information.office_name' => ['required'],
        'general_information.order_date' => ['required'],
        'general_information.join_date' => ['required'],
        'general_information.gender' => ['required'],
        'general_information.religion' => ['required'],
        'general_information.marital_status' => ['required'],
        'general_information.nid' => ['required', 'integer', 'regex:/^(\d{10}|\d{17})$/'],
        'general_information.freedom_fighter' => ['required'],
        'general_information.email' => ['required', 'email'],
        'general_information.mobile' => ['required', 'max:11'],

        'personal_information.fathers_name_bangla' => ['required'],
        'personal_information.mothers_name_bangla' => ['required'],
        'personal_information.fathers_nid' => '',
        'personal_information.mothers_nid' => '',
        'personal_information.official_mobile' => '',
        'personal_information.official_telephone' => '',
        'personal_information.official_email' => '',
        'personal_information.etin' => '',
        'personal_information.nationality' => ['required'],
        'personal_information.blood_group' => '',
        'personal_information.passport_number' => '',
        'personal_information.passport_exp_date' => '',
        'personal_information.passport_issue_date' => '',
        'personal_information.remarks' => '',

        'address_information.house_permanent' => ['required'],
        'address_information.village_permanent' => ['required'],
        'address_information.post_office_permanent' => ['required'],
        'address_information.upazila_permanent' => ['required'],
        'address_information.district_permanent' => ['required'],
        'address_information.contact_permanent' => '',
        'address_information.house_present' => ['required'],
        'address_information.village_present' => ['required'],
        'address_information.post_office_present' => ['required'],
        'address_information.upazila_present' => ['required'],
        'address_information.district_present' => ['required'],
        'address_information.contact_present' => '',

        'spouse_information.name' => '',
        'spouse_information.name_bangla' => '',
        'spouse_information.nid' => '',
        'spouse_information.designation' => '',
        'spouse_information.occupation' => '',
        'spouse_information.location' => '',
        'spouse_information.home_dist' => '',
        'spouse_information.organization' => '',

//        'children_information.*.name' => ['required'],
//        'children_information.*.name_bangla' => ['required'],
//        'children_information.*.date_of_birth' => ['required'],
//        'children_information.*.sex' => ['required'],
//        'children_information.*.special_child' => ['required', 'integer'],
    ];

    public function change_date_of_prl($val)
    {
        $this->date_of_prl = date('Y-m-d', strtotime("+59 year", strtotime($val)));
        $this->general_information->date_of_prl = date('Y-m-d', strtotime("+59 year", strtotime($val)));
    }

    public function changePermanentDistrict()
    {
        $this->district_permanent = $this->address_information["district_permanent"];
    }

//    public function addChild()
//    {
//        $arr = ["id" => null, "user_id" => Auth::id(), "name" => '', 'name_bangla' => '', 'date_of_birth' => '', 'sex' => '', 'special_child' => ''];
//        array_push($this->children_information, $arr);
////        dd($this->children_information);
//    }
//
//    public function removeChildIndex($index)
//    {
//        $this->deleteChildIndex = $index;
//        $this->confirmingChildDeletion = true;
//    }
//
//    public function removeChild()
//    {
//        if ((isset($this->children_information[$this->deleteChildIndex]['id']))) {
//            children_information::destroy($this->children_information[$this->deleteChildIndex]['id']);
//        }
//        unset($this->children_information[$this->deleteChildIndex]);
//        $this->children_information = array_values($this->children_information);
//        $this->confirmingChildDeletion = false;
//    }


    public function mount()
    {

        $this->user = Auth::user();
        $this->general_information = $this->user->general_information;
        $this->personal_information = $this->user->personal_information;
        $this->address_information = $this->user->address_information;
        $this->spouse_information = $this->user->spouse_information;

//        $this->children_information = $this->user->children_information->toArray();
//        dd($this->children_information);

        /*Custom Model*/
        $this->date_of_prl = \date('Y-m-d');
        if (isset($this->address_information->upazila_permanent)) {
            $this->district_permanent = $this->address_information->district_permanent;
        }
        if (isset($this->general_information->date_of_prl)) {
            $this->date_of_prl = $this->general_information->date_of_prl;
        }
        /*End Custom Model*/

        $this->designations = \App\Models\Designations::all();
//        dd($this->designations);
        $this->degrees = \App\Models\Degrees::all();
        $this->offices = \App\Models\Offices::all();

    }

    public function render()
    {
        return view('livewire.pds');
    }

    public function update()
    {
        $this->general_information->date_of_prl = $this->date_of_prl;
        $this->user->general_information->date_of_prl = $this->date_of_prl;
        $this->validate();

        try {
            $this->user->save();
            /*photo upload*/
            if (isset($this->photo)) {
                $this->updateProfilePhoto($this->photo);
            }

            /*Sign upload*/
            if (isset($this->signature)) {
                $this->updateSignature($this->signature);
            }
            $this->general_information->date_of_prl = $this->date_of_prl;
            $this->general_information->save();
            $this->address_information->save();
            $this->personal_information->save();
            $this->spouse_information->save();
//            children_information::upsert(
//                $this->children_information,
//                ['id', 'user_id'],
//                ['name', 'name_bangla', 'date_of_birth', 'special_child', 'sex', 'updated_at']
//            );

            toastr()->success('Saved successfully');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }

    }


}
