<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("genreUpdate") }}" method="post">
            @csrf
            <label>title:</label>
            <input type="text" name="title" value="{{ $genre['title'] }}">
            <textarea name="description" placeholder="description">{{ $genre["description"] }}</textarea>
            <input type="hidden" name="id" value="{{ $_GET['id'] }}">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>{{}}