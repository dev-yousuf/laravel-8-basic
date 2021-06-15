<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Hi.. {{ Auth::user()->name }} |
           Total User: <span class="btn btn-success">{{count($users)}}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{{ $user->created_at->diffForHumans() }}}</td> --}}
                        <td>{{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</x-app-layout>
