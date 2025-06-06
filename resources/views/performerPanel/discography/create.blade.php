<x-performer-layout>
    <x-slot name="main">
        <h1 class="text-center">Disk creation form</h1>
        <form action="{{"diskStore"}}" method="post" enctype="multipart/form-data">
            @csrf
            <label>Name:</label>
            <input type="text" name="name">
            <label>Description</label>
            <label for="description"></label>
            <input type="text" name="description">
            @error("description")
                <p>{{ $message }}</p>
            @enderror
            <label for="genre_id">Genre:</label>
            <select name="genre_id">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                @endforeach
            </select>
            @error("genre_id")
                <p>{{ $message }}</p>
            @enderror
            <input type="hidden" name="performer_id" value="{{ Auth::user()->performer->id }}">
            @error("name")
                <p>{{ $message }}</p>
            @enderror
            <label>Type:</label>
            <select name="type">
                <option value="Album">Album</option>
                <option value="Album">Album</option>
            </select>
            @error("type")
                <p>{{ $message }}</p>
            @enderror
            <label>Status:</label>
            <select name="status">
                <option value="public">Public</option>
                <option value="protected">Protected</option>
                <option value="private">Private</option>
            </select>
            @error("status")
                <p>{{ $message }}</p>
            @enderror
            <label>Image:</label>
            <label class="file">
                <input type="file" name="image">
                @error("file")
                    <p>{{ $message }}</p>
                @enderror
            </label>
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>