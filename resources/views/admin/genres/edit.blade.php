<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("genreUpdate", $genre) }}" method="post">
            @csrf
            @method("patch")
            <label>title:</label>
            <input type="text" name="title" value="{{ $genre->title }}">
            @error("title")
            <p>{{ $message }}</p>
            @enderror
            <label>year:</label>
            <input type="number" name="year" value="{{ $genre->year }}">
            @error("year")
            <p>{{ $message }}</p>
            @enderror
            <textarea name="description" placeholder="description">{{ $genre->description }}</textarea>
            @error("description")
            <p>{{ $message }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>