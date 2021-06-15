<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Update Category 
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Update Brand</div>
              <div class="card-body">
                <form action="{{url('brand/update/'.$brands->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="old_image" value="{{$brands->brand_image}}">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                    <input type="text" name="brand_name" class="form-control" value="{{$brands->brand_name}}">
                    @error('brand_name')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Brand Image</label>
                    <input type="file" class="form-control" name="brand_image" id="formFile" value="{{$brands->brand_image}}" >
                    @error('brand_image')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <img src="{{ asset($brands->brand_image)}}" class="rounded d-block" width="250">
                  </div>
                  <button type="submit" class="btn btn-primary">Update Brand</button>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</x-app-layout>
