<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("diskUpdate", $disk) }}" method="post">
            @csrf
            <input type="text" name="genre_id" value="{{ $disk->genre_id }}" placeholder="genre_id">
            <input type="text" name="author" value="{{ $disk->author }}" placeholder="author">
            <input type="text" name="type" value="{{ $disk->type }}" placeholder="type">
            <input type="text" name="description" value="{{ $disk->description }}" placeholder="description">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>