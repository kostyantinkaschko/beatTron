<x-app-layout>
    <x-slot name="slot">
        <form action="{{"diskStore" }}" method="post" class="">
            @csrf
            <label>genre_id</label>
            <input type="number" name="genre_id">
            <label>author</label>
            <input type="text" name="author">
            <label>type</label>
            <input type="text" name="type">
            <label for="description"></label>
            <input type="text" name="description">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>