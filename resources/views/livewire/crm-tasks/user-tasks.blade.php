<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <section class="flex justify-between my-10 mt-6">
        <h1 class="text-2xl font-medium text-gray-900">
            Your tasks!
        </h1>

        <label class="inline-flex items-center cursor-pointer">
            <input type="checkbox"
                wire:model="onlyOpen"
                wire:click="updateTasks()"
                class="sr-only peer">
            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-focus:ring-green-600 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Open tasks only</span>
        </label>
    </section>

    <article class="">
        <h3 class="hidden">Tasks</h3>

        @livewire('crm-tasks.selectors.user-tasks-time-filter', [
            'selectedFilterLabel' => $timeFilters->last()->label,
            'timeFilters' => $timeFilters,
        ])

        <section class="my-5" id="tasks-list">
            <h4 class="hidden">Loaded tasks</h4>

            @foreach ($tasks as $task)
                @livewire('crm-tasks.user-task-card', [
                    'task' => $task,
                ], key("task-{$task->id}-key"))
            @endforeach

            <p class="py-2 border-t border-gray-200 text-grey-600">Total:
                <span class="text-grey-900" id="tasks-total">{{ $tasks->count() }}</span></p>
        </section>
    </article>
</div>
