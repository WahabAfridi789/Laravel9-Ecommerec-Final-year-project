<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;
use App\Models\order;
use App\Models\user;
use App\HTTP\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
;


class AdminController extends Controller
{
    //

    public function admin_dashboard(){
        $user = Auth::user();
        $order = order::all();
        return view('admin.home',compact('order','user'));
    }

    public function category(){
        $data = category::all();

    return view('admin.category',compact('data'));
}

    public function add_category(Request $request  )
    {

        $category = new category;
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->back()->with('message','Category Added Successfully');
    }

    public function delete_category($id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }

    public function view_product()

    {

        $category = category::all();
        return view('admin.product',compact('category'));
    }

    public function add_product(Request $request) {

        $product = new product;
        $product->title= $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount_price;
        $product->category = $request->category;
        $image = $request->image;
        $imagename= time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image = $imagename;
        $product->save();
        return redirect()->back()->with('message','Product Added Successfully');
    }

    public function show_product(){

        $product = product::all();
        return view('admin.show_product',compact('product'));
    }

    public function delete_product($id)
    {
        $data = product::find($id);
        $data->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');
    }

    public function edit_product($id)
    {
        $product = product::find($id);
        $category = category::all();
        return view('admin.edit_product',compact('product','category'));
    }

    public function update_product_confirm(Request $request,$id)
    {
        $product = product::find($id);
        $product->title= $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount_price;
        $product->category = $request->category;


        $image = $request->image;

        if($image){
        $imagename= time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image = $imagename;
        }
        $product->save();
        return redirect()->back()->with('message','Product Updated Successfully');

}

    public function pending_order(){
        //get order where delivery status is Delivered
        $order = order::where('delivery_status','processing')->get();
        return view('admin.pending_order',compact('order'));
    }

    public function delivered_orders(){
        //get order where delivery status is Delivered
        $order = order::where('delivery_status','Delivered')->get();
        return view('admin.delivered_orders',compact('order'));
    }

    public function delivered_order($id){
        $order = order::find($id);
        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back()->with('message','Order Delivered Successfully');
    }

    public function search(Request $request)
{
    $output = '';

    $order = Order::where('user_name','LIKE','%'.$request->value."%")->orWhere('user_email','LIKE','%'.$request->value."%")->orWhere('user_phone','LIKE','%'.$request->value."%")->orWhere('user_address','LIKE','%'.$request->value."%")->orWhere('payment_status','LIKE','%'.$request->value."%")->orWhere('delivery_status','LIKE','%'.$request->value."%")
    ->get();



    foreach($order as $data){
        $output.='<tr>
        <td>'.$data->user_name.'</td>
        <td>'.$data->user_email.'</td>
        <td>'.$data->user_address.'</td>
        <td>'.$data->user_phone.'</td>
        <td>'.$data->product_quantity.'</td>
        <td>'.$data->product_title.'</td>
        <td>'.$data->product_price.'</td>
        <td > <label class="badge badge-outline-success" >'.$data->payment_status.' </label> </td>';
        if($data->delivery_status == 'Delivered'){
            $output.='<td><label class="badge badge-outline-success">Delivered</label></td>';
        }else{
            $output.='<td><label class="badge badge-outline-success">Processing</label></td>';
        }

        $output.='
        <td><img src="product/'.$data->product_image.'" width="100px" height="100px"></td>';



        if($data->delivery_status == 'Delivered'){
            $output.='<td><label class="badge badge-outline-success">Delivered</label></td>';
        }else{
            //show delivered button with action to confirm delivery
            $output.='<td><a href="delivered_order/'.$data->id.'" class="btn btn-danger">Delivered</a></td></tr>';
        }
    }

    return response($output);

}
}

