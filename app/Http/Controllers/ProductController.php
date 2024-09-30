<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function shop()
     {
         $product = Product::with('images')->get();
        //  return $product;
         return view('shop', ['products'=>$product]);
     }

    public function index()
    {
        $product = Product::with('images')->limit(4)->get();
        return view('index', ['products'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.add_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json(['message'=>'hello world']);
        $request->validate([
            'product_name'=>'required|string|min:3',
            'mrp'=>'required|numeric',
        ]);

        $imgurl = [];

        foreach ($request->file('product_images') as $image) {
            $imgurl[] = $image->store('product_image', 'public');
        }

        $produt = Product::create([
            'product_name'=>$request->product_name,
            'mrp_price'=>$request->mrp,
            'selling_price'=>$request->selling_price,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'vendor_id'=>Auth::user()->id,
            'tags'=>$request->tags,
            'category'=>$request->category
        ]);
        for($i=0;$i<count($imgurl); $i++){
            Image::create([
                'image_path'=>$imgurl[$i],
                'product_id'=>$produt->id
            ]);
        }
        return redirect()->back()->with('success', "Product has been created!");
    }

    public function shopdetails(Request $request){
        $product = Product::with('images')->where('id', '=', $request->query('product_id'))->first();
        $comments = Comment::where('product_id', '=', $request->query('product_id'))->get();
        return view('shop-detail', ['product'=>$product, 'comments'=>$comments]);
    }
    // public function shopdetails(Request $request){
    //     $product = Product::with('images')->where('id', '=', $request->query('product_id'))->first();
    //     return view('shop-detail', ['product'=>$product]);
    // }

    /**
     * Display the specified resource.
     */
    public function addComment(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:3',
            'rating' => 'required|numeric',
            'product_id' => 'required|numeric',
        ]);

        $comment = Comment::create([
            'message' => $request->message,
            'rating' => $request->rating,
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', "Your Review has been submitted!");
    }


    public function addToCart(Request $request){
        $product_id = $request->query('product_id');
        if(\session('product_idies')){
            $lastProduct = session->get('product_idies');
            session()->put('product_idies', [...$lastProduct, $product_id]);
        }else{
            session()->put('product_idies', [$product_id]);
        }
        return  redirect()->back()->with('success', "Product has been added to cart!");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
};
