<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use App\Models\payment;
use App\Models\bookrecord;

use Session;
use Stripe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    //

     public function index(){

        $product = Product::paginate(6);

        return view('home.userpage',compact('product'));
    }

    public function redirect(){
        $usertype = Auth::user()->usertype;
        if($usertype == '1'){
            return view('admin.home');
        }else{
             $product = Product::paginate(6);
        return view('home.userpage',compact('product'));
        }
    }

    public function about(){
        return view('home.about');
}

public function testimonial(){
    return view('home.testimonial');
}

public function products(){

        $product = Product::paginate(8);
        return view('home.productsPage',compact('product'));
}

public function product_details($id){
    $product = Product::find($id);
    return view('home.product_details',compact('product'));
}

public function add_cart(Request $request,$id){


   if (Auth::id()) {
    $user = Auth::user();
    $product= Product::find($id);
    $product->quantity =  $product->quantity - $request->quantity;

    //if product already exists in cart then increase the quantity
    $cart = Cart::where('user_id',$user->id)->where('product_id',$product->id)->first();
    if($cart){
        $cart->product_quantity = $cart->product_quantity + $request->quantity;
        $cart->save();
         $product->save();
        Alert::success('Product Added Successfully!', 'We have added your product to your cart!');
        return redirect()->back();
    }

    //if product does not exist in cart then add to cart with quantity

    else {

        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->user_name = $user->name;
        $cart->user_email = $user->email;
        $cart->user_phone = $user->phone;
        $cart->user_address = $user->address;
        $total_Price = $product->price ;
        $total_discount_price = $product->discount * $request->quantity;
        $cart->product_title = $product->title;
        if ($product->discount!= 0){
            $cart->product_price =  $total_discount_price;
        }
        else{
            $cart->product_price = $total_Price;
        }
        $cart->product_image = $product->image;
        $cart->product_id = $product->id;
        $cart->product_quantity = $request->quantity;
        $cart->save();
        $product->save();
        Alert::success('Product Added Successfully!', 'We have added your product to your cart!');
        return redirect()->back();
    }


   }
   else {
    return redirect('login');
    }

    // $product = Product::find($id);
    // return view('home.add_cart',compact('product'));
}

public function show_cart(){

    if (Auth::id()) {
        $user = Auth::user();
        $cart = Cart::where('user_id',$user->id)->get();
        return view('home.show_cart',compact('cart'));
    }
    else {
        return redirect('login');
    }
}

public function delete_from_cart($id){
    $cart = Cart::find($id);
    $cart->delete();
    return redirect()->back();
}

public function fetch_cart_data(){
    $user = Auth::user();
    $cart = Cart::where('user_id',$user->id)->get();

    $isCartEmpty = 0;
    if(count($cart) > 0){
        $isCartEmpty = 1;
    }

    $output = '';
    $total = 0;
    foreach($cart as $cartItem){
        $total = $total + $cartItem->product_price*$cartItem->product_quantity;
        $output.='<tr>
        <td class="product-name">'.$cartItem->product_title.'</td>
        <td class="product_image"><img src="'.asset('product/'.$cartItem->product_image).'" alt="product image" width="100px" height="100px"></td>
        <td class="product-price-cart"><span class="amount">$'.$cartItem->product_price.'</span></td>
        <td>'.$cartItem->product_quantity.'</td>
        <td class="product-subtotal">$'.$cartItem->product_price*$cartItem->product_quantity.'</td>
        <td class="product-remove"><a class="btn btn-danger deletefromcart"  id="'.$cartItem->id.'" "><i class="fa fa-trash"></i></a></td>

    </tr>'
    ;
    }

    if ($isCartEmpty == 0) {
        $output.='<tr>
        <td colspan="6"  class="text-center">No Product in Cart</td>
        </tr>'
        ;
        $output.='<tr>

                <td colspan="6" class="text-center">
                    <a href="'.url('products').'" style="background:#f7444e;
                    border:none"  class="btn btn-primary">Shop Now</a>
                </td>';

    }

    else{
 $output.='<tr style="background:#f7444e;">
    <td colspan="4"  class="product-name">Total</td>

    <td></td>
     <td class="product-price-cart"><span class="amount">$'.$total.'</span></td>
      </tr>';
    }






    return response($output);
}

public function checkout(){

        $user = Auth::user();
        $cart = Cart::where('user_id',$user->id)->get();


        foreach($cart as $cartItem){
            $order = new Order;
            $order->user_id = $cartItem->user_id;
            $order->user_name = $cartItem->user_name;
            $order->user_email = $cartItem->user_email;
            $order->user_phone = $cartItem->user_phone;
            $order->user_address = $cartItem->user_address;

            $order->product_title = $cartItem->product_title;
            $order->product_price = $cartItem->product_price;
            $order->product_quantity = $cartItem->product_quantity;
            $order->product_image = $cartItem->product_image;
            $order->product_id = $cartItem->product_id;

            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';

            $order->save();

            $cart= Cart::where('user_id',$user->id)->delete();
        }
        Alert::success('We have received your order!', 'Thankyou for shopping!');
    return redirect()->back();
}

public function stripe($total_items_price){


    return view('home.stripe',compact('total_items_price'));
}


public function stripePost(Request $request, $total_items_price)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


        Stripe\Charge::create ([

                "amount" => $total_items_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thankyou for payment."
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id',$user->id)->get();


        foreach($cart as $cartItem){

            $payment = new Payment;
            $order = new Order;
            $order->user_id = $cartItem->user_id;
            $order->user_name = $cartItem->user_name;
            $order->user_email = $cartItem->user_email;
            $order->user_phone = $cartItem->user_phone;
            $order->user_address = $cartItem->user_address;

            $order->product_title = $cartItem->product_title;
            $order->product_price = $cartItem->product_price;
            $order->product_quantity = $cartItem->product_quantity;
            $order->product_image = $cartItem->product_image;
            $order->product_id = $cartItem->product_id;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';

            $payment->total_amount = $cartItem->product_price*$cartItem->product_quantity;

            $payment->save();

            $order->save();
            $cart= Cart::where('user_id',$user->id)->delete();
        }



        Session::flash('success', 'Payment successful!');
        Alert::success('Payment Successful', 'Thankyou for shopping!');
        return redirect('/');
    }





public function delete_from_cart_ajax(Request $request,$id){
    $cart = Cart::find($id);
    $cart->delete();
    return response()->json(['success'=>'Product Deleted Successfully']);
}


public function blog(){
    return view('home.blog');
}

public function contact(){
    return view('home.contact');
}

public function category(){
    return view('admin.category');
}




}
