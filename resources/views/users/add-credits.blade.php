<x-app-layout>
        <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Симулација на додавање кредити</h2>

    <form action="{{route('user.store-credits', Auth::user()->id)}}" method="POST">
        @csrf
        <!-- Task select -->
        <!-- Amount -->
        <div class="mb-4">
            <label for="amount" class="block font-semibold mb-1">Износ</label>
            <input type="number" name="credits" id="amount" step="0.01" min="0" class="w-full border p-2 rounded" required>
        </div>
        <p class="mb-4">Останати детали...</p>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Симулирај додавање кредити
        </button>
    </form>
</div>
</x-app-layout>