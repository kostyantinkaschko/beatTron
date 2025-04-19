<x-site-layout>
    <x-slot name="main">
        <div class="disks">
            @foreach ($disks as $disk)
            <div class="diskBlock">
                @php
                $media = $disk->getFirstMedia("disks");
                @endphp

                @if($media)
                <img src="{{ $media->getUrl() }}" alt="Disk image">
                @endif
                <a class="disks" href="{{ route("disk", $disk->id ) }}">{{ $disk->name }}</a>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $disks->appends(request()->query())->links() }}
        </div>
    </x-slot>
</x-site-layout>