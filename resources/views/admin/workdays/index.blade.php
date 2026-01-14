<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Podgląd godzin pracy (admin)
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-3 border border-green-300 bg-green-50 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end" method="GET" action="{{ route('admin.workdays.index') }}">
                    <div>
                        <label class="block text-sm text-gray-800 dark:text-gray-100 mb-1">Miesiąc (YYYY-MM)</label>
                        <input class="border rounded p-2" name="month" value="{{ $month }}" />
                    </div>

                    <div>
                        <label class="block text-sm text-gray-800 dark:text-gray-100 mb-1">Pracownik (opcjonalnie)</label>
                        <select class="border rounded p-2" name="user_id">
                            <option value="">-- wszyscy --</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" @selected((string)$userId === (string)$emp->id)>
                                    {{ $emp->name }} ({{ $emp->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" type="submit">
                        Pokaż
                    </button>
                </form>

                <table class="min-w-full text-sm text-gray-800 dark:text-gray-100">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Pracownik</th>
                            <th class="text-left py-2">Data</th>
                            <th class="text-left py-2">Godziny</th>
                            <th class="text-left py-2">Dodał</th>
                            <th class="text-left py-2">Komentarze</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($days as $day)
                            <tr class="border-b align-top">
                                <td class="py-2">
                                    {{ $day->user->name }}<br>
                                    <span class="text-xs opacity-70">{{ $day->user->email }}</span>
                                </td>
                                <td class="py-2">{{ $day->day }}</td>
                                <td class="py-2">{{ $day->hours }}</td>
                                <td class="py-2">{{ $day->creator?->name ?? '-' }}</td>
                                <td class="py-2">
                                    <div class="space-y-2">
                                        @foreach($day->comments as $comment)
                                            <div class="border rounded p-2">
                                                <div class="text-xs opacity-70">
                                                    {{ $comment->user->name }} • {{ $comment->created_at }}
                                                </div>
                                                <div>{{ $comment->body }}</div>
                                            </div>
                                        @endforeach

                                        <form method="POST" action="{{ route('admin.workdays.comment', $day) }}">
                                            @csrf
                                            <input class="w-full border rounded p-2" name="body" placeholder="Dodaj komentarz..." required>
                                            <button class="mt-2 px-3 py-2 bg-black text-white rounded">Dodaj</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4">Brak wpisów w tym miesiącu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
