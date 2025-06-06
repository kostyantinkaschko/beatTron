<x-app-layout>
    <x-slot name="slot">
        <h1 class="text-center">Genre creation form</h1>
        <form action="{{ route("genreStore") }}" method="post">
            @csrf
            <label>title:</label>
            <input type="text" name="title">
            @error("title")
            <p>{{ $message }}</p>
            @enderror
            <label>year:</label>
            <input type="number" name="year">
            @error("year")
            <p>{{ $message }}</p>
            @enderror
            <textarea name="description" placeholder="description"></textarea>
            @error("description")
            <p>{{ $message }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>