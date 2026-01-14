<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dodaj użytkownika
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-3 border border-red-300 bg-red-50 rounded">
                        <ul class="list-disc pl-5 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-100">Imię</label>
                        <input class="w-full border rounded p-2" type="text" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-100">Email</label>
                        <input class="w-full border rounded p-2" type="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-100">Rola</label>
                        <select class="w-full border rounded p-2" name="role" required>
                            <option value="employee" @selected(old('role') === 'employee')>employee</option>
                            <option value="manager" @selected(old('role') === 'manager')>manager</option>
                            <option value="admin" @selected(old('role') === 'admin')>admin</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-100">Hasło (min 8 znaków)</label>
                        <input class="w-full border rounded p-2" type="password" name="password" required>
                    </div>

                    <div class="flex gap-3">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" type="submit">
                            Zapisz
                        </button>

                        <a class="px-4 py-2 border rounded text-gray-800 dark:text-gray-100" href="{{ route('admin.users.index') }}">
                            Anuluj
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
