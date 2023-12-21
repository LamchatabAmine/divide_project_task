<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\LoginUserController;

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


// Route::get('/', function () {
//     return view('auth.login');
// })->name('login')->middleware('guest');
// Route::get('/', [LoginUserController::class, 'create'])->name('login');
// Route::post('/login', [LoginUserController::class, 'store'])->name('login.store');





Route::middleware('auth')->group(function () {

    Route::prefix('project')->group(function () {
        // Route::resource('/', ProjectController::class);

        Route::get('/', [ProjectController::class, 'index'])->name("project.index");
        Route::get('/create', [ProjectController::class, 'create'])->name("project.create");
        Route::post('/create', [ProjectController::class, 'store'])->name("project.store");
        Route::get('/edit/{project}', [ProjectController::class, 'edit'])->name("project.edit");
        Route::PUT('/{project}', [ProjectController::class, 'update'])->name("project.update");
        Route::DELETE('/{project}', [ProjectController::class, 'destroy'])->name("project.destroy");

        Route::post('import/', [ProjectController::class, 'import'])->name('project.import');
        Route::get('export/', [ProjectController::class, 'export'])->name('project.export');
        Route::get('/search', [ProjectController::class, 'search'])->name("search.project");
    });
    // Task routes nested under project
    Route::prefix('tache')->group(function () {
        // Route::resource('/', TaskController::class);

        Route::get('/{project}', [TaskController::class, 'index'])->name("task.index");
        Route::get('/{project}/create', [TaskController::class, 'create'])->name("task.create");
        Route::post('/{project}/create', [TaskController::class, 'store'])->name("task.store");
        Route::get('/{project}/edit/{task}', [TaskController::class, 'edit'])->name("task.edit");
        Route::PUT('/{project}/{task}', [TaskController::class, 'update'])->name("task.update");
        Route::DELETE('/{project}/{task}', [TaskController::class, 'destroy'])->name("task.destroy");


        Route::get('/{project}/export/', [TaskController::class, 'export'])->name('task.export');
        Route::post('/{project}/import/', [TaskController::class, 'import'])->name('task.import');
        Route::get('/{project}/search', [TaskController::class, 'search'])->name("search.task");

    });
    Route::prefix('member')->group(function () {
        // Route::resource('/', MemberController::class);

        Route::get('/', [MemberController::class, 'index'])->name("member.index");
        Route::get('/create', [MemberController::class, 'create'])->name("member.create");
        Route::post('/create', [MemberController::class, 'store'])->name("member.store");
        Route::get('/edit/{member}', [MemberController::class, 'edit'])->name("member.edit");
        Route::PUT('/{member}', [MemberController::class, 'update'])->name("member.update");
        Route::DELETE('/{member}', [MemberController::class, 'destroy'])->name("member.destroy");
        Route::post('import/', [MemberController::class, 'import'])->name('member.import');
        Route::get('export/', [MemberController::class, 'export'])->name('member.export');
        Route::get('/search', [MemberController::class, 'search'])->name("search.member");

    });
    // Route::post('logout', [LoginUserController::class, 'destroy'])->name('logout');
    Route::get('/', function () {
        return redirect()->route('project.index');
    });
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
