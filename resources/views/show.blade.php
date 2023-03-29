@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <ul class="list-group">
                    <li class="list-group-item"><span>{{$worker->id}}</span>, <span>{{$worker->name}}</span></li>
                </ul>
            </div>
        </div>

        <div class="mt-3 row justify-content-center">
            <div class="col-md-7">
                <div class="h1">
                    @if($dates != 'all')
                       C {{$from}} по {{$to}}
                    @else
                        За все время
                    @endif
                </div>
                <div>Было затрачено {{$hours}} </div>
            </div>
        </div>

        <div class="mt-3 row justify-content-center">
            <div class="col-md-7">
                <form method="POST" action="{{route('show',$worker->id)}}">
                    @csrf
                    <div class="input-daterange input-group date">
                        <input value="{{$dates}}" type="text" name="dates" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                    <input type="submit" class="mt-3 btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <script defer>$('input[name="dates"]').daterangepicker();</script>
@endsection
