@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <hr>
                    @if(isset($book))
                    <form action="{{route('books.update',$book->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="bookCover">Cover</label>
                            <input type="file" class="form-control" id="bookCover">

                        </div>
                        <div class="form-group">
                            <label for="bookTitle">Book Title</label>
                            <input type="text" name="title" class="form-control" value={{$book->title}} id="bookTitle">

                        </div>
                        <div class="form-group">
                            <label for="bookPrice">Price</label>
                            <input type="text" name="price" class="form-control" value={{$book->price}} id="bookPrice">

                        </div>
                        <div class="form-group">
                            <label for="bookContent">Details</label>
                            <textarea name="content" class="form-control" id="bookContent" cols="30" rows="10" value="">{{$book->content}}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="year">Year Published</label>
                            <input type="text" name="year_publish" class="form-control" id="year" value="{{$book->year_published}}">

                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection