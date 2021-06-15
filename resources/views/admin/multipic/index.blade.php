<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         All Brand
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              <div class="card-header">Multi Picture</div>
            </div>
            <div class="card-group">
              @foreach ($images as $image)
              <div class="col-3">
              <div class="card">
                <img src="{{ asset($image->image)}}" class="img-thumbnail">
              </div>
            </div>
              @endforeach
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">Multi Picture</div>
              <div class="card-body">
                <form action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Multi Image</label>
                    <input class="form-control" name="image[]" type="file" id="formFile" multiple="">
                    @error('image')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group pt-3">
                    <button type="submit" class="btn btn-primary">Add Multi Image</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>

  </div>
</x-app-layout>
