@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>

                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert add">'.$message.'</span>';
                                Session::put('message',null);
                            }
	                    ?>

                        <div class="panel-body">
                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype='multipart/form-data'>
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value='{{$pro->product_name}}'>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value='{{$pro->product_price}}'>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('/upload/product/'.$pro->product_image)}}" width='100' height='100'>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea type="password" style ="resize:none" rows ="5" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm">{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea type="password" style ="resize:none" rows ="5" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Nội dung sản phẩm">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPasswordl">Danh mục sản phẩm</label>
                                    <select name='product_cate' class="form-control input-sm m-bot15">
                                        
                                    @foreach($cate_product as $key =>$cate)
                                        @if($cate->Category_id == $pro->category_id)
                                        <option selected value='{{$cate->Category_id}}'>{{$cate->Category_name}}</option>
                                        @else
                                        <option value='{{$cate->Category_id}}'>{{$cate->Category_name}}</option>
                                        @endif
                                    @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPasswordl">Thương hiệu</label>
                                    <select name='product_brand' class="form-control input-sm m-bot15">
                                        
                                        @foreach($brand_product as $key =>$brand)
                                            @if($brand->brand_id == $pro->brand_id)
                                            <option selected value='{{$brand->brand_id}}'>{{$brand->brand_name}}</option>
                                            @else
                                            <option value='{{$brand->brand_id}}'>{{$brand->brand_name}}</option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPasswordl">Hiển thị</label>
                                    <select name='product_status' class="form-control input-sm m-bot15">
                                        <option value='0'>Ẩn</option>
                                        <option value='1'>Hiển thị</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>

@endsection