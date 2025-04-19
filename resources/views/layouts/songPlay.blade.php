@if ($song)
<tr>
    <td><button id="play-button" onclick="audio({{ $song->id }})">Відтворити</button></td>
    <td class="text-red-50">{{ $song->performer->name }}:</td>
    <td class="text-blue-200">{{ $song->name }}</td>

    @php $media = $song->getFirstMedia("songs"); @endphp

    @if($media)
    <td>
        <audio controls class="audio-player none" id="player{{ $song->id }}">
            <source src="{{ $media->getUrl() }}" type="audio/{{
                $song->extension == 'mp3' ? 'mpeg' :
                ($song->extension == 'wav' ? 'wav' :
                ($song->extension == 'flac' ? 'flac' : 'error')) }}" />
            <p>Ваш браузер не підтримує елемент <code>audio</code>.</p>
        </audio>
    </td>
    @endif

    @if( $playlists)
    <td>
        <form action="{{ route('addSong') }}" method="post">
            @csrf
            <select name="playlist">
                @foreach ($playlists as $playlist)
                    <option value="{{ $playlist->id }}">{{ $playlist->id }}</option>
                @endforeach
            </select>
            <input type="hidden" name="song" value="{{ $song->id }}">
            <input type="submit">
        </form>
    </td>
    @endif
</tr>
@endif
