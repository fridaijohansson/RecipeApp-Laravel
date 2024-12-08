


@props(['recipe'])

<head>
    <style>
        .card-hover:hover, .card-hover:hover p, .name-hover:hover{
            color: rgb(129, 129, 129);
        }
        .card{
            min-height: 10vh;
            display: flex;
            flex-direction: column;
        }

        .bookmark-link{
            position: absolute;
            top: 0px;
            left: 10px;
            
        }

        .auth-actions{
            position: absolute;
            top: 0px;
            right: 0px;
        }
    </style>
</head>


<div class="col-md-3 mb-3">
    <div class="card h-100">
        
        <div  >
            {{-- if auth --}}
            @auth
                {{-- if recipe->user is not auth user --}}
                @if(auth()->id() !== $recipe->user_id)
                {{-- <a href="/RecipeApp/recipes/{{$recipe->id}}/saveRecipe" 
                class="bookmark-link" 
                data-id="{{ $recipe->id }}"
                data-saved="{{ $recipe->isSavedByUser(auth()->user()) }}">
                    <i class="fa {{ auth()->user()->savedRecipes->contains($recipe->id) ? 'fa-bookmark' : 'fa-bookmark-o' }} fa-lg bookmark-icon" 
                    style="color:#e95f5f; font-size:40px;"></i>
                </a> --}}

                <form method="POST" action="/RecipeApp/recipes/{{$recipe->id}}/saveRecipe" style="padding:0;margin:0;">
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    @csrf
                    <button type="submit" class="btn bookmark-link" id="bookmark-btn" style="padding:0;margin:0;">
                        <i class="fa {{ auth()->user()->savedRecipes->contains($recipe->id) ? 'fa-bookmark' : 'fa-bookmark-o' }} fa-lg bookmark-icon " 
                        style="color:#e95f5f; font-size:40px;"></i>
                    </button>
                </form>

                @endif

                @if(auth()->id() === $recipe->user_id && Request::is('my-recipes'))
                <div class="d-flex auth-actions">
                    
                    <form method="get" action="{{url("/recipes/{$recipe->slug}/edit")}}" class="mb-2 m-1">
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-primary btn-sm "><i class="fa fa-pencil"></i></button>
                    </form>
                    <form method="POST" action='{{url("/recipes/{$recipe->slug}")}}'class="mb-2 m-1">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                        
                    </form>
                </div>
                @endif

            
            
            @endauth

            <a href="/RecipeApp/recipes/{{$recipe->slug}}" class="card-hover">
                <img src="{{ asset('storage/' . $recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}" style="height: 200px;"> 
                
                <div class="card-body" >
                <h5 class="card-title fw-bold" style="font-size:1rem;">{{ $recipe->title }}</h5>
                <p class="card-text" style="font-size:0.9rem;">{{ substr($recipe->description, 0, 100).'...' }}</p>
                </div>
            </a>
            
        </div>

        @if( !(auth()->id() === $recipe->user_id && Request::is('my-recipes')))

        <p class="card-text mt-3 mx-3"><small class="text-muted">by <a href="/RecipeApp/users/{{$recipe->user->username}}" class="name-hover">{{$recipe->user->name}}</a></p></small></p>

        @endif

        
        
           
    </div>
    
</div>

