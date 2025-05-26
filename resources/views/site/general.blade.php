<x-site-layout>
    <x-slot name="main">
        <table class="songs">
            <tbody>
                @foreach ($songs as $song)
                @include('layouts.songPlay')
                @endforeach
            </tbody>
        </table>
        <ul>
            @foreach ($news as $item)
            <li>
                @php
                $media = $item->getFirstMedia("news");
                @endphp

                <a href="{{ route("article", $item->id) }}">
                    @if($media)
                    <img class="newsImage" src="{{ $media->getUrl() }}" alt="Article image">
                    @endif
                    {{ $item->title }}
                </a>
            </li>
            @endforeach
        </ul>

        <h2>Performers</h2>
        <ul>
            @foreach ($performers as $performer)
            <li>{{ $performer->name }} ({{ $performer->rate }})</li>
            @endforeach
        </ul>

    </x-slot>
</x-site-layout>