



<x-layout>

    <div class="bg-light d-flex p-4 m-3  ">

     
        
        <div class="text-center m-auto w-100 border-end border-dark">
           <p class="">{{ Auth::user()->email }}</p>
            <a href="#" class="text-muted">Reset Password</a>
        </div>

        <div class=" text-center m-auto w-100 border-end border-dark">
            
            <h1 class="text-capitalize">{{ Auth::user()->name }}</h1>
                   

        </div>

        <div class="text-center m-auto w-100 ">
           
            <a href="/RecipeApp/my-recipes/" class=" btn btn-outline-secondary" style="">Account </a>     
        </div>
        

    </div>

    <h4 class="text-center p-5">Admin - User Management</h4>
    <form action="#" method="GET" class="d-flex w-50 mx-auto mb-5" >
            <input type="text" name="search" placeholder="Search users..." class="form-control m-1" aria-label="Search" />
            
            <button type="submit" class="btn btn-primary m-1">Search</button>
        </form>
    <div class="">

        @foreach ($users as $user)

            <x-admin-user-card :user="$user" />

        @endforeach

    </div>
    <div class="d-flex justify-content-center pagination">
        {{ $users->links() }} <!-- Pagination links -->
    </div>


</x-layout>