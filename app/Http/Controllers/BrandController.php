<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Validator;
class BrandController extends Controller
{
    //index page
    public function brandindex(){
        $data = Brand::orderBy('id','desc')->get();
        return view('admin.pages.brand.index',compact('data'));
    }

    //create page function
    public function brand_add() {

        return view('admin.pages.brand.create');
    }
    //store function of brand
    public function brand_store(Request $request) {
        $request->validate([
            'brand_name' => 'string|required',
            'photo' => 'nullable',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageUrl = $image->store('brand_gallery', 'public');
            $data['photo'] = $imageUrl;
        }

        $status = Brand::create($data);
        if ($status) {
            return redirect()->route('brand.list')->with('success','Brand Added successfully');
        } else {
            flash()->error('Error occurred, Please try again!');
        }
    }

    //edit view function
    public function brand_edit($id){
       $data = Brand::find($id);
       return view('admin.pages.brand.edit',compact('data'));
    }

    //update funciton for brand
     public function brand_update(Request $request ,$id){

            $brand=brand::findOrFail($id);
            $request->validate([
                'brand_name'=>'string|required',
                'photo'=>'nullable',
                'status'=>'nullable',
            ]);
            $data= $request->all();
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageUrl = $image->store('brand_gallery', 'public');
                $data['photo'] = $imageUrl;
            }
            $status=$brand->fill($data)->save();
            if($status){
                return redirect()->route('brand.list')->with('success','Brand Added successfully');
            }
            else{
                flash()->error('Error occurred, Please try again!');

            }

        }

        //delete function for brand
        public function brand_delete($id)
        {

            $brand = Brand::findOrFail($id);
            Product::where('brand_id', $id)->update(['brand_id' => null]);
            $brand->delete();
            return redirect()->route('brand.list')->with('success', 'Brand deleted successfully');
        }


}
