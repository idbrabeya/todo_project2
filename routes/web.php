<?php


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DependencyController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\BoardController;
use App\Models\Board;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/info_create',[HomeController::class,'info_create'])->name('info.create');
Route::get('/info_data_show',[HomeController::class,'info_data_show'])->name('info.data.show');
Route::get('/info_edit/{id}',[HomeController::class,'info_edit'])->name('info.edit');
Route::post('/info_update/{id}',[HomeController::class,'info_update'])->name('info.update');
Route::get('/info_delete/{id}',[HomeController::class,'info_delete'])->name('info.delete');
Route::post('/status/change/',[HomeController::class,'status_change'])->name('status.change');


// todo list

Route::get('/todo/list/create',[TodoController::class,'todo_list_create'])->name('todo.list');
Route::post('/todolist/insert',[TodoController::class,'todolist_insert'])->name('todolist.insert');
Route::get('/todo/edit/{id}',[TodoController::class,'todo_edit'])->name('todo.edit');
Route::post('/todo/update',[TodoController::class,'todo_update'])->name('todo_update');
Route::get('/todo/delete/{id}',[TodoController::class,'todo_delete'])->name('todo_delete');
Route::get('/todo/view/{id}',[TodoController::class,'todo_view'])->name('todo_view');

// task

Route::get('/task/index/',[TodoController::class,'task_index'])->name('task.index');
Route::post('/task/list/insert',[TodoController::class,'task_list_insert'])->name('task.list.insert');
Route::get('/task/list',[TodoController::class,'task_list'])->name('task.list');
Route::get('/task/edit/{id}',[TodoController::class,'task_edit'])->name('task.edit');
Route::post('/task/update',[TodoController::class,'task_update'])->name('task.update');
Route::get('/task/delete/{id}',[TodoController::class,'task_delete'])->name('task.delete');

Route::get('/status/change',[TodoController::class,'status_change'])->name('status.change');

// task assignees
Route::get('/assignee',[TodoController::class,'assignee'])->name('assignee');

// profile
Route::get('/employee',[HomeController::class,'employee'])->name('employee');
Route::post('/add/employee',[HomeController::class,'add_employee'])->name('add.employee');
Route::post('/employee/status/',[HomeController::class,'employee_status'])->name('employee.status');
Route::get('/user/delete/{id}',[HomeController::class,'user_delete'])->name('user.delete');


// user
// Route::get('/all/user',[HomeController::class,'all_user'])->name('all.user');
// Route::get('/all/user/delete/{id}',[HomeController::class,'all_user_delete'])->name('all.user.delete');

// board
Route::get('/boardindex',[BoardController::class,'board_index'])->name('board.index');
Route::get('/boardtodocreate',[BoardController::class,'boardtodo_create'])->name('boardtodo.create');
Route::get('/view/all',[BoardController::class,'view_all'])->name('view.all');