<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isAssociatedWithTask;
use App\Http\Middleware\isNotificationOwner;
use App\Http\Middleware\IsOwner;
use App\Http\Middleware\IsNotOwner;
use App\Http\Middleware\isClient;
use App\Http\Middleware\isWorker;
use App\Models\Message;
use App\Models\Payment;
use App\Models\User;

Route::get('/', function () {
    return view('basic.home');
})->name('home');
Route::get('/about-us', function () {
    return view('basic.about-us');
})->name('about-us');

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->middleware([isClient::class])->name('tasks.create');//is client middleware
    Route::post('/tasks', [TaskController::class, 'store'])->middleware([isClient::class])->name('tasks.store');//is client middleware
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::put('/tasks/{id}/markDone', [TaskController::class, 'markDone'])->middleware([isWorker::class, isAssociatedWithTask::class])->name('tasks.markAsDone');//isWorker middleware

    Route::middleware([IsOwner::class])->group(function () {
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->middleware([IsOwner::class])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->middleware([IsOwner::class])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->middleware([IsOwner::class])->name('tasks.destroy');
    });
    Route::put('/tasks/{id}/accept', [TaskController::class, 'accept'])->middleware([IsNotOwner::class])->name('tasks.accept');

    //notifications
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->middleware([isNotificationOwner::class])->name('notifications.delete');
    //ratings
    Route::post('/ratings', [RatingController::class, 'store'])->middleware([isAssociatedWithTask::class])->name('rating.store');//is associated with the task middleware
    //messages
    Route::post('/messages', [MessageController::class, 'store'])->middleware([isAssociatedWithTask::class])->name('message.store');//is associated with the task middleware
    Route::get('/task/{task}/messages', [MessageController::class, 'getMessages'])->middleware([isAssociatedWithTask::class]);//is associated with the task middleware


    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->middleware([isAdmin::class])->name('user.edit');//is admin middleware
    Route::put('/user/{id}/update', [UserController::class, 'update'])->middleware([isAdmin::class])->name('user.update');//is admin middleware
    Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->middleware([isAdmin::class])->name('user.destroy');//is admin middleware
    Route::get('/user/{id}/add-credits', [UserController::class, 'addCredits'])->name('user.add-credits');
    Route::post('/user/{id}/add-credits', [UserController::class, 'storeCredits'])->name('user.store-credits');
    Route::post('/user/{id}/withdraw-credits', [UserController::class, 'withdrawCredits'])->name('user.withdraw-credits');

    Route::get('/payment/{task_id}', [PaymentController::class, 'index'])->middleware([isAssociatedWithTask::class])->name('payment.show');//is associated with the task middleware
    Route::post('/payment/{task_id}', [PaymentController::class, 'store'])->middleware([isAssociatedWithTask::class])->name('payments.store');//is associated with the task middleware

    Route::get('/admin-pannel', [AdminController::class, 'index'])->middleware([isAdmin::class])->name('admin');//is admin middleware
});

require __DIR__.'/auth.php';

