<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route('users') }}" method="GET" class="mb-4 space-y-4">

            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="border p-2">

            <button type="submit" class="bg-blue-500 text-white p-2">Search</button>
        </form>

        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">id:</th>
                    <th class="border border-gray-400 dark:text-white">name:</th>
                    <th class="border border-gray-400 dark:text-white">surname:</th>
                    <th class="border border-gray-400 dark:text-white">email:</th>
                    <th class="border border-gray-400 dark:text-white">phone:</th>
                    <th class="border border-gray-400 dark:text-white">rank:</th>
                    <th class="border border-gray-400 dark:text-white">exp:</th>
                    <th class="border border-gray-400 dark:text-white">role:</th>
                    <th class="border border-gray-400 dark:text-white">Created_at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                    <th class="border border-gray-400 dark:text-white">Deleted_at:</th>
                    <th class="border border-gray-400 dark:text-white" colspan="2">Act:</th>
                </tr>
            </thead>
            @foreach ($users as $user)
            <tr>
                <td class="border border-gray-400 dark:text-white">{{ $user->id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->name }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->surname }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->email }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->phone }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->rank }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->exp }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->role }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->created_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->updated_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $user->deleted_at }}</td>
                @if ($user->trashed())
                <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                    <form action="{{ route("userRestore", $user->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="submit" value="Restore">
                    </form>
                </td>
                @else
                <td class="border border-gray-400 dark:text-white">
                    <form action="{{ route("userDelete", $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Remove">
                    </form>
                </td>
                <td class="border border-gray-400 dark:text-white"><a href="{{ route("userEdit", $user->id) }}">Edit</a></td>
                @endif
            </tr>
            @endforeach
        </table>
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </x-slot>
</x-app-layout>