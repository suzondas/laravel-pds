<div>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Settings') }}
       </h2>
   </x-slot>
    <div class="sm:p-5 md:p-5 lg:p-8">
        <a href="{{route('countries')}}"><x-jet-secondary-button>Countries</x-jet-secondary-button></a>
        <a href="{{route('degrees')}}"><x-jet-secondary-button>Degrees</x-jet-secondary-button></a>
        <a href="{{route('designations')}}"><x-jet-secondary-button>Designations</x-jet-secondary-button></a>
        <a href="{{route('offices')}}"><x-jet-secondary-button>Offices</x-jet-secondary-button></a>
        <a href="{{route('wings')}}"><x-jet-secondary-button>Wings</x-jet-secondary-button></a>
        <a href="{{route('subwings')}}"><x-jet-secondary-button>Subwings</x-jet-secondary-button></a>
    </div>
</div>
