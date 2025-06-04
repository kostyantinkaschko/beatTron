<x-site-layout>
    <x-slot name="main">
        <a href="{{ route("createPlaylist") }}">Create playlist</a>

        <table class="playlists">
            @foreach ($playlists as $playlist)
                <tr class="playlist">
                    <td>
                        <div class="playlist-name-display" id="name-display-{{ $playlist->id }}">
                            <a href="{{ route("playlist", $playlist->id) }}">{{ $playlist->name }}</a>
                        </div>

                        <input type="text" class="playlist-name-input none" id="edit-input-{{ $playlist->id }}" max="30" value="{{ $playlist->name }}">
                    </td>
                    <td class="playlist_created_at">{{ $playlist->updated_at}}</td>
                    <td>|</td>
                    <td>{{ $playlist->updated_at}}</td>
                    <td class="playlist_id">Id: {{ $playlist->id }}</td>

                    <td>
                        <button class="edit-button" data-id="{{ $playlist->id }}">Edit</button>
                    </td>
                    <td>
                        <form action="{{ route("playlistDelete", $playlist->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Remove">
                        </form>
                    </td>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="mt-4">
            {{ $playlists->appends(request()->query())->links() }}
        </div>
            <script src="{{ mix('resources/js/playlistsPage.js') }}"></script>
    </x-slot>
</x-site-layout>