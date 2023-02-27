<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // admin
    // list page
    public function list_admin(){
        $data=Category::when(request('search_key'),function($search_product){
            $search_product->where('name','like','%'.request('search_key').'%');
        })
        ->paginate(10);
        return view('admin.category.list',compact('data'));
    }

    // add Category page
    public function addCategoryPage_admin(){
        return view('admin.category.addCategory');
    }

    // add Category function
    public function addCategory_admin(Request $req){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        Category::create($data);
        return redirect()->route('admin#categoryList')->with(['createSucc'=>'Category create successful']);
    }

    // edit Category page
    public function editCategory_admin($id){
        $data=Category::where('id',$id)->first();
        return view('admin.category.editCategory',compact('data'));
    }

    //update Category
    public function updateCategory_admin(Request $req,$id){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        Category::where('id',$id)->update($data);
        return redirect()->route('admin#categoryList')->with(['updateSucc'=>'Category update successful']);
    }

    //delete Category
    public function deleteCategory_admin($id){
        Category::where('id',$id)->delete();
        return redirect()->route('admin#categoryList')->with(['deleteSucc'=>'Category delete successful']);
    }




    //user
    // list page
    public function list_user(){
        $data=Category::when(request('search_key'),function($search_product){
            $search_product->where('name','like','%'.request('search_key').'%');
        })->paginate(10);
        return view('user.category.list',compact('data'));
    }

    // add Category page
    public function addCategoryPage_user(){
        return view('user.category.addCategory');
    }

    // add Category function
    public function addCategory_user(Request $req){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        Category::create($data);
        return redirect()->route('user#categoryList')->with(['createSucc'=>'Category create successful']);
    }

    // edit Category page
    public function editCategory_user($id){
        $data=Category::where('id',$id)->first();
        return view('user.category.editCategory',compact('data'));
    }

    //update Category
    public function updateCategory_user(Request $req,$id){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        Category::where('id',$id)->update($data);
        return redirect()->route('user#categoryList')->with(['updateSucc'=>'Category update successful']);
    }

    //delete Category
    public function deleteCategory_user($id){
        Category::where('id',$id)->delete();
        return redirect()->route('user#categoryList')->with(['deleteSucc'=>'Category delete successful']);
    }


    // private function

    // validation Check function
    private function validationCheck($req){
        Validator::make($req->all(),[
            'name'=>'required'
        ])->validate();
    }

    //change data
    private function changeData($req){
        return [
            'name'=>$req->name,
        ];
    }



}
