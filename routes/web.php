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
        '/dashboard',
        [CrmHomeController::class, 'home']
    )->name('dashboard');

    Route::get(
        '/tasks',
        [CrmTaskController::class, 'get']
    )->name('get_system_tasks');
    Route::post(
        '/tasks',
        [CrmTaskController::class, 'create']
    )->name('create_system_tasks');

    Route::get(
        '/task-groups',
        [CrmTaskGroupController::class, 'get']
    )->name('get_task_groups');
    Route::post(
        '/task-groups',
        [CrmTaskGroupController::class, 'create']
    )->name('create_task_groups');
});
