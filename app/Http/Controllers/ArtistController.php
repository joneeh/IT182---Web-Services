<?php

namespace App\Http\Controllers;

use App\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::with('albums', 'albums.tracks')->get();

        return response()->json($artists);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|unique:artists',
            'last_name' => 'required|string',
        ]);

        $artist = Artist::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return response()->json([
            'artist' => $artist,
            'message' => 'An Artist was added.',
        ]);
    }

    public function show($id)
    {
        $artist = Artist::where('id', $id)->with('albums', 'albums.tracks')->get();

        return response()->json($artist);
    }

    public function destroy($id)
    {
        $artist = Artist::find($id);

        if ($artist->delete()) {
            return response()->json([
                'artist' => $artist,
                'message' => 'An Artist has been deleted.'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $artist = Artist::find($id);
        $artist->first_name = $request->first_name;
        $artist->last_name = $request->last_name;
        $artist->save();

        return response()->json([
            'artist' => $artist,
            'message' => 'An Artist was updated.'
        ]);
    }
}
