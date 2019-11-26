@extends('_layouts.master')

@section('body')
<div>
    <p>
        Hello, I am eFrane.
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
</div>
<div class="mt-4">
    <h1 class="text-2xl mb-2">Things I did and do</h1>

    <div class="md:flex md:flex-wrap">
        @foreach ($projects as $project)
            <section class="pr-4 pb-4 mb-4 mt-0 flex-none md:w-1/2 lg:w-1/3">
                <h2 class="text-xl">{{ $project->name }}</h2>

                <nav class="text-2xs">
                    <ul class="md:inline-flex">
                        @if ($project->github)
                        <li class="flex-auto md:pr-1">
                            GitHub:
                            <a href="https://github.com/{{ $project->github }}" class="text-blue-500 hover:text-pink-500">
                                {{ $project->github }}
                            </a>
                        </li>
                        @endif

                        @if ($project->website)
                        <li class="flex-auto">Website: <a href="{{ $project->website }}"  class="text-blue-500 hover:text-pink-500">{{ $project->website }}</a></li>
                        @endif

                        @if ($project->license)
                        <li class="flex-1">License: {{ $project->license }}</li>
                        @endif
                    </ul>
                </nav>

                <article class="text-gray-700 font-thin">
                    {!! $project->getContent() !!}
                </article>
            </section>
        @endforeach
    </div>
</div>
@endsection
