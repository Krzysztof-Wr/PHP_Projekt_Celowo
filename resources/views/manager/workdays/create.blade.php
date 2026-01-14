<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dodaj godziny pracownikowi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-3 border border-green-300 bg-green-50 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 border border-red-300 bg-red-50 rounded">
                        <ul class="list-disc pl-5 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('manager.workdays.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-100">Pracownik</label>
                        <select class="w-full border rounded p-2" name="user_id" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-100">Dzień</label>
                        <input class="w-full border rounded p-2" type="date" name="day" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-100">Godziny (0–24)</label>
                        <input class="w-full border rounded p-2" type="number" name="hours" min="0" max="24" required>
                    </div>

                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" type="submit">
                        Zapisz
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
