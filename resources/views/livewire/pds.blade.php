<div class="pattern">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Personal Data Sheet') }}
        </h2>
    </x-slot>
    <div class="flex flex-col p-5" id="basic">
        <div class="p-5 bg-white shadow">
            <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-2">
                <div class="grid grid-cols-2 col-span-2">
                    <x-jet-label class="font-bold" value="{{ __('Employee ID:') }}"/>
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                        <x-jet-label value="{{$user->empid}}"/>
                    </span>

                    <x-jet-label class="font-bold" for="name" value="{{ __('Name English:') }}"/>

                    <x-jet-input id="name" type="text" class="mt-1 block w-full"
                                 wire:model.defer="user.name" autocomplete="name"/>
                    <x-jet-input-error for="user.name" class="mt-2"/>

                    <x-jet-label class="font-bold" for="name_bangla" value="{{ __('Name Bangla:') }}"/>
                    <x-jet-input id="name_bangla" type="text"
                                 class="mt-1 block w-full disabled:opacity-25"
                                 wire:model.defer="user.name_bangla" autocomplete="name_bangla"/>
                    <x-jet-input-error for="user.name_bangla" class="mt-2"/>
                </div>
                <div class="grid grid-cols-2 col-span-2">
                    <div class="grid-cols-1">@include('livewire.include.photoUpload')</div>
                    <div class="grid-cols-1">@include('livewire.include.signUpload')</div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col p-5" id="general">
        <div class="p-5 bg-white shadow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-3 text-center bg-gray-50">
                {{ __('General Information') }}
            </h2>
            <div class="pt-2 grid md:grid-cols-4 gap-4 uppercase {{--text-right--}} items-center">
                <x-jet-label for="fathers_name" value="{{ __('fathers_name') }}"/>
                <x-jet-input id="fathers_name" type="text" class="mt-1 block w-full"
                             wire:model.defer="general_information.fathers_name" autocomplete="fathers_name"/>
                <x-jet-input-error for="general_information.fathers_name" class="mt-2"/>

                <x-jet-label for="mothers_name" value="{{ __('mothers_name') }}"/>
                <x-jet-input id="mothers_name" type="text" class="mt-1 block w-full"
                             wire:model.defer="general_information.mothers_name" autocomplete="mothers_name"/>
                <x-jet-input-error for="general_information.mothers_name" class="mt-2"/>

                <x-jet-label for="date_of_birth" value="{{ __('date_of_birth') }}"/>
                <x-jet-input id="date_of_birth" type="date" class="mt-1 block w-full"
                             wire:change="change_date_of_prl($event.target.value)"
                             wire:model.defer="general_information.date_of_birth" autocomplete="date_of_birth"/>
                <x-jet-input-error for="general_information.date_of_birth" class="mt-2"/>

                <x-jet-label for="date_of_prl" value="{{ __('date_of_prl') }}"/>
                <x-jet-input id="date_of_prl" type="date" class="mt-1 block w-full"
                             wire:model.defer="date_of_prl" autocomplete="date_of_prl" disabled/>
                <x-jet-input-error for="date_of_prl" class="mt-2"/>

                <x-jet-label for="rank" value="{{ __('Rank') }}"/>
                <select wire:model.defer="general_information.rank">
                    <option value="1">AD Sec</option>
                </select>
                <x-jet-input-error for="general_information.rank" class="mt-2"/>

                <x-jet-label for="home_dist" value="{{ __('home_dist') }}"/>
                <select class="mt-1 block w-full" wire:model.defer="general_information.home_dist" id="home_dist">
                    @foreach(\App\Helpers\GetDistrict::GetAllDistricts() as $key=>$val)
                        <option value="{{__($val->DISTRICT_ID )}}">{{__($val->DISTRICT_NAME)}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="general_information.home_dist" class="mt-2"/>

                <x-jet-label for="designation" value="{{ __('designation') }}"/>
                <select wire:model.defer="general_information.designation">
                    <option value="1">AD</option>
                </select>
                <x-jet-input-error for="general_information.designation" class="mt-2"/>

                <x-jet-label for="office_name" value="{{ __('office_name') }}"/>
                <select wire:model.defer="general_information.office_name">
                    <option value="1">HQ</option>
                </select>
                <x-jet-input-error for="general_information.office_name" class="mt-2"/>

                <x-jet-label for="order_date" value="{{ __('order_date') }}"/>
                <x-jet-input id="order_date" type="date" class="mt-1 block w-full"
                             wire:model.defer="general_information.order_date" autocomplete="order_date"/>
                <x-jet-input-error for="general_information.order_date" class="mt-2"/>

                <x-jet-label for="join_date" value="{{ __('join_date') }}"/>
                <x-jet-input id="join_date" type="date" class="mt-1 block w-full"
                             wire:model.defer="general_information.join_date" autocomplete="join_date"/>
                <x-jet-input-error for="general_information.join_date" class="mt-2"/>

                <x-jet-label for="gender" value="{{ __('gender') }}"/>
                <select class="mt-1 block w-full" wire:model.defer="general_information.gender">
                    <option value="1" selected>Male</option>
                    <option value="2">Female</option>
                </select>
                <x-jet-input-error for="general_information.gender" class="mt-2"/>

                <x-jet-label for="religion" value="{{ __('religion') }}"/>
                <select class="mt-1 block w-full" wire:model.defer="general_information.religion">
                    <option>select</option>
                    <option value="1">Islam</option>
                    <option value="2">Hinduism</option>
                    <option value="3">Christianity</option>
                    <option value="4">Bhuddism</option>
                    <option value="5">Other</option>
                </select>
                <x-jet-input-error for="general_information.religion" class="mt-2"/>

                <x-jet-label for="marital_status" value="{{ __('marital_status') }}"/>
                <select class="mt-1 block w-full" wire:model.defer="general_information.marital_status">
                    <option value="2">Single</option>
                    <option value="1">Married</option>
                    <option value="3">Unmarried</option>
                </select>
                <x-jet-input-error for="general_information.marital_status" class="mt-2"/>

                <x-jet-label for="nid" value="{{ __('nid') }}"/>
                <x-jet-input id="nid" type="number" class="mt-1 block w-full"
                             wire:model.defer="general_information.nid" autocomplete="nid"/>
                <x-jet-input-error for="general_information.nid" class="mt-2"/>

                <x-jet-label for="freedom_fighter" value="{{ __('freedom_fighter') }}"/>
                <select class="mt-1 block w-full" wire:model.defer="general_information.freedom_fighter">
                    <option value="">Select</option>
                    <option value="1">None</option>
                    <option value="2">Freedom Fighter</option>
                    <option value="3">Son/Daughter of Freedom Fighter</option>
                    <option value="4">Grand Son/Grand Daughter of Freedom
                        Fighter
                    </option>
                </select>
                <x-jet-input-error for="general_information.freedom_fighter" class="mt-2"/>

                <x-jet-label for="email" value="{{ __('email') }}"/>
                <x-jet-input id="email" type="email" class="mt-1 block w-full"
                             wire:model.defer="general_information.email" autocomplete="email"/>
                <x-jet-input-error for="general_information.email" class="mt-2"/>

                <x-jet-label for="mobile" value="{{ __('mobile') }}"/>
                <x-jet-input id="mobile" type="tel" class="mt-1 block w-full"
                             wire:model.defer="general_information.mobile" autocomplete="mobile"/>
                <x-jet-input-error for="general_information.mobile" class="mt-2"/>

            </div>
        </div>
    </div>
    <div class="flex flex-col p-5" id="personal_information">
        <div class="p-5 bg-white shadow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-3 text-center bg-gray-50">
                {{ __('Personal Information') }}
            </h2>
            <div class="pt-2 grid md:grid-cols-4 gap-4 uppercase {{--text-right--}} items-center">
                <x-jet-label class="font-bold" for="fathers_name_bangla" value="{{ __('fathers_name_bangla:') }}"/>
                <x-jet-input id="fathers_name_bangla" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.fathers_name_bangla"
                             autocomplete="fathers_name_bangla"/>
                <x-jet-input-error for="personal_information.fathers_name_bangla" class="mt-2"/>

                <x-jet-label class="font-bold" for="mothers_name_bangla" value="{{ __('mothers_name_bangla:') }}"/>
                <x-jet-input id="mothers_name_bangla" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.mothers_name_bangla"
                             autocomplete="mothers_name_bangla"/>
                <x-jet-input-error for="personal_information.mothers_name_bangla" class="mt-2"/>

                <x-jet-label class="font-bold" for="fathers_nid" value="{{ __('fathers_nid:') }}"/>
                <x-jet-input id="fathers_nid" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.fathers_nid" autocomplete="fathers_nid"/>
                <x-jet-input-error for="personal_information.fathers_nid" class="mt-2"/>

                <x-jet-label class="font-bold" for="mothers_nid" value="{{ __('mothers_nid:') }}"/>
                <x-jet-input id="mothers_nid" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.mothers_nid" autocomplete="mothers_nid"/>
                <x-jet-input-error for="personal_information.mothers_nid" class="mt-2"/>

                <x-jet-label class="font-bold" for="official_mobile" value="{{ __('official_mobile:') }}"/>
                <x-jet-input id="official_mobile" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.official_mobile" autocomplete="official_mobile"/>
                <x-jet-input-error for="personal_information.official_mobile" class="mt-2"/>

                <x-jet-label class="font-bold" for="official_telephone" value="{{ __('official_telephone:') }}"/>
                <x-jet-input id="official_telephone" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.official_telephone"
                             autocomplete="official_telephone"/>
                <x-jet-input-error for="personal_information.official_telephone" class="mt-2"/>

                <x-jet-label class="font-bold" for="official_email" value="{{ __('official_email:') }}"/>
                <x-jet-input id="official_email" type="email" class="mt-1 block w-full"
                             wire:model.defer="personal_information.official_email" autocomplete="official_email"/>
                <x-jet-input-error for="personal_information.official_email" class="mt-2"/>

                <x-jet-label class="font-bold" for="etin" value="{{ __('etin:') }}"/>
                <x-jet-input id="etin" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.etin" autocomplete="etin"/>
                <x-jet-input-error for="personal_information.etin" class="mt-2"/>

                <x-jet-label class="font-bold" for="nationality" value="{{ __('nationality:') }}"/>
                <x-jet-input id="nationality" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.nationality" autocomplete="nationality"/>
                <x-jet-input-error for="personal_information.nationality" class="mt-2"/>

                <x-jet-label class="font-bold" for="blood_group" value="{{ __('blood_group:') }}"/>
                <select wire:model.defer="personal_information.blood_group">
                    <option>Select</option>
                    <option value="1">A+</option>
                    <option value="2">A-</option>
                    <option value="3">B+</option>
                    <option value="4">B-</option>
                    <option value="5">O+</option>
                    <option value="6">O-</option>
                    <option value="7">AB+</option>
                    <option value="8">AB-</option>
                </select>
                <x-jet-input-error for="personal_information.blood_group" class="mt-2"/>

                <x-jet-label class="font-bold" for="passport_number" value="{{ __('passport_number:') }}"/>
                <x-jet-input id="passport_number" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.passport_number" autocomplete="passport_number"/>
                <x-jet-input-error for="personal_information.passport_number" class="mt-2"/>

                {{--  <x-jet-label class="font-bold" for="signature" value="{{ __('signature:') }}"/>
                  <x-jet-input id="signature" type="text" class="mt-1 block w-full"
                               wire:model.defer="personal_information.signature" autocomplete="signature"/>
                  <x-jet-input-error for="personal_information.signature" class="mt-2"/>--}}

                <x-jet-label class="font-bold" for="passport_exp_date" value="{{ __('passport_exp_date:') }}"/>
                <x-jet-input id="passport_exp_date" type="date" class="mt-1 block w-full"
                             wire:model.defer="personal_information.passport_exp_date"
                             autocomplete="passport_exp_date"/>
                <x-jet-input-error for="personal_information.passport_exp_date" class="mt-2"/>

                <x-jet-label class="font-bold" for="passport_issue_date" value="{{ __('passport_issue_date:') }}"/>
                <x-jet-input id="passport_issue_date" type="date" class="mt-1 block w-full"
                             wire:model.defer="personal_information.passport_issue_date"
                             autocomplete="passport_issue_date"/>
                <x-jet-input-error for="personal_information.passport_issue_date" class="mt-2"/>

                <x-jet-label class="font-bold" for="remarks" value="{{ __('remarks:') }}"/>
                <x-jet-input id="remarks" type="text" class="mt-1 block w-full"
                             wire:model.defer="personal_information.remarks" autocomplete="remarks"/>
                <x-jet-input-error for="personal_information.remarks" class="mt-2"/>
            </div>
        </div>
    </div>
    <div class="flex flex-col p-5" id="spouse_information">
        <div class="p-5 bg-white shadow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-3 text-center bg-gray-50">
                {{ __('Spouse Information') }}
            </h2>
            <div class="pt-2 grid md:grid-cols-4 gap-4 uppercase {{--text-right--}} items-center">
                <x-jet-label for="spouse_information.name" value="{{ __('Name(English)') }}"/>
                <x-jet-input id="spouse_information.name" type="text" class="mt-1 block w-full"
                             wire:model.defer="spouse_information.name" autocomplete="spouse_information.name"/>
                <x-jet-input-error for="spouse_information.name" class="mt-2"/>

                <x-jet-label for="spouse_information.name_bangla" value="{{ __('Name(Bangla)') }}"/>
                <x-jet-input id="spouse_information.name_bangla" type="text" class="mt-1 block w-full"
                             wire:model.defer="spouse_information.name_bangla"
                             autocomplete="spouse_information.name_bangla"/>
                <x-jet-input-error for="spouse_information.name_bangla" class="mt-2"/>

                <x-jet-label for="spouse_information.nid" value="{{ __('NID') }}"/>
                <x-jet-input id="spouse_information.nid" type="text" class="mt-1 block w-full"
                             wire:model.defer="spouse_information.nid" autocomplete="spouse_information.nid"/>
                <x-jet-input-error for="spouse_information.nid" class="mt-2"/>

                <x-jet-label for="spouse_information.home_dist" value="{{ __('home_dist') }}"/>
                <select class="mt-1 block w-full" wire:model.defer="spouse_information.home_dist" id="home_dist">
                    @foreach(\App\Helpers\GetDistrict::GetAllDistricts() as $key=>$val)
                        <option value="{{__($val->DISTRICT_ID )}}">{{__($val->DISTRICT_NAME)}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="spouse_information.home_dist" class="mt-2"/>

                <x-jet-label for="spouse_information.occupation" value="{{ __('occupation') }}"/>
                <x-jet-input id="spouse_information.occupation" type="text" class="mt-1 block w-full"
                             wire:model.defer="spouse_information.occupation"
                             autocomplete="spouse_information.occupation"/>
                <x-jet-input-error for="spouse_information.occupation" class="mt-2"/>

                <x-jet-label for="spouse_information.designation" value="{{ __('Designation') }}"/>
                <x-jet-input id="spouse_information.designation" type="text" class="mt-1 block w-full"
                             wire:model.defer="spouse_information.designation"
                             autocomplete="spouse_information.designation"/>
                <x-jet-input-error for="spouse_information.designation" class="mt-2"/>

                <x-jet-label for="spouse_information.organization" value="{{ __('organization') }}"/>
                <x-jet-input id="spouse_information.organization" type="text" class="mt-1 block w-full"
                             wire:model.defer="spouse_information.organization"
                             autocomplete="spouse_information.organization"/>
                <x-jet-input-error for="spouse_information.organization" class="mt-2"/>

                <x-jet-label for="spouse_information.location" value="{{ __('Job location') }}"/>
                <x-jet-input id="spouse_information.location" type="text" class="mt-1 block w-full"
                             wire:model.defer="spouse_information.location" autocomplete="spouse_information.location"/>
                <x-jet-input-error for="spouse_information.location" class="mt-2"/>
            </div>
        </div>
    </div>
    <div class="flex flex-col p-5" id="address_information">
        <div class="p-5 bg-white shadow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-3 text-center bg-gray-50">
                {{ __('Address Information') }}
            </h2>
            <div class="pt-2 grid md:grid-cols-4 gap-4 uppercase {{--text-right--}} items-center">
                <x-jet-label for="house_permanent" value="{{ __('house_permanent') }}"/>
                <x-jet-input id="house_permanent" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.house_permanent" autocomplete="house_permanent"/>
                <x-jet-input-error for="address_information.house_permanent" class="mt-2"/>

                <x-jet-label for="village_permanent" value="{{ __('village_permanent') }}"/>
                <x-jet-input id="village_permanent" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.village_permanent" autocomplete="village_permanent"/>
                <x-jet-input-error for="address_information.village_permanent" class="mt-2"/>

                <x-jet-label for="post_office_permanent" value="{{ __('post_office_permanent') }}"/>
                <x-jet-input id="post_office_permanent" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.post_office_permanent"
                             autocomplete="post_office_permanent"/>
                <x-jet-input-error for="address_information.post_office_permanent" class="mt-2"/>

                <x-jet-label for="district_permanent" value="{{ __('district_permanent') }}"/>
                <select class="mt-1 block w-full" wire:model.defer="address_information.district_permanent"
                        id="district_permanent" wire:change="changePermanentDistrict()">
                    <option>Select</option>
                    @foreach(\App\Helpers\GetDistrict::GetAllDistricts() as $key=>$val)
                        <option value="{{__($val->DISTRICT_ID )}}">{{__($val->DISTRICT_NAME)}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="address_information.district_permanent" class="mt-2"/>

                <x-jet-label for="upazila_permanent" value="{{ __('upazila_permanent') }}"/>
                <select class="mt-1 block w-full" wire:model.defer="address_information.upazila_permanent"
                        id="upazila_permanent">
                    @foreach(\App\Helpers\GetThanas::GetThanas($district_permanent) as $key=>$val)
                        <option value="{{__($val->THANA_ID )}}">{{__($val->THANA_NAME)}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="address_information.upazila_permanent" class="mt-2"/>

                <x-jet-label for="contact_permanent" value="{{ __('contact_permanent') }}"/>
                <x-jet-input id="contact_permanent" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.contact_permanent" autocomplete="contact_permanent"/>
                <x-jet-input-error for="address_information.contact_permanent" class="mt-2"/>

                <x-jet-label for="house_present" value="{{ __('house_present') }}"/>
                <x-jet-input id="house_present" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.house_present" autocomplete="house_present"/>
                <x-jet-input-error for="address_information.house_present" class="mt-2"/>

                <x-jet-label for="village_present" value="{{ __('village_present') }}"/>
                <x-jet-input id="village_present" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.village_present" autocomplete="village_present"/>
                <x-jet-input-error for="address_information.village_present" class="mt-2"/>

                <x-jet-label for="post_office_present" value="{{ __('post_office_present') }}"/>
                <x-jet-input id="post_office_present" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.post_office_present"
                             autocomplete="post_office_present"/>
                <x-jet-input-error for="address_information.post_office_present" class="mt-2"/>

                <x-jet-label for="district_present" value="{{ __('district_present') }}"/>
                <x-jet-input id="district_present" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.district_present" autocomplete="district_present"/>
                <x-jet-input-error for="address_information.district_present" class="mt-2"/>

                <x-jet-label for="upazila_present" value="{{ __('upazila_present') }}"/>
                <x-jet-input id="upazila_present" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.upazila_present" autocomplete="upazila_present"/>
                <x-jet-input-error for="address_information.upazila_present" class="mt-2"/>

                <x-jet-label for="contact_present" value="{{ __('contact_present') }}"/>
                <x-jet-input id="contact_present" type="text" class="mt-1 block w-full"
                             wire:model.defer="address_information.contact_present" autocomplete="contact_present"/>
                <x-jet-input-error for="address_information.contact_present" class="mt-2"/>
            </div>
        </div>
    </div>
    <style>
        .pattern {
            background-color: rgb(223, 219, 229);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 48 48'%3E%3Cg fill='%239C92AC' fill-opacity='0.4'%3E%3Cpath d='M12 0h18v6h6v6h6v18h-6v6h-6v6H12v-6H6v-6H0V12h6V6h6V0zm12 6h-6v6h-6v6H6v6h6v6h6v6h6v-6h6v-6h6v-6h-6v-6h-6V6zm-6 12h6v6h-6v-6zm24 24h6v6h-6v-6z'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
    {{--Commented out Children custom work--}}
   {{-- <div class="p-5 flex flex-col" id="children_information">
        <div class="p-5 bg-white shadow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-3 text-center bg-gray-50">
                {{ __('Children Information') }}
            </h2>
            <div class="pt-2 uppercase --}}{{--text-right--}}{{-- items-center">
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-2">
                    <x-jet-label class="col-span-1">Sl.</x-jet-label>
                    <x-jet-label class="col-span-2">Name</x-jet-label>
                    <x-jet-label class="col-span-2">Name (Bangla)</x-jet-label>
                    <x-jet-label class="col-span-2">Date of Birth</x-jet-label>
                    <x-jet-label class="col-span-2">Sex</x-jet-label>
                    <x-jet-label class="col-span-2">Special Child?</x-jet-label>
                    <x-jet-label class="col-span-1">Action</x-jet-label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-2">
                    @foreach($children_information as $key=>$child)
                        <div class="col-span-1">#{{$key+1}}</div>
                        <x-jet-input id="children_information.{{$key}}.name" type="text"
                                     class="col-span-2 mt-1 block w-full"
                                     wire:model.defer="children_information.{{$key}}.name"
                                     autocomplete="children_information.{{$key}}.name"/>
                        <x-jet-input-error for="children_information.{{$key}}.name" class="mt-2"/>

                        <x-jet-input id="children_information.{{$key}}.name_bangla" type="text"
                                     class="col-span-2 mt-1 block w-full"
                                     wire:model.defer="children_information.{{$key}}.name_bangla"
                                     autocomplete="children_information.{{$key}}.name_bangla"/>
                        <x-jet-input-error for="children_information.{{$key}}.name_bangla" class="mt-2"/>

                        <x-jet-input id="children_information.{{$key}}.date_of_birth" type="date"
                                     class="col-span-2 mt-1 block w-full"
                                     wire:model.defer="children_information.{{$key}}.date_of_birth"
                                     autocomplete="children_information.{{$key}}.date_of_birth"/>
                        <x-jet-input-error for="children_information.{{$key}}.date_of_birth" class="mt-2"/>

                        <select wire:model.defer="children_information.{{$key}}.sex" class="col-span-2">
                            <option>Select</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        <x-jet-input-error for="children_information.{{$key}}.sex" class="mt-2"/>

                        <select wire:model.defer="children_information.{{$key}}.special_child" class="col-span-2">
                            <option>Select</option>
                            <option value="1">No</option>
                            <option value="2">Yes</option>
                        </select>
                        <x-jet-input-error for="children_information.{{$key}}.special_child" class="mt-2"/>

                        <x-jet-danger-button class="grid place-items-center text-red-600 bg-blue-100"
                                             wire:click="removeChildIndex({{$key}})" class="col-span-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                            </svg>
                        </x-jet-danger-button>
                    @endforeach
                </div>
            </div>
            <x-jet-secondary-button wire:click="addChild()"
                                    class="mt-5">
                {{ __('+ Add') }}
            </x-jet-secondary-button>
        </div>
    </div>--}}
    <livewire:children_information></livewire:children_information>
    <livewire:language_information></livewire:language_information>
    <livewire:educational_qualification></livewire:educational_qualification>
    <livewire:local_training></livewire:local_training>
    <livewire:foreign_training></livewire:foreign_training>
    <livewire:foreign_travel></livewire:foreign_travel>
    <livewire:publication></livewire:publication>
    <livewire:honors_award></livewire:honors_award>
    <livewire:service_history></livewire:service_history>
    <div class="bg-blue-100 p-3">
        <x-jet-button wire:loading.attr="disabled" wire:click="update"
                      class="container mx-0 min-w-full grid place-items-center">
            {{ __('Update') }}
        </x-jet-button>

    </div>

    <x-jet-confirmation-modal wire:model="confirmingChildDeletion">
        <x-slot name="title">
            Delete Children
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete Children?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingChildDeletion')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="removeChild" wire:loading.attr="disabled">
                Delete Account
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>

