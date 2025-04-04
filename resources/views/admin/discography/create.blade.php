<x-app-layout>
    <x-slot name="slot">
        <form action="{{"diskStore" }}" method="post" class="">
            @csrf
            <select name="genre_id">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                @endforeach
            </select>
            <select name="performer_id">
                @foreach ($performers as $performer)
                    <option value="{{ $performer->id }}">{{ $performer->name }}</option>
                @endforeach
            </select>
            <label>type</label>
            <input type="text" name="type">
            <select name="type">
                <option value="public">Public</option>
                <option value="protected">Protected</option>
                <option value="private">Private</option>
            </select>
            <label for="description"></label>
            <input type="text" name="description">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>