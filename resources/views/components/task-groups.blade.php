<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <section class="flex justify-between my-10 mt-6">
        <h1 class="text-2xl font-medium text-gray-900">
            Tasks groups
        </h1>
        <div>
            <x-create-modal
                :formAction="$formAction"
                modalTitle="Create Task Group"
                useSubmit="true"
            >
                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input type="text"
                        id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="title"
                        required />
                </div>
                <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <input type="text"
                        id="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="description" />
                </div>
            </x-create-modal>
        </div>
    </section>
    <x-validation-errors class="my-2" />

    <article class="">
        <h3 class="hidden">Task groups</h3>

        @foreach ($taskGroups as $group)
            <article class="user-task-card my-5 py-2 px-5 border border-gray-200">
                <h3 class="font-medium">{{ $group->title }}</h3>
                @if ($group->description)
                    <p class="my-2">{{ $group->description }}</p>
                @endif
            </article>
        @endforeach

        <p class="py-2 border-t border-gray-200 text-grey-600">Total:
            <span class="text-grey-900" id="groups-total">{{ $taskGroups->count() }}</span>
        </p>
    </article>
</div>
