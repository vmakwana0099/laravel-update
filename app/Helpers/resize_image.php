<?php
/**
* This helper give description for static block section by alias.
* @package   Netquick
* @version   1.00
* @since     2016-12-07
* @author    Vishal Agrawal
*/
namespace App\Helpers;
use Intervention\Image\Facades\Image as resizeImage;
use App\Image;
use File;
use Config;
use DB;	

class resize_image
{
	static function resize($imageID = false, $width = false,$height = false)
	{ 
		try 
		{
			$response  = Config::get('Constant.ENV_APP_URL').'/assets/images/default.png';	
			if($width != false || $height != false)
			{
				$cachePath = public_path().'/caches/'.$width.'x'.$height;
				$defaultImagePath =  public_path().'/assets/images/default.png';	
				if(!file_exists($cachePath.'/default.png'))
				{
					$imageNotAvailable = resizeImage::make($defaultImagePath);
					$imageNotAvailable->resize(intval($width),null,function ($constraint) 
					{
						$constraint->aspectRatio();
						$constraint->upsize();
					});

					if(!is_dir($cachePath))
					{
						File::makeDirectory($cachePath,0755,true,true);	
					}
					$imageNotAvailable->save($cachePath.'/default.png');
				}	
				$response  = Config::get('Constant.ENV_APP_URL').'/caches/'.$width.'x'.$height.'/default.png';		
			}

			$images = Image::getImg($imageID);
			
			if($images != false && !empty($images))
			{
				$imageName    =   $images->txtImageName;
				$extension    =   $images->varImageExtension;
				if(!empty($width) && !empty($height))
				{
					if($images != false && $imageID != 0 && !empty($imageName) && !empty($extension))
					{
						$imagePath = public_path().'/assets/images/'.$imageName.'.'.$extension;
						if(file_exists($imagePath))
						{
							$path = public_path().'/caches/'.$width.'x'.$height;
							if(file_exists($path.'/'.$imageName.'.'.$extension))
							{
								if($height)
								{
									$folderName = $width.'x'.$height;
								}else{
									$folderName = $width;
								}
								$response  =  Config::get('Constant.ENV_APP_URL').'/caches/'.$folderName.'/'.$imageName.'.'.$extension;

							}else{
								$img = resizeImage::make($imagePath); 
								$img->resize(intval($width),null,function ($constraint) 
								{
    							$constraint->aspectRatio();
    							$constraint->upsize();
								});
								
								if(!is_dir($path))
								{
									File::makeDirectory($path,755,true,true);	
								}

								if($img->save($path.'/'.$imageName.'.'.$extension))
								{
									$response  =  Config::get('Constant.ENV_APP_URL').'/caches/'.$width.'x'.$height.'/'.$imageName.'.'.$extension; 
								}
							}							
						}
					}

				}else {

					if($imageID != 0 || !empty($imageID))
					{
							if(file_exists(public_path().'/assets/images/'.$imageName.'.'.$extension)) 
							{
								$response  = Config::get('Constant.ENV_APP_URL').'/assets/images/'.$imageName.'.'.$extension;			
							}
					}	
				}

			}	
			return $response;
			
		}catch(Exception $e){
			return false;
		}

	}
}