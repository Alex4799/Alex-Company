<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\EnrollmentList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{
    //enrollments list
    public function list(){
        $data=Enrollment::when(request('search_key'),function($search_product){
            $search_product->where('enrollment_id','like','%'.request('search_key').'%');
        })->paginate(10);
        $status=$this->getStatus();
        return view('admin.enrollments.enrollment_list',compact('data','status'));
    }

    //enrollments start
    public function start(){
        User::where('id','1')->update(['enrollments_status'=> 1]);
        return redirect()->route('admin#enrollmentList');
    }

    //enrollments end
    public function end(){
        $data=User::where('role','user')->get();
        foreach($data as $p){
            $enrollmentData=$this->changeData($p);
            EnrollmentList::create($enrollmentData);
            User::where('id',$p->id)->update(['enrollments_status'=> 0]);
        }
        Enrollment::create(['enrollment_id'=>date('d-m-o-i')]);
        User::where('id','1')->update(['enrollments_status'=> 0]);
        return redirect()->route('admin#enrollmentList');
    }

    //enrollment list page
    public function enrollments($id){
        $data=EnrollmentList::select('enrollment_lists.*','users.name as user_name')
        ->leftJoin('users','enrollment_lists.user_id','users.id')
        ->where('enrollment_id',$id)->paginate(10);
        return view('admin.enrollments.enrollment',compact('data','id'));
    }

    //delete enrollment
    public function delete($id){
        if (Auth::user()->id==1) {
            Enrollment::where('id',$id)->delete();
            return redirect()->route('admin#enrollmentList')->with(['deleteSucc'=>'Enrollments delete Successful']);
        }else{
            return redirect()->route('admin#enrollmentList')->with(['deleteFail'=>"You don't have permession"]);
        }
    }

    // user

    // userEnrollmentPage
    public function userEnrollmentPage(){
        return view('user.enrollment.enrollmentPage');
    }

    // userEnrollment
    public function userEnrollment(Request $req){
        Validator::make($req->all(),[
            'password'=>'required',
        ])->validate();
        $password=User::where('id',Auth::user()->id)->first()->password;
        if (Hash::check($req->password, $password)) {
           User::where('id',Auth::user()->id)->update(['enrollments_status'=>1]);
           return redirect()->route('user#profile')->with(['EnrollmentSuccess'=>'Enrollments Successful']);
        }
        return back()->with(['failPass'=>'Worng Password']);

    }

    // private function
        // get status
        private function getStatus(){
            return User::where('id',1)->select('enrollments_status')->first()->enrollments_status;
        }

        // change Data
        private function changeData($data){
            return[
                'enrollment_id'=>date('d-m-o-i'),
                'user_id'=>$data->id,
                'status'=>$data->enrollments_status,
            ];
        }

}

