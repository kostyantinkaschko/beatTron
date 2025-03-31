<header>
    <nav>
        <ul class="topline">

            <li>
                <x-responsive-nav-link :href="route('general')" :active="request()->routeIs('general')">
                    {{ __('general') }}
                </x-responsive-nav-link>
            </li>
            <li>
                <x-responsive-nav-link :href="route('news')" :active="request()->routeIs('news')">
                    {{ __('news') }}
                </x-responsive-nav-link>
            </li>
            <li>
                <x-responsive-nav-link :href="route('genresSite')" :active="request()->routeIs('genres')">
                    {{ __('genres') }}
                </x-responsive-nav-link>
            </li>
            <li>
                <x-responsive-nav-link :href="route('performersSite')" :active="request()->routeIs('performers')">
                    {{ __('performers') }}
                </x-responsive-nav-link>
            </li>
            <li>
                <x-responsive-nav-link :href="route('playlists')" :active="request()->routeIs('playlists')">
                    {{ __('playlists') }}
                </x-responsive-nav-link>
            </li>
        </ul>
        <form action="" method="get">
            <input type="text" name="search" value="" placeholder="Music search">
        </form>
    </nav>
</header>