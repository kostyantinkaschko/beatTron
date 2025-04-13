<x-performer-layout>
    <x-slot name="main">
        <form action="{{ route("newsStore") }}" method="post">
            @csrf
            @method("patch")
            <input type="text" name="title">
            @error("title")
            <p>{{ $message }}</p>
            @enderror
            <textarea name="text"></textarea>
            @error("text")
            <p>{{ $message }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>