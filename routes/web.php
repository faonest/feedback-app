<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CommentsController;
use App\Models\FeedBack;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;

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
    $feedbacks = FeedBack::all();
    return view('welcome')->with([
        'feedbacks' => $feedbacks,
    ]);
});

Route::middleware(['auth', 'RoleCheck'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/createComment', [CommentsController::class, 'createComment'])->name('createComment');
    Route::get('/createVote/{id}', [CommentsController::class, 'createVote'])->name('createVote');

    Route::prefix('user')->middleware('IsUser')->group(function () {
        Route::get('/dashboard', [FeedbackController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/feedback', [FeedbackController::class, 'feedback'])->name('feedback');
        Route::post('/storeFeedback', [FeedbackController::class, 'storeFeedback'])->name('storeFeedback');
    });

    Route::prefix('admin')->middleware('IsAdmin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('users', [AdminController::class, 'users'])->name('users');
        Route::get('deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

        Route::post('updateCommentStatus', [AdminController::class, 'updateCommentStatus'])->name('updateCommentStatus');
        Route::get('deleteFeedback/{id}', [AdminController::class, 'deleteFeedback'])->name('deleteFeedback');
    });
});

require __DIR__ . '/auth.php';
