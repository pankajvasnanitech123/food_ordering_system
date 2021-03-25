@extends('layouts.master')

@section('title', 'Login')

@section('sidebar')
    @parent
@stop

@section('content')
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-12">
                {!! Form::open(['route' => 'items.store', 'id' => 'create-item']) !!}
                    <h3 class="text-center"> Create New Item </h3>
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="show-message">
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Name</h6>
                            </label> 
                            {!! Form::text('name', old('name'), ['class' => 'mb-4', 'placeholder' => 'Enter Name']) !!}
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Stock</h6>
                            </label> 
                            {!! Form::text('stock', old('stock'), ['class' => 'mb-4', 'placeholder' => 'Enter Stock']) !!}
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Price</h6>
                            </label> 
                            {!! Form::text('price', old('price'), ['class' => 'mb-4', 'placeholder' => 'Enter Price']) !!}
                        </div>
                        <div class="row px-3"> 
                            <button type="submit" class="btn btn-primary text-center validate_login">Add</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\CreateItemRequest', '#create-item'); !!}
@stop