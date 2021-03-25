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
                            <th scope="col">Order Number</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(! $data->isEmpty())
                            @foreach($data as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ show_price($order->price) }}</td>
                                    <td>
                                        @if($order->status == config('constants.order_status.active'))
                                            <button type="button" class="btn btn-warning">Active</button></td>
                                        @else
                                            <button type="button" class="btn btn-success">Completed</button></td>
                                        @endif
                                    </td>
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