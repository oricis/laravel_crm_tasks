<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <section class="flex justify-between my-10 mt-6">
        <h1 class="text-2xl font-medium text-gray-900">
            Registered Tasks
        </h1>
        <div>
            <x-create-modal
                :formAction="$formAction"
                modalTitle="Create Task"
                useSubmit="true"
            >
                <div class="mb-6">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input type="text" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="title" required />
                </div>
                <div class="mb-6">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <input type="text" id="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="description" />
                </div>
                <div class="mb-6">
                    <label for="task-groups" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        a group</label>
                    <select id="task-groups"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="task_group_id">
                        @foreach ($taskGroups as $group)
                            <option value="{{ $group->id }}">{{ $group->title }}</option>
                            </p>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6 mt-5 border-t-2 border-gray-300 pt-5">
                    <label for="start-times" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        time to start</label>
                    <select id="start-times"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="start_time_id">
                        @foreach ($startTimes as $startTime)
                            <option value="{{ $startTime->id }}">{{ $startTime->label }}</option>
                            </p>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label for="expiration-times"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select time limit to complete</label>
                    <select id="expiration-times"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="expiration_time_id">
                        @foreach ($expirationTimes as $expirationTime)
                            <option value="{{ $expirationTime->id }}">{{ $expirationTime->label }}</option>
                            </p>
                        @endforeach
                    </select>
                </div>

                <label for="start_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Period of time where the task will be assigned</label>
                <div date-rangepicker class="flex items-center">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="start_at" name="start_at" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Active from">
                    </div>
                    <span class="mx-7 text-gray-500">to</span>

                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input name="expired_at" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Active to">
                    </div>
                </div>

                @push('custom-scripts')
                    <script defer src='https://flowbite.com/docs/datepicker.min.js'>
                @endpush
            </x-create-modal>
        </div>
    </section>
    <x-validation-errors class="my-2" />

    <article class="">
        <h3 class="hidden">Tasks</h3>

        <section class="my-5" id="tasks-list">
            <h4 class="hidden">Loaded tasks</h4>

            @foreach ($tasks as $task)
                <x-tasks-task-card :task="$task" :startTimes="$startTimes" />
            @endforeach

            <p class="py-2 border-t border-gray-200 text-grey-600">Total:
                <span class="text-grey-900" id="tasks-total">{{ $tasks->count() }}</span>
            </p>
        </section>
    </article>
</div>
