@extends('_layouts.master')

@section('body')
<section class="font-thin">
    <p class="mx-auto text-center mb-4">
        Hello.  I am eFrane.
    </p>
    <p>
        I am a
        <a class="text-blue-500 hover:text-pink-500" href="https://github.com/eFrane">programmer</a>,
        <a class="text-blue-500 hover:text-pink-500" href="https://eyeem.com/eFrane">photographer</a>,
        and <a class="text-blue-500 hover:text-pink-500" href="https://meanderingsoul.com">blogger</a>
        from Berlin, Germany. Orthographical quirks include oxford commas and post-quotation-mark interpunction.
        If you encounter me
        <a class="text-blue-500 hover:text-pink-500" href="https://www.goodreads.com/user/show/5222663-stefan">without a book</a>
        in my carry-on, you can generally safely assume I'm ill.
    </p>
</section>
<section class="mt-4" aria-role="region" aria-labelled-by="h2">
    <h2 class="text-2xl mb-2">Things I did and do</h2>

    <div class="md:flex md:flex-wrap">
        @foreach ($projects as $project)
            <section class="pr-4 pb-4 mb-4 mt-0 flex-none md:w-1/2 lg:w-1/3" aria-role="region" aria-labelled-by="h3">
                <h3 class="text-xl">{{ $project->name }}</h3>

                <nav class="text-2xs" aria-label="License and links for {{ $project->name }}">
                    <ul class="md:inline-flex">
                        @if ($project->github)
                        <li class="flex-auto md:pr-1">
                            GitHub:
                            <a
                                href="https://github.com/{{ $project->github }}"
                                class="text-blue-500 hover:text-pink-500"
                                aria-label="Visit {{ $project->github }} on GitHub">
                                {{ $project->github }}
                            </a>
                        </li>
                        @endif

                        @if ($project->website)
                        <li class="flex-auto">
                            Website:
                            <a href="{{ $project->website }}"
                               class="text-blue-500 hover:text-pink-500"
                               aria-label="Visit the project website for {{ $project->name }}">
                               {{ $project->website }}
                            </a>
                        </li>
                        @endif

                        @if ($project->license)
                        <li class="flex-1">License: {{ $project->license }}</li>
                        @endif
                    </ul>
                </nav>

                <div class="text-gray-700 font-thin">
                    {!! $project->getContent() !!}
                </div>
            </section>
        @endforeach
    </div>
</section>
@endsection
