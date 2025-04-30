<x-site-layout>
    <x-slot name="main">
        <table class="songs">
            @foreach($songs as $song)
            @include('layouts.songPlay')
            @endforeach
        </table>
    </x-slot>
</x-site-layout>