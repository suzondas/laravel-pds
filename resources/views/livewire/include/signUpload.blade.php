<style>
    .sign {
        height: 40px !important;
        width: 100px !important;
        border:1px solid black;
    }
</style>
<div x-data="{signName: null, signPreview: null}" class="col-span-6 sm:col-span-4">
    <!-- Profile Photo File Input -->
    <input type="file" class="hidden"
           wire:model="signature"
           x-ref="signature"
           x-on:change="
                                    photoName = $refs.signature.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        signPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.signature.files[0]);
                            "/>

    <x-jet-label class="font-bold text-center" for="signature" value="{{ __('Signature') }}"/>

    <!-- Current Profile Photo -->
    <div class="mt-2 flex justify-center" x-show="! signPreview">
        <div class="w-64 relative group flex justify-center">
            <img src="{{ $user->signature_url }}" alt="{{ $user->name }}"
                 class="sign">
            <div class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 bottom-0 flex justify-center items-end text-xl bg-gray-200 text-black font-semibold">

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.signature.click()">
                    {{ __('Select A New Signature') }}
                </x-jet-secondary-button>

                @if ($user->signature_path)
                    <x-jet-secondary-button type="button" class="mt-2"
                                            wire:click="deleteProfileSignature('{{$user->signature_url}}')">
                        {{ __('Remove Signature') }}
                    </x-jet-secondary-button>
                @endif
            </div>
        </div>
    </div>

    <!-- New Profile Photo Preview -->
    <div class="mt-2 flex justify-center" x-show="signPreview" style="display: none;">

        <div class="w-64 relative group flex justify-center">
            <img x-bind:src="signPreview" alt="{{ $user->name }}"
                 class="sign">

            <div class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 bottom-0 flex justify-center items-end text-xl bg-gray-200 text-black font-semibold">

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.signature.click()">
                    {{ __('Select A New Signature') }}
                </x-jet-secondary-button>

                @if ($user->signature_path)
                    <x-jet-secondary-button type="button" class="mt-2"
                                            wire:click="deleteUserSign('{{$user->signature_url}}')">
                        {{ __('Remove Signature') }}
                    </x-jet-secondary-button>
                @endif
            </div>
        </div>
    </div>
    <x-jet-input-error for="signature" class="mt-2"/>
</div>
