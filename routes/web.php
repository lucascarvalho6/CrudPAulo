<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicoController;
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
    return view('index');
});
Route::post('adicionar-agendamento',[ServicoController::class,'create'])->name('create');
Route::get('consultar',[ServicoController::class,'listar'])->name('read_agendamentos');
Route::get('editar/{id}',[ServicoController::class,'editar'])->name('oi');
Route::post('atualizar',[ServicoController::class,'atualizar'])->name('update_agendamento');
Route::get('excluir/{id}',[ServicoController::class,'excluir']);