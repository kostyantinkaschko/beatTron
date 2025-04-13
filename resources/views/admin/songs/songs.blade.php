<x-app-layout>
    <x-slot name="slot">
        <a href="songCreate" class="dark:text-white">Create song</a>
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">id:</th>
                    <th class="border border-gray-400 dark:text-white">genre_id:</th>
                    <th class="border border-gray-400 dark:text-white">performer_id:</th>
                    <th class="border border-gray-400 dark:text-white">name:</th>
                    <th class="border border-gray-400 dark:text-white">listening_count:</th>
                    <th class="border border-gray-400 dark:text-white">year:</th>
                    <th class="border border-gray-400 dark:text-white">status:</th>
                    <th class="border border-gray-400 dark:text-white">disk_id:</th>
                    <th class="border border-gray-400 dark:text-white">Created_at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                    <th class="border border-gray-400 dark:text-white">Deleted_at:</th>
                    <th class="border border-gray-400 dark:text-white" colspan="2">Act:</th>
                </tr>
            </thead>
            @foreach ($songs as $song)
            <tr>
                <td class="border border-gray-400 dark:text-white">{{ $song->id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->genre_id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->performer_id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->name }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->listening_count }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->year }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->status }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->disk_id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->created_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->updated_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song->deleted_at }}</td>
                @if ($song->trashed())
                <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                    <form action="{{ route("songRestore", $song->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="submit" value="Restore">
                    </form>
                </td>
                @else
                <td class="border border-gray-400 dark:text-white">
                    <form action="{{ route("songDelete", $song->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Remove">
                    </form>
                </td>
                <td class="border border-gray-400 dark:text-white"><a href="{{ route("songEdit", $song->id) }}">Edit</a></td>
                @endif
            </tr>
            @endforeach
        </table>
    </x-slot>
</x-app-layout>