



<x-layout>

    
    <div class="container p-4 h-100">
        <div class="row">
            <button onclick="history.back()" class="btn btn-sm btn-outline-secondary w-10 mb-2 col-1 ">Go Back</button>
        
        @auth
            @if((auth()->id() === $recipe->user_id && Request::is('my-recipes')) || (auth()->user()->is_admin))
            <div class="d-flex justify-content-end col-11">
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
            
        </div>
       
    
        <div class="d-flex">

            <!-- Left Section: Title, Description, Instructions -->
            <div class=" w-100">
                <h1>{{ $recipe->title }}</h1>
                <p class="mt-3"> by <a href="/RecipeApp/users/{{$recipe->user->username}}">{{$recipe->user->name}}</a> | {{ date('d M Y', strtotime($recipe->created_at ))}}</p>
                <p class="mt-3">{{ $recipe->description }}</p>

                
            </div>
            <div class="w-50">
                <div>
                    <img src="{{ asset('storage/' . $recipe->image) }}" class="card-img-top float-end" alt="{{ $recipe->title }}" style="max-height: 250px; width:auto; max-width:500px;">
                </div>
            </div>
                
                
            
        </div>

        <div class="row mt-4 border border-secondary p-4">
            <!-- Right Section: Image and Ingredients -->
            <div class="col-md-7 pl-2 pr-2">
                <h3>Instructions</h3>
                <ol>
                    @foreach ($recipe->instructions as $instruction)

                    <li class="p-2">{{$instruction}}</li>

                    @endforeach
                </ol>
            </div>
            <div class="col-md-1">

            </div>
            <div class="col-md-4 pl-2 pr-2">
                
                <h3 >Ingredients</h3>
                <ul class="list-group">
                    @foreach ($recipe->ingredients as $ingredient)

                    <li class="p-1 m-1" style="background-color:rgb(207, 207, 207); list-style:none;">{{$ingredient}}</li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>


</x-layout>


