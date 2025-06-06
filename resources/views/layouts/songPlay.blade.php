@if ($song)
<tr data-listen-url="{{ route('completedListening', ['id' => $song->id]) }}" class="song">
    <td class="play-cell">
        <button class="play-button" data-id="{{ $song->id }}" onclick="audio({{ $song->id }})"></button>
    </td>

    @if(!isset($performerPage))
    <td class="text-red-50 performer_name">{{ $song->performer_name }}</td>
    <td class="text-red-50">-</td>
    @endif
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
    @php
    $userHasPlaylists = isset($playlists) && $playlists->isNotEmpty();
    $availablePlaylists = $userHasPlaylists ? $playlists->filter(fn($pl) => !$song->playlists->contains('id', $pl->id)) : collect();
    @endphp
    <td>


        <form action="{{ route('addSong') }}" method="post" class="addSongToPlaylist withoutFormStyle">
            @csrf

            @if($userHasPlaylists && $availablePlaylists->isNotEmpty())
            <select name="playlist" class="playlist_select">
                <option value="create">Select Playlist</option>
                @foreach ($availablePlaylists as $pl)
                <option value="{{ $pl->id }}">{{ $pl->name }}</option>
                @endforeach
            </select>
            @elseif(!$userHasPlaylists)
            <select class="playlist_select lackOfPlaylists" disabled>
                <option>You don't have any playlists</option>
            </select>
            @else
            <select class="playlist_select lackOfPlaylists" disabled>
                <option>Song already in all your playlists</option>
            </select>
            @endif

            <input type="hidden" name="song" value="{{ $song->id }}">
            <input type="submit" value="Send" class="submitWithoutStyle" {{ $availablePlaylists->isEmpty() ? 'disabled' : '' }}>
        </form>

    </td>
    @endif
    <td>
        <form class="withoutFormStyle" action="{{ route("songRate", $song->id) }}" method="post">
            @csrf
            <select name="rate" data-song-id="{{ $song->id }}" class="rate-select">
                <option value="empty">Rate the Song</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $song->user_rate == $i ? "selected" : "" }}>{{ $i }}</option>
                    @endfor
            </select>
            <input type="submit" value="Send" class="submitWithoutStyle">
        </form>
    </td>
    @if(!empty($song->average_rate) && $song->average_rate > 0 && $song->average_rate < 6)
        <td>Rating: {{ number_format($song->average_rate, 0, '.', '') }}</td>
</tr>
@endif