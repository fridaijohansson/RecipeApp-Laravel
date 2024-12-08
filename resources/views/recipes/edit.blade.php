<x-layout>
    @isset($id) 
    <form method="POST" action="{{url("/recipes/$slug")}}" enctype="multipart/form-data" class="p-5">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-6">
                <label class="form-label" for="title">Title</label>
                <input class="form-control" type="text" name="title" value="{{$title}}">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <label class="form-label" for="image">Image</label>
                <input class="form-control" type="file" name="image" accept="image/*" >
            </div>
        </div>
        
        <br>
        <div >
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control" name="description" id="" cols="100" rows="5" style="max-height: 200px">{{$description}}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <br>
        
        <br>
        <div class="d-flex">
            <div class="p-1">
                
                <label class="form-label" for="instructions">Instructions</label>
                <textarea class="form-control" name="instructions" id="" cols="100" rows="5" style="max-height: 500px">{{$instructions}}</textarea>        
                <p class="text-muted">Separate the instructions with a new line, like below:</p>
                @error('instructions')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div style="line-height: 5px;">
                    <p class="text-muted">Step 1</p>
                    <p class="text-muted">Step 2</p>
                </div>
                
            </div>
             
            <div class="p-1">
                <label class="form-label" for="ingredients">Ingredients</label>
                <textarea class="form-control" name="ingredients" id="" cols="40" rows="5" style="max-height: 500px">{{$ingredients}}</textarea> 
                <p class="text-muted">Separate the ingredients with a new line</p>
                @error('ingredients')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
        </div>

        <br>
       
        

        <br>
        {{-- <div >
            <input type="checkbox" name="private">
            <label for="private">Make Recipe Private</label>
            
        </div> --}}
        <br>
        <div >
            <input type="submit" class="btn btn-primary" value="Update Recipe">
        </div>
    </form>
    @if( ! empty($id) )	
        <img  src="{{ asset('storage/' . $image) }}" class="card-img-top" alt="{{$title }}">


        <br>
@endif
    
@endisset
</x-layout>


