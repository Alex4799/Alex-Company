<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // profile page
    public function profile(){
        return view('user.profile.profile');
    }

    // changePasswordPage
    public function changePasswordPage(){
        return view('user.main.changePassword');
    }

    // editProfile
    public function editProfile($id){
        $data=User::where('id',$id)->first();
        return view('user.main.editProfile',compact('data'));
    }

    //admin
    // adminList
    public function adminList(){
        $data=User::where('role','admin')
        ->when(request('search_key'),function($search_product){
            $search_product->where('name','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('user.admin.list',compact('data'));
    }


    // customer

    // customerList
    public function customerList(){
        $data=User::where('role','customer')
        ->when(request('search_key'),function($search_product){
            $search_product->where('name','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('user.customer.list',compact('data'));
    }

    //viewProfile
    public function viewProfile($id){
        $data=User::where('id',$id)->first();
        $totalOrder=Order::where('user_id',$id)->get();
        $orderCount=count($totalOrder);
        return view('user.customer.view',compact('data','orderCount'));
    }

    // deleteCustomer
    public function deleteCustomer($id){
        User::where('id',$id)->delete();
        return redirect()->route('user#customerList')->with(['deleteSucc'=>'Customer Account Delete Successful']);
    }

}


