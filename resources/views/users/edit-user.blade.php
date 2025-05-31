<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="w-50 mx-auto my-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input name="name" id="name" class="form-control" value = "{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('Email')}}</label>
                        <input name="email" id="email" class="form-control" rows="2" value="{{$user->email}}">
                    </div>

                    <div class="mb-3">
                        <label for="budget" class="form-label">{{__('Phone number')}}</label>
                        <input name="phone_number" id="budget" class="form-control" value = "{{ $user->phone_number}}">
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">{{__('Address')}}</label>
                        <input name="address" id="due_date" class="form-control" value="{{ $user->address }}">
                    </div>

                    <div class="mb-3">
                            <label for="due_time" class="form-label">{{__('Username')}}</label>
                            <input name="username" id="due_time" class="form-control" value="{{ $user->username }}">
                    </div>

                    <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>