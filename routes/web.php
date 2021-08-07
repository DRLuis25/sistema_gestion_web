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
        Route::resource('/company/{id}/processMaps', 'processMapController')->names('processMaps');
        Route::resource('/company/{id}/processMaps/{id2}/criterios', 'CriterioController')->names('criterios');
        Route::resource('/company/{id}/processMaps/{id2}/processCriterios', 'processCriterioController')->names('processCriterios')->only('index','store');
        Route::resource('/company/{id}/processMaps/{id2}/seguimientos', 'SeguimientoController')->names('seguimientos')->only('index','show','destroy');
        Route::post('/company/{id}/processMaps/{id2}/seguimientos/create', 'SeguimientoController@create')->name('seguimientos.create');
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

Route::get('getProcess/{id}', 'ProcessController@getProcess')->name('getProcess');
Route::get('getProcessMap/{id}', 'ProcessController@getProcessMap')->name('getProcessMap');
Route::get('getProcessById/{id}', 'ProcessController@getProcessById')->name('getProcessById');
Route::delete('processMap/{id1}/process/{id2}', 'ProcessController@destroy')->name('process.destroy');
Route::resource('process', 'ProcessController')->names('process')->only('store','edit','update');

Route::resource('processTypes', 'processTypeController');

Route::get('getMatrizPriorizacion/{id}', 'ProcessCriterioController@getMatrizPriorizacion')->name('getMatrizPriorizacion');

Route::post('storeActivity', 'SeguimientoController@storeActivity')->name('storeActivity');

Route::get('getTimes/{id}', 'SeguimientoController@getTimes')->name('getTimes');

Route::get('/company/{id}/processMaps/{id2}/seguimientos/getSeguimiento/{id3}', 'SeguimientoController@getSeguimiento')->name('getSeguimiento');
//Route::get('{id}/verSeguimiento', 'SeguimientoController@ver')->name('seguimientos.ver');


Route::resource('processFlowDiagrams', 'processFlowDiagramController');