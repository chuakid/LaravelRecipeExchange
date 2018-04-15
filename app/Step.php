<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    //
  protected  $fillable = ['description','recipeId','position'];
}
