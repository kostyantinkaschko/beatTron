<x-site-layout>
    <x-slot name="main">
        <div class="performers">
            @foreach ($genres as $genre)
            <a href="{{ route("genrePage", $genre->id ) }}">{{ $genre->title }}</a>
            @endforeach
        </div>
    </x-slot>
</x-site-layout>