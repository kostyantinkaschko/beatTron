<x-site-layout>
    <x-slot name="main">
        <h1>{{ $article->title }}</h1>
        @php
        $media = $article->getFirstMedia("news");
        @endphp

        @if($media)
        <img class="newsImage" src="{{ $media->getUrl() }}" alt="Article image">
        @endif
        <p>{{ $article->text }}</p>
    </x-slot>
</x-site-layout>    