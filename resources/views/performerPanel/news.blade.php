<x-performer-layout>
    <x-slot name="main">
        <a href="newsCreate">Create a news</a>
        @foreach ($news as $article)
        <div>
            <a href="{{ route("article", $article->id) }}">
                {{ $article->title }}
            </a>
            @if ($article->trashed())
            <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                <form action="{{ route("performerPanel/articleRestore", $article->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <input type="submit" value="Restore">
                </form>
            </td>
            @else

            <td class="border border-gray-400 dark:text-white">
                <form action="{{ route("performerPanel/articleDelete", $article->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Remove">
                </form>
            </td>
            <td class="border border-gray-400 dark:text-white"><a href="{{ route("performerPanel/articleEdit", $article->id) }}">Edit</a></td>
            @endif
        </div>
        @endforeach
        <div class="mt-4">
            {{ $disks->appends(request()->query())->links() }}
        </div>
    </x-slot>
</x-performer-layout>