<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;

class PagesController extends Controller
{
    //
    public function index(){
        $songs_count  = Song::all()->count();
        $songs = Song::orderBy('created_at','desc')->paginate(21);
        $popular_songs = Song::orderBy('views')->paginate(8);
        // dd($songs->toArray());
        return view('index',compact('songs_count','songs','popular_songs'));
    }
}
