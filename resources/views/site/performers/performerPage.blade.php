<x-site-layout>
    <x-slot name="main">
        <h1>{{ $performer->name }}</h1>
        <a href="{{ $performer->instagram }}" target="_blank">Instagram</a>
        <a href="{{ $performer->facebook }}" target="_blank">facebook</a>
        <a href="{{ $performer->x }}" target="_blank">x</a>
        <a href="{{ $performer->youtube }}" target="_blank">youtube</a>

        <div class="disks">
            @foreach ($performer->discographies as $disk)
            <a href="" class="disk bg-white">
                <h2>{{ $disk->name }}</h2>
                <p>{{ $disk->type }}</p>
            </a>
            @endforeach
        </div>
        @if($performer->news->isNotEmpty())
        <h2>News</h2>
        <div class="news">
            @foreach ($performer->news as $i => $article)
            @if($i >= 10)
            @break
            @else
            <a href="{{ to_route("article", $article->id)}}">{{ $article->title }}</a>
            @endif
            @endforeach
        </div>
        @endif
        @foreach ($performer->song as $song)
        @if ($song != null)
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
        @endif
        @endforeach
    </x-slot>
</x-site-layout>