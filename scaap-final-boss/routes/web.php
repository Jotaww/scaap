<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScaapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ScaapController::class, 'viewHomePage'])->name('homePage');
Route::get('/scaap/visualizar/{id}', [ScaapController::class, 'viewVisualizar']);

Route::get('/scaap/create/form', [ScaapController::class, 'viewCreateForm'])->middleware('auth');
Route::post('/create', [ScaapController::class, 'createForm'])->middleware('auth');

Route::get('/scaap/edit/form', [ScaapController::class, 'viewEdit'])->middleware('auth');
Route::put('/edit', [ScaapController::class, 'editForm'])->middleware('auth');
Route::get('/scaap/edit/form/seg/delete/{idSeg}', [ScaapController::class, 'deleteSegmentoUser'])->middleware('auth');
Route::get('/scaap/edit/form/anexo/delete/{idAnexo}', [ScaapController::class, 'deleteAnexoUser'])->middleware('auth');


Route::get('/scaap/admin/login', [AdminController::class, 'loginAdmin']);
Route::post('/scaap/admin/login', [AdminController::class, 'authAdmin']);

Route::group(['middleware' => 'adminauth'], function () {
  Route::get('/scaap/admin', [AdminController::class, 'viewAdmin']);

  Route::get('/scaap/admin/administradores', [AdminController::class, 'viewAdministradores']);
  Route::post('/scaap/admin/administradores', [AdminController::class, 'createAdministrador']);
  Route::get('/scaap/admin/administradores/bloquear/{id}', [AdminController::class, 'bloquearAdministrador']);
  Route::get('/scaap/admin/administradores/desbloquear/{id}', [AdminController::class, 'desbloquearAdministrador']);
  Route::get('/scaap/admin/administradores/deletar/{id}', [AdminController::class, 'deletarAdministrador']);

  Route::get('/scaap/admin/segmentos', [AdminController::class, 'viewSegmentos']);
  Route::post('/scaap/admin/segmentos', [AdminController::class, 'createSegmento']);
  Route::get('/scaap/admin/segmentos/deletar/{id}', [AdminController::class, 'deletarSegmento']);
  Route::get('/scaap/admin/segmentos/editar/{id}', [AdminController::class, 'editarSegmento']);
  Route::put('/scaap/admin/segmentos/editar/{id}', [AdminController::class, 'atualizarSegmento']);

  Route::get('/scaap/admin/lista/produtorCultural', [AdminController::class, 'viewProdutorCultural']);
  Route::get('/scaap/admin/lista/produtorEsportivo', [AdminController::class, 'viewProdutorEsportivo']);
  Route::get('/scaap/admin/lista/artista', [AdminController::class, 'viewArtista']);
  Route::get('/scaap/admin/lista/atleta', [AdminController::class, 'viewAtleta']);

  Route::get('/scaap/admin/editar/{id}', [AdminController::class, 'viewAdminEditar']);
  Route::put('/scaap/admin/editar/{id}', [AdminController::class, 'adminEditarUsuario']);
  Route::get('/scaap/admin/editar/form/{id}/delete/{idSeg}', [AdminController::class, 'deleteSegmentoUser']);
  Route::get('/scaap/admin/editar/form/{id}/anexo/delete/{idAnexo}', [AdminController::class, 'deleteAnexoUser']);

  Route::get('/scaap/admin/moderacao', [AdminController::class, 'viewModeracao']);
  Route::get('/scaap/admin/moderar/{id}', [AdminController::class, 'viewModerar']);
  Route::put('/scaap/admin/aprovar/{id}', [AdminController::class, 'adminAprovarUser']);
  Route::put('/scaap/admin/reprovar/{id}', [AdminController::class, 'adminReprovarUser']);

  Route::get('/scaap/admin/aguardandoRetorno', [AdminController::class, 'viewAguardandoRetorno']);
  Route::get('/scaap/admin/aguardandoRetorno/motivo/{id}', [AdminController::class, 'viewMotivo']);

});


Route::get('/dashboard', function () {return redirect('/');})->name('dashboard');