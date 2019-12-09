<?php

namespace App\Http\Controllers;

use App\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::all();

        return response()->json($tracks);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'duration' => 'required|string',
        ]);

        $track = Track::create([
            'title' => $request->title,
            'duration' => $request->duration,
        ]);

        return response()->json([
            'track' => $track,
            'message' => 'A track was added.',
        ]);
    }
    
    public function show($id)
    {
        $track = Track::find($id);

        return response()->json($track);
    }

    public function destroy($id)
    {
        $track = Track::find($id);

        if ($track->delete()) {
            return response()->json([
                'track' => $track,
                'message' => 'A Track has been deleted.'
            ]);
        }
    }

}
