<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("performerUpdate", $performer->id) }}" method="post">
            @csrf
            <label>id:</label>
            <input type="text" name="user_id" value="{{ $performer->user_id }}">
            <input type="text" name="name" value="{{ $performer->name }}">
            <input type="text" name="facebook" value="{{ $performer->facebook }}">
            <input type="text" name="youtube" value="{{ $performer->youtube }}">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>