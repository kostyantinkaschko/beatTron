<x-site-layout>
    <x-slot name="main">
        <table class="songs audioPlayerTable">
            <tbody>
                @foreach ($songs as $song)
                @include('layouts.songPlay')
                @endforeach
            </tbody>
        </table>
        @if($performers->isNotEmpty())
        <div class="performersGeneral">
            <h2>Performers</h2>
            <ul class="performerBlock">
                @foreach ($performers as $performer)
                <li>
                    <a class="performer" href="{{ route('performerPage', $performer->id) }}">
                        {{ $performer->name }}
                        @if ($performer->rate > 0 && $performer->rate < 6)
                            ({{ $performer->rate }})
                            @endif
                            </a>
                </li>

                @endforeach
            </ul>
        </div>
        @endif
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
    </x-slot>
</x-site-layout>