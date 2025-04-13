<x-app-layout>
    <x-slot name="slot">
        <a href="medalCreate" class="dark:text-white">Create medal</a>
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">id:</th>
                    <th class="border border-gray-400 dark:text-white">Name:</th>
                    <th class="border border-gray-400 dark:text-white">Type:</th>
                    <th class="border border-gray-400 dark:text-white">Description:</th>
                    <th class="border border-gray-400 dark:text-white">Difficulty:</th>
                    <th class="border border-gray-400 dark:text-white">Created_at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                    <th class="border border-gray-400 dark:text-white">Deleted_at:</th>
                    <th class="border border-gray-400 dark:text-white" colspan="2">Act:</th>
                </tr>
            </thead>
            @foreach ($medals as $medal)
            <tr>
                <td class="border border-gray-400 dark:text-white">{{ $medal->id }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $medal->name }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $medal->type }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $medal->description }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $medal->difficulty }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $medal->created_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $medal->updated_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $medal->deleted_at }}</td>
                @if ($medal->trashed())
                <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                    <form action="{{ route("medalRestore", $medal->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="submit" value="Restore">
                    </form>
                </td>
                @else
                <td class="border border-gray-400 dark:text-white">
                    <form action="{{ route("medalDelete", $medal->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Remove">
                    </form>
                </td>
                <td class="border border-gray-400 dark:text-white"><a href="{{ route("medalEdit", $medal->id) }}">Edit</a></td>
                @endif
            </tr>
            @endforeach
        </table>
    </x-slot>
</x-app-layout>