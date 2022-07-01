@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách nhân viên
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
            <th>Tên nhân viên</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!--Đổ dữ liệu từ csdl vào bảng-->
          <a href="{{route('users.create')}}" class="btn btn-primary" style="margin: 20px 0 20px 10px;">Thêm nhân viên</a>
          @foreach($users as $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <a href="{{route('users.edit',['id'=>$user->id])}}" class="active styling-edit">
                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{route('users.destroy',['id'=>$user->id])}}" class="active styling-edit">
                    <i class="fa fa-times text-danger text"></i>
                </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    <span>{{ $users->links() }}</span>
  </div>
</div>

@endsection
