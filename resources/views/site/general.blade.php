<x-site-layout>
    <x-slot name="main">
        <h2>Songs</h2>
        <ul>
            @foreach ($songs as $song)
            <li>{{ $song->name }} ({{ $song->year }})</li>
            @endforeach
        </ul>

        <h2>News</h2>
        <ul>
            @foreach ($news as $item)
            <li>{{ $item->title }}</li>
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