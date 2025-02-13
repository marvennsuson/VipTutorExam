<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\ImageUploader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use  App\Events\ProductSendEmail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Cache::remember('productApiIndex', [20,30], function () {
            return Product::with('user')->get(); 
    });
       
        return ProductResource::collection($product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

          return response()->json([
            'message' => "Server error : {$validator->errors()}",
            'status' => 404,
          ]);
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
                    'user_id' => $request->get('id'),
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
                        'user_id' => $request->get('id'),
                        'title' => $request->get('title'),
                        'description' => $request->get('description'),
                        'stock' => $request->get('stock'),
                        'price' => $request->get('price')
                    ];
                }
                $record = Product::create($data);
              // Not tested 
            // event(new ProductSendEmail($product));
            DB::commit();
            return response()->json([
                'message' => "Successfully fetch record",
                'status' => 201,
                'data' => new ProductResource($record)
              ]);
            }catch(\Exception $e){
                DB::rollback();
                return response()->json([
                    'message' => "Server error : {$e->getLine()}",
                    'status' => 404,
                  ]);
             
            }
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // $product = Product::with(['user'])->where('id',$product)->first();
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator =Validator::make($request->all(),[
            'header_banner' => 'mimes:jpeg,jpg,png,gif|max:100000',
            'title' => 'required',
            'description' => 'required',
            'price' => 'numeric',
            'stock' => 'numeric',
         ]);
         

         if ($validator->fails()) {

            return response()->json([
                'message' => "Server error : {$validator->errors()}",
                'status' => 404,
              ]);
         }else{



        DB::beginTransaction();
		try{
       
        
			// $product =  Product::findOrFail($product);
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
            return response()->json([
                'message' => "Successfully fetch record",
                'status' => 201,
                'data' => new ProductResource($product)
              ]);

		}catch(\Exception $e){
			DB::rollback();
            return response()->json([
                'message' => "Server error : {$e->getLine()}",
                'status' => 404,
              ]);

		}
     }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        if(Route::is('api.product.destroy')){
            return response()->json([
                'message' => "Successfully Deleted record",
                'status' => 204
              ]);
        }else{
            return response()->noContent();
        }
      
    }
}
