<?php

use App\Modules\CrmTasks\Http\Controllers\CrmHomeController;
use App\Modules\CrmTasks\Http\Controllers\CrmTaskController;
use App\Modules\CrmTasks\Http\Controllers\CrmTaskGroupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get(
        '/crm-dashboard',
        [CrmHomeController::class, 'home']
    )->name('crm_dashboard');

    Route::get(
        '/crm_tasks',
        [CrmTaskController::class, 'get']
    )->name('get_crm_system_tasks');
    Route::post(
        '/crm_tasks',
        [CrmTaskController::class, 'create']
    )->name('create_crm_system_tasks');

    Route::get(
        '/crm_task-groups',
        [CrmTaskGroupController::class, 'get']
    )->name('get_crm_task_groups');
    Route::post(
        '/crm_task-groups',
        [CrmTaskGroupController::class, 'create']
    )->name('create_crm_task_groups');
});
