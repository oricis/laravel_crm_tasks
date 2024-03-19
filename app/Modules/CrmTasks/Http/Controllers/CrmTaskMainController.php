<?php

namespace App\Modules\CrmTasks\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CrmTaskMainController extends Controller
{

    protected function goBackWithError(
        string $message = 'Something was wrong...',
        bool $includeInput = true
    ): RedirectResponse
    {
        if ($includeInput) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $message);
        }

        return redirect()
            ->back()
            ->with('error', $message);
    }

    protected function goBackWithSuccess(
        string $message = 'Action completed!',
        bool $includeInput = true
    ): RedirectResponse
    {
        if ($includeInput) {
            return redirect()
                ->back()
                ->withInput()
                ->with('success', $message);
        }

        return redirect()
            ->back()
            ->with('success', $message);
    }
}
