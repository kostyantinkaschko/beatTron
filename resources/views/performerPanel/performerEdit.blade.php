<x-performer-layout>
    <x-slot name="main">
        <h1 class="text-center">Performer edit form</h1>
        <form action="{{ route("performerPanel/update", $performer) }}" method="post">
            @csrf
            @method("patch")
            <label>Name:</label>
            <input type="text" name="name" value="{{ $performer->name }}">
            @error("name")
                <p>{{ $message }}</p>
            @enderror
            <label>Instagram:</label>
            <input type="text" name="instagram" value="{{ $performer->instagram }}">
            @error("instagram")
                <p>{{ $message }}</p>
            @enderror
            <label>Facebook:</label>
            <input type="text" name="facebook" value="{{ $performer->facebook }}">
            @error("facebook")
                <p>{{ $message }}</p>
            @enderror
            <label>X:</label>
            <input type="text" name="x" value="{{ $performer->x }}">
            @error("x")
                <p>{{ $message }}</p>
            @enderror
            <label>Youtube:</label>
            <input type="text" name="youtube" value="{{ $performer->youtube }}">
            @error("youtube")
                <p>{{ $message }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>