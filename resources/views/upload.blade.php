@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form  method="post" enctype="multipart/form-data" action="{{route('store')}}" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input name="names" accept=".csv" type="file" class="form-control-file" id="exampleFormControlFile1">
                        @error('names')
                        <div class="danger text-danger">{{ $message }}</div>
                        @enderror
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
