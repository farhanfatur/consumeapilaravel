@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Post</div>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="window.location.href='/post/add'">Add Post</button>
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th width="90">Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ str_limit($post->description, 20, '...') }}</td>
                            <td>{{ $post->category }}</td>
                            <td>
                                
                                <form method="POST" action="{{ route('apiDestroy', $post->id) }}" style="clear: both;">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <a href="/post/edit/{{ $post->id }}" class="btn btn-warning">Edit</a>  | 
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
