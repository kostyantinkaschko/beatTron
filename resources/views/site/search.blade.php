<x-site-layout>
    <x-slot name="main">
        @if($result)
        <h1>Results:</h1>

        @foreach ($result as $i => $song)

        <tr>
            <td><button id="play-button" onclick="audio({{ $song->id }})">Відтворити</button></td>

            <td class="text-red-50">{{ $song->performer->name }} - </td>
            <td class="text-blue-200">{{ $song->name }}</td>

            <td>
                @php
                $media = $song->getFirstMedia("songs");
                @endphp
                <audio controls class="audio-player none" id="player{{ $song->id }}">
                    <source src="{{ $media->getUrl() }}" type="audio/{{ 
                    $song->extension == 'mp3' ? 'mpeg' : 
                    ($song->extension == 'wav' ? 'wav' : 
                    ($song->extension == 'flac' ? 'flac' : 'error')) }}" />
                    <p>Ваш браузер не підтримує елемент <code>audio</code>.</p>
                </audio>
                @if(isset($playlists))
                <form action="{{ route("addSong") }}" method="post">
                    @csrf
                    <select name="playlist">
                        @foreach ($playlists as $playlist)
                        <option value="{{ $playlist->id }}">{{ $playlist->id }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="song" value="{{ $song->id }}">
                    <input type="submit">
                </form>
                @endif
            </td>
        </tr>
        @endforeach
        @else
        <h1>No results found</h1>
        @endif
        <div class="mt-4">
            {{ $songs->appends(request()->query())->links() }}
        </div>
    </x-slot>
</x-site-layout>