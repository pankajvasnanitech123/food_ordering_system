<div id="order_section_{{$nextSectionId}}" class="more_order_section">
    <div class="row px-3"> 
        <label class="mb-1">
            <h6 class="mb-0 text-sm">Item</h6>
        </label> 
        {!! Form::select('order_details['.$nextSectionId.'][item_id]', $activeItems, '', ['class' => 'mb-4 form-control', 'placeholder' => 'Select Item']) !!}
    </div>
    <div class="row px-3"> 
        <label class="mb-1">
            <h6 class="mb-0 text-sm">Quantity</h6>
        </label> 
        {!! Form::text('order_details['.$nextSectionId.'][quantity]', '', ['class' => 'mb-4', 'placeholder' => 'Enter Quantity']) !!}
    </div>
    <div class="row px-3"> 
        <label class="mb-1">
            <h6 class="mb-0 text-sm">Price</h6>
        </label> 
        {!! Form::text('order_details['.$nextSectionId.'][price]', '', ['class' => 'mb-4', 'placeholder' => 'Enter Price']) !!}
    </div>
    <div class="row px-3">
        <button class="btn btn-danger remove_more_orders_section" type="button" data-rel="{{$nextSectionId}}"> Remove </button>
    </div>
</div><br/><br/>