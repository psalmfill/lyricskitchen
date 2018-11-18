<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Genres;

class GenresController extends Controller
{
    //
    private $genres_repo ;

    public function __construct(Genres $genre)
    {
        $this->genres_repo = $genre;
    }
    
    public function index(){
        $genres = $this->genres_repo->getAll();

        return view('genres', compact('genres'));
    }
}
