 <x-site-layout>
     <x-slot name="main">
         <h1 class="text-center">Genres</h1>
         <div class="genres">
             <div class="genreBlock">
                 @foreach ($genres as $i => $genre)
                 <a class="genre" href="{{ route("genrePage", $genre->id ) }}">{{ $genre->title }}</a>
                 @if($i % 10 == false && $i != 0)
             </div>
             <div class="genreBlock">
                 @endif
                 @endforeach
             </div>
         </div>
         <div class="mt-4 pagination">
             {{ $genres->appends(request()->query())->links() }}
         </div>
     </x-slot>
 </x-site-layout>