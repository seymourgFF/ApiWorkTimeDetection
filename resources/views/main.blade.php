@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <ul class="list-group">
                    @foreach($workers as $worker)
                        <li class="list-group-item"><a href="{{route('show',$worker->id)}}"><span>{{$worker->id}}</span>, <span>{{$worker->name}}</span></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
