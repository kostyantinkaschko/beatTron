<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("genreStore") }}" method="post">
            @csrf
            <label>title:</label>
            <input type="text" name="title">
            <textarea name="description" placeholder="description"></textarea>
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>