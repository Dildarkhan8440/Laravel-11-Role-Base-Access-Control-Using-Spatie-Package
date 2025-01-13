

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        @role('super-admin')
                        <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
                        <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
                        <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
                        @endrole
                        <a href="{{ url('posts') }}" class="btn btn-primary mx-1">Posts</a>
                    </div>
                
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-md-12">
                
                                @if (session('status'))
                                    <div class="alert alert-success">{{ session('status') }}</div>
                                @endif
                
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4>Users
                                            @can('create post')
                                            <a href="{{ url('posts/create') }}" class="btn btn-primary float-end">Add User</a>
                                            @endcan
                                        </h4>
                                    </div>
                                    <div class="card-body">
                
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($posts as $post)
                                                <tr>
                                                    <td>{{ $post->id }}</td>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ $post->description }}</td>
                                                    <td>{{ $post->status }}</td>

                                                    <td>
                                                        @can('publish post')
                                                        @if($post->status=='inactive')
                                                        <a href="{{ url('posts/'.$post->id.'/publish') }}" class="btn btn-success">Publish</a>
                                                        @endif
                                                        @endcan
                                                        @can('unpublish post')
                                                        @if($post->status=='active')
                                                        <a href="{{ url('posts/'.$post->id.'/unpublish') }}" class="btn btn-danger">Un-Publish</a>
                                                        @endif
                                                        @endcan
                                                        @can('update post')
                                                        <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-warning">Edit</a>
                                                        @endcan
                
                                                        @can('delete post')
                                                        <a href="{{ url('posts/'.$post->id.'/delete') }}" class="btn btn-danger mx-2">Delete</a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    
                </div>
            </div>
        </div>
    </div>


    

</x-app-layout>