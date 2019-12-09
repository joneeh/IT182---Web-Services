<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('tracks')->get();

        return response()->json($albums);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'genre' => 'required|string',
            'description' => 'required|string',
        ]);

        $album = Album::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'description' => $request->description,
        ]);

        return response()->json([
            'album' => $album,
            'message' => 'An Album was added.',
        ]);
    }

    public function show($id)
    {
        $album = Album::where('id', $id)->with('tracks')->get();

        return response()->json($album);
    }

    public function destroy($id)
    {
        $album = Album::find($id);

        if ($album->delete()) {
            return response()->json([
                'album' => $album,
                'message' => 'An Album has been deleted.'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'genre' => 'required',
            'description' => 'required',
        ]);

        $album = Album::find($id);
        $album->title = $request->title;
        $album->genre = $request->genre;
        $album->description = $request->description;
        $album->save();

        return response()->json([
            'album' => $album,
            'message' => 'An Album was updated.'
        ]);
    }
}
