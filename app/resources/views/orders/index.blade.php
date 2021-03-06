@extends('layouts.master')

@section('title', 'Orders')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        @include('elements.navigation')
        <div class="card card0 border-0">
            <div class="col-md-12">
                @php
                    $waiterRoleId   = config('constants.user_types.waiter');
                    $cashierRoleId  = config('constants.user_types.cashier');
                    $adminRoleId  = config('constants.user_types.admin');
                @endphp
                @include('elements.message')
                <div class="float-right">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary">Add new order</a>
                    @if(auth()->user()->user_role_id == $waiterRoleId)
                        <a href="{{ route('orders.print_activity_report') }}" class="btn btn-primary">Print Activity Report</a>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Order Number</th>
                                <th scope="col">Table Number</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(! $data->isEmpty())
                                @foreach($data as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->table_number }}</td>
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ show_price($order->total_price) }}</td>
                                        <td>
                                            @if($order->status == config('constants.order_status.active'))
                                                <button type="button" class="btn btn-warning">Active</button></td>
                                            @else
                                                <button type="button" class="btn btn-success">Completed</button></td>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status == config('constants.order_status.active'))
                                                <a data-rel="{{ $order->id }}" href="javascript:void(0);" class="btn btn-success view_order_details"> Show </a> / 
                                                <a href="{{ route('orders.edit', [$order->id]) }}" class="btn btn-primary"> Edit </a> / 
                                                <a data-rel="{{ $order->id }}" href="javascript:void(0);" class="btn btn-danger delete_order"> Delete </a>
                                                @if(auth()->user()->user_role_id == $cashierRoleId)
                                                    / <a data-rel="{{ $order->id }}" href="javascript:void(0);" class="btn btn-primary process_order"> Process Order </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">No Records Found </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('elements.modals.show', ['id' => 'showOrderModal', 'title' => 'View Order', 'class' => 'view_order'])

    @include('elements.modals.delete', ['id' => 'deleteOrderModal', 'title' => 'Delete Order', 'class' => 'delete_order_btn', 'message' => 'Do you want to delete the order ?'])

    @include('elements.modals.process_payment', ['id' => 'processPaymentModal', 'title' => 'Process Payment', 'class' => 'process_payment_btn', 'message' => 'Do you want to process the payment ?'])

    <script type="text/javascript">
        $(function() {
            $('.process_order').click(function() {
                var id = $(this).attr('data-rel'); 

                $("#processPaymentModal").modal('show'); 
                $("#processPaymentModal").find('.process_payment_btn').attr('data-rel', id);
            });

            $('.process_payment_btn').click(function() {
                var id = $(this).attr('data-rel');

                $.ajax({
                    url: "{{ route('orders.process') }}",
                    data: {"id": id, "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        window.location.href = "{{ route('orders') }}";
                    }
                });
            });

            $('.delete_order').click(function() {
                var id = $(this).attr('data-rel'); 

                $("#deleteOrderModal").modal('show'); 
                $("#deleteOrderModal").find('.delete_order_btn').attr('data-rel', id);
            });

            $('.delete_order_btn').click(function() {
                var id = $(this).attr('data-rel');

                $.ajax({
                    url: "{{ route('orders.delete') }}",
                    data: {"id": id, "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        window.location.href = "{{ route('orders') }}";
                    }
                });
            });

            $('.view_order_details').click(function() {
                var id = $(this).attr('data-rel');

                $.ajax({
                    url: "{{ route('orders.show') }}",
                    data: {"id": id, "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        $("#showOrderModal").modal('show');
                        $('.view_order').html(data);
                    }
                });
            });
        })
    </script>
@stop