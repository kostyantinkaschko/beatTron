<x-site-layout>
    <x-slot name="main">
        <h1 class="text-center">Performers</h1>
        <div class="performers">
            <div class="performerBlock">
                @foreach ($performers as $i => $performer)
                <a class="performer" href="{{ route("performerPage", $performer->id ) }}">{{ $performer->name }}</a>
                @if($i % 10 == false && $i != 0)
            </div>
            <div class="performerBlock">
                @endif
                @endforeach
            </div>
            <div class="mt-4 pagination">
                {{ $performers->appends(request()->query())->links() }}
            </div>
    </x-slot>
</x-site-layout>