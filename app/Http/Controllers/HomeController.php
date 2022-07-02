<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
// 

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('Category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();
// dd($all_product);
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    public function search(Request $request){
        $keywords = $request->keyword_submit;
        $cate_product = DB::table('tbl_category_product')->where('Category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->limit(4)->get();
        return view('pages.details.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}
