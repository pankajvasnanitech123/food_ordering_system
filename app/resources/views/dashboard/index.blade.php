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
                            @if(auth()->user()->user_role_id == $cashierRoleId || auth()->user()->user_role_id == $adminRoleId)
                                <th scope="col">Total Active Orders</th>
                                <th scope="col">Total Completed Orders</th>
                            @else
                                <th scope="col">Total Active Orders</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if(auth()->user()->user_role_id == $cashierRoleId || auth()->user()->user_role_id == $adminRoleId)
                                <td>{{ $activeOrders }}</td>
                                <td>{{ $completedOrders }}</td>
                            @else
                                <td> {{ $activeOrders }} </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop