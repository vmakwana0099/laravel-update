<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Input;
use App\GeneralSettings;
use App\Alias;
use App\Image;
use Abraham\TwitterOAuth\TwitterOAuth;
use DB;
use File;
use App\Http\Traits\slug;
use Config;
use App\Helpers\MyLibrary;

class OnePushController extends PowerpanelController 
{
	public function ShareonSocialMedia() 
	{
		if(null !==(Input::get('socialmedia'))) {

			$formPost=Input::get();
			$settings=GeneralSettings::get()->toArray();
			$status = 0;
			
			if(in_array('facebook', $formPost['socialmedia'])){
			
			  $fbSetting = array();
				foreach ($settings as $index => $setting) {

						if($setting['fieldName'] == 'SOCIAL_SHARE_FB_ID') {
							$fbSetting['page_id'] = $setting['fieldValue'];
						}
						if ($setting['fieldName']=='SOCIAL_SHARE_FB_API_KEY') {
							$fbSetting['app_id']=$setting['fieldValue'];
						}
						if ($setting['fieldName']=='SOCIAL_SHARE_FB_SECRET_KEY') {
							$fbSetting['app_secret']=$setting['fieldValue'];
						}
						if ($setting['fieldName']=='SOCIAL_SHARE_FB_ACCESS_TOKEN') {
							$fbSetting['accessToken']=$setting['fieldValue'];
						}
				}		
		  
				$accessToken = $fbSetting['accessToken'];
				$fb = new \Facebook\Facebook([
					'app_id' => $fbSetting['app_id'],
					'app_secret' => $fbSetting['app_secret'],
					'default_graph_version' => 'v2.11'
				]);
				$img=Image::getImg($formPost['frontImg']);
				$linkData = [
					'link' => $formPost['frontLink'],
					'message' => $formPost['varTitle'].': '.$formPost['txtDescription'],
				//	'source' => $fb->fileToUpload(public_path('assets/images/'.$img->txtImageName.'.'.$img->varImageExtension)),
				];
			
				try {
					$response = $fb->post('/'.$fbSetting['page_id'].'/feed', $linkData, $accessToken);
				
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
					echo 'Graph returned an error: ' . $e->getMessage();
					exit;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
					echo 'Facebook SDK returned an error: ' . $e->getMessage();
					exit;
				}
				$graphNode = $response->getGraphNode();
				echo 'Posted with id: ' . $graphNode['id'];
				echo $status;
			}

			if(in_array('twitter', $formPost['socialmedia'])){
				
				$twSetting = array();
				foreach ($settings as $key => $value) {

						if($value['fieldName'] == 'SOCIAL_SHARE_TWITTER_API_KEY') {
							 $twSetting['api_key'] = $value['fieldValue'];
						}
						if($value['fieldName']=='SOCIAL_SHARE_TWITTER_SECRET_KEY') {
							 $twSetting['secret_key']=$value['fieldValue'];
						}
						if($value['fieldName']=='SOCIAL_SHARE_TWITTER_ACCESS_TOKEN') {
							 $twSetting['access_token']=$value['fieldValue'];
						}
						if($value['fieldName']=='SOCIAL_SHARE_TWITTER_ACCESS_SECRET_KEY') {
							 $twSetting['access_secret_key']=$value['fieldValue'];
						}
				}

					$connection = new TwitterOAuth($twSetting['api_key'], $twSetting['secret_key'], $twSetting['access_token'], $twSetting['access_secret_key']);
					$parameters = ['status' => $formPost['varTitle'].': '.$formPost['txtDescription'].': '. $formPost['frontLink']];
			

						if(!empty($formPost['frontImg']) && isset($formPost['frontImg'])) {
						 $img=Image::getImg($formPost['frontImg']);
						 $media1 = $connection->upload('media/upload', ['media' => public_path('assets/images/'.$img->txtImageName.'.'.$img->varImageExtension)]);
						$parameters['media_ids'] = $media1->media_id_string;
					}
					
					$messageTxt = substr($parameters['status'], 0, 140);
					$Response = $connection->post('statuses/update', $parameters);			    	
					
					echo json_encode($Response);
					exit;

				}

			}
		}
	
	public function getRecord() {
       
		$id = (int) Input::get('alias');
		$modal = Input::get('modal');

		$modelNameSpace = '\\App\\' . $modal;
    $record =$modelNameSpace::select(['fkIntImgId','varMetaTitle','varMetaDescription'])->where('id',$id)->get();
		
		echo json_encode($record);
	}

}