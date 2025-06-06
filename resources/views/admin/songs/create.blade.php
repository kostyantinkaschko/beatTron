<x-app-layout>
    <x-slot name="slot">
        <h1 class="text-center">Song creation form</h1>
        <form action="{{ route("songStore") }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>name</label>
            <input type="text" name="name">
            <select name="genre_id">
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                @endforeach
            </select>
            @error("name")
            <p>{{ $message }}</p>
            @enderror
            <select name="performer_id">
                @foreach ($performers as $performer)
                <option value="{{ $performer->id }}">{{ $performer->name }}</option>
                @endforeach
            </select>
            @error("performer_id")
            <p>{{ $message }}</p>
            @enderror
            <label>disk_id</label>
            <select name="disk_id">
                @foreach ($disks as $disk)
                <option value="{{ $disk->id }}">{{ $disk->name }}</option>
                @endforeach
            </select>
            @error("disk_id")
            <p>{{ $message }}</p>
            @enderror
            <label>year</label>
            <input type="text" name="year">
            @error("year")
            <p>{{ $message }}</p>
            @enderror
            <select name="status">
                <option value="public">Public</option>
                <option value="protected">Protected</option>
                <option value="private">Private</option>
            </select>
            @error("status")
            <p>{{ $message }}</p>
            @enderror
            <label>Song file:</label>
            <label class="file">
                <input type="file" name="song">
                @error("file")
                <p>{{ $message }}</p>
                @enderror
            </label>
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>