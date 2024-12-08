<!doctype html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
    *, a{
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    text-decoration: none;
    color: #212529;
    }
    .navbar {
        justify-content: space-between;
    }

    .navbar  {
        padding-left: 20rem; 
        padding-right: 20rem; 
    }

    .nav-item{
        padding-left: 1rem; 
        padding-right: 1rem; 

    }

    body{
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .navbar-brand {
        flex-grow: 1; /* This will allow the brand to take up available space */
        text-align: center; /* Center align the site name */
    }

    .form-group{
        padding-bottom:20px;
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

<body class="bg-secondary">

    
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <div class="container-fluid">
            
            <a class="navbar-brand fw-bold" href="{{ url('/') }}" style="font-family:Courier New; font-size:2rem;">RECIPE SITE</a>
            
            
            

        </div>
    </nav>
    <main class=" w-75 mx-auto  ">
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