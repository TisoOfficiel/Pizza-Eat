<?php

use App\Models\Pizza;
use App\Http\Controllers\Panier;
use App\Http\Controllers\UserCompte;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardCookController;
use App\Http\Controllers\AuthenticatedSessionController;
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

route::get('/test',[TestController::class,'test']);


Route::get('/storage/upload',[TestController::class,'storageUploadForm']);
Route::post('/storage/upload',[TestController::class,'storageUpload'])->name('fupload');
Route::get('/storage/download',[TestController::class,'storageDownload']);

Route::get('/paginate',[TestController::class,'produitsListPaginate']);
    

// Accueil / Page principal
Route::get('/', function () {
        $pizzas = Pizza::paginate(8);
        return view('index',['pizzas'=>$pizzas]);
});
// Route::get('/',[TestController::class,'test']);

// Controller enregistrement
// S'enregistrer
Route::get('/register',[RegisterController::class,'showRegisterForm'])->name('registerForm');
Route::post('/register',[RegisterController::class,'add'])->name('register');

// Controller Authentification
Route::view('/home','home')->middleware('auth')->name('home');
// Se connecter
Route::get('/login', [AuthenticatedSessionController::class,'showForm'])
    ->name('login');
    
Route::post('/login', [AuthenticatedSessionController::class,'login']);
// Se deconnecter
Route::get('/logout', [AuthenticatedSessionController::class,'logout'])
    ->name('logout')->middleware('auth');
    


Route::get('/mot_de_passe_changer',[AuthenticatedSessionController::class,'show_form_mdp_changer'])->name('mdp_changer_form');
Route::post('/mot_de_passe_changer/{id}',[AuthenticatedSessionController::class,'mdp_changer'])->name('mdp_changer');


// Panier
Route::post('/panier_add/{id}',[Panier::class, 'Panier_add'])->name('panier_add')->middleware('auth');
Route::get('/reset_panier/{id}',[Panier::class, 'resetPanier'])->name('resetPanier')->middleware('auth');


// Commande
Route::get('/pizzaEat/checkout',[CommandeController::class,'commander'])->name('checkout');
Route::get('/commande/paiement/valider',[CommandeController::class, 'Commande_add'])->middleware('auth')->name('Commande');

    // View Commmande
Route::get('/commande/{id}',[CommandeController::class,'ShowCommandes'])->middleware('auth')->name('commandeView');

Route::get('/commande/details/{cid}/{uid}',[CommandeController::class,'ShowDetailCommande'])->middleware('auth')->name('detailCommande');
    // Trie des commandes par statut

Route::post('/filterCommandeUser/{id}',[CommandeController::class,'filterCommandeStatut'])->middleware('auth')->name('filterCommandeStatutUser');
// UserCompte
Route::get('/{id}/compteSetting',[UserCompte::class,'userSettings'])->middleware('auth')->name('UserSettings');

Route::post('/{id}/editCompte',[UserCompte::class,'EditUser'])->middleware('auth')->name('editUser');
Route::post('/modification/mot_de_passe',[UserCompte::class,'editMotDePasse'])->middleware('auth')->name('modificationMotDePasse');

Route::get('/{id}/suppression_Compte',[UserCompte::class,'suppresionCompteUser'])->middleware('auth')->name('SuppressionComptePerso');


// Pour les cuisiniers 

Route::get('/cook/dashboard/Commande',[DashboardCookController::class,'showCommandeliste'])->middleware('auth')->middleware('is_cook')->name('CookDashboard');
Route::post('/cook/dashboard/Commande/Update/{id}',[DashboardCookController::class,'updatestatutCommandeliste'])->middleware('auth')->middleware('is_cook')->name('udpateStatut');

// Dashboard pour les admminstrateur
Route::get('/admin/dashboard',[DashboardAdmin::class,'showDashboad'])->middleware('auth')->middleware('is_admin')->name('dashboard');

Route::get('/admin/dashboard/pizza',[DashboardAdmin::class,'showDashboadPizza'])->middleware('auth')->middleware('is_admin')->name('dashboardPizza');
Route::post('/admin/dashboard/pizza',[DashboardAdmin::class,'showDashboadPizza'])->middleware('auth')->middleware('is_admin')->name('dashboardPizzaUpdate');
Route::post('/admin/dashboard/pizza/add',[DashboardAdmin::class,'PizzaAdd'])->middleware('auth')->middleware('is_admin');


Route::get('/admin/dashboard/usersList',[DashboardAdmin::class,'showUserList'])->middleware('auth')->middleware('is_admin')->name('dashboardUser');
Route::post('/admin/dashboard/usersListfilter',[DashboardAdmin::class,'showUserListFilter'])->middleware('auth')->middleware('is_admin')->name('dashboardUserfilter');
Route::post('/admin/dashboard/usersList/update_role/{id}',[DashboardAdmin::class,'updaterole'])->middleware('auth')->middleware('is_admin')->name('udpateRole');
Route::get('/admin/dashboard/usersList/remove/{id}',[DashboardAdmin::class,'removemember'])->middleware('auth')->middleware('is_admin')->name('removemember');
Route::post('/admin/dashboard/usersList/addmember',[DashboardAdmin::class,'createmember'])->middleware('auth')->middleware('is_admin')->name('addMember');
Route::get('/admin/dashboard/usersList/editmember/{id}',[DashboardAdmin::class,'editmemberView'])->middleware('auth')->middleware('is_admin')->name('editmemberview');
Route::post('/admin/dashboard/usersList/editmember/{id}',[DashboardAdmin::class,'editmember'])->middleware('auth')->middleware('is_admin')->name('editmember');
Route::get('/admin/dashboard/commandeListe',[DashboardAdmin::class,'showCommmandeListe'])->middleware('auth')->middleware('is_admin')->name('commandeListe');
Route::post('/admin/dashboard/commandeListe',[DashboardAdmin::class,'showCommmandeListe'])->middleware('auth')->middleware('is_admin')->name('commandeListe');
// Route::get('/admin/modificationPizza/formulaire/{id}',[DashboardAdmin::class,'ModificationPizzaForm'])->name('modificationPizzaFormulaire')->middleware('auth')->middleware('is_admin');
Route::post('/admin/modificationPizza/edit/{id}',[DashboardAdmin::class,'ModificationPizza'])->name('modificationPizza')->middleware('auth')->middleware('is_admin');

Route::get('/admin/deletePizza/{id}',[DashboardAdmin::class,'RemovePizza'])->name('removePizza')->middleware('auth')->middleware('is_admin');