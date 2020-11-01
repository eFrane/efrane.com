<section class="bg-white pr-4 pb-4 mb-4 mt-0 flex-none md:w-1/2 lg:w-1/3" role="region" aria-labelledby="{{ snake($sectionName) }}">
    <h3 class="text-xl" id="{{ snake($sectionName) }}">{{ $sectionName }}</h3>

    {!! $sectionContent !!}
</section>
