<x-layout>
    <x-job-card :$job>
        <div>
            <x-link-button :href="route('jobs.index')">
                Back
            </x-link-button>
        </div>
    </x-job-card>
</x-layout>
