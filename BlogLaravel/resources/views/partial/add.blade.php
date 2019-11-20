@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Post</div>
                <form method="POST" action="{{ route('apiStore') }}">
                    @csrf
                <div class="card-body">
                   <div class="row form-group">
                        <div class="col-md-8">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                   </div>
                   <div class="row form-group">
                        <div class="col-md-8">
                            <label for="description">Description</label>
                            <textarea rows="10" cols="40" class="form-control" name="description"></textarea>
                        </div>
                   </div>
                   <div class="row form-group">
                        <div class="col-md-8">
                            <label for="category">Category</label>
                            <select name="category" class="form-control">
                                <option value="berita">Berita</option>
                                <option value="ekonomi">Ekonomi</option>
                                <option value="mancanegara">Mancanegara</option>
                                <option value="teknologi">Teknologi</option>
                            </select>
                        </div>
                   </div>
                   <div class="row form-group">
                       <div class="col-md-8">
                           <button type="submit" class="btn btn-primary">Add</button>
                       </div>
                   </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
