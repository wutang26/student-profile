<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HighChartController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StoreItemController;
use App\Http\Controllers\BorrowRecordController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Register All Routes 
| !
|
*/

//Permissions Guarded
Route::middleware('auth')->group(function () {
    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('settings.permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'createPermission'])->name('settings.permissions.create');
    Route::post('/permissions/store', [PermissionController::class, 'storePermission'])->name('settings.permissions.storePermission');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'editPermission'])->name('settings.permissions.edit');
    Route::put('/permissions/{id}/update', [PermissionController::class, 'updatePermission'])->name('settings.permissions.updatePermission');
    Route::delete('/permissions/{id}/delete', [PermissionController::class, 'deletePermission'])->name('settings.permissions.deletePermission');
     
    //Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('settings.roles.index');
    Route::get('/roles/create', [RoleController::class, 'createRole'])->name('settings.roles.create');
    Route::post('/roles/store', [RoleController::class, 'storeRole'])->name('settings.roles.storeRole');
    Route::get('/roles/{role}/edit', [RoleController::class, 'editRole'])->name('settings.roles.edit');
    Route::put('/roles/{role}/update', [RoleController::class, 'updateRole'])->name('settings.roles.updateRole');
    Route::delete('/roles/{role}/delete', [RoleController::class, 'deleteRole'])->name('settings.roles.deleteRole');
 

});


//accountant generate report 
Route::get('/reports', function () {
    return view('reports.index');})->name('reports.index');

//Genenerate Pdf Preview and Download
Route::get('/pdf/preview', [PdfController::class, 'preview'])
     ->name('pdf.preview');

Route::get('/pdf/download', [PdfController::class, 'download'])
     ->name('pdf.download');

Route::get('/pdf/generate', [PdfController::class, 'generatePdf'])
     ->name('pdf.generate');




// Profile page
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Show change password form
    Route::get('/password/change', [PasswordController::class, 'edit'])->name('password.change');

    // Handle password update
    Route::put('/password/change', [PasswordController::class, 'update'])->name('password.update');

    // Logout (Breeze default)
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//Welcome page



Route::get('/', function () {  return redirect()->route('register'); });


// Route::get('/welcome', function () {
//     return view('welcome');
// });


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Access Users(use users controllers)
Route::get('/users', [UserController::class, 'index'])->name('settings.users.index');
Route::get('/users/create', [UserController::class, 'createUser'])->name('settings.users.create');
Route::post('/users/store', [UserController::class, 'storeUser'])->name('settings.users.storeUser');
Route::get('/users/{id}/edit', [UserController::class, 'editUser'])->name('settings.users.editUser');
Route::put('/users/{id}/update', [UserController::class, 'updateUser'])->name('settings.users.updateUser');
Route::delete('/users/{id}/delete',[UserController::class, 'deleteUser'])->name('settings.users.deleteUser');

//User assigment route
Route::post('/users/{id}/assign-permissions', [UserController::class, 'assignPermissions'])
    ->name('users.assign_permissions');


//Access Users(use member controllers)
Route::get('/members', [AdminController::class, 'members'])->name('admin.members.index');

Route::get('/create', [AdminController::class, 'create'])->name('members.create');

Route::post('/members', [AdminController::class, 'store'])->name('members.store');

    //Edit Members
Route::get('/admin/members/{id}/edit', [AdminController::class, 'edit'])->name('admin.members.edit');

// Update member
Route::put('/admin/members/{id}', [AdminController::class, 'update'])->name('admin.members.update');
//Delete Member
Route::delete('members/{id}/delete', [AdminController::class, 'deleteMember'])->name('admin.members.deleteMember');



//Regions
Route::get('/regions', [SettingController::class, 'regions'])
    ->name('admin.regions.index');


    //Setting
    Route::prefix('settings')->group(function () {
    
    Route::get('/regions', [SettingController::class, 'regions'])->name('settings.regions.region');
    Route::get('/regions/create', [SettingController::class, 'createRegion'])->name('settings.regions.create_region');
    Route::post('/regions/store', [SettingController::class, 'storeRegion'])->name('settings.regions.storeRegion');
    Route::get('/regions/{id}/edit', [SettingController::class, 'editRegion'])->name('settings.regions.editRegion');
    Route::put('/regions/{id}/update', [SettingController::class, 'updateRegion'])->name('settings.regions.updateRegion');
    Route::delete('/regions/{id}/delete',[SettingController::class, 'deleteRegion'])->name('settings.regions.deleteRegion');


    Route::get('/districts', [SettingController::class, 'districts'])->name('settings.district');
    Route::get('/district/create', [SettingController::class, 'createDistrict'])->name('settings.districts.create_district');
    Route::post('/districts/store', [SettingController::class, 'storeDistrict'])->name('settings.districts.storeDistrict');
    Route::get('/districts/{id}/edit', [SettingController::class, 'editDistrict'])->name('settings.districts.edit_district');
    Route::put('/districts/{id}/update', [SettingController::class, 'updateDistrict'])->name('settings.districts.updateDistrict');
    Route::delete('districts/{id}/delete', [SettingController::class, 'deleteDistrict'])->name('settings.districts.deleteDistrict');




        //Currencies route
    Route::get('/currencies', [SettingController::class, 'currencies'])->name('settings.currency');
    Route::get('/currencies/create', [SettingController::class, 'createCurrency'])->name('settings.currencies.create_currency');
    Route::post('/currencies/store', [SettingController::class, 'storeCurrency'])->name('settings.currencies.storeCurrency');
    Route::get('/currencies/{id}/edit', [SettingController::class, 'editCurrency'])->name('settings.currencies.edit_currency');
    Route::put('/currencies/{id}/update', [SettingController::class, 'updateCurrency'])->name('settings.currencies.updateCurrency');
    Route::delete('/currencies/{id}/delete',[SettingController::class, 'deleteCurrency'])->name('settings.currencies.deleteCurrency');


});

//Histogram Popup
Route::get('/charts', [HighChartController::class, 'index']);


//Staff Management

Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('index');
    Route::get('/create', [StaffController::class, 'create'])->name('create');
    Route::post('/store', [StaffController::class, 'store'])->name('store');

    // SHOW
    Route::get('/{id}', [StaffController::class, 'show'])->name('show');

    // EDIT
    Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('edit');
    Route::put('/{id}', [StaffController::class, 'update'])->name('update');

    // DELETE
    Route::delete('/{id}', [StaffController::class, 'destroy'])->name('destroy');
});

// Students Routes
Route::get('/students', [StudentController::class, 'index'])->name('students.index');

Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');

Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');

Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');

Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

//Students Upload excel
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');

//Audit handling
Route::get('/audit', [AuditLogController::class, 'index'])
    ->name('admin.audit.index');

    //Barua ya maelezo na Zingine
Route::get('/documents', [StudentDocumentController::class, 'index'])->name('students.documents.index');

Route::get('/documents/create', [StudentDocumentController::class, 'create'])->name('students.documents.create');

Route::post('/documents', [StudentDocumentController::class, 'store'])->name('students.documents.store');

Route::delete('/documents/{id}', [StudentDocumentController::class, 'destroy'])->name('students.documents.destroy');

//Store Items
Route::get('/store-items', [StoreItemController::class, 'index'])
    ->name('storeItems.index');

Route::get('/storeItems/create', [StoreItemController::class, 'create'])
    ->name('storeItems.create');

Route::post('/storeItems', [StoreItemController::class, 'store'])
    ->name('storeItems.store');

Route::get('/storeItems/{storeItem}/edit', [StoreItemController::class, 'edit'])
    ->name('storeItems.edit');

Route::put('/storeItems/{storeItem}', [StoreItemController::class, 'update'])
    ->name('storeItems.update');

Route::delete('/storeItems/{storeItem}', [StoreItemController::class, 'destroy'])
    ->name('storeItems.destroy');

//Borrow Items
Route::get('/borrow-records', [BorrowRecordController::class, 'index'])
    ->name('borrowItems.index');

Route::get('/borrow-records/create', [BorrowRecordController::class, 'create'])
    ->name('borrowItems.create');

Route::post('/borrow-records', [BorrowRecordController::class, 'store'])
    ->name('borrowItems.store');

    //RETURN ITEM ROUTE
// LIST ALL BORROWED ITEMS
Route::get('/borrow-items', [BorrowRecordController::class, 'index'])
    ->name('borrowItems.index');

// SHOW RETURN FORM (needs ID)
Route::get('/borrow/{borrowRecord}/return', [BorrowRecordController::class, 'showReturnForm']
)->name('borrowItems.receive_items');

// PROCESS RETURN (needs ID)
Route::patch('/borrow/{borrowRecord}/return', [BorrowRecordController::class, 'updateStatus']
)->name('borrowItems.return');

// RETURNED ITEMS LIST (NO ID)
Route::get('/borrow-returned', [BorrowRecordController::class, 'returnedItems']
)->name('borrowItems.returned');

Route::post('/borrow/bulk-return', [BorrowRecordController::class, 'bulkReturn'])
    ->name('borrowItems.bulkReturn');

Route::get('/borrow/{borrowRecord}/return', [BorrowRecordController::class, 'showReturnForm'])
    ->name('borrowItems.return_form');

//Used for AuTH
require __DIR__.'/auth.php';
