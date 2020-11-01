@extends('_layouts.master')

@section('title')
    Portfolio
@stop

@section('body')
<section class="font-thin">
    <p class="mx-auto text-center mb-4">
        Hello.  I am eFrane.
    </p>
    <p>
        I am a
        <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://meanderingsoul.com">blogger</a>,
        <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://www.youtube.com/channel/UCA9vabs2diMrQP4-Jm32Qwg">musician</a>,
        <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://eyeem.com/eFrane">photographer</a>,
        and <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://github.com/eFrane">programmer</a>
        from Berlin, Germany. Orthographical quirks include oxford commas and post-quotation-mark interpunction.
        If you encounter me
        <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://www.goodreads.com/user/show/5222663-stefan">without a book</a>
        in my carry-on, you can generally safely assume I'm ill.
    </p>
</section>
<section class="mt-4" role="region" aria-labelledby="things_header">
    <h2 class="text-2xl mb-2" id="things_header">Things I did and do</h2>

    <div class="md:flex md:flex-wrap md:bg-fixed bg-pattern pt-4">
        @foreach ($projects as $project)
            <section class="bg-white pr-4 pb-4 mb-4 mt-0 flex-none md:w-1/2 lg:w-1/3" role="region" aria-labelledby="{{ $project->getSnakeName() }}">
                <h3 class="text-xl" id="{{ $project->getSnakeName() }}">{{ $project->name }}</h3>

                <nav class="text-2xs pt-2 pb-2 border-mossy-green border-t-2 border-b-2 bg-opacity-25" aria-label="Meta information about {{ $project->name }}">
                    <ul class="grid grid-cols-4 place-items-center space-x-2">
                        @if ($project->github)
                        <li>
                            <a href="https://github.com/{{ $project->github }}" aria-label="Visit {{ $project->github }} on GitHub">
                                <img src="/assets/images/github.svg" alt="Icon to symbolize a repository" aria-hidden="true" width="24" height="24" />
                            </a>
                        </li>
                        @endif

                        @if ($project->website)
                        <li>
                            <a href="{{ $project->website }}" aria-label="Visit the project website for {{ $project->name }}">
                                <img src="/assets/images/site.svg" alt="Icon to symbolize a link" aria-hidden="true" width="24" height="24" />
                            </a>
                        </li>
                        @endif

                        @if ($project->license)
                        <li class="border-black border-2 p-1 rounded text-3xs cursor-default" aria-label="Software license">
                            {{ $project->license }}
                        </li>
                        @endif

                        @if ($project->hasDownloadCount())
                        <li aria-label="Total downloads" class="inline-flex items-center">
                            <img src="/assets/images/chart.svg" alt="Icon to symbolize statistics" aria-hidden="true" width="24" height="24" class="mr-1" />
                            <span title="Total download count for {{ $project->name }}, updated weekly">{{ $project->getDownloadCount() }}</span>
                        </li>
                        @endif
                    </ul>
                </nav>

                <div class="text-gray-700 font-thin pt-2">
                    {!! $project->getContent() !!}
                </div>
            </section>
        @endforeach
    </div>
</section>
@endsection
