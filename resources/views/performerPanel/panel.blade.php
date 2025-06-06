<x-performer-layout>
    <x-slot name="main">
        <div class="performerObj">
            <h1 class="performerName">{{ $performer->name }}</h1>
            <a href="{{ $performer->instagram }}" target="_blank">Instagram</a>
            <a href="{{ $performer->facebook }}" target="_blank">facebook</a>
            <a href="{{ $performer->x }}" target="_blank">x</a>
            <a href="{{ $performer->youtube }}" target="_blank">youtube</a>
        </div>
        @if($performer->discographies->isNotEmpty())
            <div class="disks">
                <h2>Discography:</h2>
                {{-- @dd($performer->discographies) --}}
                @foreach ($performer->discographies as $disk)
                    <a href="{{ route("disk", $disk->id) }}" class="disk">
                        <h2>{{ $disk->name }}</h2>
                    </a>
                @endforeach
            </div>
        @endif
        @if($performer->songs->isNotEmpty())
            <table  class="audioPlayerTable">
                @foreach ($performer->songs as $song)
                    @include("layouts.songPlay")
                @endforeach
            </table>
        @endif
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
    </x-slot>
</x-performer-layout>