<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Songs;
use App\Models\Genres;
use App\Models\GenresSongs;

class SongsController extends Controller
{
    public function newSong(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'song_name' => 'required|max:255',
            'artist_name' => 'required|max:255',
        ]);
        $genreList = $request->genreList;

        $checkSong = Songs::where([
            [
                'song_name', '=', $validated['song_name']
            ],
            [
                'artist_name', '=', $validated['artist_name']
            ]
        ])->first();

        if(!isset($checkSong)){
            Songs::insert([
                'song_name' => $validated['song_name'],
                'artist_name' => $validated['artist_name'],
            ]);
            $response['status'] = "success";
        }
        else{
            $response['status'] = "failed";
        }

        $song = Songs::where([
            [
                'song_name', '=', $validated['song_name']
            ],
            [
                'artist_name', '=', $validated['artist_name']
            ]
        ]);

        $response['songid'] = $song->id;

        foreach($genreList as $genre){
            GenresSongs::insert(
                [
                    'song_id' => $song->id,
                    'genre_id' => $genre,
                ]
            );
        }

        return response()->json($response);
    }







    public function editSongFile(Request $request, String $songid)
    {

        $validated = $request->validate([
            'file' => 'mimes:mp3,wav,ogg'
        ]);

        $file = $validated['file'];

        $song = Songs::where('id', $songid)->first();

        $data['status'] = 'failed';

        if(isset($file)){
            if($song->has_song_file){
                Storage::disk('local')->delete('public/audio/' . $song->id . "." . $song->song_file_type );
            }

            $fileName = $song->id . "." . $file->extension();
            $file->storeAs('public/audio', $fileName, 'local');
            Songs::where('id', $song->id)->update([
                'has_song_file' => true,
                'song_file_type' => $file->extension(),
            ]);
            $data['status'] = 'success';
        }

        return response()->json($data);
    }
}