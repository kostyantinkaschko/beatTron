<x-performer-layout>
    <x-slot name="main">
        <h1 class="text-center">Song creation form</h1>
        <form action="{{ route("performerPanel/songStore") }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>Name:</label>
            <input type="text" name="name">
            <label>Genre:</label>
            <select name="genre_id">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                @endforeach
            </select>
            @error("name")
                <p>{{ $message }}</p>
            @enderror

            <input type="hidden" name="performer_id" value="{{ Auth::user()->performer->id }}">

            <label>Disk:</label>
            <select name="disk_id">
                @foreach ($disks as $disk)
                    <option value="{{ $disk->id }}">{{ $disk->name }}</option>
                @endforeach
            </select>
            @error("disk_id")
                <p>{{ $message }}</p>
            @enderror
            <label>Year:</label>
            <input type="text" name="year">
            @error("year")
                <p>{{ $message }}</p>
            @enderror
               <label>Status:</label>
            <select name="status">
                <option value="public">Public</option>
                <option value="protected">Protected</option>
                <option value="private">Private</option>
            </select>
            @error("status")
                <p>{{ $message }}</p>
            @enderror
            <label>Song file:</label>
            <label class="file">
                <input type="file" name="song">
                @error("song")
                    <p>{{ $message }}</p>
                @enderror
            </label>
            <input type="hidden" value="{{ Auth::user()->performer->id }}" name="performer_id">
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>