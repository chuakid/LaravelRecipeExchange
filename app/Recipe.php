<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
  protected  $fillable = ['name','submitter','description','status','timeneeded','preptime','servings','image'];
}
