<x-site-layout>
    <x-slot name="main">
        <h1>{{ $article->title }}</h1>
        <p>{{ $article->text }}</p>
    </x-slot>
</x-site-layout>