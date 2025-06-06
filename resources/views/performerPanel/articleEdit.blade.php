<x-performer-layout>
    <x-slot name="main">
        <h1 class="text-center">Article edit form</h1>
        <form action="{{ route("performerPanel/articleUpdate", $article->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method("patch")
            <label>Title:</label>
            <input type="text" name="title" value="{{ $article->title }}">
            @error("title")
                <p>{{ $message }}</p>
            @enderror
            <label>Text:</label>
            <textarea name="text">{{ $article->text }}</textarea>
            @error("text")
                <p>{{ $message }}</p>
            @enderror
            <label>Image:</label>
            <label class="file">
                <input type="file" name="image">
                @error("file")
                    <p>{{ $message }}</p>
                @enderror
            </label>
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>