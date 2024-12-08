<!doctype html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <style>
    

 
/*------------------------------------
- COLOR primary
------------------------------------*/

.bg-primary {
    background-color: #e95f5f !important;
}

.btn-primary {
    color: white;
    background-color: #e95f5f;
    border-color: #e95f5f;
}

.btn-primary:hover {
    color: white;
    background-color: #e43f3f;
    border-color: #e23232;
}

.btn-primary:focus, .btn-primary.focus {
    box-shadow: 0 0 0 0.2rem rgba(233, 95, 95, 0.5);
}

.btn-primary.disabled, .btn-primary:disabled {
    color: #212529;
    background-color: #e95f5f;
    border-color: #e95f5f;
}

.btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
    color: #212529;
    background-color: #e23232;
    border-color: #e02424;
}

.btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .show > .btn-primary.dropdown-toggle:focus {
    box-shadow: 0 0 0 0.2rem rgba(233, 95, 95, 0.5);
}

.btn-outline-primary {
    color: #e95f5f;
    background-color: transparent;
    border-color: #e95f5f;
}

.btn-outline-primary:hover {
    color: #212529;
    background-color: #e95f5f;
    border-color: #e95f5f;
}

.btn-outline-primary:focus, .btn-outline-primary.focus {
    box-shadow: 0 0 0 0.2rem rgba(233, 95, 95, 0.5);
}

.btn-outline-primary.disabled, .btn-outline-primary:disabled {
    color: #e95f5f;
    background-color: transparent;
}

.btn-outline-primary:not(:disabled):not(.disabled):active, .btn-outline-primary:not(:disabled):not(.disabled).active, .show > .btn-outline-primary.dropdown-toggle {
    color: #212529;
    background-color: #e95f5f;
    border-color: #e95f5f;
}

.btn-outline-primary:not(:disabled):not(.disabled):active:focus, .btn-outline-primary:not(:disabled):not(.disabled).active:focus, .show > .btn-outline-primary.dropdown-toggle:focus {
    box-shadow: 0 0 0 0.2rem rgba(233, 95, 95, 0.5);
}

a.text-primary:hover, a.text-primary:focus {
    color: #e23232 !important;
}


    *{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        
        color: #212529;
    }
    a{
        color: black;
        text-decoration: none;
    }
    a:hover{
        color: rgba(0,0,0,0.4);
    }
    
    body{
        background-image:url('{{ URL::asset('/storage/website_images/bg.jpg') }}');
        
        background-position: center top;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;

        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .navbar {
        justify-content: space-between;
        
    }

    nav{
        background: rgb(154,188,195);
        background: linear-gradient(180deg, rgba(154,188,195,0.401) 0%, rgba(255,255,255,0) 100%);
    }

    .navbar  {
        padding-left: 15rem; 
        padding-right: 15rem; 
    }

    .nav-item{
        padding-left: 1rem; 
        padding-right: 1rem; 

    }

    .navbar-brand {
        flex-grow: 1; /* This will allow the brand to take up available space */
        text-align: center; /* Center align the site name */
    }

    footer {
        margin-top: auto;
    }

    .toast{
        display:absolute;
        position:fixed;
        top:50px;
        right:40vw;
        height: 50px;
        width: 300px ;
        padding:10px;
        font-family:ariel;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }
    
    .toast-success {
        background-color: #4CAF50; 
        color: white; 
    }

    .toast-error {
        background-color: #F44336;
        color: white; 
    }

    .toast-warning {
        background-color: #FFC107; 
        color: black; 
    }

    .toast-info {
        background-color: #2196F3; 
        color: white; 
    }

</style>

</head>

<body>

    
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        
            <div class="d-flex align-items-center">
            <a class="fw-bold m-2" href="{{ url('/') }}" style="font-family:Courier New; font-size:2rem;">RECIPE SITE</a>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/RecipeApp/recipes/">Find Recipes</a>
                        
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="/dashboard/users/">View Users</a>
                    </li> --}}
                </ul>
            </div>
            
            {{-- if auth --}}
            <div class="d-flex align-items-center">
                <ul class="navbar-nav ms-auto">

                    @auth
                    <li class="nav-item">
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">Sign Out</a>
                        </form>
                    </li>

                    
                    
                    <li class="nav-item">
                        @if(Auth::user()->is_admin)
                        <a class="nav-link fw-bold" href="/RecipeApp/admin/">{{ Auth::user()->name }} - Admin </a>
                        @else
                        <a class="nav-link fw-bold" href="/RecipeApp/my-recipes/">{{ Auth::user()->name }} </a>

                        @endif
                        
                        
                    </li>

                    @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>

                    @endauth
                </ul>
            </div>

            

        </div>
    </nav>
    <main class=" w-75 mx-auto shadow" style="background-color:rgb(255,255,255,0.8); ">
        {{ $slot }}
    </main>
    <br>
    
    <footer class="bg-white text-center py-3 border-top">
        <p class="mb-0">&copy; Frida Johansson B00385661</p>
    </footer>

    @if(session('status'))
        <script>
            $(document).ready(function() {
                toastr.success("{{ session('status') }}");
                
            });
        </script>
    @endif
</body>

<script>

toastr.options = {
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

</script>