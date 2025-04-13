<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route("performerStore") }}" method="post">
            @csrf
            <label>Name</label>
            <input type="text" name="name">
            @error("name")
            <p>{{ $message }}</p>
            @enderror
            <label>facebook</label>
            <input type="text" name="facebook">
            @error("facbook")
            <p>{{ $message }}</p>
            @enderror
            <label>instagram</label>
            <input type="text" name="instagram">
            @error("instagram")
            <p>{{ $message }}</p>
            @enderror
            <label>x</label>
            <input type="text" name="x">
            @error("x")
            <p>{{ $message }}</p>
            @enderror
            <label>youtube</label>
            <input type="text" name="youtube">
            @error("youtube")
            <p>{{ $message }}</p>
            @enderror
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>