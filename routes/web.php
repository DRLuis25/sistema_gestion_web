<?php

use App\Models\supplyChainCustomer;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

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
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function()
{
    Route::middleware(['issuperadmin'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('audits', 'AuditController');
        Route::resource('companies', 'CompanyController');
    });

    Route::middleware(['companycheck'])->group(function () {
        Route::get('/company/{id}', 'CompanyController@showCompany')->name('company.showCompany');
        Route::resource('/company/{id}/suppliers', 'SupplierController')->names('suppliers');
        Route::resource('/company/{id}/customers', 'CustomerController')->names('customers');
        Route::resource('/company/{id}/businessUnits', 'businessUnitController')->names('businessUnits');
        Route::resource('/company/{id}/supplyChains', 'supplyChainController')->names('supplyChains');

    });

});

Route::get('getSupplyChainCustomers/{id}', 'supplyChainCustomerController@getSupplyChainCustomers')->name('getSupplyChainCusto');
Route::get('getSupplyChainSupplier/{id}', 'supplyChainSupplierController@getSupplyChainSuppliers')->name('getSupplyChainSupp');

//Para generar la cadena de suministro
Route::get('getCustomers/{id}', 'CustomerController@getCustomers');
Route::get('getSuppliers/{id}', 'SupplierController@getSuppliers');//$id: company_id
Route::get('getSupplyChainCustomersParents/{id}/{id2}', 'supplyChainCustomerController@getSupplyChainCustomerParents');
Route::get('getSupplyChainSuppliersParents/{id}/{id2}', 'supplyChainSupplierController@getSupplyChainSupplierParents');
Route::get('generateSupplyChain/{id}','supplyChainController@generateSupplyChain');

Route::get('getHistorial/{id}','historialController@getHistorial')->name('getHistorial');
Route::resource('supplyChainSuppliers', 'supplyChainSupplierController');
Route::resource('supplyChainCustomers', 'supplyChainCustomerController');
Route::resource('historials', 'historialController');
Route::post('guardarAudit', 'AuditController@guardar')->name('guardaraudit');
