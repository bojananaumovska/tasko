<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("You're on board tasker :name!", ['name' => Auth::user()->name]) }}
        </h2>
    </x-slot>

    <div class="py-12 flex-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg d-flex">
                <img src="{{ auth()->user()->image }}" class="rounded-circle m-4">   
                <div>
                <h4 class="p-6 text-gray-900 dark:text-gray-100 h2">
                    {{ auth()->user()->name }} 
                </h4>
                <p>{{ auth()->user()->email }}</p>
                <p>{{ auth()->user()->phone }}</p>
                <p>{{ auth()->user()->address }}</p>
                </div>
                
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Stats here") }}
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Активни обврски") }}
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex w-100">
        <div class="py-12 flex-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a class="btn btn-sm btn-success me-3" href="{{ route('tasks.create') }}">+</a>
                        {{ __("Create new task") }}
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12 flex-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a class="btn btn-sm btn-success me-3" href="{{ route('tasks.index') }}">+</a>
                        {{ __("View your tasks") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
