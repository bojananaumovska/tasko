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
    <!--- Modal for description -->
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

<!---- Modal for rating -->
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="{{ route('rating.store') }}">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ratingModalLabel">Оцени го корисникот</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          {{-- Hidden IDs --}}
          <input type="hidden" name="rater_user_id" id="rater_user_id" value="{{ auth()->id() }}">
          <input type="hidden" name="rated_user_id" id="rated_user_id" value="">
          <input type="hidden" name="task_id" id="task_id" value="">

          {{-- Rating (1 to 5 stars or dropdown) --}}
          <div class="mb-3">
            <label for="rating" class="form-label">Оцена (1-5)</label>
            <select class="form-control" name="rating" id="rating" >
              <option value="">Избери оцена</option>
              <option value="1">1 - Лошо</option>
              <option value="2">2</option>
              <option value="3">3 - Просечно</option>
              <option value="4">4</option>
              <option value="5">5 - Одлично</option>
            </select>
          </div>

          {{-- Comment --}}
          <div class="mb-3">
            <label for="comment" class="form-label">Коментар</label>
            <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Поднеси</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Затвори</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--Chat-->

<div class="modal" tabindex="-1" id="chatModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="chat">
          
        </div>
        <div class="input-group mb-3">
            <form class="d-flex w-100 gap-2" method="POST" action="{{route('message.store')}}">
                @csrf
                <input type="hidden" name="task_owner_id" id="task_owner_id" value="{{ auth()->id() }}"> 
                <input type="hidden" name="task_worker_id" id="task_worker_id" value="">
                <input type="hidden" name="task_id" id="task_id" value="">
                <input class="form-control flex-1" placeholder="Your message" id="message" name="message">
                <button class="btn btn-outline-secondary" type="submit">Send</button>
            </form>
        </div>
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
            <select name="category_id_my" class="form-control" style="height: 40px;">
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
                    <th style="background-color: pink;">Статус</th>
                    <th style="background-color: pink;">Акција</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="text-center align-middle">
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
                        @if ($task->status == "pending")
                            <span class="text-info">Pending</span>
                        @elseif($task->status == "in_progress")
                            <span class="text-primary">In progress</span>
                        @else
                            <span class="text-success">Completed</span>
                        @endif
                    </td>
                    <td>
                        @if($task->status == 'pending')  
                        <a href="{{ route('tasks.edit', $task->id) }}"  class="btn btn-sm bg-indigo-400 d-inline-block m-1">Edit</a>
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-red-400 d-inline-block m-1">Delete</button>
                        </form>
                        @elseif($task->status == "completed")
                        <a class="btn btn-sm btn-info d-inline-block m-1 rate"
                         data-rated_user_id = "{{ $task->accepted_by_id }}" data-task_id = "{{ $task->id }}" >Rate the service</a>
                        @else
                        <a class="btn btn-sm btn-success d-inline-block m-1 chat" data-task_id = "{{ $task->id }}" >View updates</a>
                        @endif

                        
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
            <select name="category_id_available" class="form-control" style="height: 40px;">
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
                <tr  class="text-center align-middle">
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
                        <form method="POST" action="{{ route('tasks.accept', $task->id) }}">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm d-inline-block m-1 bg-indigo-400">Accept</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
</x-app-layout>