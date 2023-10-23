<?php

use App\Http\Controllers\Frontend\BlogController;

// Blog custom pages all route
Route::get('/financing-the-purchase-of-goods', [BlogController::class, 'getFinancingPage'])->name('blog.financing');
Route::get('/encom-galaxy', [BlogController::class, 'getEncomGalaxyPage'])->name('blog.encomGalaxy');
Route::get('/galaxy-petrol', [BlogController::class, 'getGalaxyPetrolPage'])->name('blog.galaxyPetrol');
Route::get('/privacy-policy', [BlogController::class, 'getPrivacyPolicyPage'])->name('blog.privacyPolicy');
Route::get('/about-us', [BlogController::class, 'getAboutusPage'])->name('blog.aboutus');
Route::get('/contact-us', [BlogController::class, 'getContactusPage'])->name('blog.contactus');
Route::post('/contact-us-send', [BlogController::class, 'emailContactusPage'])->name('blog.contactus.send');
Route::get('/credit-purchase', [BlogController::class, 'getCreditPurchasePage'])->name('blog.creditPurchase');
Route::post('/credit-purchase-send', [BlogController::class, 'emailCreditPurchasePage'])->name('blog.creditPurchase.send');
Route::get('/anti-money-laundering-law', [BlogController::class, 'getMoneyLaundringPage'])->name('blog.moneyLaundering');

// Blog pages all route
Route::get('/blog', [BlogController::class, 'getBlogPage'])->name('home.blog');
Route::get('/blog/{slug}', [BlogController::class, 'getBlogSinglePage'])->name('home.blog.single');
Route::get('/blog/category/{category_id}', [BlogController::class, 'ViewblogCategoryFiltered'])->name('blog.category');
Route::post('/blog/search', [BlogController::class, 'ViewblogCategorySearch'])->name('blog.search');