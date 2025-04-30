<x-performer-layout>
    <x-slot name="main">
        <form action="{{ route("performerPanel/articleUpdate", $article->id) }}" method="post" enctype="multipart/form-data">
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
            <div>
                <input type="file" name="image">
                @error("file")
                <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>