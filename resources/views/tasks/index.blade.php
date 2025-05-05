<x-app-layout>
    @if(session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger m-3">
            {{ session('error') }}
        </div>
    @endif
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Опис</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="p-5 d-flex mx-auto w-100 gap-4">
    @if(Auth::check() && in_array(Auth::user()->userType->name, ['Client', 'Universal', 'Admin']))
    <div class="w-50 flex-1">
        <h3 class="mb-4">My tasks</h3>
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-3 d-flex gap-2">
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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="background-color: pink;">Обврска</th>
                    <th style="background-color: pink;">Категорија</th>
                    <th style="background-color: pink;">Опис</th>
                    <th style="background-color: pink;">Надоместок</th>
                    <th style="background-color: pink;">Место</th>
                    <th style="background-color: pink;">Потребна до</th>
                    <th style="background-color: pink;">Потребно време</th>
                    <th style="background-color: pink;">Акција</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>
                        <strong>{{ $task->title }}</strong><br>
                    </td>
                    <td>{{$task->category->name}}</td>
                    <td>
                    <a type="button" href="#" class="desc" data-description="{{ $task->description }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z"/>
                        </svg>
                    </a>

                    </td>
                    <td>{{$task->budget}}</td>
                    <td>{{ $task->location }} </td>
                    <td>{{ $task->due_date }} - {{ $task->due_time }}</td>
                    <td>{{ $task->estimated_time }} hrs</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}"  class="btn btn-sm bg-indigo-400 d-inline-block m-1">Edit</a>
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-red-400 d-inline-block m-1">Delete</button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ __("Add new task!") }}
            <a class="btn btn-sm btn-success ms-2" href="{{ route('tasks.create') }}">+</a>
        </div>
    </div>
    @endif

    @if(Auth::user()->userType->name == 'Admin' or Auth::user()->userType->name == 'Provider' or Auth::user()->userType->name == 'Universal')
    <div class="w-50 flex-1">
        <h3 class="mb-4">Available tasks</h3>
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-3 d-flex gap-2">
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

        <table class="table table-bordered">
            <thead class="bg-danger-subtle">
            <tr>
                    <th style="background-color: pink;">Обврска</th>
                    <th style="background-color: pink;">Категорија</th>
                    <th style="background-color: pink;">Опис</th>
                    <th style="background-color: pink;">Надоместок</th>
                    <th style="background-color: pink;">Место</th>
                    <th style="background-color: pink;">Потребна до</th>
                    <th style="background-color: pink;">Потребно време</th>
                    <th style="background-color: pink;">Корисник</th>
                    <th style="background-color: pink;">Акција</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($otherTasks as $task)
                <tr>
                    <td>
                        <strong>{{ $task->title }}</strong><br>
                    </td>
                    <td>{{$task->category->name}}</td>
                    <td>
                    <a type="button" href="#" class="desc" data-description="{{ $task->description }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z"/>
                        </svg>
                    </a>
                    </td>
                    <td>{{$task->budget}}</td>
                    <td>{{ $task->location }} </td>
                    <td>{{ $task->due_date }} - {{ $task->due_time }}</td>
                    <td>{{ $task->estimated_time }} hrs</td>
                    <td><a href="{{ route('user.show', $task->user_id) }}" class="rounded-circle">{{ __('User') }}</a></td>
                    <td>
                        <button class="btn btn-sm d-inline-block m-1 bg-indigo-400">Accept</button>
                        <button class="btn btn-sm d-inline-block m-1 bg-red-400 ">Reject</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
</x-app-layout>
