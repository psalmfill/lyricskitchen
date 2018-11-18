<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Artist;
use App\Album;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        // dd($request->q);composer require laravel/scout
        // return Artist::where('name','like','%'.$request->q.'%')->get();
        $search = $request->q;
        switch($request->type){
            case 'artist':
                $artists = Artist::where('name','like','%'.$search.'%')->paginate(20);
                return view('artists',compact('artists'));
            case 'lyrics' :
                $songs = Song::where('title','like','%'.$search.'%')->paginate(20);
                return view('songs',compact('songs'));
            case 'album':
                $albums = Album::where('title','like','%'.$search.'%')->paginate(20);
                return view('albums',compact('albums'));        
        }
        
    }


}
