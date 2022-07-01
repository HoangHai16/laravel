<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
Session_start();

class BrandProduct extends Controller
{
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        //tạo biến có key là info để lấy dữ liệu
        $result['info'] = DB::table('tbl_brand_product')->get()->toArray();

        return view('admin.all_brand_product',$result);
    }
    public function save_brand_product(Request $request){
        //Lấy dữ liệu
        $data = array();
        $data['brand_name'] = $request->brand_product_name;//Lấy biến name trong db để gán tên của form
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        //Insert dữ liệu vào CSDL
        DB::table('tbl_brand_product')->insert($data);
        Session::put('message','Thêm thương hiệu thành công.');
        return Redirect::to('/add-brand-product');
    }
    //truyền tham số id để nó biết id nào để ẩn hoặc hiển thị
    public function unactive_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Ẩn thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Hiển thị thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }

    public function edit_brand_product($brand_product_id){
        $edit_brand_product['info'] = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        return view('admin.edit_brand_product',$edit_brand_product);
    }
    //Bấm vào nút edit
    public function update_brand_product(Request $request, $brand_product_id){

        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('/all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    // End Admin page
    public function show_brand_home($brand_id){
        $cate_product = DB::table('tbl_category_product')->where('Category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.brand_id',$brand_id)->get();

        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$brand_id)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}
