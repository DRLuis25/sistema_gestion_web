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
        Route::resource('/company/{id}/processMaps/{id2}/seguimientoPropuestos', 'seguimientoPropuestoController')->names('seguimientoPropuestos')->only('show','destroy');
        Route::resource('/company/{id}/processMaps/{id2}/processFlowDiagrams', 'processFlowDiagramController')->names('processFlowDiagrams')->except('create');
        // Route::post('/company/{id}/processMaps/{id2}/processFlowDiagrams/create', 'processFlowDiagramController@create')->name('processFlowDiagrams.create');
        Route::resource('/company/{id}/processMaps/{id2}/hojaCaracterizacionProcesos', 'hojaCaracterizacionProcesosController')->names('hojaCaracterizacionProcesos')->except('create');
    });

});

Route::get('getSupplyChainCustomers/{id}', 'supplyChainCustomerController@getSupplyChainCustomers')->name('getSupplyChainCusto');
Route::get('getSupplyChainSupplier/{id}', 'supplyChainSupplierController@getSupplyChainSuppliers')->name('getSupplyChainSupp');

//Para generar la cadena de suministro
Route::resource('supplyChainSuppliers', 'supplyChainSupplierController');
Route::resource('supplyChainCustomers', 'supplyChainCustomerController');
Route::get('getCustomers/{id}', 'CustomerController@getCustomers');
Route::get('getSuppliers/{id}', 'SupplierController@getSuppliers');//$id: company_id
Route::get('getSupplyChainCustomersParents/{id}/{id2}', 'supplyChainCustomerController@getSupplyChainCustomerParents');
Route::get('getSupplyChainSuppliersParents/{id}/{id2}', 'supplyChainSupplierController@getSupplyChainSupplierParents');
//
Route::get('generateSupplyChain/{id}','supplyChainController@generateSupplyChain');
//Resource Historial SupplyChains
Route::resource('historials', 'historialController');
Route::get('getHistorial/{id}','historialController@getHistorial')->name('getHistorial');
//Resource Auditoria bd
Route::post('guardarAudit', 'AuditController@guardar')->name('guardaraudit');
//Resource CRUD Procesos
Route::resource('process', 'ProcessController')->names('process')->only('store','edit','update');
Route::get('getProcess/{id}', 'ProcessController@getProcess')->name('getProcess');
Route::resource('processTypes', 'processTypeController');
//Resource CRUD ProcessMap
Route::get('getProcessMap/{id}', 'ProcessController@getProcessMap')->name('getProcessMap');
Route::get('getProcessById/{id}', 'ProcessController@getProcessById')->name('getProcessById');
Route::delete('processMap/{id1}/process/{id2}', 'ProcessController@destroy')->name('process.destroy');
//Menú historial Mapa Proceso
Route::resource('historialProcessMaps', 'historialProcessMapController');
Route::get('getHistorialProcessMaps/{id}','historialProcessMapController@getHistorialProcessMaps')->name('getHistorialProcessMaps');
//Resource Subprocesos
Route::resource('/company/{id}/processMaps/{id2}/process/{id3}/subProcesses', 'subProcessController')->names('subProcesses');
//Menú matriz priorización
Route::get('getMatrizPriorizacion/{id}', 'ProcessCriterioController@getMatrizPriorizacion')->name('getMatrizPriorizacion');
Route::get('/company/{id}/processMaps/{id2}/selectPriorizar', 'processCriterioController@selectPriorizar')->name('selectPriorizar');
Route::post('/company/{id}/processMaps/{id2}/storePriorizar', 'processCriterioController@storePriorizar')->name('storePriorizar');
//Menú Diagrama de flujo
Route::post('/company/{id}/processMaps/{id2}/processFlowDiagrams/create', 'processFlowDiagramController@create')->name('processFlowDiagrams.create');
Route::post('/company/{id}/processMaps/{id2}/processFlowDiagrams/create2', 'processFlowDiagramController@createApplication')->name('processFlowDiagrams.create2');
Route::post('getProcessFlowDiagram/{id}','processFlowDiagramController@getProcessFlowDiagram')->name('getProcessFlowDiagram');
//Menú Hoja Caracterización
Route::post('/company/{id}/processMaps/{id2}/hojaCaracterizacionProcesos/create', 'hojaCaracterizacionProcesosController@create')->name('hojaCaracterizacionProcesos.create');
Route::post('/company/{id}/processMaps/{id2}/hojaCaracterizacionProcesos/create2', 'hojaCaracterizacionProcesosController@createApplication')->name('hojaCaracterizacionProcesos.create2');
Route::post('updateHojaCaracterizacion', 'hojaCaracterizacionProcesosController@updateFile')->name('updateHojaCaracterizacion');

//Diagrama flujo

Route::post('storeProcessFlowDiagramRedesignFile', 'processFlowDiagramController@storeRedesignFile')->name('storeProcessFlowDiagramRedesignFile');
Route::DELETE('/company/{id}/processMaps/{id2}/destroyProcessFlowDiagramRedesign/{id3}', 'processFlowDiagramController@destroyProcessFlowDiagramRedesign')->name('destroyProcessFlowDiagramRedesign');
Route::get('/company/{id}/processMaps/{id2}/processFlowDiagrams/{id3}/createRedesign','processFlowDiagramController@createRedesignApplication')->name('createRedesign');
Route::post('/company/{id}/processMaps/{id2}/processFlowDiagrams/{id3}/storeProcessFlowDiagramRedesignApplication', 'processFlowDiagramController@storeRedesignApplication')->name('storeProcessFlowDiagramRedesignApplication');
Route::get('/company/{id}/processMaps/{id2}/processFlowDiagrams/{id3}/showRedesign','processFlowDiagramController@showRedesignApplication')->name('showRedesign');
Route::get('/company/{id}/processMaps/{id2}/processFlowDiagrams/{id3}/editRedesign','processFlowDiagramController@editRedesignApplication')->name('editRedesign');
Route::patch('/company/{id}/processMaps/{id2}/processFlowDiagrams/{id3}/updateRedesign','processFlowDiagramController@updateRedesignApplication')->name('updateRedesign');

//Diagrama Seguimiento
Route::get('/company/{id}/processMaps/{id2}/seguimientos/getSeguimiento/{id3}', 'SeguimientoController@getSeguimiento')->name('getSeguimiento');
Route::post('storeActivity', 'SeguimientoController@storeActivity')->name('storeActivity');
Route::get('getTimes/{id}', 'SeguimientoController@getTimes')->name('getTimes');
Route::DELETE('/company/{id}/processMaps/{id2}/seguimientos/{id3}/destroySeguimientoActividad/{id4}', 'SeguimientoController@destroySeguimientoActividad')->name('destroySeguimientoActividad');

Route::get('/company/{id}/processMaps/{id2}/seguimientoPropuestos/getSeguimientoPropuesto/{id3}', 'seguimientoPropuestoController@getSeguimientoPropuesto')->name('getSeguimientoPropuesto');
Route::post('storeActivityPropuesto', 'seguimientoPropuestoController@storeActivityPropuesto')->name('storeActivityPropuesto');
Route::get('getTimesPropuesto/{id}', 'seguimientoPropuestoController@getTimesPropuesto')->name('getTimesPropuesto');
Route::DELETE('/company/{id}/processMaps/{id2}/seguimientoPropuestos/{id3}/destroySeguimientoActividadPropuesto/{id4}', 'seguimientoPropuestoController@destroySeguimientoActividadPropuesto')->name('destroySeguimientoActividadPropuesto');



Route::resource('/company/{id}/processMaps/{id2}/matrizPriorizados', 'matrizPriorizadoController')->names('matrizPriorizados');
Route::post('/company/{id}/processMaps/{id2}/matrizPriorizados/{id3}/activate', 'matrizPriorizadoController@activate')->name('matrizPriorizados.activate');


Route::resource('/company/{id}/processMaps/{id2}/rols', 'RolController')->names('rols');

//Tercera Unidad
//id3: id priorización | id4: proceso priorizado
Route::resource('/company/{id}/processMaps/{id2}/matrizPriorizados/{id3}/mapaEstrategico/{id4}', 'mapaEstrategicoController')->names('mapaEstrategico');





//Otros

Route::resource('indicators', 'IndicatorController');

Route::resource('perspectives', 'PerspectiveController');

Route::resource('objectives', 'ObjectiveController');
