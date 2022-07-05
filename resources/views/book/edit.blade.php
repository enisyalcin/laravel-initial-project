@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route("book.update",$book)}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        <div class="form-group">
          <label for="name">Book Name</label>
          <input type="input" class="form-control" name="name" id="name" aria-describedby="Book Name" placeholder="Book Name" value="{{$book->name}}">
        </div>
        <br/>

        <div class="form-group">
            <label for="author">Book Author</label>
            <input type="input" class="form-control" name="author" id="author" aria-describedby="Book Author" placeholder="Book Author" value="{{$book->author}}">
        </div><br/>

        <div class="form-group">
            <label for="photo">Choose file</label>
            <input type="file" class="form-control" name="photo" id="photo">
        </div><br/>

        <div class="form-group">
            <label for="isbn">Book ISBN</label>
            <input type="input" class="form-control" name="isbn" id="isbn" aria-describedby="Book ISBN" placeholder="Book ISBN" value="{{$book->isbn}}">
        </div><br/>

        <button type="submit" class="btn btn-primary">Save</button>
      </form>
</div>
@endsection
