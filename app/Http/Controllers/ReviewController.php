<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Review;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        if(Review::where([["recipe","=",$id],['submitter','=',$request->userId]])->exists()){
          $review = Review::where([["recipe","=",$id],['submitter','=',$request->userId]])->first();
          $review->review = $request->review;
          $review->stars = $request->stars;
          $review->save();
          return response()->json("Review updated", 200);
        }
        else if(Recipe::where('id',$id)->exists()){
          $request['recipe'] = $id;
          $request['submitter'] = $request->userId;
          Review::create($request->all());
        }
        else {
          return response()->json('Recipe does not exist', 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return response()->json(Review::where('recipe',$id)->get(),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      if(Member::find($request->userId)->role == 2 || Review::find($id)->submitter = $request->userId){
        Review::find($id)->delete();
      }
    }
}
