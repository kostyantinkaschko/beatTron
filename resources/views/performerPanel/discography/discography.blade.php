<x-performer-layout>
    <x-slot name="main">
        <form action="{{ route('performerPanel/discography') }}" method="GET" class="mb-4 space-y-4">

            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="border p-2">

            <label for="genre_id" class="dark:text-white">Genre:</label>
            <select name="genre_id" id="genre_id" class="border">
                <option value="">Select Genre</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->title }}
                </option>
                @endforeach
            </select>

            <input type="hidden" name="performer_id" value="{{ Auth::user()->performer->id }}">
            <label for="type" class="dark:text-white">Type:</label>
            <select name="type">
                <option value="album">Album</option>
                <option value="single">Single</option>
            </select>



            <button type="submit" class="bg-blue-500 text-white p-2">Search</button>
        </form>
        <a href="diskCreate" class="dark:text-white">Create disk</a>
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">id:</th>
                    <th class="border border-gray-400 dark:text-white">Photo:</th>
                    <th class="border border-gray-400 dark:text-white">genre:</th>
                    <th class="border border-gray-400 dark:text-white">Name:</th>
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
                <td class="border border-gray-400 dark:text-white img200px">
                    @php
                    $media = $disk->getFirstMedia("disks");
                    @endphp

                    @if($media)
                    <img src="{{ $media->getUrl() }}" alt="Disk image">
                    @endif
                </td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->genre}}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->type }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->name }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->description }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->created_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->updated_at }}</td>
                <td class="border border-gray-400 dark:text-white">{{ $disk->deleted_at }}</td>
                @if ($disk->trashed())
                <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                    <form action="{{ route("performerPanel/diskRestore", $disk->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="submit" value="Restore">
                    </form>
                </td>
                @else
                <td class="border border-gray-400 dark:text-white">
                    <form action="{{ route("performerPanel/diskDelete", $disk->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Remove">
                    </form>
                </td>
                <td class="border border-gray-400 dark:text-white"><a href="{{ route("performerPanel/diskEdit", $disk->id) }}">Edit</a></td>
                @endif
            </tr>
            @endforeach
        </table>

        <div class="mt-4">
            {{ $disks->appends(request()->query())->links() }}
        </div>
    </x-slot>
</x-performer-layout>