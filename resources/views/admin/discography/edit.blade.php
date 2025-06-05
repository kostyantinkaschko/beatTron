<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("diskUpdate", $disk) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("patch")
            <select name="genre_id">
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ $genre->id == $disk->genre_id ? 'selected' : '' }}>{{ $genre->title }}</option>
                @endforeach
            </select>
            @error("genre_id")
            <p>{{ $message }}</p>
            @enderror
            <select name="performer_id">
                @foreach ($performers as $performer)
                <option value="{{ $performer->id }}" {{ $disk->performer_id == $performer->id ? 'selected' : '' }}>{{ $performer->name }}</option>
                @endforeach
            </select>
            @error("performer_id")
            <p>{{ $message }}</p>
            @enderror
            <input type="text" name="name" value="{{ $disk->name }}" placeholder="name">
            @error("name")
            <p>{{ $message }}</p>
            @enderror
            <select name="type">
                <option value="Album" {{ $disk->type == "album" ? "selected" : "" }}>Album</option>
                <option value="Single" {{ $disk->type == "single" ? "selected" : "" }}>Single</option>
            </select>
            @error("type")
            <p>{{ $message }}</p>
            @enderror
            <input type="text" name="description" value="{{ $disk->description }}" placeholder="description">
            @error("description")
            <p>{{ $message }}</p>
            @enderror
            <select name="status">
                <option value="public" {{ $disk->status == "public" ? "selected" : "" }}>Public</option>
                <option value="protected" {{ $disk->status == "protected" ? "selected" : "" }}>Protected</option>
                <option value="private" {{ $disk->status == "private" ? "selected" : "" }}>Private</option>
            </select>
            @error("status")
            <p>{{ $message }}</p>
            @enderror
            <div>
                <input type="file" name="image">
                @error("file")
                <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>