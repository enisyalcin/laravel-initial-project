@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img src="{{asset("images/$book->photo")}}" class="img-fluid" alt="">
        </div>
        <div class="col-md-9">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                  <h3 class="mb-0">
                        {{$book->name}}
                  </h3>

                  <p class="card-text mb-auto">{{$book->author}}</p>
                  <p class="card-text mb-auto">{{$book->isbn}}</p>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
