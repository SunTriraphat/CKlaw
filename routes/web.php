<?php

use App\Http\Controllers\DataDept;
use App\Http\Controllers\StaticController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataCustomer;
use App\Http\Controllers\DataContract;
use App\Http\Controllers\DataLawsuit;
use App\Http\Controllers\DataCompromise;

use App\Http\Controllers\DataExecution;
use App\Http\Controllers\DataFinance;
use App\Http\Controllers\DataLawTrack;
use App\Http\Controllers\DataTracking;
use App\Http\Controllers\DomPdfController;
use App\Http\Controllers\Upload_File;
use Dflydev\DotAccessData\Data;

Route::get('/', function () {
    return view('auth/login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
// controler

Route::resource('Cus',DataCustomer::class); // ระบบฐานลูกค้า
Route::resource('Con',DataContract::class); // ระบบฐานสัญญา
Route::resource('Law',DataLawsuit::class); // ระบบกฎหมาย
Route::resource('LawCom',DataCompromise::class); // ระบบประนอมหนี้
Route::resource('Upload',Upload_File::class); // ระบบอัปโหลด
Route::resource('Fin',DataFinance::class); // ระบบอัปโหลด
Route::resource('Exe',DataExecution::class); // ระบบบังคับคดี
Route::resource('Dept',DataDept::class); // ระบบ
Route::resource('LawTrack',DataLawTrack::class); // ระบบ
Route::resource('Tracking',DataTracking::class); // ระบบติดตาม
Route::resource('DomPdf',DomPdfController::class); // ระบบติดตาม
Route::post('Cus/export/',[DataCustomer::class, 'export'])->name('export.excel');
Route::post('Law/export/',[DataLawsuit::class, 'export'])->name('exportLaw.excel');
Route::post('Exe/export/',[DataExecution::class, 'export'])->name('exportExe.excel');
Route::post('DomPdf/export/',[DomPdfController::class, 'export'])->name('exportPdf.Dom');

Route::resource('static',StaticController::class);

Route::post('/Cus/SearchData',[DataCustomer::class, 'SearchData'])->name('Cus.SearchData');

Route::get('calendar-event', [DataLawTrack::class, 'index'])->name('event.index');
Route::post('calendar-crud-ajax', [DataLawTrack::class, 'calendarEvents']);


});


