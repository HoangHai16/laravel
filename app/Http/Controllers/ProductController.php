<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;


class ProductController extends Controller
{
    public function add_product()
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id', 'desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product()
    {
        //tạo biến có key là info để lấy dữ liệu
        $result['info'] = DB::table('tbl_product')
            ->leftJoin('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->leftJoin('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->orderby('tbl_product.product_id', 'desc')->get();

        return view('admin.all_product', $result);
    }
    public function save_product(Request $request)
    {
        //Lấy dữ liệu
        $data = array();
        $data['product_name'] = $request->product_name; //Lấy biến name trong db để gán tên của form
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công.');
            return Redirect::to('/add-product');
        } else {
            $data['product_image'] = '';
        }

        //Insert dữ liệu vào CSDL
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công.');
        return Redirect::to('/all-product');
    }
    //truyền tham số id để nó biết id nào để ẩn hoặc hiển thị
    public function unactive_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Ẩn sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function active_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Hiển thị sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with(
            'edit_product',
            $edit_product
        )->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    //Bấm vào nút edit
    public function update_product(Request $request, $product_id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công.');
            return Redirect::to('/all-product');
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function delete_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    // End Admin Page

    public function details_product($product_id)
    {
        $product = Product::findOrFail($product_id);

        $cate_product = DB::table('tbl_category_product')->where('Category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $details_product = DB::table('tbl_product')
            ->leftJoin('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->leftJoin('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get();

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }

        $related_product = DB::table('tbl_product')
            ->leftJoin('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->leftJoin('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->get();

        return view('pages.details.show_details')->with('category', $cate_product)
            ->with('brand', $brand_product)->with('product_details', $details_product)
            ->with('relate', $related_product);
    }
}
