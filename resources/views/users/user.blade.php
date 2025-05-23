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
                <div class="p-6 ">
                    <h4 class="h5">{{ __("Average rating: ") }} @for($i = 0; $i < (int)$average_rating; $i++)
                                            &#9733;
                                        @endfor
                                         ({{ $average_rating }})</h5>
                    @if($average_rating != 'No ratings yet')
                    <h4 class="h6">{{ __(":name's ratings", ['name' => $user->name]) }}</h4>
                    @endif
                    @foreach ($ratings as $stat)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 m-2">
                            <div class="p-6 text-gray-900 dark:text-gray-100 d-flex flex-row justify-between align-items-center">
                                <div>
                                    <h5><a href = "{{ route('user.show', $stat->task->user_id) }}"><b>User:</b> {{ $stat->task->user->name }}</a></h5>
                                    <p><b>Task title: </b>{{ $stat->task->title }}</=>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $stat->comment }}</p>
                                </div>
                                <div>
                                    <h5>
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
    </div>

</x-app-layout>
