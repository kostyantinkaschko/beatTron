<x-site-layout>
    <x-slot name="main">
        @if(!empty($songs))
        <h1>Results:</h1>
        @foreach ($songs as $song)
        @include('layouts.songPlay')
        @endforeach
        @else
        <h1>No results found</h1>
        @endif
        <div class="mt-4">
            {{ $songs->appends(request()->query())->links() }}
        </div>
    </x-slot>
</x-site-layout>