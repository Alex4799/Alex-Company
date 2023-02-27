<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // profile
    public function profile(){
        return view('customer.profile.profile');
    }

    // profileEdit
    public function profileEdit(){
        return view('customer.profile.edit');
    }

    //change Password page
    public function changePasswordPage(){
        return view('customer.profile.changePassword');
    }

    //update function
    public function update_customer(Request $req,$id){
        $this->profileValidation($req);
        $data=$this->getData($req);
        if ($req->hasFile('image')) {
            $dbImage=User::where('id',$id)->first()->image;
            if ($dbImage!=null) {
                Storage::delete('public/'.$dbImage);
            }
            $imgName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public',$imgName);
            $data['image']=$imgName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('customer#profile')->with(['profileUpdate'=>'User profile update successful']);
    }

    //clear profile picture
    public function clearPP($id){
        $dbImage=User::where('id',$id)->first()->image;
        Storage::delete('public/'.$dbImage);
        User::where('id',$id)->update(['image'=>null]);
        return redirect()->route('customer#profile')->with(['profileUpdate'=>'Clear profile picture successful']);
    }

    //delete account
    public function deleteAcc(){
        $data= [
            'user_id'=>2,
            'title'=>'Delete Account',
            'message'=>'Delete account pending.',
            'email'=>Auth::user()->email,
        ];
        Message::create($data);
        Session::flush();

        return redirect('login');
    }

    // private function
    //profile validation check
    private function profileValidation($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'role'=>'required',
        ])->validate();
    }

    //get data
    private function getData($req){
        return[
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address,
            'gender'=>$req->gender,
            'position'=>$req->position,
            'role'=>$req->role,
        ];
    }
}
