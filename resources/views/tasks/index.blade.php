<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Your tasks') }}
        </h2>
    </x-slot>
    
    @if(Auth::check() && in_array(Auth::user()->userType->name, ['Client', 'Universal', 'Admin']))
    <div class="d-flex w-100">
    <div class="py-12 flex-1">
        <div>
            <h3 class="p-3 ms-5">My tasks</h3>
            @foreach ($tasks as $task)
                <div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                            <div>
                                <h5>{{ $task->title }}</h5>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                                <small>Expires: {{$task->due_date}}</small>
                                <small>Est. time : {{$task->estimated_time}} hrs</small>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-success ms-3" href="{{ route('tasks.show', $task->id) }}">{{__('View')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("Add new task!") }}
                        <a class="btn btn-sm btn-success ms-3" href="{{ route('tasks.create') }}">+</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(Auth::user()->userType->name == 'Admin' or Auth::user()->userType->name == 'Provider' or Auth::user()->userType->name == 'Universal')
    <div class="py-12 flex-1">
        <div class="d-flex ">
            <h3 class="p-3 ms-5 flex-3">Available tasks</h3>
            <select name="category_id" id="category_id" class="form-select" style="width: 30%;height: 40px">
                <option value="">{{__('Select category')}}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @foreach ($otherTasks as $task)
            <div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                        <div>
                            <h5>{{ $task->title }}</h5>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                            <small>Expires: {{$task->due_date}}</small>
                            <small>Est. time : {{$task->estimated_time}} hrs</small>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-success ms-3" href="{{ route('tasks.show', $task->id) }}">{{__('View')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>
    </div>
</x-app-layout>