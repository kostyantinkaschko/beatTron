<x-app-layout>
    <x-slot name="slot">
        <a href="genreCreate" class="dark:text-white">Create genre</a>
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">id:</th>
                    <th class="border border-gray-400 dark:text-white">Title:</th>
                    <th class="border border-gray-400 dark:text-white">Description:</th>
                    <th class="border border-gray-400 dark:text-white">Year:</th>
                    <th class="border border-gray-400 dark:text-white">Created_at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                    <th class="border border-gray-400 dark:text-white">Deleted_at:</th>
                    <th class="border border-gray-400 dark:text-white" colspan="2">Act:</th>
                </tr>
            </thead>
            @foreach ($genres as $genre)
            <tr>
                <td class="border border-gray-400 dark:text-white">{{ $genre->id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $genre->title }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $genre->description }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $genre->year }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $genre->created_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $genre->updated_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $genre->deleted_at }}</td>
                @if ($genre->trashed())
                <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                    <form action="{{ route("genreRestore", $genre->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="submit" value="Restore">
                    </form>
                </td>
                @else
                <td class="border border-gray-400 dark:text-white">
                    <form action="{{ route("genreDelete", $genre->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Remove">
                    </form>
                </td>
                <td class="border border-gray-400 dark:text-white"><a href="{{ route("genreEdit", $genre->id) }}">Edit</a></td>
                @endif
            </tr>
            @endforeach
        </table>
    </x-slot>
</x-app-layout>