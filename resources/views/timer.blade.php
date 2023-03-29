@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="mt-3 row justify-content-center">
            <div class="col-md-7">
                <div class="h1">

                </div>
            </div>
        </div>

        <div class="mt-3 row justify-content-center">
            <div class="col-md-7">
                <form method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Выберите работника</label>
                        <select class="form-control" name="worker" id="worker">
                            @foreach($workers as $worker)
                                <option value="{{$worker->id}}">{{$worker->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" class="mt-3 btn btn-primary">
                </form>
            </div>
        </div>
    </div>\
@endsection
