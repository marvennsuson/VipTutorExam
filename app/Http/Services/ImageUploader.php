<?php 

namespace App\Http\Services;


/*
*
* Models used for this class
*/

/*
*
* Classes used for this class
*/

// use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Nette\Utils\Helpers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
// use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image;
class ImageUploader {

	/**
	*
	*@param Illuminate\Support\Facades\File $file
	*@param string $image_directory
	*
	*@return array
	*/
	public static function upload($file, $image_directory = "uploads", $resized_size = 1024, $thumbnail_size = 320){
		$manager = new ImageManager(new Driver());
		$storage = env('IMAGE_STORAGE', "file");

		list($width, $height) = getimagesize($file);
		
		switch (Str::lower($storage)) {
			case 'file':
				// $file = $request->file("file");
				$ext = $file->getClientOriginalExtension();
				$thumbnail = ['height' => 250, 'width' => 250];
				$path_directory = $image_directory."/".Carbon::now()->format('Ymd');
				$resized_directory = $image_directory."/".Carbon::now()->format('Ymd')."/resized";
				$thumb_directory = $image_directory."/".Carbon::now()->format('Ymd')."/thumbnails";

				if (!File::exists($path_directory)){
					File::makeDirectory($path_directory, $mode = 0777, true, true);
				}

				if (!File::exists($resized_directory)){
					File::makeDirectory($resized_directory, $mode = 0777, true, true);
				}

				if (!File::exists($thumb_directory)){
					File::makeDirectory($thumb_directory, $mode = 0777, true, true);
				}

				$filename = Helper::create_filename($ext);

				$file->move($path_directory, $filename); 
				// if($width >= 1024){
				// 	//if greater than or equalt to 1024 width
				// 	Image::read("{$path_directory}/{$filename}")->resize()->contain(1024)->save("{$resized_directory}/{$filename}",95);
				// 	Image::read("{$path_directory}/{$filename}")->resize()->contain(320)->save("{$thumb_directory}/{$filename}",95);
					
				// }else{
				// 	// Image::read("{$path_directory}/{$filename}")->resize()->contain($width)->save("{$resized_directory}/{$filename}",95);

				// 	// if($width >= 320){
				// 	// 	//if greater than or equalt to 320 width
				// 	// 	Image::read("{$path_directory}/{$filename}")->resize()->contain(320)->save("{$thumb_directory}/{$filename}",95);
				// 	// }else{
				// 	// 	Image::read("{$path_directory}/{$filename}")->resize()->contain($width)->save("{$thumb_directory}/{$filename}",95);
				// 	// }
					
				// }

				return [ 
					"path" => $image_directory, 
					"directory" => URL::to($path_directory), 
					"filename" => $filename ,
					"width" => $width,
					"height" => $height,
					"source" => $storage
				];

			break;

	
			default:
				return array();
			break;
		}
	}
}