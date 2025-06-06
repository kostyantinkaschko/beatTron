<x-performer-layout>
    <x-slot name="main">
        <h1 class="text-center">Song edit form</h1>
        <form action="{{ route('performerPanel/songs') }}" method="GET" class="mb-4 space-y-4">

            <input type="text" name="search" placeholder="Search songs..." value="{{ request('search') }}"
                class="border p-2">

            <label for="genre_id" class="dark:text-white">Genre:</label>
            <select name="genre_id" id="genre_id" class="border">
                <option value="">Select Genre</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->title }}
                    </option>
                @endforeach
            </select>

            <label for="performer_id" class="dark:text-white">Performer:</label>
            <select name="performer_id" id="performer_id" class="border">
                <option value="">Select Performer</option>
                @foreach ($performers as $performer)
                    <option value="{{ $performer->id }}" {{ request('performer_id') == $performer->id ? 'selected' : '' }}>
                        {{ $performer->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white p-2">Search</button>
        </form>

        <a href="songCreate" class="dark:text-white">Create song</a>

        <table class="border-collapse border border-gray-400 mt-4">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">Id:</th>
                    <th class="border border-gray-400 dark:text-white">Genre:</th>
                    <th class="border border-gray-400 dark:text-white">Name:</th>
                    <th class="border border-gray-400 dark:text-white">Listening count:</th>
                    <th class="border border-gray-400 dark:text-white">Year:</th>
                    <th class="border border-gray-400 dark:text-white">Status:</th>
                    <th class="border border-gray-400 dark:text-white">Disk:</th>
                    <th class="border border-gray-400 dark:text-white">Created_at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated_at:</th>
                    <th class="border border-gray-400 dark:text-white">Deleted_at:</th>
                    <th class="border border-gray-400 dark:text-white" colspan="2">Act:</th>
                </tr>
            </thead>
            @foreach ($songs as $song)
                <tr>
                    <td class="border border-gray-400 dark:text-white">{{ $song->id }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->genre->title }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->name }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->listening_count }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->year }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->status }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->disk->name }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->created_at }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->updated_at }}</td>
                    <td class="border border-gray-400 dark:text-white">{{ $song->deleted_at }}</td>
                    @if ($song->trashed())
                        <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                            <form action="{{ route("performerPanel/songRestore", $song->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <input type="submit" value="Restore">
                            </form>
                        </td>
                    @else
                        <td class="border border-gray-400 dark:text-white">
                            <form action="{{ route("performerPanel/songDelete", $song->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="removeButton" value="Remove">
                            </form>
                        </td>
                        <td class="border border-gray-400 dark:text-white">
                            <a href="{{ route("performerPanel/songEdit", $song->id) }}">Edit</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
        <div class="mt-4">
            {{ $songs->appends(request()->query())->links() }}
        </div>
    </x-slot>
    </x-app-layout>