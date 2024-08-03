<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BloqueController;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FincaController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\ProductoCicloController;
use App\Http\Controllers\AgrupacionController;
use App\Http\Controllers\UserController;
use App\Http\Controller\AdminDashboardController;

// Rutas p�blicas
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticaci�n
// Route::get('/login', [AuthManager::class, 'login'])->name('login');
// Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
// Route::get('/register', [AuthManager::class, 'register'])->name('register');
// Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');
// Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

// Rutas protegidas por autenticaci�n
Route::get('/profile', function () {
    return "hi";
})->name('profile');

// Rutas para el superadministrador


// Rutas para el administrador


// Rutas para usuarios

// Rutas para otros recursos


// Rutas para la API
Route::get('/api/lotes/{finca}', [AgrupacionController::class, 'getLotesByFinca']);
Route::get('/lotesFinca/{fincaId}', [AgrupacionController::class, 'getLotesByFinca']);
Route::get('/bloquesFinca/{loteId}', [AgrupacionController::class, 'getBloquesByLote']);

// Ruta para el formulario de registro de usuarios
//Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');
//Route::post('/register', [UserController::class, 'register'])->name('register.post');

// Ejemplo de ruta para el sidebar (puedes eliminarla si no la necesitas)
Route::get('/sidebar', function () {
    return view('sidebar');
})->name('sidebar');

Route::middleware('auth')->group(function () {
//rutas que ocupan estar logeado
Route::resource('bodegas', 'App\Http\Controllers\BodegaController');
Route::resource('lotes', LoteController::class);
Route::resource('bloques', BloqueController::class);
Route::resource('clasificaciones', ClasificacionController::class);
Route::resource('productos', ProductoController::class);
Route::resource('programas', ProgramaController::class);
Route::resource('ciclos', CicloController::class);
Route::resource('productoCiclos', ProductoCicloController::class);
Route::resource('agrupaciones', AgrupacionController::class);
Route::get('/superadmin/dashboard', [SuperadminController::class, 'dashboard'])->name('superadmin.dashboard');
Route::get('/superadmin/register', [SuperadminController::class, 'register'])->name('superadmin.register');
Route::resource('/superadmin/admins', AdminController::class);
Route::resource('users', UserController::class);
Route::resource('/admin/employees', EmployeeController::class);
Route::get('/superadmin/index', [SuperadminController::class, 'index'])->name('superadmin.index');
Route::resource('/superadmin/companies', CompanyController::class);
Route::resource('/admin/fincas', FincaController::class);
Route::get('/superadmin/employees/register', [SuperadminController::class, 'showEmployeeRegister'])->name('superadmin.employees.register');

//ruta para que menu dashboard de admin

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('/admin/employees', EmployeeController::class);

// Rutas para el empleado
Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');

});

require __DIR__.'/auth.php';