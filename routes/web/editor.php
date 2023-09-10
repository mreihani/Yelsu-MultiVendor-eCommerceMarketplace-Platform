<?php

use App\Http\Controllers\Backend\Editor\EditorController;
use App\Http\Controllers\Backend\Editor\EditorBlogController;

//Editor Dashboard
Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::get('dashboard', [EditorController::class, 'EditorDashboard'])->name('editor.dashboard');
    Route::get('logout', [EditorController::class, 'EditorDestroy'])->name('editor.logout');
    Route::get('profile', [EditorController::class, 'EditorProfile'])->name('editor.profile');
    Route::get('settings', [EditorController::class, 'EditorProfileSettings'])->name('editor.profileSettings');
    Route::post('profile/store', [EditorController::class, 'EditorProfileStore'])->name('editor.profile.store');
    Route::post('update/password', [EditorController::class, 'EditorUpdatePassword'])->name('editor.update.password');

    // Editor Blog Category All Route
    Route::get('blog/category', [EditorBlogController::class, 'AllBlogCategory'])->name('editor.blog.category');
    Route::get('add/blog/category', [EditorBlogController::class, 'AddBlogCategory'])->name('editor.add.blog.category');
    Route::post('store/blog/category', [EditorBlogController::class, 'StoreBlogCategory'])->name('editor.store.blog.category');
    Route::get('edit/blog/category/{id}', [EditorBlogController::class, 'EditBlogCategory'])->name('editor.edit.blog.category');
    Route::post('update/blog/category', [EditorBlogController::class, 'UpdateBlogCategory'])->name('editor.update.blog.category');
    Route::get('delete/blog/category/{id}', [EditorBlogController::class, 'DeleteBlogCategory'])->name('editor.delete.blog.category');

    // Editor Blog Post All Route
    Route::get('blog/post', [EditorBlogController::class, 'AllBlogPost'])->name('editor.blog.post');
    Route::get('add/blog/post', [EditorBlogController::class, 'AddBlogPost'])->name('editor.add.blog.post');
    Route::post('store/blog/post', [EditorBlogController::class, 'StoreBlogPost'])->name('editor.store.blog.post');
    Route::get('edit/blog/post/{id}', [EditorBlogController::class, 'EditBlogPost'])->name('editor.edit.blog.post');
    Route::post('update/blog/post', [EditorBlogController::class, 'UpdateBlogPost'])->name('editor.update.blog.post');
    Route::get('delete/blog/post/{id}', [EditorBlogController::class, 'DeleteBlogPost'])->name('editor.delete.blog.post');

    // File management all route
    Route::get('media/files', [EditorController::class, 'EditorMediaFiles'])->name('editor.media.files');
    Route::get('media/addfiles', [EditorController::class, 'EditorMediaAddFiles'])->name('editor.media.add');
    Route::post('media/storefiles', [EditorController::class, 'EditorMediaStoreFiles'])->name('editor.media.store');
    Route::get('media/delete/{id}', [EditorController::class, 'EditorDeleteFile'])->name('editor.media.delete');
});