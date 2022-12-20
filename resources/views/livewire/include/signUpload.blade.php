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

    <x-jet-label class="font-bold text-center" for="signature" value="{{ __('Signature (80x300px)') }}"/>

    <!-- Current Profile Photo -->
    <div class="mt-2  justify-center" x-show="! signPreview">
        <div class="relative group flex justify-center">
            <img src="{{ $user->signature_url }}" alt="{{ $user->name }}"
                 class="sign">
        </div>
        <div class="relative group flex  justify-center">

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.signature.click()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </x-jet-secondary-button>

            @if ($user->signature_path)
                <x-jet-secondary-button type="button" class="mt-2"
                                        wire:click="deleteProfileSignature('{{$user->signature_url}}')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </x-jet-secondary-button>
            @endif
        </div>

    </div>

    <!-- New Profile Photo Preview -->
    <div class="mt-2  justify-center" x-show="signPreview" style="display: none;">

        <div class="relative group flex justify-center">
            <img x-bind:src="signPreview" alt="{{ $user->name }}"
                 class="sign">
        </div>
        <div class="relative group flex  justify-center">

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.signature.click()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
            </x-jet-secondary-button>

            @if ($user->signature_path)
                <x-jet-secondary-button type="button" class="mt-2"
                                        wire:click="deleteUserSign('{{$user->signature_url}}')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                </x-jet-secondary-button>
            @endif
        </div>

    </div>
    <x-jet-input-error for="signature" class="mt-2"/>
</div>
