<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
//use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;


class RecipeController extends Controller
{

    


    /////////// VIEW ////////////////

    public function index(){
        return view('recipes.all-recipes',[
            'recipes' => Recipe::latest()
            ->whereHas('user', function ($query) {
                $query->where('inactive', false); // Only include active users
            })
            ->filter(request(['search']))
            ->paginate(12),
            
        ]);
    }

    //show all my recipes
    public function myRecipes()
    {
        $user = auth()->user();
        return view('recipes.my-recipes', [
            'recipes' => $user->recipes()->orderBy('created_at', 'desc')->get(),
            
        ]);
    }

    public function show($slug)
    {
        $recipe = Recipe::find($slug);
        
        
        if(!$recipe){
            return redirect()->route('recipe-index')->with('status', 'No recipe of that name found');
        }
        return view(('recipes.recipe'), ['recipe' => $recipe]);

    }

    public function showUser($username){

        $user = User::find($username);

        if(!$user){
            return redirect()->route('recipe-index')->with('status', 'No user of that name found');
        }

        return view('recipes.all-recipes', [
            'recipes' => $user->recipes()->paginate(12)
        ]);
    }

    ////////////////END VIEW/////////////////////////


    ///////////////CREATE//////////////////////////

    // create new recipe view
    public function create()
    {
        return view('recipes.create');
    }


    ///////////////END CREATE//////////////////////////


    ///////////////EDIT//////////////////////////

    public function edit(Recipe $recipe)
    {
        
        //$recipe = Recipe::find($slug);

        // $this->authorize('update', $recipe);
        // dd('Authorized!');
        
        if(!$recipe){
            return redirect()->route('recipe-index')->with('status', 'No recipe of that name found');
        };

        return view('recipes.edit',
            ['id'=>$recipe->id,
            'slug'=>$recipe->slug,
            'title'=>$recipe->title,
            'image'=>$recipe->image,
            'description'=>$recipe->description,
            'ingredients'=>implode("\n", $recipe->ingredients),
            'instructions'=>implode("\n", $recipe->instructions),]
        );
    }
    public function update(Request $request, Recipe $recipe)
    {

        $request->validate([
            'title' => 'required|string|max:255|unique:recipes,title,' . $recipe->id,
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
        ]);
        

		$recipe->title = $request->title;
        $recipe->slug = Str::slug($request->title);
        $recipe->description = $request->description;
        $ingredientsArr = preg_split("/\r\n|\n|\r/", $request->ingredients);
        $instructionsArr = preg_split("/\r\n|\n|\r/", $request->instructions);
        //dd($instructionsArr);
        //remove empty entries from array
        $ingredientsArr = array_filter($ingredientsArr, function ($value) {
            return !empty(trim($value));
        });

        $instructionsArr = array_filter($instructionsArr, function ($value) {
            return !empty(trim($value)); 
        });

        $recipe->ingredients = array_values($ingredientsArr);
        $recipe->instructions = array_values($instructionsArr);

        //dd($recipe->instructions);
         
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($recipe->image && Storage::disk('public')->exists($recipe->image)) {
                Storage::disk('public')->delete($recipe->image);
            }
            // Upload the new image
            $path = $request->file('image')->store('uploads', 'public');
            $recipe->image = $path; 
        }

		$recipe->save();

		return redirect()->route('recipe-index')->with('status', 'Recipe updated successfully.');
    }

    

    ///////////////END EDIT//////////////////////////



    ///////////////STORE//////////////////////////


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:recipes,title',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
        ]);

        $recipe = new Recipe;
        $recipe->title = $request->title;

        $recipe->slug = Str::slug($request->title);
        $recipe->description = $request->description;
        
        $ingredientsArr = preg_split("/\r\n|\n|\r/", $request->ingredients);
        $instructionsArr = preg_split("/\r\n|\n|\r/", $request->instructions);

        //remove empty entries from array
        $ingredientsArr = array_filter($ingredientsArr, function ($value) {
            return !empty(trim($value));
        });
        $instructionsArr = array_filter($instructionsArr, function ($value) {
            return !empty(trim($value)); 
        });
        $recipe->ingredients = array_values($ingredientsArr);
        $recipe->instructions = array_values($instructionsArr);

        $recipe->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('uploads', 'public');
        }

        $recipe->save();
        return redirect()->route('my-recipes')->with('status', 'Recipe created successfully.');
        
    }

    ///////////////END STORE//////////////////////////

    ///////////////DELETE//////////////////////////

    public function destroy(Recipe $recipe)
    {
        //$recipe = Recipe::find($slug);
        
        if(!$recipe){
            return redirect()->route('recipe-index')->with('status', 'No recipe of that name found');
        }

        if ($recipe->image && Storage::disk('public')->exists($recipe->image)) {
            Storage::disk('public')->delete($recipe->image);
        }
        // Storage::delete($recipe->image);
        $recipe->delete();
        //return back()->with(['operation'=>'deleted', 'id'=>$recipe->id]);
        return redirect()->route('recipe-index')->with('status', 'Recipe deleted successfully.');
    }

    ///////////////END DELETE//////////////////////////
    

    

    

    

    

}
