


<div class="container m-auto mt-4">
    <div class="filter-section mb-4 row d-inline">
        

        <form action="#" method="GET" class="d-flex " >
            <input type="text" name="search" placeholder="Search recipes..." class="form-control m-1" aria-label="Search" />
            
            <button type="submit" class="btn btn-primary m-1">Search</button>
        </form>
    </div>

    <div class="row">
        @foreach($recipes as $recipe)
            <x-recipe-card :recipe="$recipe"  />
        @endforeach
    </div>

</div>

<meta name="csrf-token" content="{{ csrf_token() }}">


{{-- <script>
   $(document).ready(function() {
    console.log('Document ready fired');

    
$('.bookmark-link').on('click', function(e) {
        e.preventDefault();
        console.log('Click event fired');
        
        const $link = $(this);
        const recipeId = $link.data('id');
        
        // Log all relevant data
        console.log({
            recipeId: recipeId,
            linkElement: $link[0],
            url: `/RecipeApp/recipes/${recipeId}/saveRecipe`,
            csrfToken: $('meta[name="csrf-token"]').attr('content')
        });

        // Check if jQuery selector found the element
        if ($link.length === 0) {
            console.error('Bookmark link not found');
            return;
        }
        $.ajax({
            url: `/RecipeApp/recipes/${recipeId}/saveRecipe`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(xhr) {
                console.log('Request about to be sent', {
                    url: this.url,
                    method: this.method,
                    headers: this.headers
                });
            },
            success: function(response) {
                console.log('Success:', response);
            },
            error: function(xhr, status, error) {
                console.log('Error details:', {
                    status: xhr.status,
                    statusText: xhr.statusText,
                    responseText: xhr.responseText,
                    error: error
                });
            }
        });
    });


    });

</script> --}}


    
