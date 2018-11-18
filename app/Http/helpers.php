<?php
/**
 * Custom helper functions for lyrics kitchen
 */
if (! function_exists('get_slug')) {
    function get_slug($slug,$model=null) {
        // ...
        // Normalize the title
        $slug = str_slug($slug);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $model='App\\'.$model;
        $allSlugs = $model::select('slug')->where('slug', 'like', $slug.'%')
        ->get();
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        $cnt = count($allSlugs)+1;
       return $slug.'-'.$cnt;

    }
}
if (! function_exists('check_slug')) {
    function check_slug($slug,$model=null,$id) {
        // ...
        // Normalize the title
        $slug = str_slug($slug);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $model='App\\'.$model;
        $allSlugs = $model::select('slug')->where('slug', 'like', $slug.'%')
        ->get();
        $models = $model::where('slug', 'like', $slug.'%')->get();
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        foreach($models as $md){
            if($md->id == $id && $md->slug ==$slug){
                return $slug;
            }
        }
        $cnt = count($allSlugs)+1;
       return $slug.'-'.$cnt;

    }
}
