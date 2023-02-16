<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispositionController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OutboxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TemplateLetterController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    // Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('verify', [AuthController::class, 'verify_login'])->name('verify_login');
    // Route::post('verify-register', [AuthController::class, 'verifyRegister'])->name('verify_register');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:user,admin')->group(function () {
    // Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::prefix('manages')->name('manage.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('page');
            Route::post('/', [AdminController::class, 'store'])->name('store');
            Route::get('detail', [AdminController::class, 'detail'])->name('detail');
            Route::get('delete', [AdminController::class, 'delete'])->name('delete');
        });
        Route::prefix('settings')->name('setting.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('page');
            Route::post('/', [SettingController::class, 'store'])->name('store');
            Route::get('reset', [SettingController::class, 'reset'])->name('reset');
        });

        Route::prefix('types')->name('type.')->group(function () {
            Route::get('/', [TypeController::class, 'index'])->name('page');
            Route::post('/', [TypeController::class, 'store'])->name('store');
            Route::get('more/{code}', [TypeController::class, 'more'])->name('more');
            Route::get('detail', [TypeController::class, 'detail'])->name('detail');
            Route::get('delete', [TypeController::class, 'delete'])->name('delete');
        });

        Route::prefix('templates')->name('template.')->group(function () {
            Route::get('/', [TemplateController::class, 'index'])->name('page');
            Route::post('/', [TemplateController::class, 'store'])->name('store');
            // Route::get('detail', [TypeController::class, 'detail'])->name('detail');
            Route::get('delete', [TemplateController::class, 'delete'])->name('delete');
        });

        Route::prefix('profiles')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'admin'])->name('page');
            Route::post('update', [ProfileController::class, 'update'])->name('update');
            Route::post('reset-password', [ProfileController::class, 'update_password'])->name('update_password');
        });

        Route::prefix('instructions')->name('instruction.')->group(function () {
            Route::get('/', [InstructionController::class, 'index'])->name('page');
            Route::post('/', [InstructionController::class, 'store'])->name('store');
        });

        Route::prefix('users')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('page');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('detail', [UserController::class, 'detail'])->name('detail');
        });

        Route::prefix('messages')->name('message.')->group(function () {
            Route::prefix('inbox')->name('inbox.')->group(function () {
                Route::get('/', [InboxController::class, 'index'])->name('page');
                // Route::get('internal', [InboxController::class, 'internal'])->name('internal');
                Route::get('detail/{id}', [InboxController::class, 'detail'])->name('detail');
                Route::get('create', [InboxController::class, 'create'])->name('create');
                Route::post('save', [InboxController::class, 'store'])->name('store');
                Route::post('save-detail', [InboxController::class, 'save'])->name('save');
                Route::get('delete', [InboxController::class, 'delete'])->name('delete');
                Route::prefix('dispositions')->name('disposition.')->group(function () {
                    Route::get('in', [DispositionController::class, 'in'])->name('in');
                    Route::get('out', [DispositionController::class, 'out'])->name('out');
                    Route::post('create', [DispositionController::class, 'store'])->name('store');
                    Route::get('message/{code}', [DispositionController::class, 'create'])->name('create');
                    Route::get('detail/{code}', [DispositionController::class, 'detail'])->name('detail');
                });
            });
            Route::prefix('outbox')->name('outbox.')->group(function () {
                Route::get('/', [OutboxController::class, 'outbox'])->name('page');
                Route::get('create', [OutboxController::class, 'create'])->name('create');
            });
            Route::prefix('draft')->name('draft.')->group(function () {
                Route::get('/', [OutboxController::class, 'draft'])->name('page');
                Route::get('create', [OutboxController::class, 'create'])->name('create');
            });
            Route::prefix('chats')->name('chat.')->group(function () {
                Route::post('/', [ChatController::class, 'store'])->name('store');
                Route::get('delete', [ChatController::class, 'delete'])->name('delete');
            });
        });

        Route::prefix('template-letters')->name('template_letter.')->group(function () {
            Route::get('/', [TemplateLetterController::class, 'index'])->name('page');
            Route::post('/', [TemplateLetterController::class, 'store'])->name('store');
            // Route::post('update', [ProfileController::class, 'update'])->name('update');
            // Route::post('reset-password', [ProfileController::class, 'update_password'])->name('update_password');
        });
    });
});

// Route::prefix('users')->name('user.')->group(function () {
//     Route::get('dashboard', [DashboardController::class, 'user'])->name('dashboard');

//     // Route::prefix('admins')->name('admin.')->group(function () {
//     //     Route::get('/', [AdminController::class, 'index'])->name('index');
//     //     Route::post('/', [AdminController::class, 'store'])->name('store');
//     //     Route::get('create', [AdminController::class, 'create'])->name('create');
//     // });
// })->middleware('auth:user');
