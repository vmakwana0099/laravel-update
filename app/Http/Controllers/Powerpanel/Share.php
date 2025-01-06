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
class Share extends PowerpanelController 
{
	public function ShareonSocialMedia() 
	{
		if(null !==(Input::get('socialmedia'))) {
			$formPost=Input::get();
			$settings=GeneralSettings::get();
			$status = 0;

			if(in_array('facebook', $formPost['socialmedia'])){
				$fbSetting=array();
				foreach ($settings as $key=>$setting) {
					if ($setting->field_name=='SOCIAL_SHARE_FB_ID') {
						$fbSetting['page_id']=$setting->field_value;
					}
					if ($setting->field_name=='SOCIAL_SHARE_FB_API_KEY') {
						$fbSetting['app_id']=$setting->field_value;
					}
					if ($setting->field_name=='SOCIAL_SHARE_FB_SECRET_KEY') {
						$fbSetting['app_secret']=$setting->field_value;
					}
					if ($setting->field_name=='SOCIAL_SHARE_FB_ACCESS_TOKEN') {
						$fbSetting['accessToken']=$setting->field_value;
					}
				}
				$accessToken = $fbSetting['accessToken'];
				$fb = new \Facebook\Facebook([
					'app_id' => $fbSetting['app_id'],
					'app_secret' => $fbSetting['app_secret'],
					'default_graph_version' => 'v2.10'
				]);
				$linkData = [
					'link' => $formPost['frontLink'],
					'message' => $formPost['txtDescription'],
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

			if(in_array('twitter', $formPost['socialmedia']))
			{		
					$connection = new TwitterOAuth(env('TWITTER_CONSUMER_KEY'), env('TWITTER_CONSUMER_SECRET'), env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
					$parameters = ['status' => $formPost['varTitle'].': '. $formPost['frontLink']];
					
					
					if(isset($formPost['frontImg'])){
						$img=Image::where('images.id',$formPost['frontImg'])->first();
						$media1 = $connection->upload('media/upload', ['media' => public_path('assets/images/'.$img->txt_image_alt_tag.'.'.$img->var_image_extension)]);
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
		if(is_string(Input::get('alias'))){
			$id = slug::resolve_alias(Input::get('alias'));
		}else{
			$id=Input::get('alias');
		}
		$record=DB::table(Input::get('table'))
		->where('id',$id)
		->get();
		echo json_encode($record);
	}

}