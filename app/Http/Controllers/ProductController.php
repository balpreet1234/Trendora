<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Validator;


class ProductController extends Controller
{


    public function index()
    {
        $products = Product::with('galleries')->orderBy('id','desc')->paginate(12);
        return view('frontend.pages.products.index', compact('products'));
    }
    public function shop()
    {
        $products = Product::orderBy('id','desc')->paginate(12);
        // dd($products);
        return view('frontend.shoppage', compact('products'));
    }


    public function product_list()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('admin.pages.product.list', compact('products'));
    }

    public function product_add() {
        $categories = Category::all();
        $brand = Brand::where('status','active')->get();
        return view('admin.pages.product.add', compact('categories','brand'));
    }

    public function product_edit($id)
    {
        $product = Product::with(['galleries'])->find($id);
        $categories = Category::all();
        $brands = Brand::where('status','active')->get();

        return view('admin.pages.product.edit', compact('product', 'categories', 'brands'));
    }


    public function product_update(Request $request, $id)
{


$request->validate([
    'title' => 'required',
    'description' => 'nullable',
    'photo' => 'array',
    'photo.*' => 'image',
    'video' => 'nullable',
    'video_thumbnail' => 'nullable',
    'sku' => 'required',
    'stock' => 'required',
    'price' => 'nullable',
    'discount' => 'nullable|numeric',
    'size' => 'string|nullable',
    'height' => 'nullable|numeric',
    'width' => 'nullable|numeric',
    'cat_id' => 'required|array',
    'cat_id.*' => 'exists:categories,id',
]);

    $product = Product::findOrFail($id);
    $data = $request->all();

    // Handle slug
    $slug = Str::slug($data['title']);
    $count = Product::where('slug', $slug)->where('id', '!=', $id)->count();
    if ($count > 0) {
        $slug .= '-' . date('ymdis') . '-' . rand(0, 999);
    }
    $data['slug'] = $slug;

    $data['cat_id'] = implode(',', $data['cat_id']);
    $data['tags'] = implode(',', $data['tags']);

    // Update product
    $product->update([
        'title' => $data['title'] ?? null,
        'slug' => $data['slug'] ?? null,
        'description' => $data['description'] ?? null,
        'stock' => $data['stock'] ?? null,
        'sku' => $data['sku'] ?? null,
        'color' => $data['color'] ?? null,
        'tags' => $data['tags'] ?? null,
        'price' => $data['price'] ?? null,
        'discount' => $data['discount'] ?? 0,
        'size' => $data['size'] ?? null,
        'height' => $data['height'] ?? null,
        'width' => $data['width'] ?? null,
        'cat_id' => $data['cat_id'] ?? null,
        'brand_id' => $data['brand'] ?? null,
    ]);

    // Handle file uploads
    if ($request->hasFile('photo')) {
        foreach ($request->file('photo') as $image) {
            $imageUrl = $image->store('product_gallery', 'public');

            ProductGallery::create([
                'product_id' => $product->id,
                'photo' => $imageUrl,
            ]);
        }
    }

    if ($request->hasFile('video')) {
        $videoUrl = $request->file('video')->store('videos', 'assets');
        $product->video = $videoUrl;
    }

    if ($request->hasFile('video_thumbnail')) {
        $thumbnailUrl = $request->file('video_thumbnail')->store('thumbnails', 'assets');
        $product->video_thumbnail = $thumbnailUrl;
    }

    $product->save();


    return redirect()->route('product.list')->with('success', 'Product updated successfully');
}


public function removeImage($id)
{

    $gallery = ProductGallery::find($id);

    if (!$gallery) {
        return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
    }


    if (file_exists(public_path('storage/' . $gallery->photo))) {
        unlink(public_path('storage/' . $gallery->photo));
    }


    $gallery->delete();

    return response()->json(['success' => true]);
}


    public function product_detail($slug)
    {
        $product_detail= Product::getProductBySlug($slug);
        $category=Category::where('id',$product_detail->cat_id)->first();

        return view('frontend.pages.products.details', compact('product_detail','category'));
    }

    public function product_cate_detail( $slug)
    {
        // $category=ProductCategory::where('is_parent',$slug)->get();
        $categories=Category::getProductByCat($slug);
        $products = Product::where('id',$categories['product_id'])->get();
        //return view('frontend.pages.products.index', compact('products'));
    }


    //store function of products
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'product_gallery' => 'array',
            'product_gallery.*' => 'image',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
            'video_thumbnail' => 'nullable',
            'sku' => 'required',
            'stock' => 'required|numeric',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'size' => 'string|nullable',
            'height' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'colors' => 'array',
            'colors.*' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $data = $request->all();


        $slug = Str::slug($data['title']);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;


        $data['cat_id'] = implode(',', $data['categories']);
        $data['tags'] = implode(',', $data['tags'] ?? []);
        $data['color'] = json_encode($data['colors'] ?? []);


        $product = Product::create([
            'title' => $data['title'] ?? null,
            'slug' => $data['slug'] ?? null,
            'description' => $data['description'] ?? null,
            'stock' => $data['stock'] ?? null,
            'sku' => $data['sku'] ?? null,
            'color' => $data['color'],
            'tags' => $data['tags'] ?? null,
            'price' => $data['price'] ?? null,
            'discount' => $data['discount'] ?? 0,
            'size' => $data['size'] ?? null,
            'height' => $data['height'] ?? null,
            'width' => $data['width'] ?? null,
            'cat_id' => $data['cat_id'] ?? null,
            'brand_id' => $data['brand'] ?? null,
        ]);


        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $image) {
                $imageUrl = $image->store('product_gallery', 'public');
                ProductGallery::create([
                    'product_id' => $product->id,
                    'photo' => $imageUrl,
                ]);
            }
        }


        if ($request->hasFile('video')) {
            $videoUrl = $request->file('video')->store('videos', 'assets');
            $product->video = $videoUrl;
        }


        if ($request->hasFile('video_thumbnail')) {
            $thumbnailUrl = $request->file('video_thumbnail')->store('thumbnails', 'assets');
            $product->video_thumbnail = $thumbnailUrl;
        }

        $product->save();


        return redirect()->route('product.list')-with('success', 'Product added successfully');
    }



    public function product_destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('success','Product deleted successfully');
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title'=>'string|required',
    //         // 'summary'=>'string|required',
    //         'description'=>'string|nullable',
    //         'photo'=>'string|required',
    //         'stock'=>"required|numeric",
    //         'sku'=>"required",
    //         'cat_id'=>'required|exists:categories,id',
    //         'price'=>'required|numeric',
    //         'discount'=>'required|numeric',
    //         'size'=>'string|nullable',
    //         'height'=>'string|nullable',
    //         'width'=>'string|nullable',
    //         // 'colors'=>'array|nullable',
    //     ]);


    //     $data=$request->all();
    //     $slug=Str::slug($request['title']);
    //     $count=Product::where('slug',$slug)->count();
    //     if($count>0){
    //         $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
    //     }
    //     $data['slug']=$slug;
    //     $data['is_featured']=$request->input('is_featured',0);
    //     $size=$request->input('size');
    //     if($request->has('sizes') && is_array($request->input('sizes'))) {
    //         $data['sizes'] = implode(',', $request->input('sizes'));
    //     } else {
    //         $data['sizes'] = '';  // Default to an empty string if no sizes are provided
    //     }

    //     $colors=$request->input('colors');
    //     if($request->has('colors') && is_array($request->input('colors'))) {
    //         $data['colors'] = implode(',', $request->input('colors'));
    //     } else {
    //         $data['colors'] = '';  // Default to an empty string if no sizes are provided
    //     }

    //     $product = new Product;
    //     $product->title = $data['title'];
    //     $product->slug = $data['slug'];
    //     $product->description = $data['description'];
    //     $product->stock = $data['stock'];
    //     $product->sku = $data['sku'];
    //     $product->cat_id = $data['cat_id'];
    //     $product->tags = json_encode($request->input('tags', []));
    //     $product->photo = $data['photo'];
    //     $product->price = $data['price'];
    //     $product->discount = $data['discount'];
    //     $product->size = $data['size'];
    //     $product->sizes = $data['sizes'];
    //     $product->colors = $data['colors'];
    //     $product->height = $data['height'];
    //     $product->width = $data['width'];
    //     $product->bedsheet_height = $data['bedsheet_height'];
    //     $product->bedsheet_width = $data['bedsheet_width'];
    //     $product->scbag_height = $data['scbag_height'];
    //     $product->scbag_width = $data['scbag_width'];
    //     $product->lbag_height = $data['lbag_height'];
    //     $product->lbag_width = $data['lbag_width'];
    //     $product->cushion_height = $data['cushion_height'];
    //     $product->cushion_width = $data['cushion_width'];
    //     $product->meta_title = $data['meta_title'];
    //     $product->meta_description = $data['meta_description'];
    //     // $product->categories()->sync($data['cat_id']);
    //     $product->save();

    //     if($request->hasFile('product_gallery')){


    //         foreach ($request->file('product_gallery') as $image) {
    //             $imageUrl = $image->store('product_gallery', 'assets');

    //             // Add or update gallery image for the product
    //             ProductImage::updateOrCreate(
    //                 ['product_id' => $product->id, 'photo' => $imageUrl],
    //                 ['photo' => $imageUrl]
    //             );
    //         }
    //     }

    //     // $status=Product::create($data);
    //     if($product){
    //         request()->session()->flash('success','Product added successfully');
    //     }
    //     else{
    //         request()->session()->flash('error','Please try again!!');
    //     }
    //     return redirect()->route('product.list');


    // }


}
