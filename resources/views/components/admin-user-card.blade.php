


<head>

<style>
    ul{
        list-style:none;
    }

    

</style>

</head>


@props(['user'])


    
<div class="bg-light m-2 p-2 col-md-8 mx-auto">
        <div class="d-flex">
            <div class="mx-4 mt-2 w-100 d-flex float-end">
                <h4 class="fw-bold w-100 my-auto">
                {{ $user->name }}             
                <span class="text-muted" style="font-size:0.9rem;"> - {{ $user->is_admin ? 'Admin' : 'User' }}</span>
                </h4>
            </div>

            @if ($user->id !== auth()->id())
                
            

                <div class=" w-50 d-flex my-auto">
                    

                    @if($user->is_admin)
                    

                    <form action="/RecipeApp/admin/{{$user->id}}/remove-user" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                            Remove Admin
                        </button>
                    </form>
                    

                    @else
                    <form action="/RecipeApp/admin/{{$user->id}}/add-user" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                            Make Admin
                        </button>
                    </form>
                    
                    
                    @endif

                    <div style="width:20px;"></div>

                    @if($user->inactive)
                    

                    <form action="/RecipeApp/admin/{{$user->id}}/activate-user" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                            Activate Account
                        </button>
                        
                    </form>

                    @else

                    <form action="/RecipeApp/admin/{{$user->id}}/inactivate-user" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            Inactivate Account
                        </button>
                        
                    </form>
                    
                    @endif
                </div>
            @endif
        </div>
        

        <div class="d-flex">
            <div class="w-75">
                <ul class="mt-2">
                    <li><strong>Username:</strong> {{ $user->username }}</li>
                    <li><strong>Email:</strong> {{ $user->email }}</li>
                    <li><strong>Number of Recipes:</strong> {{ $user->recipes_count ?? $user->recipes->count() }}</li>
                    
                </ul>
            </div>
            <div class="w-100">
                <ul class="mt-2">
                    
                    
                    <li>
                        <strong>Joined:</strong> 
                        <span class="{{ $user->is_admin ? 'text-red-500' : 'text-gray-500' }}">
                            Joined: {{ date('d M Y', strtotime(Auth::user()->created_at ))}}
                        </span>
                    </li>

                    <li>
                        <strong>Email Verified:</strong> 
                        <span class="{{ $user->email_verified_at ? 'text-green' : 'text-red' }}">
                            {{ $user->email_verified_at ? date('d M Y',strtotime($user->email_verified_at )) : 'Not Verified' }}
                        </span>
                    </li>
                    
                    <li class="">
                        <a href="/RecipeApp/users/{{$user->username}}" class="" style="color:green;">View Recipes</a>
                    </li>
                </ul>
            </div>

            
        </div>
    
    
</div>