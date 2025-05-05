<x-app-layout>
<div class="p-5 d-flex mx-auto">
    @if(Auth::check() && in_array(Auth::user()->userType->name, ['Client', 'Universal', 'Admin']))
    <div class="py-12" style="flex: 1;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex-1">
            <h3 class="mb-4">My tasks</h3>
            <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 d-flex gap-2">
                <input name="search_my_tasks" placeholder="Search my tasks..." style="height: 40px;" class="form-control" value="{{ request('search_my_tasks') }}">
                <select name="category_id_my" class="form-select" style="height: 40px;">
                    <option value="">{{__('Select category')}}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id_my') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm btn-primary align-self-center">{{ __('Search') }}</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">{{ __('Clear') }}</a>
            </form>

            @foreach ($tasks as $task)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                        <div>
                            <h5>{{ $task->title }}</h5>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                            <small>Expires: {{$task->due_date}}</small></br>
                            <small>Est. time : {{$task->estimated_time}} hrs</small></br>
                            <small>Category: {{$task->category->name}}</small>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-success ms-3" href="{{ route('tasks.show', $task->id) }}">{{__('View')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-5">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Add new task!") }}
                    <a class="btn btn-sm btn-success ms-3" href="{{ route('tasks.create') }}">+</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->userType->name == 'Admin' or Auth::user()->userType->name == 'Provider' or Auth::user()->userType->name == 'Universal')
    <div class="py-12" style="flex: 1;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex-gro">
            <h3 class="mb-4">Available tasks</h3>
            <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 d-flex gap-2">
                <input name="search_available_tasks" placeholder="Search available tasks..." style="height: 40px;" class="form-control" value="{{ request('search_available_tasks') }}">
                <select name="category_id_available" class="form-select" style="height: 40px;">
                    <option value="">{{__('Select category')}}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id_available') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm btn-primary align-self-center">{{ __('Search') }}</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">{{ __('Clear') }}</a>
            </form>

            @foreach ($otherTasks as $task)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                        <div>
                            <h5>{{ $task->title }}</h5>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                            <small>Expires: {{$task->due_date}}</small></br>
                            <small>Est. time : {{$task->estimated_time}} hrs</small></br>
                            <small>Category: {{$task->category->name}}</small>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-success ms-3" href="{{ route('tasks.show', $task->id) }}">{{__('View')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
</x-app-layout>