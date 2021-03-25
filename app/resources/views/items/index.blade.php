@extends('layouts.master')

@section('title', 'Dashboard')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        @include('elements.navigation')
        <div class="card card0 border-0">
            <div class="col-md-12">
                <table class="table">
                    @php
                        $waiterRoleId   = config('constants.user_types.waiter');
                        $cashierRoleId  = config('constants.user_types.cashier');
                        $adminRoleId  = config('constants.user_types.admin');
                    @endphp

                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(! $data->isEmpty())
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ show_price($item->price) }}</td>
                                    <td><button type="button" class="btn btn-success">Active</button></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="4">No Records Found </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop