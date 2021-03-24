@extends('layouts.master')

@section('title', 'Login')

@section('sidebar')
    @parent
@stop

@section('content')
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="{{ asset('images/food_ordering_system.jpg') }}" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                {!! Form::open(['route' => 'login-validate', 'id' => 'validate-login-form']) !!}
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="show-message">
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Email Address</h6>
                            </label> 
                            {!! Form::text('email', old('email'), ['class' => 'mb-4', 'placeholder' => 'Enter a valid email address']) !!}
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Password</h6>
                            </label>
                            {!! Form::password('password', ['placeholder' => 'Enter password']) !!}
                        </div>
                    </div>
                    <br/>
                    <div class="row mb-3 px-3"> <button type="button" class="btn btn-primary text-center validate_login">Login</button> </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $(".validate_login").click(function() {
            $.ajax({
                url: "{{ route('login-validate') }}",
                method: "POST",
                data: $("#validate-login-form").serialize(),
                success: function(data) {
                    if(data.success == false) {
                        var divHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+data.message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

                        $(".show-message").html(divHtml);
                    } else {
                        window.location.href = "{{ route('dashboard') }}";
                    }
                }
            });
        });
    });
</script>
@stop