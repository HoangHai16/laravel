@extends('admin_layout')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2-init').select2({
            placeholder: 'Chọn vai trò'
        });
    </script>
@endsection
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm nhân viên
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
                                <form role="form" action="{{route('users.store')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên </label>
                                    <input type="text" value="{{old('name')}}" name="name" class="form-control" id="exampleInputEmail1" required placeholder="Nhập tên ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Email </label>
                                    <input type="email" value="{{old('email')}}" name="email" class="form-control" id="exampleInputEmail2" required placeholder="Nhập Email ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Số điện thoại </label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail3" required placeholder="Nhập phone ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail4">Password </label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail4" required placeholder="Nhập password ">
                                </div>
                                <div class="form-group">
                                    <label>Chọn vai trò</label>
                                    <select name='role_id[]' class="select2-init form-control"  multiple="">
                                        <option value=''></option>
                                        @foreach ($roles as $role)
                                            <option value='{{$role->id}}'>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
