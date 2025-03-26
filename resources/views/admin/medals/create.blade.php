<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("medalStore") }}" method="post">
            @csrf
            <label>Name</label>
            <input type="text" name="name">
            <label>type</label>
            <input type="text" name="type">
            <label>description</label>
            <input type="text" name="description">
            <label>difficult</label>
            <input type="text" name="difficult">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>