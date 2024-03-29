<div id="time-filters" class="py-2 border-b border-gray-200">
    <button type="button"
        id="timesButton"
        data-dropdown-toggle="times--{{ $taskId }}"
        data-dropdown-delay="500"
        data-dropdown-trigger="hover"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        {{ $startTimes->last()->label }}
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="times--{{ $taskId }}"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="timesButton">
            @foreach ($startTimes as $time)
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-id="{{ $time->id }}"
                        title="{{ $time->description }}">
                        {{ $time->label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
