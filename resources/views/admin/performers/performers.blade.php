<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route('performers') }}" method="GET" class="mb-4 space-y-4">

            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="border p-2">
            <button type="submit" class="bg-blue-500 text-white p-2">Search</button>
        </form>
        <a href="performerCreate" class="dark:text-white">Create performer</a>
        <div class="overflow-x-auto">
            <table class="border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-400 dark:text-white">id:</th>
                        <th class="border border-gray-400 dark:text-white">User_id:</th>
                        <th class="border border-gray-400 dark:text-white">Name:</th>
                        <th class="border border-gray-400 dark:text-white">instagram:</th>
                        <th class="border border-gray-400 dark:text-white">facebook:</th>
                        <th class="border border-gray-400 dark:text-white">x:</th>
                        <th class="border border-gray-400 dark:text-white">youtube:</th>
                        <th class="border border-gray-400 dark:text-white">Created_at:</th>
                        <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                        <th class="border border-gray-400 dark:text-white">Deleted_at:</th>
                        <th class="border border-gray-400 dark:text-white" colspan="3">Act:</th>
                    </tr>
                </thead>
                @foreach ($performers as $performer)
                <tr>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->id }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->user_id }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->name }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->instagram }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->facebook }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->x }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->youtube }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->created_at }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->updated_at }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $performer->deleted_at }}</td>
                    @if ($performer->trashed())
                    <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                        <form action="{{ route("performerRestore", $performer->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="submit" value="Restore">
                        </form>
                    </td>
                    @else
                    <td class="border border-gray-400 dark:text-white">
                        <form action="{{ route("performerDelete", $performer->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="removeButton" value="Remove">
                        </form>
                    </td>
                    <td class="border border-gray-400 dark:text-white"><a href="{{ route("performerEdit", $performer->id) }}">Edit</a></td>
                    @endif
                </tr>
                @endforeach
            </table>
            <div class="mt-4">
                {{ $performers->appends(request()->query())->links() }}
            </div>
        </div>
    </x-slot>
</x-app-layout>