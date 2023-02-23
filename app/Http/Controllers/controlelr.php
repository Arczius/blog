<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Songs;
use App\Models\Genres;
use App\Models\GenresSongs;

use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;

class SongController extends Controller
{

    protected function newSongRequest(Request $request)
    {
        $validated = $request->validate([
            'song_name' => 'required|max:255',
            'artist_name' => 'required|max:255',
            'song_mp3' => 'mimes:mp3,wav,ogg'
        ]);

        $name = $validated['song_name'];
        $artist = $validated['artist_name'];
        $file = isset($validated['song_mp3']) ? $validated['song_mp3']: null;

        $file = $request->file('song_mp3');

        $song_data = [
            "song_name" => $name,
            "artist_name" => $artist,
            "has_song_file" => isset($file),
            "song_file_type" => isset($file) ? $file->extension() : null,
        ];

        Songs::insert($song_data);

        if(isset($file)){
            $fileName = $song->id . "." . $file->extension();

            $file->storeAs('public/audio', $fileName, 'local');
        }
    }
}