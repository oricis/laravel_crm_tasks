<article class="user-task-card my-5 py-2 px-5 border border-gray-200">
    <h5 class="hidden">Task</h5>

    <div class="flex flex-row justify-between">
        <div class="flex-grow min-w-180">
            <details class="text-gray-600">
                <summary class="text-2xl">{{ $task->title }}</summary>

                <p class="mb-2">{{ $task->description }}</p>

                <p>Started time: <strong class="text-gray-500">{{ $task->startTime->label }}</strong></p>
                <p>Time limit to complete:
                    <strong class="text-gray-500">{{ $task->expirationTime ? $task->expirationTime->label : 'without time limit' }}</strong>
                </p>

            </details>
        </div>

        <div class="min-w-180 text-right">
            <span class="text-green-600" data-tooltip-target="active-period-tooltip--{{ $task->id }}">
                @if ($task->start_at <= now()
                    && now() <= $task->expired_at)
                    <strong class="text-green-600">
                        Active
                    </strong>
                @else
                    <strong class="text-red-600">
                        Inactive
                    </strong>
                @endif
            </span>

            <div id="active-period-tooltip--{{ $task->id }}"
                role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                Active from: {{ $task->start_at }} to {{ $task->expired_at }}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
    </div>

    <p class="flex justify-between mt-2 md:mt-3 bg-gray-200 p-1 md:p-2 md:py-3">
        <span>Group:</span><strong> {{ $task->group->title }}</strong>
    </p>
</article>
