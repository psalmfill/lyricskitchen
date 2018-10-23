<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Genures;

class GenureController extends Controller
{
    //
    private $genures_repo ;

    public function __construct(Genures $genure)
    {
        $this->genures_repo = $genure;
    }
    

}
