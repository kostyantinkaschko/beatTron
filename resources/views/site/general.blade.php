<x-site-layout>
    <x-slot name="main">
        <h2>Songs</h2>
        <table>
            <tbody>
                @foreach ($songs as $song)
                @if ($song != null)
                <tr>
                    <td><button id="play-button" onclick="audio({{ $song->id }})">Відтворити</button></td>

                    <td class="text-red-50">{{ $performersView[$song->performer_id - 1]['name'] }}:</td>
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
                @endif
                @endforeach
            </tbody>
        </table>
        <h2>News</h2>
        <ul>
            @foreach ($news as $item)
            <li>{{ $item->title }}</li>
            @endforeach
        </ul>

        <h2>Performers</h2>
        <ul>
            @foreach ($performers as $performer)
            <li>{{ $performer->name }} ({{ $performer->rate }})</li>
            @endforeach
        </ul>

    </x-slot>
</x-site-layout>