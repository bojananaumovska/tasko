<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="w-50 mx-auto my-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('Title') }}</label>
                        <input name="title" id="title" class="form-control" value = "{{ $task->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">{{__('Description')}}</label>
                        <textarea name="description" id="description" class="form-control" rows="2" >{{$task->description}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="budget" class="form-label">{{__('Budget ($)')}}</label>
                        <input name="budget" id="budget" class="form-control" step="0.01" value = "{{ $task->budget }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">{{__('Due Date')}}</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="due_time" class="form-label">{{__('Due Time')}}</label>
                            <input type="time" name="due_time" id="due_time" class="form-control" value="{{ $task->due_time }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">{{__('Location')}}</label>
                        <input name="location" id="location" class="form-control" value="{{ $task->location }}">
                    </div>

                    <div class="mb-3">
                        <label for="estimated_time" class="form-label">{{__('Estimated Time (hrs)')}}</label>
                        <input name="estimated_time" id="estimated_time" class="form-control" step="0.1" value="{{ $task->estimated_time }}">
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">{{__('Category')}}</label>
                        <select name="category_id" id="category_id" class="form-select" >
                            <option value="">{{__('Select category')}}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected($task->category_id == $category->id) >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{__('Save Changes')}}k</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>