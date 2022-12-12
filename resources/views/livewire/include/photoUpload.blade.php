@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
    <style>
        .pds_photo{
            height: 100px !important;
            width:100px !important;
            border: 1px solid black;
        }
    </style>
    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
        <!-- Profile Photo File Input -->
        <input type="file" class="hidden"
               wire:model="photo"
               x-ref="photo"
               x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>

        <x-jet-label class="font-bold text-center"  for="photo" value="{{ __('Photo') }}"/>

        <!-- Current Profile Photo -->
        <div class="mt-2 flex justify-center" x-show="! photoPreview">
            <div class="w-64 relative group flex justify-center">
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                     class="pds_photo">
                <div class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 bottom-0 flex justify-center items-end text-xl bg-gray-200 text-black font-semibold">

                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-jet-secondary-button>

                    @if ($user->profile_photo_path)
                        <x-jet-secondary-button type="button" class="mt-2"
                                                wire:click="deleteUserPhoto('{{$user->profile_photo_url}}')">
                            {{ __('Remove Photo') }}
                        </x-jet-secondary-button>
                    @endif
                </div>
            </div>
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2 flex justify-center" x-show="photoPreview" style="display: none;">

            <div class="w-64 relative group flex justify-center">
                <img x-bind:src="photoPreview" alt="{{ $user->name }}"
                     class="pds_photo">

                <div class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 bottom-0 flex justify-center items-end text-xl bg-gray-200 text-black font-semibold">

                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-jet-secondary-button>

                    @if ($user->profile_photo_path)
                        <x-jet-secondary-button type="button" class="mt-2"
                                                wire:click="deleteUserPhoto('{{$user->profile_photo_url}}')">
                            {{ __('Remove Photo') }}
                        </x-jet-secondary-button>
                    @endif
                </div>
            </div>
        </div>
        <x-jet-input-error for="photo" class="mt-2"/>
    </div>
@endif
