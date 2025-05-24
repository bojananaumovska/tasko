<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\IsOwner;
use App\Http\Middleware\IsNotOwner;
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
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::put('/tasks/{id}/markDone', [TaskController::class, 'markDone'])->name('tasks.markAsDone');//middleware

    Route::middleware([IsOwner::class])->group(function () {
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });

    //notifications
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.delete');
    //ratings
    Route::post('/ratings', [RatingController::class, 'store'])->name('rating.store');
    Route::put('/tasks/{id}/accept', [TaskController::class, 'accept'])->name('tasks.accept')->middleware([IsNotOwner::class]);
    //messages
    Route::post('/messages', [MessageController::class, 'store'])->name('message.store');
    Route::get('/task/{task}/messages', [MessageController::class, 'getMessages']);


    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/id/add-credits', [UserController::class, 'addCredits'])->name('user.add-credits');
    Route::post('/user/{id}/add-credits', [UserController::class, 'storeCredits'])->name('user.store-credits');

    Route::get('/payment/{task_id}', [PaymentController::class, 'index'])->name('payment.show');
    Route::post('/payment/{task_id}', [PaymentController::class, 'store'])->name('payments.store');
});

require __DIR__.'/auth.php';

