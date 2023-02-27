<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    //admin
    //list
    public function list_admin(){
        if (request('sent_message')) {
            $data=Message::where('email',Auth::user()->email)->paginate(10);
        }else{
            $data=Message::where('user_id',Auth::user()->id)->paginate(10);
        }
        return view('admin.message.list',compact('data'));
    }

    // sendPage
    public function sendPage_admin(){
        if (request('reply_message')) {
            $users=User::where('email',request('reply_message'))->get();
        }else{
            $users=User::get();
        }
        // dd($users->toArray());
        return view('admin.message.sendPage',compact('users'));
    }

    //send
    public function send_admin(Request $req){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        Message::create($data);
        return redirect()->route('admin#messageList')->with(['sendSucc'=>'Message send successful']);
    }

    // viewMessage
    public function viewMessage_admin($id,$user_id){
        if ($user_id==Auth::user()->id) {
            $status=Message::where('id',$id)->first()->status;
            if ($status==0) {
                Message::where('id',$id)->update(['status'=>1]);
                return redirect()->route('admin#viewMessage',[$id,$user_id]);
            }
        }
        $data=Message::where('messages.id',$id)
        ->select('messages.*','users.email as user_email')
        ->leftJoin('users','messages.user_id','users.id')
        ->first();
        return view('admin.message.view',compact('data'));
    }

    // deleteMessage
    public function deleteMessage_admin($id){
        Message::where('id',$id)->delete();
        return back()->with(['deleteSucc'=>'Message delete successful']);
    }


    //user
     //list
     public function list_user(){
        if (request('sent_message')) {
            $data=Message::where('email',Auth::user()->email)->paginate(10);
        }else{
            $data=Message::where('user_id',Auth::user()->id)->paginate(10);
        }
        return view('user.message.list',compact('data'));
    }

    // sendPage
    public function sendPage_user(){
        if (request('reply_message')) {
            $users=User::where('email',request('reply_message'))->get();
        }else{
            $users=User::get();
        }
        // dd($users->toArray());
        return view('user.message.sendPage',compact('users'));
    }

    //send
    public function send_user(Request $req){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        Message::create($data);
        return redirect()->route('user#messageList')->with(['sendSucc'=>'Message send successful']);
    }

    // viewMessage
    public function viewMessage_user($id,$user_id){
        if ($user_id==Auth::user()->id) {
            $status=Message::where('id',$id)->first()->status;
            if ($status==0) {
                Message::where('id',$id)->update(['status'=>1]);
                return redirect()->route('user#viewMessage',[$id,$user_id]);
            }
        }
        $data=Message::where('messages.id',$id)
        ->select('messages.*','users.email as user_email')
        ->leftJoin('users','messages.user_id','users.id')
        ->first();
        return view('user.message.view',compact('data'));
    }

    // deleteMessage
    public function deleteMessage_user($id){
        Message::where('id',$id)->delete();
        return back()->with(['deleteSucc'=>'Message delete successful']);
    }


    //customer
     //list
     public function list_customer(){
        if (request('sent_message')) {
            $data=Message::where('email',Auth::user()->email)->paginate(10);
        }else{
            $data=Message::where('user_id',Auth::user()->id)->paginate(10);
        }
        return view('customer.message.list',compact('data'));
    }

    // sendPage
    public function sendPage_customer(){
        $user=User::where('position','HR')->first();
        // dd($user->toArray());
        return view('customer.message.sendPage',compact('user'));
    }

    //send
    public function send_customer(Request $req){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        Message::create($data);
        return redirect()->route('customer#home')->with(['sendSucc'=>'Message send successful. We will reply Soon']);
    }

    // viewMessage
    public function viewMessage_customer($id,$user_id){
        if ($user_id==Auth::user()->id) {
            $status=Message::where('id',$id)->first()->status;
            if ($status==0) {
                Message::where('id',$id)->update(['status'=>1]);
                return redirect()->route('customer#viewMessage',[$id,$user_id]);
            }
        }
        $data=Message::where('messages.id',$id)
        ->select('messages.*','users.email as user_email')
        ->leftJoin('users','messages.user_id','users.id')
        ->first();
        return view('customer.message.view',compact('data'));
    }

    // deleteMessage
    public function deleteMessage_customer($id){
        Message::where('id',$id)->delete();
        return redirect()->route('customer#messageList')->with(['deleteSucc'=>'Message delete successful!!!!!']);
    }


    // private function
    // validationCheck
    private function validationCheck($req){
        Validator::make($req->all(),[
            'user_id'=>'required',
            'title'=>'required',
            'message'=>'required',
            'email'=>'required',
        ])->validate();
    }

    // change data
    private function changeData($req){
        return [
            'user_id'=>$req->user_id,
            'title'=>$req->title,
            'message'=>$req->message,
            'email'=>$req->email,
        ];
    }

}
