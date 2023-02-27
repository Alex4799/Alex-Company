<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    // public function

        // admin

    //work list page
    public function list(){
        $work=Work::get();
        foreach ($work as $item) {
            if ($item->status==0) {
                $deadline=$item->deadline;
                $created_at=$item->created_at;
                $current_time=Carbon::now();
                $check=$current_time->between($created_at,$deadline,true);
                if (!$check) {
                    Work::where('id',$item->id)->update(['status'=>2]);
                }
            }
        }
       $data=Work::select('works.*','users.name as user_name')
            ->leftjoin('users','works.user_id','users.id')
            ->when(request('search_key'),function($search_product){
                $search_product->orWhere('works.task_id','like','%'.request('search_key').'%')
                               ->orWhere('users.name','like','%'.request('search_key').'%');
            })
            ->paginate(10);

       return view('admin.work.list',compact('data'));
    }

    //work create page
    public function createWorkPage(){
        $users=User::where('role','user')->get();
        return view('admin.work.create',compact('users'));
    }

    //work create function
    public function createWork(Request $req){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        $data['task_id']='WID-'.date('d-m-o-i');
        Work::create($data);
        return redirect()->route('admin#workList')->with(['createSucc' => 'Work send successful']);
    }

    //work view page
    public function viewPage($id){
        $work=Work::select('works.*','users.name as user_name')
            ->leftjoin('users','works.user_id','users.id')
            ->where('works.id',$id)
            ->first();

       return view('admin.work.view',compact('work','id'));
    }

    //work edit page function
    public function editPage($id){
        $work=Work::where('id',$id)->first();
        $users=User::where('role','user')->get();
        return view('admin.work.edit',compact('work','users'));
    }

    //work Update function
    public function workUpdate(Request $req,$id){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        $data['status']=$req->status;
        Work::where('id',$id)->update($data);
        return redirect()->route('admin#workViewPage',$id)->with(['updateSucc'=>'Work Update Successful']);
    }

    //work Delete function
    public function workDelete($id){
        Work::where('id',$id)->delete();
        return redirect()->route('admin#workList')->with(['deleteSucc' => 'Work delete successful']);

    }

    // user
    // work list page
    public function workList(){
        $data=Work::where('user_id',Auth::user()->id)
        ->when(request('search_key'),function($search_product){
            $search_product->where('task_id','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('user.work.list',compact('data'));
    }

    // view Work
    public function viewWork($id){
        $work=Work::where('id',$id)->first();
        return view('user.work.viewWork',compact('work','id'));
    }

    // doneWork
    public function doneWork($id){
        Work::where('id',$id)->update(['status'=>1]);
        return redirect()->route('user#workList');
    }



    // private function
    //validation check
    private function validationCheck($req){
        Validator::make($req->all(),[
            'user_id'=>'required',
            'work'=>'required',
            'deadline'=>'required'
        ])->validate();
    }

    //create data array form
    private function changeData($req){
        return [
            'user_id'=>$req->user_id,
            'work'=>$req->work,
            'deadline'=>$req->deadline,
        ];
    }
}
