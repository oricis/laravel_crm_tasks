<!-- components.feedbacks.error -->

@if (session('error'))
    <div class="alert-background
        bg-red-200 p-2 px-6 sm:p-5 sm:px-6 lg:px-8 border-solid border-1 border-red-900"
        data-timeout="{{ $timeout ?? 3000 }}">

        <div class="alert alert-danger
            flex justify-between">
            <span class="text-red-600">{!! session('error') !!}</span>
            <span class="text-red-600"
                onclick="closeFb()"
                role="button"
                title="Remove message">
                x
            </span>
        </div>
    </div>
@endif
