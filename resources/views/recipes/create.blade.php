<x-layout>
    <form method="POST" action="{{url("/recipes/save")}}" enctype="multipart/form-data" class="p-5">
        @csrf
        <div class="row">
            <div class="col-6">
                <label class="form-label" for="title">Title</label>
                <input class="form-control" type="text" name="title" value="{{ old('title') }}">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <label class="form-label" for="image">Image</label>
                <input class="form-control" type="file" name="image" accept="image/*">
                 @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
           
        </div>
        
        <br>
        <div >
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control" name="description" id="" cols="100" rows="5" style="max-height: 200px" >{{ old('description') }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <br>
        
        <br>
        <div class="d-flex">
            <div class="p-1">
                
                <label class="form-label" for="instructions">Instructions</label>
                <textarea class="form-control" name="instructions" id="" cols="100" rows="5" style="max-height: 500px" >{{ old('instructions') }}</textarea>        
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
                <textarea class="form-control" name="ingredients" id="" cols="40" rows="5" style="max-height: 500px" >{{ old('ingredients') }}</textarea> 
                <p class="text-muted">Separate the ingredients with a new line</p>
                @error('ingredients')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
        </div>

        <br>
       
        <br>
        <div >
            <input type="submit" class="btn btn-primary" value="Create Recipe">
        </div>
    </form>
</x-layout>


