<div class="min-w-180 text-right">
    @if ($endedAt)
        <strong class="text-green-600" data-tooltip-target="closed-at-tooltip--{{ $userTaskId }}">Ended</strong>
        <div id="closed-at-tooltip--{{ $userTaskId }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
            {{ $endedAt }}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    @else
        @if (now() > $expiredAt)
            <strong class="text-red-500" data-tooltip-target="expired-at-tooltip--{{ $userTaskId }}">Time expired</strong>
            <div id="expired-at-tooltip--{{ $userTaskId }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                {{ (new Carbon\Carbon($expiredAt))->diffForHumans(new Carbon\Carbon(now())) }}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        @else
            <button type="button"
                wire:click="close"
                data-action="close-task"
                data-id="{{ $userTaskId }}"
                class="focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                Close
            </button>

            {{ $endedAt }}
        @endif
    @endif
</div>
