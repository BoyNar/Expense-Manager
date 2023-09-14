<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\EnjoyerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\BusinessSettingsController;

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

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');

Auth::routes(['verify' => true]);
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::post('/language', [LanguageController::class,'changeLanguage'])->name('language.change');


//User
Route::group(['prefix' =>'user', 'middleware' => ['user', 'verified']], function(){

    Route::get('/dashboard', [HomeController::class,'dashboard'])->name('dashboard');

	Route::get('/profile', [HomeController::class,'profile'])->name('profile');
	Route::post('/user/update-profile', [HomeController::class,'user_update_profile'])->name('user.profile.update');

	Route::get('/expenses', [HomeController::class,'user_expense_list'])->name('user.expenses');
    Route::get('/expenses/create', [HomeController::class,'user_expense_create'])->name('user.expense.create');
    Route::post('/expenses/store', [HomeController::class,'user_expense_store'])->name('user.expense.store');
	Route::get('/expenses/edit/{id}', [HomeController::class,'user_expense_edit'])->name('user.expense.edit');
    Route::post('/expenses/update/{id}', [HomeController::class,'user_expense_update'])->name('user.expense.update');
    Route::get('/expenses/edit/destroy/{id}', [HomeController::class,'user_expense_destroy'])->name('user.expense.destroy');

    Route::get('/categories', [HomeController::class,'user_categories_list'])->name('user.categories');
    Route::get('/category/create', [HomeController::class,'user_category_create'])->name('user.category.create');
    Route::post('/category/store', [HomeController::class,'user_category_store'])->name('user.category.store');
	Route::get('/category/edit/{id}', [HomeController::class,'user_category_edit'])->name('user.category.edit');
    Route::post('/category/update/{id}', [HomeController::class,'user_category_update'])->name('user.category.update');
    Route::get('/category/edit/destroy/{id}', [HomeController::class,'user_category_destroy'])->name('user.category.destroy');


});


//Admin
Route::get('/admin', [HomeController::class,'admin_dashboard'])->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){

    Route::resource('/categories', CategoryController::class);
    Route::get('/categories/destroy/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');
    Route::resource('/expenses', ExpenseController::class);
    Route::get('/expenses/destroy/{id}', [ExpenseController::class,'destroy'])->name('expenses.destroy');

    Route::resource('generalsettings', GeneralSettingController::class);
	Route::get('/logo',[GeneralSettingController::class,'logo'])->name('generalsettings.logo');
	Route::post('/logo',[GeneralSettingController::class,'storeLogo'])->name('generalsettings.logo.store');

    Route::resource('roles', RoleController::class);
    Route::get('/roles/destroy/{id}', [RoleController::class,'destroy'])->name('roles.destroy');

    Route::resource('staffs', StaffController::class);
    Route::get('/staffs/destroy/{id}', [StaffController::class,'destroy'])->name('staffs.destroy');

    Route::resource('users', EnjoyerController::class);
	Route::get('/users/destroy/{id}', [EnjoyerController::class,'destroy'])->name('users.destroy');

    Route::resource('/languages', LanguageController::class);
	Route::get('/languages/destroy/{id}', [LanguageController::class,'destroy'])->name('languages.destroy');
	Route::get('/languages/{id}/edit', [LanguageController::class,'edit'])->name('languages.edit');
	Route::post('/languages/{id}/update', [LanguageController::class,'update'])->name('languages.update');
	Route::post('/languages/key_value_store', [LanguageController::class,'key_value_store'])->name('languages.key_value_store');

    Route::resource('/profile', ProfileController::class);

    Route::post('/business-settings/update', [BusinessSettingsController::class,'update'])->name('business_settings.update');
	Route::post('/business-settings/update/activation', [BusinessSettingsController::class,'updateActivationSettings'])->name('business_settings.update.activation');
	Route::get('/activation',[BusinessSettingsController::class,'activation'])->name('activation.index');
	Route::get('/smtp-settings', [BusinessSettingsController::class,'smtp_settings'])->name('smtp_settings.index');
    Route::post('/env_key_update', [BusinessSettingsController::class,'env_key_update'])->name('env_key_update.update');
});
