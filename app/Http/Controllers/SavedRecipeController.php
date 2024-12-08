<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Http\Controllers\RecipeController;


class SavedRecipeController extends Controller
{

    public function getSavedRecipes()
    {
        return view('recipes.my-recipes', [
            'recipes' => auth()->user()->savedRecipes,
        ]);
    }

    public function saveRecipe(Recipe $recipe)
    {
        $user = auth()->user();
    
        if ($user->savedRecipes()->where('recipe_id', $recipe->id)->exists()) {
            $user->savedRecipes()->detach($recipe->id);
        }else{
            $user->savedRecipes()->attach($recipe->id);

        }

        return back();
    
        
    }
    
}
