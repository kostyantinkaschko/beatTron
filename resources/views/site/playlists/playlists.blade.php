<x-site-layout>
    <x-slot name="main">
        <a href="{{ route("createPlaylist") }}">Create playlist</a>

        @foreach ($playlists as $playlist)
        <a href="{{ route("playlist", $playlist->id) }}">Playlist{{ $playlist->id }}</a>
        @endforeach
        <div class="mt-4">
            {{ $playlists->appends(request()->query())->links() }}
        </div>
    </x-slot>
</x-site-layout>