@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success m-3" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger m-3">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    @if(session('error'))
                    <div class="alert alert-danger m-3">
                        {{session('error')}}
                    </div>
                    @endif
                    @endif
                    {{ __('You are logged in!') }}
                    @if(isset($books))
                    <table class="table">
                        <thead>
                            <tr class="px-2">
                                <th scope="col">Cover</th>
                                <th scope="col">Book Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Price</th>
                                <th scope="col">Published</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col">Content</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>
                                    <img src="{{$book->cover}}" alt="{{$book->title}}" class="img-thumbnail">

                                </td>
                                <td>{{$book->title}}</td>
                                <td>{{$book->author->name}}</td>
                                <td>{{$book->price}}</td>
                                <td>{{$book->year_published}}</td>
                                <td>{{$book->updated_at}}</td>
                                <td>{{Str::substr($book->content,0,100)}}</td>
                                <td>
                                    <a href="{{URL::to('books/'.$book->id.'/edit')}}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form method="post" action="{{route('books.destroy',['book' => $book->id])}}">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$books->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection