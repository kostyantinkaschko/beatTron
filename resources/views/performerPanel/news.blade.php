<x-performer-layout>
    <x-slot name="main">
        <a href="newsCreate">Create a news</a>
        @if($news->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th class="border border-gray-400 dark:text-white">Image:</th>
                    <th class="border border-gray-400 dark:text-white">Title:</th>
                    <th class="border border-gray-400 dark:text-white">Created at:</th>
                    <th class="border border-gray-400 dark:text-white">Updated at:</th>
                    <th colspan="2" class="border border-gray-400 dark:text-white">Actions:</th>
                </tr>
            </thead>
            @foreach ($news as $article)
                <tr>
                    <td class="border border-gray-400 dark:text-white imageColumn">
                        @php
                            $media = $article->getFirstMedia("news");
                        @endphp

                        @if($media)
                            <img src="{{ $media->getUrl() }}" alt="Article image">
                        @endif
                    </td>
                    <td class="border border-gray-400 dark:text-white">
                        <a href="{{ route("article", $article->id) }}">
                            {{ $article->title }}
                        </a>
                    </td>
                    <td class="border border-gray-400 dark:text-white">
                        {{$article->created_at}}
                    </td>
                    <td class="border border-gray-400 dark:text-white"> {{$article->updated_at}}</td>
                    @if ($article->trashed())
                        <td class="border border-gray-400 dark:text-white text-center" colspan="2">
                            <form action="{{ route("performerPanel/articleRestore", $article->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <input type="submit" value="Restore">
                            </form>
                        </td>
                    @else

                        <td class="border border-gray-400 dark:text-white items-center">
                            <form action="{{ route("performerPanel/articleDelete", $article->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="removeButton" value="Remove">
                            </form>
                        </td>
                        <td class="border border-gray-400 dark:text-white"><a
                                href="{{ route("performerPanel/articleEdit", $article->id) }}">Edit</a></td>
                    @endif
            @endforeach
            </tr>
        </table>
        <div class="mt-4">
            {{ $news->appends(request()->query())->links() }}
        </div>
        @endif
    </x-slot>
</x-performer-layout>