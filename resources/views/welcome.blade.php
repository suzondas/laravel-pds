<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Personal Data Sheet (PDS)</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Styles -->
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</head>
<body class="antialiased m-5">
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <x-jet-application-mark class="block h-9 w-auto"/>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="font-medium text-base text-gray-800">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-responsive-nav-link>
            @else
                <x-jet-responsive-nav-link href="{{ route('login') }}">
                    {{ __('Login') }}
                </x-jet-responsive-nav-link>

                @if (Route::has('register'))
                    <x-jet-responsive-nav-link href="{{ route('register') }}">
                        {{ __('Register') }}
                    </x-jet-responsive-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        {{--<x-jet-application-logo class="block h-12 w-auto" />--}}
    </div>

    <div class="mt-8 text-2xl">
        Welcome to your Personal Data Sheet (PDS) of<br>
        Department of Narcotics Control
    </div>

    <div class="mt-6 text-gray-500">
        It is a questionnaire used by organizations to obtain biographical facts about current or potential employees, including their date of birth, sex, education, occupational history, interests, and health history, etc.
        PDS helps organization in making data driven decision including employees benefits.
    </div>
</div>
</body>
</html>
