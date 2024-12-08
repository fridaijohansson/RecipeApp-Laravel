<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SavedRecipeController;
use App\Http\Controllers\AdminController;
use App\Mail\SignUpVerificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Recipe;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/verificationMail', function() {
//     $name = "User";

//     // The email sending is done using the to method on the Mail facade
//     Mail::to('verifymail4@sharklasers.com')->send(new SignUpVerificationEmail($name));
// });


Route::get('/', function () {
    return view('index');
});

// Route::get('/recipes/', function () {
//     return view('recipes.all-recipes');
// })->middleware(['auth', 'verified'])->name('all-recipes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// END OF BREEZE



// Route::prefix('RecipeApp')->group(function(){

///////////////////////////////////////////////////////////

Route::get('/recipes/', [RecipeController::class, 'index'])->name('recipe-index');

Route::get('/recipes/{recipe:slug}', [RecipeController::class, 'show']);


Route::get('/users/{user:username}', [RecipeController::class, 'showUser']);




Route::get('/my-recipes', [RecipeController::class, 'myRecipes'])->middleware(['auth'])->name('my-recipes');




/////////////////////////////////////////////////////////

Route::middleware('auth')->group(function () {
    
    Route::get('/my-recipes/create', [RecipeController::class, 'create'])->middleware(['can:create,App\Models\Recipe', 'verified']);

    Route::post('/recipes/save', [RecipeController::class, 'store'])->middleware(['can:create,App\Models\Recipe', 'verified']);

    //////////////////////////////////////////////////////

    

    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->middleware('can:update,recipe');


    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->middleware('can:update,recipe');

    ///////////////////////////////////////////////////////////////

    

    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->middleware('can:delete,recipe'); 

    ///////////////////////////////////////////////////////////////////


    Route::get('/my-saved-recipes', [SavedRecipeController::class, 'getSavedRecipes'])->middleware(['auth', 'verified'])->name('my-saved-recipes');

    // Route::post('/recipes/{recipe:id}/saveRecipe', function($recipe) {
    //     dd('Route hit', $recipe);
    // })->middleware('auth');

    Route::post('/recipes/{recipe:id}/saveRecipe', [SavedRecipeController::class, 'saveRecipe'])->middleware(['can:saveRecipe,recipe', 'verified']);


    //Route::delete('/recipes/{recipe}/unsaveRecipe', [SavedRecipeController::class, 'unsaveRecipe'])->middleware('can:saveRecipe,App\Models\Recipe');
        
});




///////////////////////////////////////////////////////////////////




/////////////////////////ADMIN//////////////////////////////


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/', [AdminController::class, 'index']);

    Route::post('/admin/{user}/inactivate-user/', [AdminController::class, 'inactivateUser'])->middleware('can:update,user');

    Route::post('/admin/{user}/activate-user/', [AdminController::class, 'activateUser'])->middleware('can:update,user');

    Route::post('/admin/{user}/add-user', [AdminController::class, 'addUser'])->middleware('can:update,user');
    Route::post('/admin/{user}/remove-user', [AdminController::class, 'removeUser'])->middleware('can:update,user');
});


// });