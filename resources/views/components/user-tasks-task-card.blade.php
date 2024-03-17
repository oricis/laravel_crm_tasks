<article class="user-task-card my-5 py-2 px-5 border border-gray-200">
    <h5 class="hidden">Task</h5>

    <div class="flex flex-row justify-between">
        <div class="flex-grow min-w-180">
            <details class="text-gray-600">
                <summary class="text-2xl">{{ $task->title }}</summary>

                <p class="mb-2">{{ $task->description }}</p>

                <p>Started at: {{ $task->created_at }}</p>
                <p>Time limit: <strong class="text-red-500">{{ $task->expired_at }}</strong></p>
            </details>
        </div>

        <div class="min-w-180 text-right">
            @if ($task->ended_at)
                <strong class="text-green-600" data-tooltip-target="closed-at-tooltip--{{ $task->id }}">Ended</strong>
                <div id="closed-at-tooltip--{{ $task->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                    {{ $task->ended_at }}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            @else
                @if (now() > $task->expired_at)
                    <strong class="text-red-500" data-tooltip-target="expired-at-tooltip--{{ $task->id }}">Time expired</strong>
                    <div id="expired-at-tooltip--{{ $task->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                        {{ (new Carbon\Carbon($task->expired_at))->diffForHumans(new Carbon\Carbon(now())) }}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                @else
                    <button type="button"
                        data-action="close-task"
                        data-id="{{ $task->id }}"
                        class="focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                        Close
                    </button>
                @endif
            @endif
        </div>
    </div>
    <p class="flex justify-between mt-5 md:mt-8 bg-gray-200 p-1 md:p-2 md:py-3"><span>Group:</span><strong> {{ $task->group->title }}</strong></p>
</article>

@push('custom-scripts')
    <script defer src="{{ asset('js/components/user-tasks--task-card.js') }}"></script>
@endpush
