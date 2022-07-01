<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
Session_start();
//Danh muc san pham


class CategoryProduct extends Controller
{
    public function add_category_product(){
        
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        
        //tạo biến có key là info để lấy dữ liệu
        $result['info'] = DB::table('tbl_category_product')->get()->toArray();

        return view('admin.all_category_product',$result);
    }
    public function save_category_product(Request $request){
        //Lấy dữ liệu
        $data = array();
        $data['category_name'] = $request->category_product_name;//Lấy biến name trong db để gán tên của form
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        //Insert dữ liệu vào CSDL
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục thành công.');
        return Redirect::to('/add-category-product');
    }
    //truyền tham số id để nó biết id nào để ẩn hoặc hiển thị
    public function unactive_category_product($category_product_id){

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Ẩn danh mục thành công');
        return Redirect::to('/all-category-product');
    }
    public function active_category_product($category_product_id){

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Hiển thị danh mục thành công');
        return Redirect::to('/all-category-product');
    }

    public function edit_category_product($category_product_id){

        $edit_category_product['info'] = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        return view('admin.edit_category_product',$edit_category_product);
    }
    //Bấm vào nút edit
    public function update_category_product(Request $request, $category_product_id){

        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('/all-category-product');
    }
    public function delete_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    // End Admin Page

    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_product')->where('Category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_product.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
}
