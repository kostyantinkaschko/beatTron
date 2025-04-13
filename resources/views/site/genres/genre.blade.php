<x-site-layout>
    <x-slot name="main">
        <h1>{{ $genre->title }}</h1>
        <h6>{{ $genre->year }}</h6>
        <p>{{ $genre->description }}</p>
    </x-slot>
</x-site-layout>