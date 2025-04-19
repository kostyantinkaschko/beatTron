@if($medals->isNotEmpty())
<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-xl">

        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Medals
                </h2>
                @foreach ($medals as $medal)
                <a href="{{ route("medal", $medal->id) }}">
                    <h3>{{ $medal->name }}</h3>
                    <p>{{ $medal->difficulty }}</p>
                </a>
                @endforeach
            </header>
        </section>
    </div>
</div>
@endif