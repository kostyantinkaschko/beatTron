<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("songStore") }}" method="post">
            @csrf
            <label>genre_id:</label>
            <input type="text" name="genre_id">
            <label>performer</label>
            <input type="text" name="performer_id">
            <label>name</label>
            <input type="text" name="name">
            <label>year</label>
            <input type="text" name="year">
            <label>disk_id</label>
            <input type="text" name="disk_id">
            <label>status</label>
            <input type="text" name="status">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>