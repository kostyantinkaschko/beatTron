<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("medalUpdate", $medal) }}" method="post">
            @csrf
            @method("patch")
            <label>id:</label>
            <input type="text" name="name" value="{{ $medal->name }}">
            @error("name")
            <p>{{ $message }}</p>
            @enderror
            <input type="text" name="type" value="{{ $medal->type }}">
            @error("type")
            <p>{{ $message }}</p>
            @enderror
            <input type="text" name="description" value="{{ $medal->description }}">
            @error("genre_id")
            <p>{{ $message }}</p>
            @enderror
            <input type="text" name="difficulty" value="{{ $medal->difficulty }}">
            @error("genre_id")
            <p>{{ $difficult }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>