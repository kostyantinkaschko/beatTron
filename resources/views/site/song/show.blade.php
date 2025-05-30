<x-site-layout>
    <x-slot name="main">
        <div class="wrapper">

        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                window.dataLayer.push(@json(session("createSongGTM")));
                console.log(window.dataLayer);
            });
        </script>

        @if(session("song_gtm"))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    window.dataLayer.push(@json(session("song_gtm")));
                    console.log(window.dataLayer);
                });
            </script>
        @endif
    </x-slot>
</x-site-layout>
