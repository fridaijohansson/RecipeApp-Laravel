<x-layout>


    
    @if(Auth::user() !== null && Auth::user()->email_verified_at === null)
        <div class=" fw-bold m-3 p-2 text-center mx-auto" style="border:red dotted 2px; width:500px;">
            <p>VERIFY EMAIL FOR FULL ACCESS TO SITE</p>
        </div>
    
    @endif
   

    <x-recipes :recipes="$recipes"/>

    <div class="d-flex justify-content-center pagination">
        {{ $recipes->links() }} <!-- Pagination links -->
    </div>

</x-layout>