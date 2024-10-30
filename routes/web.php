<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UserEmpresaController; 
use App\Http\Controllers\PublicacaoController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\RedeSocialController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin.config', function () {
    return view('admin.config');
});
Route::get('/empresas.index', function () {
    return view('empresas.index');
});
Route::get('/avaliacoes.avaliar', function () {
    return view('avaliacoes.avaliar');
});
Route::get('/avaliacoes.veravaliacao', function () {
    return view('avaliacoes.veravaliacao');
});
Route::get('/categorias.index', function () {
    return view('categorias.index');
});
Route::get('/categorias.editar', function () {
    return view('categorias.editar');
});

Route::get('/categorias.empresas', function () {
    return view('categorias.empresas');
});

Route::get('/sobrenos', function () {
    return view('sobrenos');
});
Route::get('/empresas.painel', function () {
    return view('empresas.painel');
});
Route::get('/publicacoes.create', function () {
    return view('publicacoes.create');
});
Route::get('/publicacoes.edit', function () {
    return view('publicacoes.edit');
});
Route::get('/empresas.create', function () {
    return view('empresas.create');
});
Route::get('/publicacoes.create', function () {
    return view('publicacoes.create');
});
Route::get('/denuncias.index', function () {
    return view('denuncias.index');
});

Route::get('/redesocial.edit', function () {
    return view('redesocial.edit');
});
Route::get('/redesocial.create', function () {
    return view('redesocial.create');
});


// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Página de Configuração de Admin
Route::get('/admin.config', function () {
    return view('admin.config');
})->middleware(['auth', 'admin']);

// Outras rotas fixas
Route::get('/sobrenos', function () {
    return view('sobrenos');
});

// Rota de Dashboard - apenas para usuários autenticados
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/index2', [DashboardController::class, 'index2'])->name('index2');
Route::get('/userencontrado', [DashboardController::class, 'userencontrado'])->name('userencontrado');

// Gerenciamento de perfil do usuário autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grupo de rotas para administração - acessível apenas por administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('config');
    Route::put('/admin/make-admin/{user}', [AdminController::class, 'makeAdmin'])->name('admin.makeAdmin');
    Route::put('/admin/desmake-admin/{user}', [AdminController::class, 'desmakeAdmin'])->name('admin.desmakeAdmin');
    Route::delete('/admin/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});

// CRUD de Empresas
Route::resource('empresas', EmpresaController::class);
Route::put('empresas/{id}/biosustentavel', [EmpresaController::class, 'toggleBiosustentavel'])->name('empresas.biosustentavel');
Route::post('/empresas/solicitar', [EmpresaController::class, 'solicitar'])->name('empresas.solicitar');
Route::post('/empresas/approve/{id}', [EmpresaController::class, 'aprovar'])->name('empresas.aprovar'); 
Route::get('/minha-empresa', [EmpresaController::class, 'index'])->name('minha.empresa');
Route::get('/empresas/create', [EmpresaController::class, 'create'])->name('empresas.create');


// CRUD de Avaliações - somente para usuários autenticados
Route::middleware('auth')->group(function () {
    Route::resource('empresas.avaliacoes', AvaliacaoController::class)->parameters([
        'empresas' => 'empresaId',
        'avaliacoes' => 'avaliacaoId',
    ]);
});

// CRUD de Categorias
Route::resource('categorias', CategoriaController::class);

Route::get('/categorias/{id}/empresas', [CategoriaController::class, 'empresas'])->name('categorias.empresas');

// Vincular Usuários a Empresas - acessível apenas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/user-empresa', [UserEmpresaController::class, 'index'])->name('userempresa.index');
    Route::post('/user-empresa', [UserEmpresaController::class, 'store'])->name('userempresa.store');
    Route::delete('/user-empresa/{id}', [UserEmpresaController::class, 'destroy'])->name('userempresa.destroy');
    Route::post('/user-empresa/{UserId}', [UserEmpresaController::class, 'desvincular'])->name('userempresa.desvincular');
});

// CRUD de Publicações
Route::resource('publicacoes', PublicacaoController::class);
Route::get('/publicacoes/create/{empresa}', [PublicacaoController::class, 'create'])->name('publicacoes.create');
Route::get('/publicacoes/edit/{publicacao}', [PublicacaoController::class, 'edit'])->name('publicacoes.edit');
Route::put('/publicacoes/update/{publicacao}', [PublicacaoController::class, 'update'])->name('publicacoes.update');
Route::delete('/publicacoes/destroy/{publicacao}', [PublicacaoController::class, 'destroy'])->name('publicacoes.destroy');

// CRUD de Imagens
Route::resource('imagens', ImagemController::class);
Route::delete('/imagens/{id}', [ImagemController::class, 'destroy'])->name('imagens.destroy');


Route::resource('denuncias', DenunciaController::class);

// CRUD de Denúncias - acessível apenas por administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/denuncias', [DenunciaController::class, 'index'])->name('denuncias.index');
    
});

Route::get('/denuncias/create/{empresa_id}', [DenunciaController::class, 'create'])->name('denuncias.create');


// CRUD de Redes Sociais
Route::resource('redesocial', RedeSocialController::class);

// Rota específica para criar uma rede social com o ID da empresa
Route::get('/redesocial/create/{empresa}', [RedeSocialController::class, 'create'])->name('redesocial.create');

Route::post('/store', [RedeSocialController::class, 'store'])->name('redesocial.store');

require __DIR__.'/auth.php';
