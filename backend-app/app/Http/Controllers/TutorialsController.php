<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TutorialsController extends Controller
{

    public function index(Request $request)
    {
        if ($title = $request->title) {
            $all = Tutorial::where('title', 'like', "%$title%")->get();
        } else {
            $all = Tutorial::all();
        }

        return $all;
    }

    public function create(Request $request)
    {
        try {
            $request->validate(
                [
                    'title'       => 'required',
                    'description' => 'required',
                ]
            );
        } catch (Throwable $e) {
            return ['error' => $e->getMessage()];
        }

        return Tutorial::create($request->all());
    }

    public function show(Request $request, string $id)
    {
        $t = Tutorial::find($id);
        if (!$t) {
            return ['error' => 'not found'];
        } else {
            return $t;
        }
    }

    public function update(Request $request, string $id)
    {
        $t = Tutorial::find($id);
        if (!$t) {
            return ['error' => 'not found'];
        }
        $t->update($request->all());

        return $t;
    }

    public function delete(Request $request, string $id) {
        /** @var \App\Models\Tutorial $t */
        $t = Tutorial::find($id);
        if (!$t) {
            return ['error' => 'not found'];
        }
        $t->delete();

        return $t;
    }

    public function truncate(Request $request) {
        DB::table('tutorials')->truncate();

        return 'ok';
    }
}
