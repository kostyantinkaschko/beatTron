<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("performerStore") }}" method="post">
            @csrf
            <label>User_id</label>
            <input type="number" name="genre">
            <label>Name</label>
            <input type="text" name="name">
            <label>instagram</label>
            <input type="text" name="instagram">
            <label>instagram</label>
            <input type="text" name="instagram">
            <label>youtube</label>
            <input type="text" name="youtube">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>