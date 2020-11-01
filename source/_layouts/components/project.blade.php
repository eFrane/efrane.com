@component('_layouts.components.section')

    @slot('sectionName')
        {{ $project->name }}
    @endslot

    @slot ('sectionContent')
        <nav class="text-2xs pt-2 pb-2 border-mossy-green border-t-2 border-b-2 bg-opacity-25" aria-label="Meta information about {{ $project->name }}">
            <ul class="grid grid-cols-4 place-items-center space-x-2">
                @includeWhen($project->github, '_partials.project.github')
                @includeWhen($project->website, '_partials.project.website')
                @includeWhen($project->license, '_partials.project.license')
                @includeWhen($project->hasDownloadCount(), '_partials.project.statistics')
            </ul>
        </nav>

        <div class="text-gray-700 font-thin pt-2">
            {!! $project->getContent() !!}
        </div>

        @if ($project->inactive)
        <div class="text-gray-700 font-medium pt-2 text-2xs text-center">(This project is currently inactive.)</div>
        @endif
    @endslot

@endcomponent
