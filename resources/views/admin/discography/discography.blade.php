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
                <td class="border border-gray-400 dark:text-white"><a href="disksDelete?id=<?= $disk->id ?>">Remove</a></td>
                <td class="border border-gray-400 dark:text-white"><a href="disksEdit?id=<?= $disk->id ?>">Edit</a></td>
            </tr>
            @endforeach
        </table>
    </x-slot>
</x-app-layout>