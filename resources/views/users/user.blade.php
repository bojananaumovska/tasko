<x-app-layout>

    <div class="py-12 flex-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg d-flex">
                <img src="{{ $user->image }}" class="rounded-circle m-4">   
                <div>
                <h4 class="p-6 text-gray-900 dark:text-gray-100 h2">
                    {{ $user->name }} 
                </h4>
                <p>{{ $user->email }}</p>
                <p>{{ $user->phone }}</p>
                <p>{{ $user->address }}</p>
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
    </div>

</x-app-layout>
