@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách vai trò
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
            <th>Tên vai trò</th>
            <th>Mô tả vai trò</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!--Đổ dữ liệu từ csdl vào bảng-->
          <a href="{{route('roles.create')}}" class="btn btn-primary" style="margin: 20px 0 20px 10px;">Thêm vai trò</a>
          @foreach($roles as $role)
          <tr>
            <td>{{$role->name}}</td>
            <td>{{$role->display_name}}</td>
            <td>
                <a href="{{route('roles.edit',['id'=>$role->id])}}" class="active styling-edit">
                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{route('roles.destroy',['id'=>$role->id])}}" class="active styling-edit">
                    <i class="fa fa-times text-danger text"></i>
                </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    <span>{{ $roles->links() }}</span>
  </div>
</div>

@endsection
