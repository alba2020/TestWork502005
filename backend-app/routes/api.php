<?php

use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
Route::get('/tutorials', function(Request $request) {
    if ($title = $request->title) {
        $all = Tutorial::where('title', 'like', "%$title%")->get();
    } else {
        $all = Tutorial::all();
    }
    return $all;
});

//POST	/api/tutorials	create new Tutorial
Route::post('tutorials', function(Request $request) {
    try {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
    } catch (Throwable $e) {
        return ['error' => $e->getMessage()];
    }

    return Tutorial::create($request->all());
});

//GET	/api/tutorials/:id	retrieve a Tutorial by :id
Route::get('tutorials/{id}', function (Request $request, string $id) {
    $t = Tutorial::find($id);
    if (!$t) {
        return ['error' => 'not found'];
    } else {
        return $t;
    }
});

//PUT	/api/tutorials/:id	update a Tutorial by :id
Route::put('tutorials/{id}', function(Request $request, string $id) {
    $t = Tutorial::find($id);
    if (!$t) {
        return ['error' => 'not found'];
    }
    $t->update($request->all());

    return $t;
});

//DELETE	/api/tutorials/:id	delete a Tutorial by :id
Route::delete('tutorials/{id}', function(Request $request, string $id) {
    /** @var \App\Models\Tutorial $t */
    $t = Tutorial::find($id);
    if (!$t) {
        return ['error' => 'not found'];
    }
    $t->delete();

    return $t;
});

//DELETE	/api/tutorials	delete all Tutorials
Route::delete('tutorials', function(Request $request) {
   DB::table('tutorials')->truncate();

   return 'ok';
});
