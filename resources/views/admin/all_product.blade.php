@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê thương hiệu sản phẩm
            </div>

            <div class="table-responsive">

                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>

                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Hiển thị</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--Đổ dữ liệu từ csdl vào bảng-->
                        @foreach ($info as $value)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                                </td>
                                <td>{{ $value->product_name }}</td>
                                <td>{{ $value->product_price }}</td>
                                <td><img src='public/upload/product/{{ $value->product_image }}' width='100'
                                        height='100' /></td>
                                <td>{{ $value->Category_name }}</td>
                                <td>{{ $value->brand_name }}</td>
                                <td><span class="text-ellipsis">
                                        <?php
                if($value->product_status==0){
                  ?>
                                        <a href="{{ URL::to('/unactive-product/' . $value->product_id) }}"><span
                                                class="fa-thumb-styling fa fa-eye-slash"></span></a>
                                        <?php
                }else{
                  ?>
                                        <a href="{{ URL::to('/active-product/' . $value->product_id) }}"><span
                                                class="fa-thumb-styling fa fa-eye"></span></a>
                                        <?php
                }
              ?>
                                    </span></td>
                                <td>
                                    <a href="{{ URL::to('/edit-product/' . $value->product_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn có muốn xóa không ?')"
                                        href="{{ URL::to('/delete-product/' . $value->product_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
