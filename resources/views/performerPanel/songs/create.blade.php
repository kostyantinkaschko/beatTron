<x-performer-layout>
    <x-slot name="main">
        <form action="{{ route("performerPanel/songStore") }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>name</label>
            <input type="text" name="name">
            <select name="genre_id">
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                @endforeach
            </select>
            @error("name")
            <p>{{ $message }}</p>
            @enderror
       
            <input type="hidden" name="performer_id" value="{{ Auth::user()->performer->id }}">
          
            <label>disk_id</label>
            <select name="disk_id">
                @foreach ($disks as $disk)
                <option value="{{ $disk->id }}">{{ $disk->name }}</option>
                @endforeach
            </select>
            @error("disk_id")
            <p>{{ $message }}</p>
            @enderror
            <label>year</label>
            <input type="text" name="year">
            @error("year")
            <p>{{ $message }}</p>
            @enderror
            <select name="status">
                <option value="public">Public</option>
                <option value="protected">Protected</option>
                <option value="private">Private</option>
            </select>
            @error("status")
            <p>{{ $message }}</p>
            @enderror
            <input type="file" name="song">
            @error("song")
                <p>{{ $message }}</p>
            @enderror
            <input type="hidden" value="{{ Auth::user()->performer->id }}" name="performer_id">
            <input type="submit">
        </form>
    </x-slot>
</x-performer-layout>