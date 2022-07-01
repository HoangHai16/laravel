@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>
    <div class="table-responsive">

                          <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                          ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>{{$info->customer_name}}</td>
            <td>{{$info->customer_phone}}</td>
            <td>{{$info->customer_address}}</td>
            <td></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    <div class="table-responsive">

                          <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                          ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>{{$info->shipping_name}}</td>
            <td>{{$info->shipping_address}}</td>
            <td>{{$info->shipping_phone}}</td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>


    <div class="table-responsive">

                          <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                          ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$info->product_name}}</td>
            <td>{{$info->product_sales_quantity}}</td>
            <td>{{$info->product_price}}</td>
            <td>{{$info->product_price * $info->product_sales_quantity}}</td>
          </tr>
        </tbody>
      </table>
    </div>

</div>
</div>
@endsection
