<div class="p-5 text-right">
    @if (! Route::is('get_task_groups'))
        <a class="focus:outline-none text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
            href="{{ route('get_task_groups') }}">
            Go to: Task Groups
        </a>
    @endif

    @if (! Route::is('get_system_tasks'))
        <a class="focus:outline-none text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
            href="{{ route('get_system_tasks') }}">
            Go to: Tasks
        </a>
    @else
        <a class="focus:outline-none text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
            href="{{ route('dashboard') }}">
            Go to: My tasks
        </a>
    @endif
</div>
