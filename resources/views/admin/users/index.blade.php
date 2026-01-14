<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel admina — Użytkownicy
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <div class="mb-4">
                @if (session('success'))
                    <div class="mb-4 p-3 border border-green-300 bg-green-50 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <a class="px-4 py-2 bg-black text-white rounded" href="{{ route('admin.users.create') }}">
                    
                    + Dodaj użytkownika
                </a>
            </div>

                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">ID</th>
                            <th class="text-left py-2">Imię</th>
                            <th class="text-left py-2">Email</th>
                            <th class="text-left py-2">Rola</th>
                            <th class="text-left py-2">Utworzono</th>
                            <<th class="text-left py-2">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b">
                                <td class="py-2">{{ $user->id }}</td>
                                <td class="py-2">{{ $user->name }}</td>
                                <td class="py-2">{{ $user->email }}</td>
                                <td class="py-2">{{ $user->role }}</td>
                                <td class="py-2">{{ $user->created_at }}</td>
                                <td class="py-2">{{ $user->created_at }}</td>
                                <td class="py-2">
                                    <a
                                        href="{{ route('admin.users.edit', $user) }}"
                                        class="text-blue-600 hover:underline mr-3"
                                    >
                                        Edytuj
                                    </a>

                                    <form
                                        action="{{ route('admin.users.destroy', $user) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Na pewno usunąć użytkownika?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600 hover:underline">
                                            Usuń
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
