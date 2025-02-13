<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\ImageUploader;
use App\Http\Services\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use  App\Events\ProductSendEmail;
use Illuminate\Support\Facades\Cache;
class ProductController extends Controller
{
  
    public function index()
    {
     
        $product = Cache::remember('productUserIndex', [20,30], function () {
         return   Product::with('user')->where('user_id',Auth::user()->id)->get();
    });
        return view('user.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    

        $validator =Validator::make($request->all(),[
            'header_banner' => 'mimes:jpeg,jpg,png,gif|max:100000',
            'title' => 'required',
            'description' => 'required',
            'price' => 'numeric',
            'stock' => 'numeric',
         ]);
         

         if ($validator->fails()) {

            session()->flash('notification-status', "error");
            session()->flash('notification-message', "validation error: Code #{$validator->errors()}");
            return redirect()->back();
         }else{
            try{
                DB::beginTransaction();
                if ($request->hasFile('header_banner') && $request->file('header_banner')->isValid()) {
                    $file = $request->header_banner;
                    $image_name = rand(10,10000).'_'.time() . '.' . $file->getClientOriginalExtension();
                    $image = ImageUploader::upload($file,'product');
                             //Need to setup FTP Connection to work the file upload 
                    // Storage::disk('ftp')->put($image["filename"], file_get_contents($file));
                $data = [
                    'user_id' => Auth::user()->id,
                    'title' => $request->get('title'),
                    'description' => $request->get('description'),
                    'stock' => $request->get('stock'),
                    'price' => $request->get('price'),
                    'image' => $image["filename"],
                    'path' => $image["path"],
                    'fullpath' => $image["directory"]
                ];
                }else{
                    $data = [
                        'user_id' => Auth::user()->id,
                        'title' => $request->get('title'),
                        'description' => $request->get('description'),
                        'stock' => $request->get('stock'),
                        'price' => $request->get('price')
               
                    ];
                }
       
            
           $product =  Product::create($data);
            // Not tested 
            // event(new ProductSendEmail($product));
            DB::commit();
            session()->flash('notification-message', "Successfully created.");
            session()->flash('notification-status', "success");
            return to_route('user.product.create');
            }catch(\Exception $e){
                DB::rollback();
                session()->flash('notification-status', "error");
                session()->flash('notification-message', "Server Error: Code #{$e->getLine()}");
                return redirect()->back();
            }
         }


    }

    /**
     * Display the specified resource.
     */
    public function show(String $product)
    {
        $record =  Product::with('user')->where('id',$product)->first();
   
        return view('user.product.show',compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Instead using this for edit form i used theh show method to edit the data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $product)
    {
    
        $validator =Validator::make($request->all(),[
            'header_banner' => 'mimes:jpeg,jpg,png,gif|max:100000',
            'title' => 'required',
            'description' => 'required',
            'price' => 'numeric',
            'stock' => 'numeric',
         ]);
         

         if ($validator->fails()) {

            session()->flash('notification-status', "error");
            session()->flash('notification-message', "validation error: Code #{$validator->errors()}");
            return redirect()->back();
         }else{



        DB::beginTransaction();
		try{
       
        
			$product =  Product::findOrFail($product);
            if ($request->hasFile('header_banner') && $request->file('header_banner')->isValid()) {
                $file = $request->header_banner;
                $image_name = rand(10,10000).'_'.time() . '.' . $file->getClientOriginalExtension();
                $image = ImageUploader::upload($file,'product');
                          //Need to setup FTP Connection to work the file upload 
                // Storage::disk('ftp')->put($image["filename"], file_get_contents($file));
                $product->title = $request->get('title');
                $product->description = $request->get('description');
                $product->stock =  $request->get('stock');
                $product->price =  $request->get('price');
                $product->image =  $image["filename"];
                $product->path =  $image["path"];
                $product->fullpath =  $image["directory"];

            }else{
                $product->title = $request->get('title');
                $product->description = $request->get('description');
                $product->stock =  $request->get('stock');
                $product->price =  $request->get('price');
              
            }
            $product->save();
	       // Not tested 
            // event(new ProductSendEmail($product));
			DB::commit();
            session()->flash('notification-message', "Successfully Updated.");
            session()->flash('notification-status', "success");
            return redirect()->back();

		}catch(\Exception $e){
			DB::rollback();
            session()->flash('notification-status', "error");
			session()->flash('notification-message', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();

		}
     }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $product)
    {
        DB::beginTransaction();
		try{
            $product = Product::find($product);
            $product->delete();
            DB::commit();
            session()->flash('notification-message', "Successfully Delete.");
            session()->flash('notification-status', "success");
            return to_route('admin.product.index');
		}catch(\Exception $e){
			DB::rollback();
            session()->flash('notification-status', "error");
			session()->flash('notification-message', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}  
     }
}
