<x-performer-layout>
    <x-slot name="main">
        <a href="newsCreate">Create a news</a>
        @foreach ($news as $oneNews)
        <div>
        <a href="{{ route("article", $oneNews->id) }}">
            {{ $oneNews->title }}
        </a>
        <a href="{{ route("articleEdit", $oneNews->id) }}">
            Edit
        </a>
        </div>
        @endforeach
    </x-slot>
</x-performer-layout>