@extends('backEnd.layouts.masters')
@section('Page-Title','Building Category Edit')
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Edit Category 



            </h3>
      
        <div class="card-body">
       <form action="{{ route ('admin.Building_Category.update',$category->id)  }}" method="POST" class="">
        @csrf
        @method('PUT');
        <div class="mb-3">
            <label for="form-label">Building Type</label>
            <input type="text" class="form-control" name="building_type" value={{ $category->building_type }}>

            @error('building_type')
            <span class="text-danger">
                {{ $message }}
                
            </span>
                
            @enderror
        </div>


            <button type="submit" class="btn btn-primary" > Update</button>
       </form>
        </div>
    </div>
</div>

@endsection