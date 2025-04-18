<x-site-layout>
    <x-slot name="main">
        <h2>Songs</h2>
        <table>
            <tbody>
                @foreach ($songs as $song)
                @include('layouts.songPlay')
                @endforeach
            </tbody>
        </table>
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