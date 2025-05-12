@if ($song)
<tr>
    <td><button id="play-button" onclick="audio({{ $song->id }})">Відтворити</button></td>
    <td class="text-red-50">{{ $song->performer->name }}:</td>
    <td class="text-blue-200">{{ $song->name }}</td>

    @php $media = $song->getFirstMedia("songs"); @endphp

    @if($media)
    <td class="audio-player none">
        <div class="audioInfo">
            <h2>{{ $song->performer->name }}</h2>
            <h2>{{ $song->name }}</h2>
        </div>
        <div class="listeningCount">
            <h2>{{ $song->listening_count }} {{  $song->listening }}</h2>
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
    <td>{{ $song->listening_count }}{{ $song->listening }}</td>

    @if(isset($playlists) && Auth::check())
    <td>
        <form action="{{ route('addSong') }}" method="post">
            @csrf
            <select name="playlist">
                <option value="create">
                    @if(!empty($playlists))
                    Select Playlist
                    @else
                    Create Playlist
                    @endif
                </option>
                @foreach ($playlists as $pl)
                    @if(isset($playlist) && $pl->id != $playlist->id)
                        <option value="{{ $pl->id }}">{{ $pl->id }}</option>
                    @else
                        <option value="{{ $pl->id }}">{{ $pl->id }}</option>
                    @endif
                @endforeach
            </select>
            <input type="hidden" name="song" value="{{ $song->id }}">
            <input type="submit">
        </form>
    </td>
    <td>
        <form action="{{ route('songRate', $song->id) }}" method="post">
            @csrf
            <select name="rate">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <input type="submit">
        </form>
    </td>
    @endif
</tr>
@endif