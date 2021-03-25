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
                @include('elements.message')
                <div class="float-right">
                    <a href="{{ route('items.create') }}" class="btn btn-primary">Add new item</a>
                </div>
                <div class="table-responsive">
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
                                <th scope="col">Action</th>
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
                                        <td>
                                            <a data-rel="{{ $item->id }}" href="javascript:void(0);" class="btn btn-success view_item_details"> Show </a> / 
                                            <a href="{{ route('items.edit', [$item->id]) }}" class="btn btn-primary"> Edit </a> / 
                                            <a data-rel="{{ $item->id }}" href="javascript:void(0);" class="btn btn-danger delete_item"> Delete </a>
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

    @include('elements.modals.show', ['id' => 'showItemModal', 'title' => 'View Item', 'class' => 'view_item'])

    @include('elements.modals.delete', ['id' => 'deleteItemModal', 'title' => 'Delete Item', 'class' => 'delete_item_btn', 'message' => 'Do you want to delete the item ?'])

    <script type="text/javascript">
        $(function() {
            $('.delete_item').click(function() {
                var id = $(this).attr('data-rel'); 

                $("#deleteItemModal").modal('show'); 
                $("#deleteItemModal").find('.delete_item_btn').attr('data-rel', id);
            });

            $('.delete_item_btn').click(function() {
                var id = $(this).attr('data-rel');

                $.ajax({
                    url: "{{ route('items.delete') }}",
                    data: {"id": id, "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        window.location.href = "{{ route('items') }}";
                    }
                });
            });

            $('.view_item_details').click(function() {
                var id = $(this).attr('data-rel');

                $.ajax({
                    url: "{{ route('items.show') }}",
                    data: {"id": id, "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        $("#showItemModal").modal('show');
                        $('.view_item').html(data);
                    }
                });
            });
        })
    </script>
@stop