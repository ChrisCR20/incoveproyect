<?php

use App\Http\Controllers\empresaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\sucursalController;
use App\Http\Controllers\empleadoController;
use App\Http\Controllers\clientesController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\medidaController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\compraController;
use App\Http\Controllers\ventaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::group(['middleware' => ['auth']], function() {


    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('posts', PostController::class);
    Route::resource('empresa',empresaController::class);
    Route::resource('sucursal',sucursalController::class);
    Route::resource('empleado',empleadoController::class);
    Route::resource('ventas',ventasController::class);
    Route::resource('clientes',clientesController::class);
    Route::resource('proveedor',proveedorController::class);
    Route::resource('categoria',categoriaController::class);
    Route::resource('marca',marcaController::class);
    Route::resource('medida',medidaController::class);
    Route::resource('producto',productoController::class);
    Route::resource('compra',compraController::class);
     Route::resource('venta',ventaController::class);

    //Categoria
    Route::get('indexcategoria', 'App\Http\Controllers\categoriaController@index'); 
    Route::post('producto/ingreso', 'App\Http\Controllers\categoriaController@store');// crear categoria con modal en vista producto
    Route::post('getcategorias',[categoriaController::class,'obtenercategoria'])->name('getcategoriass');

    //Marca
    Route::post('producto/crear', 'App\Http\Controllers\marcaController@store'); // crear marca con modal en vista producto
    Route::post('getmarcas',[marcaController::class,'obtenermarca'])->name('getmarcass');

    //Medida
    Route::post('producto/crearmedida', 'App\Http\Controllers\medidaController@store'); // crear medida con modal en vista producto
    Route::post('getmedidas',[medidaController::class,'obtenermedida'])->name('getmedidass');

    //Compras
    Route::get('indexcompras', 'App\Http\Controllers\compraController@index');
    Route::post('compra/ingreso', 'App\Http\Controllers\compraController@store');// crear categoria con modal en vista producto 

    //Ventas
    //Route::get('venta/create', 'App\Http\Controllers\ventaController@create');
    Route::get('venta/obtener/nit/{nit}', 'App\Http\Controllers\ventaController@getnit');
    Route::get('venta/obtener/p_unitario/{id}', 'App\Http\Controllers\ventaController@getunitario'); // obtener precio unitario de producto
    Route::post('venta/crearcliente', 'App\Http\Controllers\clientesController@storecl');
    // Route::get('ventanew', 'App\Http\Controllers\ventaController@create');
    // Route::post('venta/ingreso', 'App\Http\Controllers\clientesController@storecl');// crear categoria con modal en vista producto
    


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas users
Route::get('users/delete/{id}', 'App\Http\Controllers\UserController@destroy');
//rutas roles
Route::get('roles/delete/{id}', 'App\Http\Controllers\RoleController@destroy');

//rutas empresa
// Route::get('empresa/nuevo', 'App\Http\Controllers\empresaController@create');

// Route::get('empresa/index', 'App\Http\Controllers\empresaController@index');
// Route::post('empresa/store', 'App\Http\Controllers\empresaController@store');
//rutas sucursal
// Route::get('sucursal/nuevo', 'App\Http\Controllers\sucursalController@create');
// Route::get('sucursal/index', 'App\Http\Controllers\sucursalController@index');
