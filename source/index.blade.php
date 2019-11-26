@extends('_layouts.master')

@section('body')
<div>
    <p class="drop-cap">
        Hello, I am eFrane. I am a
        <a class="text-blue-500 hover:text-pink-500" href="https://github.com/eFrane">programmer</a>,
        <a class="text-blue-500 hover:text-pink-500" href="https://eyeem.com/eFrane">photographer</a>,
        <a class="text-blue-500 hover:text-pink-500" href="https://meanderingsoul.com">blogger</a> and
        <a class="text-blue-500 hover:text-pink-500" href="https://www.last.fm/user/eFrane">listener to music</a>.
        If you encounter me
        <a class="text-blue-500 hover:text-pink-500" href="https://www.goodreads.com/user/show/5222663-stefan">without a book</a>
        in my carry-on, you can generally safely assume I'm ill.
    </p>
</div>
<div class="mt-4">
    <h1 class="text-2xl">Projects</h1>

    @foreach ($projects as $project)
    <section class="rounded border border-gray-600 p-4 mb-4 mt-0">
        <h2 class="text-xl">{{ $project->name }}</h2>

        <nav class="text-2xs">
            <ul class="md:inline-flex">
                <li class="flex-1">
                    GitHub:
                    <a href="https://github.com/{{ $project->github }}" class="text-blue-500 hover:text-pink-500">
                        {{ $project->github }}
                    </a>
                </li>
                <li class="flex-1">Website: <a href="{{ $project->website }}"  class="text-blue-500 hover:text-pink-500">{{ $project->website }}</a></li>
                <li class="flex-1">License: {{ $project->license }}</li>
            </ul>
        </nav>

        <article class="text-gray-600 font-thin">
            {!! $project->getContent() !!}
        </article>
    </section>
    @endforeach
</div>
@endsection
