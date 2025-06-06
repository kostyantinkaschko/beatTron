<x-site-layout>
    <x-slot name="main">
        <table  class="audioPlayerTable">
            <tbody>
                @include('layouts.songPlay')
            </tbody>
        </table>
        <div class="disks">
            <h2>Discography</h2>
            @php
                $media = $disk->getFirstMedia("disks");
            @endphp
            <a class="disk" href="{{ route("disk", $disk->id) }}">
                @if($media)
                    <img src="{{ $media->getUrl() }}" alt="Disk image">
                @endif
                {{ $disk->name }}
            </a>
        </div>
    </x-slot>
</x-site-layout>