<?php

use App\Http\Controllers\ObituaryController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Task 3: form
Route::get('/obituaries/create', [ObituaryController::class, 'create'])->name('obituaries.create');

// Task 4: submission (submit_obituary)
Route::post('/obituaries', [ObituaryController::class, 'store'])->name('obituaries.store');

// Task 5: retrieval / listing (view_obituaries), paginated
Route::get('/obituaries', [ObituaryController::class, 'index'])->name('obituaries.index');

// Task 6: individual obituary page with SEO/OG/schema.org tags
Route::get('/obituaries/{obituary:slug}', [ObituaryController::class, 'show'])->name('obituaries.show');

// Task 6.6: XML sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', fn () => redirect()->route('obituaries.index'));
