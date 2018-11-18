<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Unirest;
use DOMDocument;
use Intervention\Image\Facades\Image;

use App\Repositories\Songs;
use App\Repositories\Artists;
use App\Artist;
use App\Song;
use App\Album;

class GeniusController extends Controller
{   private $headers = array('Authorization' => 'Bearer 1OUUctsPsfTmR_NgUH-ZnRwgNDYCpiTFfVWsNBRXM3Tia_-XB6kQIjiENjMJiK1W');
    private  $base_url ='https://api.genius.com/' ;
    private $artists_repo;
    private $songs_repo;

    public function __construct(Artists $artist, Songs $song){
        $this->artists_repo = $artist;
        $this->songs_repo = $song;
    }

    public function index(Request $request,$page=1){

        if(empty($request->get('query'))){
            return view('admin.genius.index'); 
        }

        if($request->has('page')){
            $page=$request->get('page');
        }
        $data = array(
            'q' => $request->get('query'),
            'per_page' =>10,
            'page'=>$page,
            'sort' => 'popularity'
        );
        try {
              $response = Unirest\Request::get($this->base_url.'search', $this->headers, $data);
        }catch(Exception $e) {
            return $e->getMessage();
        }
      
       
        $artist = $this->getMostFreqResultForArtist($response->body->response->hits);

        if(!empty($artist && $artist !=null)){
          $songs = $this->artistSong($artist->id,$page);  
        }else{
            return redirect()->back();
        }
        
              
        return view('admin.genius.index',compact('songs'));
    }

    public function artistSong($id,$page=1){
        
        $data = array(
            'per_page' =>10,
            'page' =>$page,
        );
        $response = Unirest\Request::get($this->base_url.'artists/'.$id.'/songs', $this->headers,$data);
        return   $response->body->response;
    }
    public function song($id){
        $response = Unirest\Request::get($this->base_url.'songs/'.$id, $this->headers);
        
        if($response->body->meta->status !=404){
        
        $songArtist = $response->body->response->song->primary_artist;
        $artist_name =  $songArtist->name;
    

        # grap song title
        $song_title = $response->body->response->song->title;
        $date_string_to_time = strtotime($response->body->response->song->release_date); 
        $release_date = date('Y-m-d',$date_string_to_time);
        # Grap the song url 
        $url = $response->body->response->song->url;
        $album = $response->body->response->song->album;
        $lyrics ='';
        $html = file_get_html($url,false,null,1);

        $artistBio = '';
        $artistUrl =file_get_html($songArtist->url,false,null,1); 
        foreach($artistUrl->find('div') as $e) {
            #get only div with class of lyrics and store it content in $lyrics
             if($e->class =='rich_text_formatting'){
                    if($e->innertext !='' || $e->innertext !=null){
                         $dom = str_get_html($e->innertext);
                     //remove all links from html
                        foreach($dom->find('a') as $link){
                                $link->outertext = $link->plaintext;
                        }
                        $artistBio = $dom->save();
                    }
             }
        } 

       

        # loop through all the div
        foreach($html->find('div') as $e) {
            #get only div with class of lyrics and store it content in $lyrics
             if($e->class =='lyrics'){
                     $dom = str_get_html($e->innertext);
                     //remove all links from html
                foreach($dom->find('a') as $link){
                         $link->outertext = $link->plaintext;
                }
                    $lyrics = $dom->save() ;
             }
        } 
        $artist = $this->artists_repo->getArtistByName($artist_name);
        
        
        if($artist ==null){
            $artist = new Artist();
            $artist->name =  $artist_name;
            $artist->slug =  get_slug($artist_name,'Artist');
            $artist->biography = $artistBio ;
            $artist->year = 0;

            if( $response->body->response->song->primary_artist->image_url !=null ||
            $response->body->response->song->primary_artist->image_url  !=''){
                $path = $response->body->response->song->primary_artist->image_url ;
                $extension = explode('.',$path)[count(explode('.',$path)) -1];
                $filename = str_random(10).'.'.$extension;
                if(Image::make($path)->save(public_path('uploads/artists/' . $filename))){
                    $artist->avatar = $filename;
                }else{
                    $artist->avatar = 'artist.jpg';
                }
            }

            $artist->save();
        }
        $id = $artist->id;
        $album_id = null;
        
        
        if($album != null || $album !=''){
            $check_album = Album::where([
                ['artist_id','=',$id],
                ['title','=',$album->name]
            ])->get();
            
            if( $check_album->count() > 0){
                $newAlbum = new Album();
                $newAlbum->title = $album->name;
                $newAlbum->artist_id = $id;
                $newAlbum->slug = str_slug($album->name);
                if( $album->cover_art_url !=null ||
                $album->cover_art_url!=''){
                    $path = $album->cover_art_url;
                    $extension = explode('.',$path)[count(explode('.',$path)) -1];
                    $filename = str_random(10).'.'.$extension;
                    if(Image::make($path)->save(public_path('uploads/albums/' . $filename))){
                        $newAlbum->image = $filename;
                    }else{
                        $newAlbum->image = 'artist.jpg';
                    }
                }
                if($newAlbum->save()){
                    $album_id = $newAlbum->id;
                }
            }
        } 
        
        $songExist = Song::where(
            [
                ['title','=',$song_title],
                ['artist_id','=', $artist->id]
            ]
            )->get()->first();
            
        if( $songExist !=null){
            return redirect()->back()->with('error', 'Song already exist');
        }
        
        if($lyrics !='' || $lyrics !=null){
             $lyrics = new Song(
                [
                'title' => $song_title,
                'lyrics' => $lyrics,
                'artist_id' =>$id,
                'album_id' =>$album_id,
                'slug' => get_slug($song_title,'Song'),
                'release_date' => ($release_date !='' || $release_date !=null)? $release_date:null
                ]
            );

            if($lyrics->save()){
                return redirect()->back()->with('success', 'Song added successfully');
            }
        }
       

        return view('admin.lyrics.edit',compact('lyrics','artist','genre'));
        $request = Request::create('/lyrics','Post',$data);


        return redirect('/lyrics')->with($request);
        
        }else{
          return view('errors.404');  
        }
        
        
    }
    public function get_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }


    public function getMostFreqResultForArtist($hits){
        $mostLikelyArtist = '';
	    if (count($hits)== 0){
            return null;
        }
        $modeMap = [];
        $modeId =$hits[0];
        $highestCount = 1;
		    
   
        foreach ($hits as $hit) {
        $artist = $hit->result->primary_artist;
		$id = $artist->id;
		if (!array_key_exists($id,$modeMap)){
            $modeMap[$id] = 1;
        }else{
           $modeMap[$id] +=1;
        }
        if ($modeMap[$id] > $highestCount) {
			$mostLikelyArtist = $artist;
			$highestCount =$modeMap[$id];
		}
    }
	return $mostLikelyArtist;

    }
}
