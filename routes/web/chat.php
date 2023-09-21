<?php

use App\Http\Controllers\Frontend\ChatController;

// Chat all route
Route::post('/sendmessage', [ChatController::class, 'sendMessage']);
Route::post('/fetchspecialist', [ChatController::class, 'fetchSpecialist']);
Route::post('/fetchSpecialistFinal', [ChatController::class, 'fetchSpecialistFinal']);
Route::post('/fetchSpecialistLongPolling', [ChatController::class, 'fetchSpecialistLongPolling']);
Route::post('/sendfirstform', [ChatController::class, 'sendfirstform']);