<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AlumniController extends Controller
{
    public function read () {
        return response()->json(User::all());
    }

    public function delete ($id) {
        $request = new Request();
        $request['id'] = $id;

        $validator = Validator::make($request->all(), [
            'id' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'user tidak ditemukan'
            ], 404);
        }

        User::where('id', $id)->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function update(Request $request, $id) {
        $request['id'] = $id;

        $validator = Validator::make($request->all(), [
            'id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        User::where('id', $id)->update($request->all());

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function create() {
        
    }
}
