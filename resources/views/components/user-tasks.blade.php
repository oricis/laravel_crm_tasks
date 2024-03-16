<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <section class="flex justify-between my-10 mt-6">
        <h1 class="text-2xl font-medium text-gray-900">
            Your tasks!
        </h1>

        <label class="inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer" checked>
            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-600 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Open tasks only</span>
        </label>
    </section>


    <article class="">
        <h3 class="hidden">Tasks</h3>

        <div class="py-2 border-b border-gray-200">
            <button id="timeFiltersButton"
                data-dropdown-toggle="timeFilters"
                data-dropdown-delay="500"
                data-dropdown-trigger="hover"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                {{ $timeFilters->last()->label }}
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="timeFilters"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="timeFiltersButton">
                    @foreach ($timeFilters as $timeFilter)
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-id="{{ $timeFilter->id }}"
                                title="{{ $timeFilter->description }}">
                                {{ $timeFilter->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </article>

    @push('custom-scripts')
        <script defer src="{{ asset('js/components/user-task--filters.js') }}"></script>
    @endpush
</div>
