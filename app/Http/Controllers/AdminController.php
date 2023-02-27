<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\EnrollmentList;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // profile page
    public function profile(){
        return view('admin.profile.profile');
    }


    // view Profile
    public function viewProfile($id){
        $data=User::where('id',$id)->first();
        return view('admin.main.viewProfile',compact('data'));
    }

    // change Password Page
    public function changePasswordPage(){
        return view('admin.main.changePassword');
    }

    //Edit page
    public function edit($id){
        $data=User::where('id',$id)->first();
        return view('admin.profile.edit',compact('data'));
    }

    // user
    // user list
    public function userList(){
        $data=User::where('role','user')->when(request('search_key'),function($search_product){
            $search_product->where('name','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('admin.user.list',compact('data'));
    }

    //add User Page
    public function addUserPage(){
        return view('admin.user.addUser');
    }

    // add User function
    public function addUser(Request $req){
        $this->addAccount($req);
        return redirect()->route('admin#userList')->with(['createSucc'=>'User account create successful']);
    }

    // edit User
    public function editUser($id){
        $data=User::where('id',$id)->first();
        return view('admin.user.editUser',compact('data'));
    }

    //update User
    public function updateUser(Request $req,$id){
        $this->profileUpdate($id,$req);
        return redirect()->route('admin#userList')->with(['updateSucc'=>'User profile update successful']);
    }

    // delete User
    public function deleteUser($id){
        $user=User::where('id',$id)->first();
        $dbImage=$user->image;
        if ($dbImage!=null) {
            Storage::delete('public/'.$dbImage);
        }
        EnrollmentList::where('user_id',$id)->delete();
        Work::where('user_id',$id)->delete();
        Message::where('user_id',$id)->delete();
        Message::where('email',$user->email)->delete();
        User::where('id',$id)->delete();;
        return redirect()->route('admin#userList')->with(['deleteSucc'=>'User profile delete successful']);
    }

    //admin list
    public function adminList(){
        $data=User::where('role','admin')
        ->when(request('search_key'),function($search_product){
            $search_product->where('name','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('admin.list.adminList',compact('data'));
    }

    // add Admin
    public function addAdminPage(){
        return view('admin.list.addAdmin');
    }

    // add Admin
    public function addAdmin(Request $req){
        $this->addAccount($req);
        return redirect()->route('admin#adminList')->with(['createSucc'=>'User account create successful']);
    }

    // edit Admin
    public function editAdmin($id){
        $data=User::where('id',$id)->first();
        return view('admin.list.editAdmin',compact('data'));
    }

    //update Admin
    public function updateAdmin(Request $req,$id){
        $this->profileUpdate($id,$req);
        return redirect()->route('admin#adminList')->with(['updateSucc'=>'Admin profile update successful']);
    }

    // delete Admin
    public function deleteAdmin($id){
        $dbImage=User::where('id',$id)->first()->image;
        if ($dbImage!=null) {
            Storage::delete('public/'.$dbImage);
        }
        User::where('id',$id)->delete();
        return redirect()->route('admin#adminList')->with(['deleteSucc'=>'Admin profile delete successful']);
    }

    // customer

    // customerList
    public function customerList(){
        $data=User::where('role','customer')->when(request('search_key'),function($search_product){
            $search_product->where('name','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('admin.customer.list',compact('data'));
    }

    // deleteCustomer
    public function deleteCustomer($id){
        $dbImage=User::where('id',$id)->first()->image;
        if ($dbImage!=null) {
            Storage::delete('public/'.$dbImage);
        }
        User::where('id',$id)->delete();
        return redirect()->route('admin#customerList')->with(['deleteSucc'=>'Customer Account Delete Successful']);
    }

    //customer view Profile
    public function viewProfile_customer($id){
        $data=User::where('id',$id)->first();
        $totalOrder=Order::where('user_id',$id)->get();
        $orderCount=count($totalOrder);
        return view('admin.customer.view',compact('data','orderCount'));
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
            'position'=>'required',
            'role'=>'required',
            'NRC'=>'required'
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
            'NRC'=>$req->NRC
        ];
    }

    // add account function
    private function addAccount($req){
        $this->profileValidation($req);
        $data=$this->getData($req);
        if ($req->hasFile('image')) {
            $imgName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public',$imgName);
            $data['image']=$imgName;
        }
        $hashPassword=Hash::make($req->password);
        $data['password']=$hashPassword;
        User::create($data);
    }

    //update profile
    private function profileUpdate($id,$req){
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
    }
}
