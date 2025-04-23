<x-performer-layout>
    <x-slot name="main">
        <form action="{{"performerPanel/diskStore"}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <select name="genre_id">
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                    @endforeach
                </select>
                @error("genre_id")
                <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="performer_id" value="{{ Auth::user()->performer->id }}">
            <div>
                <label>name</label>
                <input type="text" name="name">
                @error("name")
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div>
                <select name="type">
                    <option value="Album">Album</option>
                    <option value="Album">Album</option>
                </select>
                @error("type")
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="description"></label>
                <input type="text" name="description">
                @error("description")
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="file" name="image">
                @error("file")
                <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>