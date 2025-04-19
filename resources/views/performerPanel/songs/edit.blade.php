<x-performer-layout>
    <x-slot name="main">
        <form action="{{ route("performerPanel/songUpdate", $song) }}" method="post">
            @csrf
            @method("patch")
            <label>Name:</label>
            <input type="text" name="name" value="{{ $song['name'] }}">
            <select name="genre_id">
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ $genre->id == $song->genre_id ? 'selected' : '' }}>{{ $genre->title }}</option>
                @endforeach
            </select>
            @error("genre_id")
            <p>{{ $message }}</p>
            @enderror
            <select name="performer_id">
                @foreach ($performers as $performer)
                <option value="{{ $performer->id }}" {{ $song->performer_id == $performer->id ? 'selected' : '' }}>{{ $performer->name }}</option>
                @endforeach
            </select>
            @error("performer_id")
            <p>{{ $message }}</p>
            @enderror
            <label>disk_id</label>
            <select name="disk_id">
                @foreach ($disks as $disk)
                <option value="{{ $disk->id }}" {{ $song->disk_id == $disk->id ? 'selected' : '' }}>{{ $disk->name }}</option>
                @endforeach
            </select>
            @error("disk_id")
            <p>{{ $message }}</p>
            @enderror
            <select name="status">
                <option value="public" {{ $song->status == "public" ? "selected" : "" }}>Public</option>
                <option value="protected" {{ $song->status == "protected" ? "selected" : "" }}>Protected</option>
                <option value="private" {{ $song->status == "private" ? "selected" : "" }}>Private</option>
            </select>
            @error("status")
            <p>{{ $message }}</p>
            @enderror
            <label>year</label>
            <input type="number" name="year" value="{{ $song->year }}" min="1000" step="1">
            @error("year")
            <p>{{ $message }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>