<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;


    protected $with = ['user'];

    protected $guarded = ['id',];


    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    public function scopeFilter($query, array $filters){

        $query->when($filters['search'] ?? false, fn ($query, $search)=>$query
        ->where('title', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%'));

    }

    protected $casts=[
        'ingredients' => 'array',
        'instructions' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_recipes')
                    ->withTimestamps();
    }

    public function isSavedByUser(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->savedByUsers()->where('user_id', $user->id)->exists();
    }
    
    public static function find($slug){
        return static::all()->firstWhere('slug', $slug);

    }
}
