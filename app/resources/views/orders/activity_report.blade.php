<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Activity Report</title>
    <style type="text/css">
      table.center {
        margin-left: auto; 
        margin-right: auto;
      }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div>     
      <hr style="height:1px;border:none;color:black;background-color:#333;" /> <br/><br/><br/> <br/> <br/> <br/>
      <h3> Activity Report </h3>
      <table class="table">
        <thead class="thead-dark">
            <tr>
                <th> Order # </th>
                <th> Table # </th>
                <th> Customer </th>
                <th> Price </th>
                <th> Status </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $order)
                <tr>
                    <td> {{$order->order_number}} </td>
                    <td> {{$order->table_number}} </td>
                    <td> {{$order->user_name}} </td>
                    <td> {{show_price($order->total_price)}} </td>
                    <td>
                        @if($order->status == config('constants.order_status.active'))
                            Active
                        @else
                            Completed
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
     </table>
      <hr style="height:1px;border:none;color:black;background-color:#333;" />
    </div>
  </body>
</html>