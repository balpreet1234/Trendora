<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{


    public function index()
    {
        $category=Category::orderBy('id','desc')->get();
        return view('admin.pages.category.index')->with('categories',$category);
    }


    public function create()
    {
        // $parent_cats=Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('admin.pages.category.create')->with('parent_cats');
    }


    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'string|required|unique:categories',
            'summary' => 'string|nullable',

            'status' => 'required|in:active,inactive',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable',
        ]);

        $data = $request->all();

        // Generate slug from title
        $slug = Str::slug($request->title);

        // Ensure slug is unique
        $count = Category::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . date('ymdis') . '-' . rand(0, 999);
        }

        $data['slug'] = $slug;
        $data['is_parent'] = $request->input('is_parent', 0) ?? null;
        $data['cate_main_title'] = $request->input('cate_main_title')?? null;
        $data['category_title'] = $request->input('category_title')?? null;
        $data['meta_title'] = $request->input('meta_title')?? null;
        $data['meta_description'] = $request->input('meta_description') ?? null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageUrl = $image->store('category_gallery', 'public');
            $data['photo'] = $imageUrl;
        }

        $status = Category::create($data);


        if ($status) {
            flash()->success('Category added successfully.');
        } else {
            flash()->error('Error occurred, Please try again!');
        }

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $parent_cats=Category::where('is_parent',1)->get();
        $category=Category::findOrFail($id);
        return view('admin.pages.category.edit')->with('category',$category)->with('parent_cats',$parent_cats);
    }


    public function update(Request $request, $id)
    {
        // return $request->all();
        $category=Category::findOrFail($id);
        $request->validate([
            'title'=>'string|required',
            // 'summary'=>'string|nullable',
            // 'photo'=>'required|string|nullable',
            'status'=>'required|in:active,inactive',
            // 'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable|exists:categories,id',
        ]);
        $data= $request->all();
        $data['is_parent']=$request->input('is_parent',0);
        $data['cate_main_title']=$request->input('cate_main_title');
        $data['category_title']=$request->input('category_title');
        $data['meta_title']=$request->input('meta_title');
        $data['meta_description']=$request->input('meta_description');
        $slug=Str::slug($request->slug);

        if($slug == $category->slug){
            $data['slug']=$slug;
        }else{
            // dd($request->all() );
            $count=Category::where('slug',$slug)->count();
            if($count>0){
                $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
            }else{
                $data['slug']=$slug;
            }

        }

        // return $data;
        $status=$category->fill($data)->save();
        if($status){
            // flash()->success('Category updated successfully.');
            // request()->session()->flash('success','Category updated successfully');
            toastr()->success('Category updated successfully!');

            return redirect()->route('category.index');
        }
        else{
            flash()->error('Error occurred, Please try again!');
            // request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('category.index');
    }


    public function destroy($id)
{
    $category = Category::findOrFail($id);
    $child_cat_id = Category::where('parent_id', $id)->pluck('id');

    // Delete the category from the database
    $status = $category->delete();

    if ($status) {
        // If there are child categories, shift them
        if (count($child_cat_id) > 0) {
            Category::shiftChild($child_cat_id);
        }


        Product::where('cat_id', 'LIKE', "%,$id,%")
            ->orWhere('cat_id', 'LIKE', "$id,%")
            ->orWhere('cat_id', 'LIKE', "%,$id")
            ->orWhere('cat_id', $id)
            ->update(['cat_id' => DB::raw("REPLACE(REPLACE(REPLACE(cat_id, ',$id', ''), '$id,', ''), '$id', '')")]);

        request()->session()->flash('success', 'Category deleted');
    } else {
        request()->session()->flash('error', 'Error while deleting category');
    }

    return redirect()->route('category.index');
}


    public function getChildByParent(Request $request){
        // return $request->all();
        $category=Category::findOrFail($request->id);
        $child_cat=Category::getChildByParentID($request->id);
        // return $child_cat;
        if(count($child_cat)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$child_cat]);
        }
    }


}
