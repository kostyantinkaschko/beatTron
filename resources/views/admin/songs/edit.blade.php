<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("songUpdate") }}" method="post">
            @csrf
            <label>title:</label>
            <input type="text" name="title" value="{{ $songe['title'] }}">
            <textarea name="description" placeholder="description">{{ $songe["description"] }}</textarea>
            <input type="hidden" name="id" value="{{ $_GET['id'] }}">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>{{}}