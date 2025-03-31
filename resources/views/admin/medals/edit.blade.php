<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("medalUpdate", $medal) }}" method="post">
            @csrf
            <label>id:</label>
            <input type="text" name="name" value="{{ $medal->name }}">
            <input type="text" name="type" value="{{ $medal->type }}">
            <input type="text" name="description" value="{{ $medal->description }}">
            <input type="text" name="difficult" value="{{ $medal->difficult }}">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>