<x-site-layout>
    <x-slot name="main">
        <form class="searchForm flex">
            <input type="text" name="search" placeholder="Search" id="searchInput">
            <label class="searchSubmit">
                <input type="submit" value="">
            </label>
        </form>


        <table class="songs">
            @foreach($songs as $song)
                @include('layouts.songPlay')
            @endforeach
        </table>
           <script src="{{ mix('resources/js/playlistSongSearch.js') }}"></script>
    </x-slot>
</x-site-layout>