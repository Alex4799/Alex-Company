<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
      //loginPage function
      public function loginPage(){
        return view('auth.login');
    }

     //registerPage function
    public function registerPage(){
        return view('auth.register');
    }

    //Auth admin or user
    public function dashboard(){
        if(Auth::user()->role=='admin'){

            return redirect()->route('admin#profile');

        }else if(Auth::user()->role=='user'){

            return redirect()->route('user#profile');

        }else{

            return redirect()->route('customer#home');

        }

    }

        //update function
        public function update(Request $req,$id){
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

            if(Auth::user()->role=='admin'){

                return redirect()->route('admin#profile')->with(['profileUpdate'=>'User profile update successful']);

            }else if(Auth::user()->role=='user'){

                return redirect()->route('user#profile')->with(['profileUpdate'=>'User profile update successful']);

            }else{

                return redirect()->route('customer#profile')->with(['profileUpdate'=>'User profile update successful']);

            }

        }

        // change Password function
        public function changePassword(Request $req){
            $this->passwordValidation($req);
            if (Hash::check($req->oldPassword,Auth::user()->password)) {
                $newPassword=Hash::make($req->newPassword);
                User::where('id',Auth::user()->id)->update([
                    'password'=>$newPassword
                ]);
            if(Auth::user()->role=='admin'){

                return redirect()->route('admin#profile')->with(['successPass'=>'Change Password Successful']);

            }else if(Auth::user()->role=='user'){

                return redirect()->route('user#profile')->with(['successPass'=>'Change Password Successful']);

            }else{

                return redirect()->route('customer#home')->with(['successPass'=>'Change Password Successful']);

            }

            }else{
                return redirect()->route('profile#changePasswordPage')->with(['failPass'=>'Wrong Password. Try again !!!!!!!!!']);
            }
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
                'NRC'=>$req->NRC,
            ];
        }

        //password validation check
        private function passwordValidation($req){
            Validator::make($req->all(),[
                'oldPassword'=>'required|min:6|max:16',
                'newPassword'=>'required|min:6|max:16',
                'comfirmPassword'=>'required|min:6|max:16|same:newPassword',
            ])->validate();
        }



}
