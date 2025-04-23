<x-site-layout>
    <x-slot name="main">
        <h1>{{ $disk->name }}</h1>
        <a href="{{ route("performerPage", $disk->performer->id) }}">By {{ $disk->performer->name }}</a>
        <h3>{{ $disk->type }}</h3>
        <p>{{ $disk->description }}</p>
        <table class="songs">
            @foreach ($songs as $song)
            @include('layouts.songPlay')
            @endforeach
        </table>
    </x-slot>
</x-site-layout>