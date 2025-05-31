<x-app-layout>
    @if(session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Welcome on board, Admin") }}
        </h2>
    </x-slot>
    <div class="pt-12 flex-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg d-flex">
                <img src="{{ auth()->user()->image }}" class="rounded-circle m-4 " style="width:150px; height:150px">   
                <div>
                <h4 class="p-6 text-gray-900 dark:text-gray-100 h2">
                    {{ auth()->user()->name }} 
                </h4>
                    <p class="ms-3">
                        Admin
                    </p>                
                </div>
            </div>
        </div>
</div>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 d-flex gap-4">
                    <div class=" flex-1">
                        <p class="h3">All Tasks</p>
                        @foreach($allTasks as $task)
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
                                    <div>
                                        <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-sm btn-primary my-2">Edit</a>
                                        <form action="{{route('tasks.destroy', $task->id)}}" method="post">
                                            @csrf 
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class=" flex-1">
                        <p class="h3">All Users</p>
                        @foreach($allUsers as $user)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between">
                                    <div>
                                        <h5>{{ $user->name }}</h5>
                                        <small>Email: {{ $user->email }}</small><br>
                                        <small>Phone number: {{ $user->phone_number }}</small><br>
                                        <small>Address: {{ $user->address }}</small><br>
                                        <small>Balance: {{ $task->balance }}</small>
                                    </div>
                                    <div>
                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-sm btn-primary my-2">Edit</a>
                                        <form action="{{route('user.destroy', $task->id)}}" method="post">
                                            @csrf 
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>