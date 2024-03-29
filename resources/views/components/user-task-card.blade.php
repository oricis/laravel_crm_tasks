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

        @livewire('crm-tasks.close-task', [
            'userTaskId' => $task->id,
            'endedAt'    => $task->ended_at,
            'expiredAt'  => $task->expired_at,
        ], key("close-task-{$task->id}-key"))
    </div>

    <p class="flex justify-between mt-2 md:mt-3 bg-gray-200 p-1 md:p-2 md:py-3">
        <span>Group:</span><strong> {{ $task->group->title }}</strong>
    </p>
</article>
