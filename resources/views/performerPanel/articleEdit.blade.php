<x-performer-layout>
    <x-slot name="main">
        <form action="{{ route("articleUpdate", $article->id) }}" method="post">
            @csrf
            @method("patch")
            <input type="text" name="title" value="{{ $article->title }}">
            @error("title")
            <p>{{ $message }}</p>
            @enderror
            <textarea name="text">{{ $article->text }}</textarea>
            @error("text")
            <p>{{ $message }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>