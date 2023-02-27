<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // admin
    //list page
    public function list_admin(){
        $data=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('search_key'),function($search_product){
            $search_product->orWhere('products.name','like','%'.request('search_key').'%');
        })
        ->when(request('category_id'),function($search_product){
            $search_product->where('products.category_id','like','%'.request('category_id').'%');
        })
        ->paginate(10);
        $category=Category::get();
        return view('admin.product.list',compact('data','category'));
    }

    //create page
    public function createProductPage_admin(){
        $category=Category::get();
        return view('admin.product.create_product',compact('category'));
    }

    // createProduct
    public function createProduct_admin(Request $req){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        for ($i=1; $i <4 ; $i++) {
            $imageName=uniqid().$req->file('image'.$i)->getClientOriginalName();
            $req->file('image'.$i)->storeAs('public',$imageName);
            $data['image'.$i]=$imageName;
        }
        Product::create($data);
        return redirect()->route('admin#productList')->with(['createSucc'=>'Product Create Successful']);
    }

    // viewProduct
    public function viewProduct_admin($id){
        $data=Product::where('products.id',$id)
        ->select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->first();
        return view('admin.product.viewProduct',compact('data'));
    }

    // edit Product
    public function editProduct_admin($id){
        $product=Product::where('id',$id)->first();
        $category=Category::get();
        return view('admin.product.edit_product',compact('category','product'));
    }

    // update Product
    public function updateProduct_admin(Request $req,$id){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        for ($i=1; $i < 4; $i++) {
            if ($req->hasFile('image'.$i)) {
                $image='image'.$i;
                $dbImage=Product::where('id',$id)->first()->$image;
                Storage::delete('public/'.$dbImage);
                $imageName=uniqid().$req->file('image'.$i)->getClientOriginalName();
                $req->file('image'.$i)->storeAs('public',$imageName);
                $data['image'.$i]=$imageName;
            };
        };
        Product::where('id',$id)->update($data);
        return redirect()->route('admin#viewProduct',$id)->with(['productUpdate'=>'Product Update Successful']);
    }

    // delete Product
    public function deleteProduct_admin($id){
        for ($i=1; $i < 4; $i++) {
            $image='image'.$i;
            $dbImage=Product::where('id',$id)->first()->$image;
            Storage::delete('public/'.$dbImage);
        };
        Product::where('id',$id)->delete();
        return redirect()->route('admin#productList')->with(['deleteSucc'=>'Product Delete Successful']);
    }


    // user
    //list page
    public function list_user(){
        $data=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('search_key'),function($search_product){
            $search_product->orWhere('products.name','like','%'.request('search_key').'%');
        })
        ->when(request('category_id'),function($search_product){
            $search_product->where('products.category_id','like','%'.request('category_id').'%');
        })
        ->paginate(10);
        $category=Category::get();
        return view('user.product.list',compact('data','category'));
    }

    //create page
    public function createProductPage_user(){
        $category=Category::get();
        return view('user.product.create_product',compact('category'));
    }

    // createProduct
    public function createProduct_user(Request $req){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        for ($i=1; $i <4 ; $i++) {
            $imageName=uniqid().$req->file('image'.$i)->getClientOriginalName();
            $req->file('image'.$i)->storeAs('public',$imageName);
            $data['image'.$i]=$imageName;
        }
        Product::create($data);
        return redirect()->route('user#productList')->with(['createSucc'=>'Product Create Successful']);
    }

    // viewProduct
    public function viewProduct_user($id){
        $data=Product::where('products.id',$id)
        ->select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->first();
        return view('user.product.viewProduct',compact('data'));
    }

    // edit Product
    public function editProduct_user($id){
        $product=Product::where('id',$id)->first();
        $category=Category::get();
        return view('user.product.edit_product',compact('category','product'));
    }

    // update Product
    public function updateProduct_user(Request $req,$id){
        $this->validationCheck($req);
        $data=$this->changeData($req);
        for ($i=1; $i < 4; $i++) {
            if ($req->hasFile('image'.$i)) {
                $image='image'.$i;
                $dbImage=Product::where('id',$id)->first()->$image;
                Storage::delete('public/'.$dbImage);
                $imageName=uniqid().$req->file('image'.$i)->getClientOriginalName();
                $req->file('image'.$i)->storeAs('public',$imageName);
                $data['image'.$i]=$imageName;
            };
        };
        Product::where('id',$id)->update($data);
        return redirect()->route('user#viewProduct',$id)->with(['productUpdate'=>'Product Update Successful']);
    }

    // delete Product
    public function deleteProduct_user($id){
        for ($i=1; $i < 4; $i++) {
            $image='image'.$i;
            $dbImage=Product::where('id',$id)->first()->$image;
            Storage::delete('public/'.$dbImage);
        };
        Product::where('id',$id)->delete();
        return redirect()->route('user#productList')->with(['deleteSucc'=>'Product Delete Successful']);
    }


    //customer
    //list
    public function list_customer(){
        $data=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('search_key'),function($search_product){
            $search_product->where('products.name','like','%'.request('search_key').'%');
        })
        ->when(request('category_id'),function($search_product){
            $search_product->where('products.category_id','like','%'.request('category_id').'%');
        })
        ->orderBy('view','desc')->paginate(10);
        $category=Category::get();
        return view('customer.product.list',compact('data','category'));
    }

    // viewProduct
    public function viewProduct_customer($id){
        $view_count=Product::where('id',$id)->first()->view+1;
        Product::where('id',$id)->update(['view'=>$view_count]);
        $data=Product::where('products.id',$id)
        ->select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->first();
        return view('customer.product.viewProduct',compact('data'));
    }

    // private function

    // validation check
    private function validationCheck($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'category'=>'required',
            'description'=>'required',
            'price'=>'required',
        ])->validate();
    }

    // ChangeData
    private function changeData($req){
        return [
            'name'=>$req->name,
            'category_id'=>$req->category,
            'description'=>$req->description,
            'price'=>$req->price,
        ];
    }

    private function add_image(){
        for ($i=1; $i < 4; $i++) {
            logger('hello'.$i);
        }
    }
}
