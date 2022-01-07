<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\news;
use Validator;

class NewsController extends Controller
{
    public function create (Request $request) {
        $validator = Validator::make($request->all(), [
            'judul' => ['required'],
            'deskripsi' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        news::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function update (Request $request, $id) {
        $request = new Request();
        $request['id'] = $id;

        $validator = Validator::make($request->all(), [
            'id' => 'exists:news,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'berita tidak ditemukan.'
            ], 404);
        }

        news::where('id', $id)->update($request->all());

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function delete ($id) {
        $request = new Request();
        $request['id'] = $id;

        $validator = Validator::make($request->all(), [
            'id' => 'exists:news,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'berita tidak ditemukan'
            ], 404);
        }

        news::where('id', $id)->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function read () {
        return response()->json(news::all());
    }

    public function getById($id) {
        $request = new Request();
        $request['id'] = $id;

        $validator = Validator::make($request->all(), [
            'id' => 'exists:news,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'maaf berita tidak ditemukan.'
            ], 404);
        }

        return response()->json(news::where('id', $id)->first());
    }
}
