<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Artists;
use Yajra\Datatables\Datatables;

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
        $artists = $this->artist_repo->getAll();
        return \View::make('admin.artists.index',compact('artists'));
    }

    public function getdata(){
        return Datatables::of(\App\Artist::query())->make(true);
    }

    public function create(ArtistRequest $request)
    {  
        if($this->artist_repo->create($request)){
            
            \Alert::success("Success creating Artist","Success");
            return redirect()->route('artist_home');
        }else{
            \Alert::error("Fail creating Artist","Fail");
            return redirect()->route('artist_home');
        }
    }

    public function delete($id)
    {
        if($this->artist_repo->delete($id)){
            \Alert::success("Success deleting artist","Success");

            return redirect()->route('artist_home');
        }else{
            \Alert::error("Fail creating artist","Fail");

            return redirect()->route('artist_home');
        }
    }
    public function getartist(Request $request){
        $data = [];


        if($request->has('q')){

            $search = $request->q;

            $data = DB::table("artists")

            		->select("id","name")

            		->where('name','LIKE',"%$search%")

            		->get();

        }


        return response()->json($data);
    }

    
}
