<x-site-layout>
    <x-slot name="main">
        <h1>{{ $disk->name }}</h1>
        <a href="{{ route("performerPage", $disk->performer->id) }}">By {{ $disk->performer->name }}</a>
        <h3>{{ $disk->type }}</h3>
        <p>{{ $disk->description }}</p>
        <table class="songs">
            @foreach ($disk->songs as $song)
                <tr>
                    <td><button id="play-button" onclick="audio({{ $song->id }})">Відтворити</button></td>
                    <td class="text-blue-200">{{ $song->name }}</td>
                    <td>
                        <audio controls class="audio-player none" id="player{{ $song->id }}">
                            <source src="{{ mix('resources/songs/' . $song->id . '.' . $song->extension) }}" type="audio/{{ 
                                    $song->extension == 'mp3' ? 'mpeg' : 
                                    ($song->extension == 'wav' ? 'wav' : 
                                    ($song->extension == 'flac' ? 'flac' : 'error')) }}" />
                            <p>
                                Ваш браузер не підтримує елемент <code>audio</code>.
                            </p>
                        </audio>
                    </td>
                </tr>
            @endforeach
        </table>
    </x-slot>
</x-site-layout>
