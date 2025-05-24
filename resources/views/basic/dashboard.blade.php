<x-app-layout>
    @if(session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("You're on board tasker :name!", ['name' => Auth::user()->name]) }}
        </h2>
    </x-slot>

<!--Chat Modal-->
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
                <input type="hidden" name="sender_id" id="sender_id" value="{{Auth::id()}}"> 
                <input type="hidden" name="reciever_id" id="reciever_id" value="">
                <input type="hidden" name="task_id" id="task_id" value="">
                <input class="form-control flex-1" placeholder="Your message" id="message" name="message">
                <button class="btn btn-outline-secondary" type="submit">Send</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!---- Modal for rating -->
<div class="modal fade" id="ratingModal2" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
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
          <input type="hidden" name="rater_user_id" id="rater_user_id2" value="{{ auth()->id() }}">
          <input type="hidden" name="rated_user_id" id="rated_user_id2" value="">
          <input type="hidden" name="task_id" id="task_id2" value="">

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
    <div class="pt-12 flex-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg d-flex">
                <img src="{{ auth()->user()->image }}" class="rounded-circle m-4 " style="width:150px; height:150px">   
                <div>
                <h4 class="p-6 text-gray-900 dark:text-gray-100 h2">
                    {{ auth()->user()->name }} 
                </h4>
                    <p class="ms-3">
                        @auth
                        @switch(auth()->user()->role_id)
                            @case(1)
                                {{ __("Admin") }}
                                @break
                            @case(2)
                                {{ __("Client") }}
                                @break
                            @default
                                {{ __("Provider") }}
                        @endswitch
                        @endauth
                    </p>                
                <p class="ms-3">{{ auth()->user()->email }}</p>
                <p class="ms-3">{{ auth()->user()->phone }}</p>
                <p class="ms-3">{{ auth()->user()->address }}</p>
                <div class="m-3">
                    <p><b>My balance: </b>{{auth()->user()->balance}}</p>
                    <a class="btn btn-sm btn-secondary" href="{{route('user.add-credits', auth()->user()->id)}}">Add credits</a>
                </div>
                </div>
                
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 ">
                    <h4 class="h5">{{ __("Average rating: ") }} @for($i = 0; $i < (int)$average_rating; $i++)
                                            &#9733;
                                        @endfor
                                         ({{ $average_rating }})</h5>

                    <h4 class="h6 m-4">{{ __("My ratings") }}</h4>
                    @foreach ($ratings as $stat)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 m-2">
                            <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between align-items-center">
                                <div>
                                    <h5><a href = "{{ route('user.show', $stat->task->user_id) }}"><b>User:</b> {{ $stat->task->acceptedBy->name }}</a></h5>
                                    <p><b>Task title: </b>{{ $stat->task->title }}</=>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $stat->comment }}</p>
                                </div>
                                <div class="d-flex flex-col align-items-center jusify-content-center">
                                    <h5 class="h5">
                                        @for($i = 0; $i < $stat->rating; $i++)
                                            &#9733;
                                        @endfor
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Активни обврски") }}
                    <div class="flex gap-4">
                    @if(Auth::check() && (auth()->user()->hasRole('client') || auth()->user()->hasRole('admin')))
                            <div class="w-50 flex-1">
                                <h3 class="w-100 p-3">My Active Tasks</h3>
                                @foreach ($activeTasks as $task)
                                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                        <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                                            <div>
                                                <h5>{{ $task->title }}</h5>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                                                <small>User: {{$task->acceptedBy->name}}</small></br>
                                                <small>Expires: {{$task->due_date}}</small></br>
                                                <small>Est. time : {{$task->estimated_time}} hrs</small></br>
                                                <small>Category: {{$task->category->name}}</small>
                                            </div>
                                            <div>
                                                <a class="btn btn-sm btn-warning ms-3 chat" data-task_id = "{{ $task->id }}" data-task_owner_id = "{{ $task->user_id }}" data-task_worker_id = "{{ $task->accepted_by_id }}"  data-current_user_id = "{{ Auth::user()->id }}">{{__('View updates')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            @if(Auth::check() && (auth()->user()->hasRole('provider') || auth()->user()->hasRole('admin')))
                            <div class="w-50 flex-1">
                                <h3 class="w-100 p-3">Tasks I've Accepted</h3>
                                @foreach ($acceptedTasks as $task)
                                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                        <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                                            <div>
                                                <h5>{{ $task->title }}</h5>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                                                <small>User: {{$task->user->name}}</small></br>
                                                <small>Expires: {{$task->due_date}}</small></br>
                                                <small>Est. time : {{$task->estimated_time}} hrs</small></br>
                                                <small>Category: {{$task->category->name}}</small>
                                            </div>
                                            <div>
                                               <button type="submit" class="btn btn-sm btn-info m-2 chat"  data-task_id = "{{ $task->id }}" data-task_worker_id = "{{ $task->accepted_by_id }}" data-task_owner_id = "{{ $task->user_id }}" data-current_user_id = "{{ Auth::user()->id }}">{{__('Post an update')}}</button>
                                                <form method="POST" id="markAsDone" action="{{ route('tasks.markAsDone', $task->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-sm btn-success m-2" type="submit">{{__('Mark as done')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class=" flex-1">
                        <h3 class="w-100 p-3">My older tasks</h3>
                        @if(Auth::check() && (auth()->user()->hasRole('provider') || auth()->user()->hasRole('admin')))
                        @foreach ($completedTasksAsProvider as $task)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                                    <div>
                                        <h5>{{ $task->title }}</h5>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                                        <small>User: {{ $task->user->name }}</small><br>
                                        <small>Expires: {{ $task->due_date }}</small><br>
                                        <small>Est. time: {{ $task->estimated_time }} hrs</small><br>
                                        <small>Category: {{ $task->category->name }}</small>
                                    </div>
                                    @if(Auth::user()->ratingsGiven()->where('task_id', $task->id)->count() == 0)
                                    <div>
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-info m-2 rate2"
                                            data-task_id="{{ $task->id }}"
                                            data-rated_user_id="{{ $task->user_id }}"
                                            data-current_user_id="{{ Auth::user()->id }}"
                                        >
                                            {{ __('Rate the experience') }}
                                        </button>
                                    </div>
                                    @else 
                                    <small>You've already rated this task
                                        <span class="text-success">{{ Auth::user()->ratingsGiven()->where('task_id', $task->id)->first()->rating }}/5</span>
                                    </small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @elseif(Auth::check() && (auth()->user()->hasRole('client') || auth()->user()->hasRole('admin')))
                        @foreach ($completedTasksAsClient as $task)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                                    <div>
                                        <h5>{{ $task->title }}</h5>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                                        <small>User: {{ $task->user->name }}</small><br>
                                        <small>Expires: {{ $task->due_date }}</small><br>
                                        <small>Est. time: {{ $task->estimated_time }} hrs</small><br>
                                        <small>Category: {{ $task->category->name }}</small>
                                    </div>
                                    @if(Auth::user()->ratingsGiven()->where('task_id', $task->id)->count() == 0)
                                    <div>
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-info m-2 rate2"
                                            data-task_id="{{ $task->id }}"
                                            data-rated_user_id="{{ $task->user_id }}"
                                            data-current_user_id="{{ Auth::user()->id }}"
                                        >
                                            {{ __('Rate the experience') }}
                                        </button>
                                    </div>
                                    @else 
                                    <small>You've already rated this task
                                        <span class="text-success">{{ Auth::user()->ratingsGiven()->where('task_id', $task->id)->first()->rating }}/5</span>
                                    </small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @endif
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