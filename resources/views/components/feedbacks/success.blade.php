<!-- components.feedbacks.error -->

@if (session('success'))
    <div class="alert-background
        bg-green-200 p-2 px-6 sm:p-5 sm:px-6 lg:px-8 border-solid border-1 border-green-900"
        data-timeout="{{ $timeout ?? 3000 }}">

        <div class="alert alert-danger
            flex justify-between">
            <span class="text-green-600">{!! session('success') !!}</span>
            <span class="text-green-600"
                onclick="closeFb()"
                role="button"
                title="Remove message">
                x
            </span>
        </div>
    </div>
@endif
