<x-site-layout>
    <x-slot name="main">
        <h1 class="text-center text-5xl">Performers</h1>
        <div class="performers">
            @foreach ($performers as $performer)
            <a class="performer" href="{{ route("performerPage", $performer->id ) }}">{{ $performer->name }}</a>
            @endforeach
        </div>
    </x-slot>
</x-site-layout>