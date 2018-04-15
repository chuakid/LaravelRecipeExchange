<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Recipe;
use App\Category;
use App\Step;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['submitter'] = $request->userId;
        $steps = $request->steps;
        $ingredients = $request->ingredients;
        unset($request['steps']);
        unset($request['ingredients']);

         $id = Recipe::create($request->all());
         $this->updateSteps($steps, $id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
      if(Recipe::find($id)->exists()) {
        return response()->json(Recipe::find($id),200);
      }
      else {
        return response()->json('Recipe not found', 403);
      }
    }

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
        if(Recipe::where('id',$id)->exists()) {
          $steps = $request->steps;
          $ingredients = $request->ingredients;
          unset($request['steps']);
          unset($request['ingredients']);
          Recipe::where('id',$id)->update($request->all());

          $this->updateSteps($steps, $id);
          $this->updateIngredients($ingredients, $id);
          }
        else {
          return response()->json("Recipe not found", 200);
        }
    }

    public function updateSteps($steps, $id){
      Step::where('recipeId',$id)->delete();
      for($i = 0; $i < count($steps); $i++) {
        $steps[$i]["position"] = $i;
        $steps[$i]["recipeId"] = $id;
        Step::create($steps[$i]);
      }
    }

    public function updateIngredients($ingredients, $id){
      Ingredient::where('recipe',$id)->delete();
      for($i = 0; $i < count($ingredients); $i++) {
        $ingredients[$i]["recipe"] = $id;
        Ingredient::create($ingredients[$i]);
      }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      if(Member::find($request->userId)->role == 2 || Recipe::find($id)->submitter = $request->userId){
        Recipe::find($id)->delete();
      }
    }
}
