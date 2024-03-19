<!-- components.feedbacks.error -->

@if (session('warn'))
    <div class="alert-background
        bg-yellow-100 p-2 px-6 sm:p-5 sm:px-6 lg:px-8 border-solid border-1 border-orange-700"
        data-timeout="{{ $timeout ?? 3000 }}">

        <div class="alert alert-danger
            flex justify-between">
            <span class="text-orange-500">{!! session('warn') !!}</span>
            <span class="text-orange-500"
                onclick="closeFb()"
                role="button"
                title="Remove message">
                x
            </span>
        </div>
    </div>
@endif
