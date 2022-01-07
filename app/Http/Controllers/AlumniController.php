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

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'asal_prodi' => ['required'],
            'username' => ['required'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'asal_prodi' => $request->asal_prodi,
            'username' => $request->username,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
            'linkedin' => $request->linkedin,
            'pekerjaan' => $request->pekerjaan,
            'alamat_kantor' => $request->alamat_kantor
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function getById($id) {
        $request = new Request();
        $request['id'] = $id;

        $validator = Validator::make($request->all(), [
            'id' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'data alumni tidak ditemukan.'
            ], 404);
        }

        return response()->json(User::where('id', $id)->first());
    }
}
