<x-app-layout>
    <x-slot name="slot">
        <a href="songCreate" class="dark:text-white">Create song</a>
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">id:</th>
                    <th class="border border-gray-400 dark:text-white">genre_id:</th>
                    <th class="border border-gray-400 dark:text-white">performe_idr:</th>
                    <th class="border border-gray-400 dark:text-white">name:</th>
                    <th class="border border-gray-400 dark:text-white">size:</th>
                    <th class="border border-gray-400 dark:text-white">rate:</th>
                    <th class="border border-gray-400 dark:text-white">listeningCount:</th>
                    <th class="border border-gray-400 dark:text-white">year:</th>
                    <th class="border border-gray-400 dark:text-white">status:</th>
                    <th class="border border-gray-400 dark:text-white">disk_id:</th>
                    <th class="border border-gray-400 dark:text-white">Created_at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                    <th class="border border-gray-400 dark:text-white" colspan="2">Act:</th>
                </tr>
            </thead>
            @foreach ($songs as $song)
            <tr>
                <td class="border border-gray-400 dark:text-white">{{ $song["id"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["genre_id"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["performer_id"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["name"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["size"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["rate"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["listeningCount"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["year"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["status"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["disk_id"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["created_at"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $song["updated_at"] }}</td>
                <td class="border border-gray-400 dark:text-white"><a href="songDelete?id=<?= $song['id'] ?>">Remove</a></td>
                <td class="border border-gray-400 dark:text-white"><a href="songEdit?id=<?= $song['id'] ?>">Edit</a></td>
            </tr>
            @endforeach
        </table>
    </x-slot>
</x-app-layout>