<x-site-layout>
    <x-slot name="main">
        <h1 class="performerName">{{ $performer->name }}</h1>
        <a href="{{ $performer->instagram }}" target="_blank">Instagram</a>
        <a href="{{ $performer->facebook }}" target="_blank">facebook</a>
        <a href="{{ $performer->x }}" target="_blank">x</a>
        <a href="{{ $performer->youtube }}" target="_blank">youtube</a>

        <div class="disks">
            @foreach ($performer->discographies as $disk)
            <a href="" class="disk">
                <h2>{{ $disk->name }}</h2>
                <p>{{ $disk->type }}</p>
            </a>
            @endforeach
        </div>
        @if($performer->news->isNotEmpty())
        <h2>News</h2>
        <div class="news">
            @foreach ($performer->news as $article)
            <div>
                @php
                $media = $article->getFirstMedia("news");
                @endphp

                @if($media)
                <img class="newsImage" src="{{ $media->getUrl() }}" alt="Article image">
                @endif
                <a href="{{ to_route("article", $article->id)}}">{{ $article->title }}</a>
            </div>
            @endforeach
        </div>
        @endif
        <table>
            @foreach ($performer->song as $song)
            @include("layouts.songPlay")
            @endforeach
        </table>
    </x-slot>
</x-site-layout>