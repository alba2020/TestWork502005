<?php

use App\Http\Controllers\TutorialsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//GET	/api/tutorials	retrieve all Tutorials
//GET	/api/tutorials?title=[keyword]	find all Tutorials which title contains keyword
Route::get('/tutorials', [ TutorialsController::class, 'index' ]);
Route::post('tutorials', [ TutorialsController::class, 'create' ]);
Route::get('tutorials/{id}', [ TutorialsController::class, 'show' ]);
Route::put('tutorials/{id}', [ TutorialsController::class, 'update' ]);
Route::delete('tutorials/{id}', [ TutorialsController::class, 'delete' ]);
//DELETE	/api/tutorials	delete all Tutorials
Route::delete('tutorials', [ TutorialsController::class, 'truncate' ]);
