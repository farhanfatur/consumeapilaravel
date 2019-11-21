@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Post</div>
                <div class="card-body">
                    @if ($errors->has('file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif

                    @if ($success = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $success }}</strong>
                    </div>
                    @endif

                    @if ($warning = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $warning }}</strong>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" onclick="window.location.href='/post/add'">Add Post</button>    
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-success" onclick="window.location.href='/post/export'">Export to Excel</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#importExcel">Import Sheet Excel</button>
                        </div>
                    </div>
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


    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="/post/import" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <label>Choose excel file</label>
                            <div class="form-group">
                                <input type="file" name="file" required="required" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
