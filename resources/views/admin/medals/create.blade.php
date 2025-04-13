<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("medalStore") }}" method="post">
            @csrf
            <label>Name</label>
            <input type="text" name="name">
            @error("name")
            <p>{{ $message }}</p>
            @enderror
            <label>type</label>
            <input type="text" name="type">
            @error("type")
            <p>{{ $message }}</p>
            @enderror
            <label>description</label>
            <input type="text" name="description">
            @error("description")
            <p>{{ $message }}</p>
            @enderror
            <label>difficulty</label>
            <input type="text" name="difficulty">
            @error("difficulty")
            <p>{{ $message }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>