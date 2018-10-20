<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Artists;

class ArtistsController extends Controller
{
    //
    private $artist_repo  ;

    public function __construct(Artists $artist)
    {
        $this->artist_repo = $artist;
    }
    public function index()
    {  
        $artist = $this->artist_repo->getAll();
        return \View::make('admin.index',compact('artist'));
    }

    public function create(ArtistRequest $request)
    {
        dd($this->artist_repo->create($request));
    }

    public function delete($id)
    {
        if($this->artist_repo->delete($id)){
            
        }else{

        }
    }

    
}
