<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Message;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{

    //admin
    // orderHistory
    public function orderHistory_admin(){
        $data=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->when(request('search_key'),function($search_product){
            $search_product->orWhere('orders.order_id','like','%'.request('search_key').'%')
                           ->orWhere('users.name','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('admin.order.order',compact('data'));
    }

    // orderList
    public function orderList_admin($order_id){
        $data=OrderList::where('order_id',$order_id)
        ->select('order_lists.*','products.name as product_name','products.image1 as product_image','products.price as product_price')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->paginate(10);
        return view('admin.order.orderList',compact('data'));
    }

    //change order status
    public function changeStatus_admin($id,$status){
        Order::where('id',$id)->update(['status'=>$status]);
        if($status!=0){
            $order=Order::select('orders.*','users.name as user_name')
            ->where('orders.id',$id)
            ->leftJoin('users','orders.user_id','users.id')
            ->first();
            $data=$this->sendMessage($order->user_name,$order->user_id,$status,$order->order_id);
            Message::create($data);
        }
        return back();
    }

    // orderDelete
    public function orderDelete_admin($id){
        Order::where('id',$id)->delete();
        return redirect()->route('admin#orderHistory')->with(['DeleteSucc'=>'Order History Delete Successful']);
    }



    // user
    // orderHistory
    public function orderHistory_user(){
        $data=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->when(request('search_key'),function($search_product){
            $search_product->orWhere('orders.order_id','like','%'.request('search_key').'%')
                           ->orWhere('users.name','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('user.order.order',compact('data'));
    }

    // orderList
    public function orderList_user($order_id){
        $data=OrderList::where('order_id',$order_id)
        ->select('order_lists.*','products.name as product_name','products.image1 as product_image','products.price as product_price')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->paginate(10);
        return view('user.order.orderList',compact('data'));
    }

    //change order status
    public function changeStatus_user($id,$status){
        Order::where('id',$id)->update(['status'=>$status]);
        if($status!=0){
            $order=Order::select('orders.*','users.name as user_name')
            ->where('orders.id',$id)
            ->leftJoin('users','orders.user_id','users.id')
            ->first();
            $data=$this->sendMessage($order->user_name,$order->user_id,$status,$order->order_id);
            Message::create($data);
        }
        return back();
    }

    // orderDelete
    public function orderDelete_user($id){
        Order::where('id',$id)->delete();
        return redirect()->route('user#orderHistory')->with(['DeleteSucc'=>'Order History Delete Successful']);
    }

    //customer

    // add Order
    public function addOrder(Request $req){
        if (Hash::check($req->password, Auth::user()->password)) {
            $orderData=[];

            for ($i=0; $i < count($req->all()); $i++) {
                if (gettype($req[$i])=='array') {
                    $orderData[$i]=$req[$i];
                }
            }

            $totalPrice=3000;

            foreach($orderData as $item){
                $data=$this->changeData($item);
                OrderList::create($data);
                $totalPrice += $item['total'];

            }

            Order::create([
                'user_id'=>Auth::user()->id,
                'order_id'=>$data['order_id'],
                'total_price'=>$totalPrice,
            ]);
            Cart::where('user_id',Auth::user()->id)->delete();
            return response()->json([
                'status'=>'true',
                'message'=>'Order Successful'
            ], 200);

        }else {
            return response()->json([
                'status'=>'false',
                'message'=>'Worng Password'
            ], 200);
        }

    }

    //order history
    public function orderHistory_customer(){
        $data=Order::where('user_id',Auth::user()->id)->get();
        return view('customer.order.orderHistory',compact('data'));
    }

    // orderList
    public function orderList_customer($order_id){
        $data=OrderList::where('order_id',$order_id)
        ->select('order_lists.*','products.name as product_name','products.image1 as product_image','products.price as product_price')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->get();
        return view('customer.order.orderlist',compact('data'));
    }

    // orderDelete
    public function orderDelete_customer($id){
        Order::where('id',$id)->delete();
        return redirect()->route('customer#orderHistory')->with(['DeleteSucc'=>'Order History Delete Successful']);
    }

    // private function
    //change data
    private function changeData($item){
        return [
            'user_id'=>$item['user_id'],
            'product_id'=>$item['product_id'],
            'qty'=>$item['qty'],
            'total'=>$item['total'],
            'order_id'=>$item['order_id'],
        ];
    }

    //send order message
    private function sendMessage($user_name,$user_id,$status,$order_id){
        if($status==1){
            return [
                'user_id'=>$user_id,
                'title'=>'Order Confirm',
                'message'=>'Hello '.$user_name.'. Your order '.$order_id.' is confirm. We sent your order now.',
                'email'=>'user@gmail.com',
            ];
        }else{
            return [
                'user_id'=>$user_id,
                'title'=>'Order Cancel',
                'message'=>'Hello '.$user_name.'. Your order '.$order_id.' is cancel. We will be sent mail soon.',
                'email'=>'user@gmail.com',
            ];
        }
    }
}
