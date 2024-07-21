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
        I am a <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://meanderingsoul.com">blogger</a>,
        <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://www.youtube.com/channel/UCA9vabs2diMrQP4-Jm32Qwg">musician</a>,
        <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://eyeem.com/eFrane">photographer</a>,
        and <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://github.com/eFrane">programmer</a>
        from Berlin, Germany. Orthographical quirks include oxford commas and post-quotation-mark interpunction.
        If you encounter me
        <a class="text-mossy-green-light hover:text-mossy-green underline" href="https://www.goodreads.com/user/show/5222663-stefan">without a book</a>
        in my carry-on, you can generally safely assume I'm ill.
    </p>
</section>
<section class="mt-4" role="region" aria-labelledby="projects-header">


    <h2 class="text-2xl mb-2" id="projects-header">Projects</h2>

    <p class="font-thin">
        I am a big proponent of open source software. Below is a list of projects I have worked on in the past.
        Most of these are still actively maintained or even improved upon. Find out more by visiting the linked
        websites or code repositories.
    </p>

    <div class="flex mt-4 pt-4 w-11/12 mx-auto">
        <img
                src="{{ 'assets/images/contributionsgraph.png'  }}"
                width="2048"
                height="64"
                alt="A graph representation of my GitHub contributions from {{ $page->contributionsStart }} to {{ $page->contributionsEnd }}."
                class="object-fill w-full"
                aria-hidden="true"
        />
    </div>
    <div class="md:flex md:flex-wrap md:bg-fixed bg-pattern">
        @each('_layouts.components.project', $projects, 'project')
    </div>
</section>
@endsection
