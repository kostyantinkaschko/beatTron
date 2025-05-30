@if ($song)
<tr class="song">
    <td class="play-cell"><button id="play-button" onclick="audio({{ $song->id }})"></button></td>
    <td class="text-red-50 performer_name">{{ $song->performer_name }}</td>
    <td class="text-red-50">-</td>
    <td class="text-blue-200">{{ $song->name }}</td>

    @php $media = $song->getFirstMedia("songs"); @endphp

    @if($media)
    <td class="audio-player none">
        <div class="audioInfo">
            <h2>{{ $song->performer_name }}</h2>
            <h2>{{ $song->name }}</h2>
        </div>
        <div class="listeningCount">
            <h2>{{ $song->listening_count }} {{ $song->listening }}</h2>
        </div>
        <audio controls id="player{{ $song->id }}">
            <source src="{{ $media->getUrl() }}" type="audio/{{
                $song->extension == 'mp3' ? 'mpeg' :
                ($song->extension == 'wav' ? 'wav' :
                ($song->extension == 'flac' ? 'flac' : 'mpeg')) }}" />
            <p>Ваш браузер не підтримує елемент <code>audio</code>.</p>
        </audio>
    </td>
    @endif
    @endif
    <td>{{ $song->listening_count }}{{ $song->listening }}</td>

    @if(isset($playlists) && Auth::check())
    <td>
        @php
        $availablePlaylists = $playlists->filter(fn($pl) => !$song->playlists->contains('id', $pl->id));
        @endphp

        <form action="{{ route('addSong') }}" method="post" class="addSongToPlaylist">
            @csrf

            @if($availablePlaylists->isNotEmpty())
            <select name="playlist" class="playlist_select" {{ $availablePlaylists->isEmpty() ? 'disabled' : '' }}>
                <option value="create">
                    Select Playlist
                </option>
                @else
                <select class="playlist_select lackOfPlaylists" {{ $availablePlaylists->isEmpty() ? 'disabled' : '' }}>
                    <option value="create">
                        Song already in all your playlists
                    </option>
                    @endif

                    @foreach ($availablePlaylists as $pl)
                    <option value="{{ $pl->id }}">{{ $pl->id }}</option>
                    @endforeach
                </select>

                <input type="hidden" name="song" value="{{ $song->id }}">
                <input type="submit" value="Send" {{ $availablePlaylists->isEmpty() ? 'disabled' : '' }}>
        </form>

    </td>
    <td>
        <form action="{{ route("songRate", $song->id) }}" method="post">
            @csrf
            <select name="rate" data-song-id="{{ $song->id }}" class="rate-select">
                <option value="empty">Rate the Song</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $song->user_rate == $i ? "selected" : "" }}>{{ $i }}</option>
                    @endfor
            </select>
            <input type="submit" value="Send">
        </form>
    </td>
    <td>Rating: {{ $song->average_rate ?? "none"}}</td>
</tr>
@endif