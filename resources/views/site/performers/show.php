<x-site-layout>
    <x-slot name="main">
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                window.dataLayer.push(@json(session("createPerformerGTM")));
                console.log(window.dataLayer);
            });
        </script>

        @if(session("performer_gtm"))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    window.dataLayer.push(@json(session("performer_gtm")));
                    console.log(window.dataLayer);
                });
            </script>
        @endif
    </x-slot>
</x-site-layout>
