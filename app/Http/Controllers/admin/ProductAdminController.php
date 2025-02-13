<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon; 
use Illuminate\Support\Facades\Validator;
use App\Http\Services\ImageUploader;
use App\Http\Services\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use  App\Events\ProductSendEmail;
use Illuminate\Support\Facades\Cache;
class ProductAdminController extends Controller
{
    protected $data;
	protected $per_page = 8;

 
    public function index(Request $request)
    {
  
    //    $this->data['record']  = Product::with('user')->get(); 
    $this->data['record']  = Cache::remember('productAdminIndex', [20,30], function () {
            return Product::with('user')->get(); 
    });

        return view('admin.product.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
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
       
  
       
         

            DB::beginTransaction();
            try{
             
                if ($request->hasFile('header_banner') && $request->file('header_banner')->isValid()) {
                    $file = $request->header_banner;
                    $image_name = rand(10,10000).'_'.time() . '.' . $file->getClientOriginalExtension();
                    $image = ImageUploader::upload($file,'product');
    
                    //Need to setup FTP Connection to work the file upload 
                    // Storage::disk('ftp')->put($image["filename"], file_get_contents($file));
                    $data = [
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
                        'title' => $request->get('title'),
                        'description' => $request->get('description'),
                        'stock' => $request->get('stock'),
                        'price' => $request->get('price'),
                    ];
                
              
                }
                $product = Product::create($data);
               // Not tested 
            // event(new ProductSendEmail($product));
            DB::commit();
            session()->flash('notification-message', "Successfully created.");
            session()->flash('notification-status', "success");
            return to_route('admin.product.create');
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
    
        $this->data['record'] =  Product::with('User')->where('id',$product)->first();
   
        return view('admin.product.show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //leave ablank
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
			$product = Product::where('id',$product)->first();
        
            if(!empty($product->user_id)){

                session()->flash('notification-message', "Product has already Assigned Unable to remove .");
                session()->flash('notification-status', "error");
         
            }else{
         
                $product->delete();
                DB::commit();
                session()->flash('notification-message', "Successfully Delete.");
                session()->flash('notification-status', "success");
              
            }
            return to_route('admin.product.index');
		}catch(\Exception $e){
			DB::rollback();
            session()->flash('notification-status', "error");
			session()->flash('notification-message', "Server Error: Code #{$e->getMessage()}");
			return redirect()->back();
		}  
    }

    
}
