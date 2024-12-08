


<x-layout>

    
    @if(Auth::user() !== null && Auth::user()->email_verified_at === null)
        <div class=" fw-bold m-3 p-2 text-center mx-auto" style="border:red dotted 2px; width:500px;">
            <p>VERIFY EMAIL FOR FULL ACCESS TO SITE</p>
        </div>
    
    @endif

    <div class="d-flex p-4 m-3  ">
        <div class=" text-center m-auto w-50 border-end border-dark">
            
            <h1 class="text-capitalize">{{ Auth::user()->name }}</h1>
            <p>Joined: {{ date('d M Y', strtotime(Auth::user()->created_at ))}}</p>
            @if(Auth::user()->is_admin)
             <p>Admin</p>
            @endif

        </div>
        <div class="text-start m-auto w-100 px-3">
           <p class="">{{ Auth::user()->email }}</p>
            <a href="#" class="text-muted">Reset Password</a>
        </div>

        
        <div class="text-center m-auto w-100">
            
            @if(Request::is('my-saved-recipes'))
                <a href="/RecipeApp/my-recipes/" class="btn btn-outline-secondary" >My Recipes <i class="fa fa-pencil" style=" font-size:20px;"></i></a>
            @else
                <a href="/RecipeApp/my-saved-recipes/" class=" btn btn-outline-secondary" style="">Saved Recipes <i class="fa fa-bookmark fa-lg bookmark-icon" 
                        style=" font-size:20px;"></i></a>

            @endif
            <a href="/RecipeApp/my-recipes/create/" class="btn btn-outline-primary">Create New Recipe <i class="fa fa-plus" style="color:#e95f5f; font-size:20px;"></i></a>
            
        </div>
    
    </div>



<hr/>
    @if ($recipes->isEmpty() && Request::is('my-recipes'))
        <p class="text-center text-muted" style="font-size:1rem;">You have no recipes yet...</p>
    @elseif($recipes->isEmpty() && Request::is('my-saved-recipes'))
        
        <p class="text-center text-muted" style="font-size:1rem;">You have no saved recipes...</p>
    @else
        <p class="text-center text-muted" style="font-size:1rem;">You have {{ $recipes->count() }} recipes...</p>
    @endif
    
<hr/>

    
    <x-recipes :recipes="$recipes"/>
  

    
    

</x-layout>