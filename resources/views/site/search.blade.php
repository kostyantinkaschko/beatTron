<x-site-layout>
    <x-slot name="main">
        @if($result)
        <h1>Results:</h1>

        @foreach ($result as $song)

        <tr>
            <td><button id="play-button" onclick="audio({{ $song['id'] }})">Відтворити</button></td>

            <td class="text-red-50">{{ $song['performer'] }}:</td>
            <td class="text-blue-200">{{ $song['name'] }}</td>

            <td>
                <audio controls class="audio-player none" id="player{{ $song['id'] }}">
                    <source src="{{ mix('resources/songs/' . $song['id'] . '.' . $song['extension']) }}" type="audio/{{ 
                                $song['extension'] == 'mp3' ? 'mpeg' : 
                                ($song['extension'] == 'wav' ? 'wav' : 
                                ($song['extension'] == 'flac' ? 'flac' : 'error')) }}" />
                    <p>
                        Ваш браузер не підтримує елемент <code>audio</code>.
                    </p>
                </audio>
            </td>
        </tr>
        @endforeach
        @else
        <h1>No results found</h1>
        @endif
    </x-slot>
</x-site-layout>