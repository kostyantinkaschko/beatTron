<x-app-layout>
    <x-slot name="slot">
        <a href="performerCreate" class="dark:text-white">Create performer</a>
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">id:</th>
                    <th class="border border-gray-400 dark:text-white">User_id:</th>
                    <th class="border border-gray-400 dark:text-white">Name:</th>
                    <th class="border border-gray-400 dark:text-white">Rate:</th>
                    <th class="border border-gray-400 dark:text-white">instagram:</th>
                    <th class="border border-gray-400 dark:text-white">facebook:</th>
                    <th class="border border-gray-400 dark:text-white">youtube:</th>
                    <th class="border border-gray-400 dark:text-white">Created_at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                    <th class="border border-gray-400 dark:text-white" colspan="2">Act:</th>
                </tr>
            </thead>
            @foreach ($performers as $performer)
            <tr>
                <td class="border border-gray-400 dark:text-white">{{ $performer["id"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $performer["user_id"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $performer["name"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $performer["rate"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $performer["instagram"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $performer["facebook"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $performer["youtube"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $performer["created_at"] }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $performer["updated_at"] }}</td>
                <td class="border border-gray-400 dark:text-white"><a href="performerDelete?id=<?= $performer['id'] ?>">Remove</a></td>
                <td class="border border-gray-400 dark:text-white"><a href="performerEdit?id=<?= $performer['id'] ?>">Edit</a></td>
            </tr>
            @endforeach
        </table>
    </x-slot>
</x-app-layout>