<x-site-layout>
    <x-slot name="main">
    <div class="disks">
            @foreach ($disks as $disk)
            <a class="disks" href="{{ route("disk", $disk->id ) }}">{{ $disk->name }}</a>
            @endforeach
        </div>
    </x-slot>
</x-site-layout>