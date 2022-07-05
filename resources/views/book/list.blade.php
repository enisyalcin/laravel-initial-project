@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="table-responsive-md">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Show</th>
                        @auth
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <th scope="row">{{$book->id}}</th>
                                <td>{{$book->name}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->isbn}}</td>
                                <td>
                                    <a href="{{route("book.show",$book)}}" class="btn btn-sm btn-primary" role="button" aria-pressed="true">Show</a>
                                </td>
                            @auth
                                <td>
                                    <a href="{{route("book.edit",$book)}}" class="btn btn-sm btn-primary" role="button" aria-pressed="true">Edit</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{route("book.destroy",$book)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                        </div>
                                    </form>
                                </td>
                            @endauth

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
