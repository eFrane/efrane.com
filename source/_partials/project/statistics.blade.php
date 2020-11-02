<li aria-label="Total downloads" class="inline-flex items-center">
    <img src="/assets/images/chart.svg" alt="Icon to symbolize statistics" aria-hidden="true" width="24" height="24" class="mr-1" />
    <span title="Total download count for {{ $project->name }}, updated weekly">{{ $project->getRoundedDownloadCount() }}</span>
</li>
