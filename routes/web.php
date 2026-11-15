<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/machinery', [WebsiteController::class, 'machinery'])->name('machinery');
Route::get('/fabrics', [WebsiteController::class, 'catalog'])->name('catalog');
Route::get('/fabrics/{slug}', [WebsiteController::class, 'fabric'])->name('fabric');
Route::get('/news', [WebsiteController::class, 'news'])->name('news');
Route::get('/sample-request', [WebsiteController::class, 'sample'])->name('sample');
Route::get('/rfq', [WebsiteController::class, 'rfq'])->name('rfq');
Route::get('/careers', [WebsiteController::class, 'careers'])->name('careers');
Route::get('/sitemap.xml', [WebsiteController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [WebsiteController::class, 'robots'])->name('robots');
Route::get('/{slug}', [WebsiteController::class, 'page'])->whereIn('slug', WebsiteController::PAGES)->name('page');

Route::middleware('auth')->get('/documents/{kind}/{id}', DocumentController::class)->name('documents.show');
