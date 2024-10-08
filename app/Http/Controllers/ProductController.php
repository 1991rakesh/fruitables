<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Auth;

class ProductController extends Controller
{
     public function shop()
     {
         $product = Product::with('images')->get();
         return view('shop', ['products'=>$product]);
     }

    public function index()
    {
        $product = Product::with('images')->limit(4)->get();
        return view('index', ['products'=>$product]);
    }

    public function create()
    {
        return view('products.add_product');
    }

    public function store(Request $request)
    {
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
        if(is_array(session()->get('product_idies'))){
            $productIdies = session()->get('product_idies');
            if(in_array($product_id, array_column($productIdies, 'product_id'))){
                $key = array_search($product_id, array_column(session('product_idies'), 'product_id'));
                $productIdies[$key]['count'] += 1;
                session()->put('product_idies',  $productIdies);
            }else{
                $lastProduct = session()->get('product_idies');
                session()->put('product_idies', [...$lastProduct, ['product_id'=>$product_id, 'count'=>1]]);
            }
        }else{
            session()->put('product_idies', [['product_id'=>$product_id, 'count'=>1]]);
        }
        return redirect()->back()->with('success', "Product has been added to cart!");
    }


    public function showCartPage()
    {
        $addedItems = session()->get('product_idies');
        $product_idies = array_column($addedItems, 'product_id');
        $products = Product::with('images')->whereIn('id', $product_idies)->get()->map(function($product)use($addedItems){
            foreach ($addedItems as $key => $value) {
                if($product->id == $value['product_id']){
                    $product->count =  $value['count'];
                }
            }
            return $product;
        });
        return view('cart', ['products'=>$products]);
    }

    public function showchackoutPage()
    {
        $addedItems = session()->get('product_idies');
        $product_idies = array_column($addedItems, 'product_id');
        $products = Product::with('images')->whereIn('id', $product_idies)->get()->map(function($product)use($addedItems){
            foreach ($addedItems as $key => $value) {
                if($product->id == $value['product_id']){
                    $product->count =  $value['count'];
                }
            }
            return $product;
        });
        return view('chackout', ['products'=>$products]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    // ProductController.php

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products-edit', compact('product'));
    }

    // ProductController.php

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        // और फील्ड्स के लिए भी ऐसा ही करें
        $product->save();
        return redirect()->route('products-index');
    }

    public function destroy(string $id)
    {
        //
    }

    public function placedOrder(Request $request){
        $request->validate([
            'fullname'=>'required|string|min:3',
            'address'=>'required|string',
            'city'=>'required',
            'district'=>'required|string',
            'state'=>'required|string',
            'postalcode'=>'required|string|max:6',
            'mobile'=>'required|string|max:10',
            'email'=>'required|string',
        ]);
        {
            // Order::create($request->all());
            Order::create([
                'fullname'=>$request->fullname,
                'address'=>$request->address,
                'city'=>$request->city,
                'district'=>$request->district,
                'city'=>$request->city,
                'state'=>$request->state,
                'postalcode'=>$request->postalcode,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'user_id'=>$request->user()->id,
                'products'=>json_encode(session()->get('product_idies'))
            ]);
            return redirect()->route('profile.edit')->with('success', 'Order Placed Successfully');
            }
    }
};
