<article class="user-task-card my-5 py-2 px-5 border border-gray-200">
    <h5 class="hidden">Task</h5>

    <div class="flex flex-row justify-between">
        <div class="flex-grow min-w-180">
            <details class="text-gray-600">
                <summary class="text-2xl">{{ $task->title }}</summary>

                <p class="mb-2">{{ $task->description }}</p>

                <p>Started on: {{ $task->startTime->label }}</p>
                <p>Time limit: <strong class="text-red-500">{{ $task->expired_at }}</strong></p>
            </details>
        </div>

        <div class="min-w-180 text-right">
            @if ($task->expired_at)
                <strong class="text-green-600" data-tooltip-target="closed-at-tooltip--{{ $task->id }}">Ended</strong>
                <div id="closed-at-tooltip--{{ $task->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                    {{ $task->ended_at }}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            @else
                {{-- <x-tasks-start-times-selector :startTimes="$startTimes" :taskId="$task->id"/> --}}
            @endif
        </div>
    </div>
    <p class="flex justify-between mt-5 md:mt-8 bg-gray-200 p-1 md:p-2 md:py-3"><span>Group:</span><strong> {{ $task->group->title }}</strong></p>
</article>

@push('custom-scripts')
    <script defer src="{{ asset('js/components/tasks--task-card.js') }}"></script>
@endpush
