@extends('admin_layout')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.checkbox_wrapper').on('click', function() {
            $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        })
    </script>
@endsection
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm vai trò
                </header>

                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert add">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <form role="form" action="{{ route('roles.store') }}" method="post" style="width : 100%;">
                                {{ csrf_field() }}
                                <div class="form-group col-md-12" style="padding: 0">
                                    <label for="exampleInputEmail1">Tên vai trò </label>
                                    <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                        id="exampleInputEmail1" required placeholder="Nhập tên ">
                                </div>
                                <div class="form-group col-md-12" style="padding: 0">
                                    <label for="exampleInputEmail2">Mô tả vai trò </label>
                                    <textarea type="text" value="{{ old('display_name') }}" name="display_name" class="form-control"
                                        id="exampleInputEmail2" required placeholder="Nhập Email "></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="row">
                                        @foreach ($permissionParent as $permissionParentItem)
                                            <div class="card text-white bg-primary mb-3 col-md-12">
                                                <div class="card-header">
                                                    <label>
                                                        <input type="checkbox" value="" class="checkbox_wrapper">
                                                    </label>
                                                    Module {{ $permissionParentItem->name }}
                                                </div>
                                                <div class="row">
                                                    @foreach ($permissionParentItem->permissionsChildrent as $permissionsChildrentItem)
                                                        <div class="card-body col-md-3">
                                                            <label>
                                                                <input type="checkbox" name="permission_id[]"
                                                                    value="{{ $permissionsChildrentItem->id }}"
                                                                    class="checkbox_childrent">
                                                            </label>
                                                            {{ $permissionsChildrentItem->name }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info">Thêm</button>
                            </form>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    @endsection
