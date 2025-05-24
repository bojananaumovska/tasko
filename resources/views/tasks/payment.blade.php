<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Симулација на плаќање</h2>

    <form action="{{ route('payments.store', $task->id) }}" method="POST">
        @csrf
        <!-- Task select -->
        <div class="mb-4">
            <label for="task_id" class="block font-semibold mb-1">Име на задача</label>
            <input type="hidden" name="task_id" value="{{$task->id}}" />
            <input value="{{$task->title}}" readonly class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label for="payer_id" class="block font-semibold mb-1">Плаќање од</label>
            <input type="hidden" name="payer_id" value="{{Auth::id()}}" />
            <input value="{{Auth::user()->name}}" readonly class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label for="reciever_id" class="block font-semibold mb-1">Плаќање до</label>
            <input type="hidden" name="receiver_id" value="{{$task->acceptedBy->id}}" />
            <input value="{{$task->acceptedBy->name}}" readonly class="w-full border p-2 rounded">
        </div>
        <!-- Amount -->
        <div class="mb-4">
            <label for="amount" class="block font-semibold mb-1">Износ</label>
            <input type="number" name="budget" id="amount" step="0.01" min="0" class="w-full border p-2 rounded" value="{{$task->budget}}" readonly required>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Симулирај плаќање
        </button>
    </form>
</div>
</x-app-layout>