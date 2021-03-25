@extends('layouts.master')

@section('title', 'Edit Order')

@section('sidebar')
    @parent
@stop

@section('content')
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-12">
                {!! Form::open(['route' => ['orders.update', $data->id], 'id' => 'update-order']) !!}
                    <h3 class="text-center"> Edit Order </h3>
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="show-message">
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Customer Name</h6>
                            </label> 
                            {!! Form::text('user_name', $data->user_name, ['class' => 'mb-4', 'placeholder' => 'Enter Customer Name']) !!}
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Table Number</h6>
                            </label> 
                            {!! Form::text('table_number', $data->table_number, ['class' => 'mb-4', 'placeholder' => 'Enter Table Number']) !!}
                        </div>
                        <div class="add_more_orders_section">
                            @foreach($orderDetails as $key=>$val)
                                <div id="order_section_{{ $key }}" class="more_order_section">
                                    <div class="row px-3"> 
                                        <label class="mb-1">
                                            <h6 class="mb-0 text-sm">Item</h6>
                                        </label> 
                                        {!! Form::select('order_details['.$key.'][item_id]', $activeItems, $val->item_id, ['class' => 'mb-4 form-control', 'placeholder' => 'Select Item']) !!}
                                    </div>
                                    <div class="row px-3"> 
                                        <label class="mb-1">
                                            <h6 class="mb-0 text-sm">Quantity</h6>
                                        </label> 
                                        {!! Form::text('order_details['.$key.'][quantity]', $val->quantity, ['class' => 'mb-4', 'placeholder' => 'Enter Quantity']) !!}
                                    </div>
                                    <div class="row px-3"> 
                                        <label class="mb-1">
                                            <h6 class="mb-0 text-sm">Price</h6>
                                        </label> 
                                        {!! Form::text('order_details['.$key.'][price]', $val->price, ['class' => 'mb-4', 'placeholder' => 'Enter Price']) !!}
                                    </div>
                                    @if($key > 0)
                                        <div class="row px-3">
                                            <button class="btn btn-danger remove_more_orders_section" type="button" data-rel="{{$key}}"> Remove </button>
                                        </div>
                                    @endif
                                </div><br/><br/>
                            @endforeach
                        </div>
                        <div class="row px-3"> 
                            <a href="javascript:void(0);" class="btn btn-success add_more_orders">Add more</a>
                        </div><br/>
                        <div class="row px-3"> 
                            <button type="submit" class="btn btn-primary text-center validate_login">Update</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $(document).on('click', '.remove_more_orders_section', function() {
            var id = $(this).attr('data-rel');
            $('#order_section_'+id).remove();
        });

        $(".add_more_orders").click(function() {
            var lastSectionDataRel = $('div.more_order_section').last().attr('id');

            var lastSectionDataRelSplit = lastSectionDataRel.split("_");

            var nextSectionId = parseInt(lastSectionDataRelSplit[2]) + 1;

            $.ajax({
                type: 'GET',
                url: "{{ route('orders.add_more_order')}}",
                data: {'next_section_id' : nextSectionId},
                success: function(response){                
                    $(".add_more_orders_section").append(response);
                }
            });
        });
    });
</script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\CreateOrderRequest', '#update-order'); !!}
@stop