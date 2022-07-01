<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use DB;



class CheckoutController extends Controller
{

    public function login_checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('Category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_customer(Request $request)
    {
        $data = array();

        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_address'] = $request->customer_address;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('Category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function save_checkout_customer(Request $request)
    {
        $auth_id = session()->get('customer_id', 1);
        $validatedData = $request->validate([
            'shipping_name' => ['required'],
            'shipping_email' => ['required', 'email'],
            'shipping_phone' => ['required'],
            'shipping_notes' => ['required'],
            'shipping_address' => ['required'],
        ]);

        $data = [];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;

        // $data['customer_id'] = $request->get('customer_id', 1);



        $data['customer_id'] = $auth_id;

        // orm eloquent
        $shipping = new Shipping();
        $shipping->insert($data);



        //query builder
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }
    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('Category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function order_place(Request $request)
    {
        // insert payment method
        // dd(session()->all());
        $data = array();
        $data['payment_method'] = $request->get('payment_option', Payment::METHOD_COD);
        $data['payment_status'] = Payment::STATUS_ACTIVE;
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        // Insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::totalFloat();


        $order_data['order_status'] = Order::ORDER_STATUS_DANG_CHO_XU_LY;
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        // Insert order details
        $content = Cart::content();
        foreach ($content as $item) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
            Product::find($v_content->id)->decrement('quantity', $v_content->qty);
        }

        if ($data['payment_method'] == Payment::METHOD_ATM) {
            session('order_status', 'Thanh toán bằng ATM');
        } else {
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('Category_status', '0')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
            return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
        }

        // return Redirect::to('/payment');
    }

    public function logout_checkout()
    {
        Session::flush();

        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);

        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        }

        return back()->with([
            'message' => 'Đăng nhập thất bại.',
            'old_username' => $email,
            'old_password' => $request->password_account,
        ]);
    }


    // Quan ly don hang

    public function manager_order()
    {

        $result['info'] = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name')
            ->orderby('tbl_order.order_id', 'desc')->get();

        return view('admin.manager_order', $result);
    }

    public function view_order($orderId)
    {

        $order_by_id['info'] = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*', 'tbl_order_details.*')->first();

        return view('admin.view_order', $order_by_id);
    }
    public function delete_order($orderId)
    {
        // DB::table('tbl_order')->where('order_id',$orderId)->delete();
        // DB::table('tbl_order')
        // ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')
        // ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')
        // ->select('tbl_order.*','tbl_order_details.*','tbl_payment.*')->get();

        // Session::put('message','Xóa đơn hàng thành công');
        return Redirect::to('/manager-order');
    }
}
