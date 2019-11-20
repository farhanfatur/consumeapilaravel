@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>
                <form method="POST" action="{{ route('apiUpdate') }}">
                    @csrf
                    {{ method_field('PUT') }}
                <div class="card-body">
                   <div class="row form-group">
                        <div class="col-md-8">
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                        </div>
                   </div>
                   <div class="row form-group">
                        <div class="col-md-8">
                            <label for="description">Description</label>
                            <textarea rows="10" cols="40" class="form-control" name="description">{{ $post->description }}</textarea>
                        </div>
                   </div>

                   <div class="row form-group">
                        <div class="col-md-8">
                            <label for="category">Category</label>
                            <select name="category" class="form-control">
                                @foreach($categories as $category)
                                @if($category == $post->category)
                                <option value="{{ $post->category }}" selected>{{ $post->category }}</option>
                                @else
                                <option value="{{ $category }}">{{ $category }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                   </div>
                   <div class="row form-group">
                       <div class="col-md-8">
                           <button type="submit" class="btn btn-primary">Save</button>
                       </div>
                   </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
