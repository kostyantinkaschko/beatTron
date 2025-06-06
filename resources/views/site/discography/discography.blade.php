<x-site-layout>
    <x-slot name="main">
        <h1 class="text-center">Disks</h1>
        <div class="disksGen">
            <div class="diskBlock">
                @foreach ($disks as $i => $disk)
                @php
                $media = $disk->getFirstMedia("disks");
                @endphp
                <a class="disk" href="{{ route("disk", $disk->id ) }}">
                    @if($media)
                    <img src="{{ $media->getUrl() }}" alt="Disk image">
                    @endif
                    {{ $disk->name }}
                </a>
                @if($i % 10 == false && $i != 0)
            </div>
            <div class="diskBlock">
                @endif
                @endforeach
            </div>
        </div>
            <div class="mt-4 pagination">
                {{ $disks->appends(request()->query())->links() }}
            </div>
    </x-slot>
</x-site-layout>