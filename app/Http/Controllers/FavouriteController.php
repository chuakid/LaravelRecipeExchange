<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use App\Recipe;

class FavouriteController extends Controller
{

    public function count($id){
      return response()->json(Favourite::where('recipe', $id)->count(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if(Recipe::find($id)->exists() && Favourite::where([['recipe',$id],['user',$request->userId]])){
          Favourite::create(['user'=>$request->userId,'recipe'=>$id]);
        }
    }

    public function destroy(Request $request, $id)
    {
      Favourite::where([['user',$request->userId],['recipe',$id]])->delete();
    }
}
