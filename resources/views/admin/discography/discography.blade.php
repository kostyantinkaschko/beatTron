<x-app-layout>
    <x-slot name="slot">
        <a href="diskCreate" class="dark:text-white">Create disk</a>
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">id:</th>
                    <th class="border border-gray-400 dark:text-white">genre_id:</th>
                    <th class="border border-gray-400 dark:text-white">Author:</th>
                    <th class="border border-gray-400 dark:text-white">Type:</th>
                    <th class="border border-gray-400 dark:text-white">Description:</th>
                    <th class="border border-gray-400 dark:text-white">Created_at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                    <th class="border border-gray-400 dark:text-white">Deleted_at:</th>
                    <th class="border border-gray-400 dark:text-white" colspan="2">Act:</th>
                </tr>
            </thead>
            @foreach ($disks as $disk)
            <tr>
                <td class="border border-gray-400 dark:text-white">{{ $disk->id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->genre_id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->author }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->type }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->description }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->created_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->updated_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->deleted_at }}</td>
                @if ($disk->trashed())
                <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                    <form action="{{ route("diskRestore", $disk->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="submit" value="Restore">
                    </form>
                </td>
                @else
                <td class="border border-gray-400 dark:text-white">
                    <form action="{{ route("diskDelete", $disk->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Remove">
                    </form>
                </td>
                <td class="border border-gray-400 dark:text-white"><a href="{{ route("diskEdit", $disk->id) }}">Edit</a></td>
                @endif
            </tr>
            @endforeach
        </table>
    </x-slot>
</x-app-layout>