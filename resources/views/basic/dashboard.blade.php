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
                    <div class="flex gap-4">
                    @if(Auth::check() && in_array(Auth::user()->userType->name, ['Client', 'Universal', 'Admin']))
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
                                                <a class="btn btn-sm btn-warning ms-3 chat" data-task_id = "{{ $task->id }}" data-task_worker_id = "{{ $task->accepted_by_id }}"  data-current_user_id = "{{ Auth::user()->id }}">{{__('View updates')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            @if(Auth::check() && in_array(Auth::user()->userType->name, ['Provider', 'Universal', 'Admin']))
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
                                               <button type="submit" class="btn btn-sm btn-info m-2 chat"  data-task_id = "{{ $task->id }}" data-task_worker_id = "{{ $task->accepted_by_id }}" data-current_user_id = "{{ Auth::user()->id }}">{{__('Post an update')}}</button>
                                                <form method="POST" action="{{ route('tasks.markAsDone', $task->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-sm btn-success m-2">{{__('Mark as done')}}</button>
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