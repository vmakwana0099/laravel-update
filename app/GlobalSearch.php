<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use Crypt;
class GlobalSearch extends Model{
	static function global_search($searchGlobalValue=false,$team_code=false,$faq_code=false,$cmspage_code=false,$banner_code=false,$service_code=false,$staticblock_code=false,$blog_code=false,$testimonial_code=false,$contact_code=false,$image_url=false){
		$response=false;
		$banner_real=array();
		$cmspage_real=array();
		$staticblock_real=array();
		$contact_real=array();
		$user_real=array();
		$service_real=array();		
		$sponsor_real=array();
		$blog_real=array();
		$news_real=array();
		$testimonial_real=array();
		$team_real=array();
		$photo_album_real=array();
		$video_album_real=array();
		$faq_real=array();
		$searchGlobalValue = trim($searchGlobalValue);
		$arrGuessKeywords = array();
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$team_search_query = "SELECT";
			$team_search_query.= " `team`.`id` as `team_id`,";
			$team_search_query.= " `team`.`varTitle` as `team_name`,";
			$team_search_query.= " `alias`.`varAlias` as `team_alias`,";
			$team_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$team_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$team_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$team_search_query.= " FROM";
			$team_search_query.= " `team`";
			$team_search_query.= " LEFT JOIN `alias` ON `team`.`id`=`alias`.`fk_record_code`";
			$team_search_query.=" LEFT JOIN `images` ON `team`.`img_id`=`images`.`id`";
			$team_search_query.= " WHERE";
			$team_search_query.= " `team`.`chr_delete` = 'N'";
			$team_search_query.= " AND `team`.`chr_publish` = 'Y'";
			$team_search_query.= " AND `alias`.`fk_module_code` = '$team_code'";
			$team_search_query.= " AND ( ";
			$team_search_query.= "soundex_match('".$searchGlobalValue."',team.name,' ') ";
			foreach ($arrSearchKeywords as $value){
				$team_search_query.= " OR ";
				$team_search_query.= " CONCAT_WS(' ',team.name) LIKE '%".$value."%' ";
			}
			$team_search_query.= " ) ";
			$team_search_query.= " GROUP BY `team`.`id`";
			$team_search_query.= " ORDER BY `team`.`varTitle` ASC";
			$team_search_query.= " LIMIT 5";
			$teamDetails = DB::select(DB::raw($team_search_query));
			if ($teamDetails){
				$teams = $teamDetails;
				if(!empty($teams)){
					$team_real = array();
					foreach($teams as $key=>$value){
						if(!empty($value->team_id) && !empty($value->team_name)){
							$team_real[$key]['team_id'] = $value->team_id;
							$team_real[$key]['name'] = ucwords($value->team_name);
							$team_real[$key]['alias_name'] = $value->team_alias;
							if(!empty($value->thumb_url) && !empty($value->image_alt_tag) && !empty($value->image_extension)){
								$team_real[$key]['image_url'] = $value->thumb_url.'/'.$value->image_alt_tag.'.'.$value->image_extension;
							}else{
								$team_real[$key]['image_url'] = $image_url;
							}
							$team_real[$key]['type']='team';
							$team_real[$key]['title']='Team';
							$arrChunks = explode(" ",$value->team_name);
							$arrGuessKeywords[] = $value->team_name;
							foreach ($arrChunks as $value) {
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$team_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$faq_search_query = "SELECT";
			$faq_search_query.= " `faq`.`id` as `faq_id`,";
			$faq_search_query.= " `faq`.`question` as `faq_question`";
			$faq_search_query.= " FROM";
			$faq_search_query.= " `faq`";
			$faq_search_query.= " WHERE";
			$faq_search_query.= " `faq`.`chr_delete` = 'N'";
			$faq_search_query.= " AND `faq`.`chr_publish` = 'Y'";
			$faq_search_query.= " AND ( ";
			$faq_search_query.="soundex_match('".$searchGlobalValue."',faq.question, ' ') ";
			foreach ($arrSearchKeywords as $value) {
				$faq_search_query.=" OR ";
				$faq_search_query.=" CONCAT_WS(' ',faq.question) LIKE '%".$value."%' ";
			}
			$faq_search_query.= " ) ";
			$faq_search_query.= " GROUP BY `faq`.`id`";
			$faq_search_query.= " ORDER BY `faq`.`question` ASC";
			$faq_search_query.=" LIMIT 5";
			$faqDetails = DB::select(DB::raw($faq_search_query));
			if($faqDetails){
				$faqs = $faqDetails;
				if(!empty($faqs)){
					$faq_real = array();
					foreach($faqs as $key=>$value){
						if(!empty($value->faq_id) && !empty($value->faq_question)){
							$faq_real[$key]['faq_id'] = $value->faq_id;
							$faq_real[$key]['name'] = ucwords($value->faq_question);
							$faq_real[$key]['alias_name'] = Crypt::encrypt($value->faq_id);
							$faq_real[$key]['image_url'] = $image_url;
							$faq_real[$key]['type']='faq';	
							$faq_real[$key]['title']='Faq';	
							$arrChunks = explode(" ",$value->faq_question);
							$arrGuessKeywords[] = $value->faq_question;
							foreach ($arrChunks as $value){
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$faq_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$cmspages_search_query = "SELECT";
			$cmspages_search_query.= " `cms_pages`.`id` as `cms_id`,";
			$cmspages_search_query.= " `cms_pages`.`var_title` as `cmspages_var_title`,";
			$cmspages_search_query.= " `alias`.`varAlias` as `cms_alias`";
			$cmspages_search_query.= " FROM";
			$cmspages_search_query.= " `cms_pages`";
			$cmspages_search_query.=" LEFT JOIN `alias` ON `cms_pages`.`id`=`alias`.`fk_record_code`";
			$cmspages_search_query.= " WHERE";
			$cmspages_search_query.= " `cms_pages`.`chr_publish` = 'Y'";
			$cmspages_search_query.= " AND `cms_pages`.`chr_delete` = 'N'";
			$cmspages_search_query.= " AND `alias`.`fk_module_code` = '$cmspage_code'";
			$cmspages_search_query.= " AND ( ";
			$cmspages_search_query.="soundex_match('".$searchGlobalValue."',cms_pages.var_title, ' ') ";
			foreach ($arrSearchKeywords as $value) {
				$cmspages_search_query.=" OR ";
				$cmspages_search_query.=" CONCAT_WS(' ',cms_pages.var_title) LIKE '%".$value."%' ";
			}
			$cmspages_search_query.= " ) ";
			$cmspages_search_query.= " GROUP BY `cms_pages`.`id`";
			$cmspages_search_query.= " ORDER BY `cms_pages`.`var_title` ASC";
			$cmspages_search_query.=" LIMIT 5";
			$cmspagesDeatils = DB::select(DB::raw($cmspages_search_query));
			if($cmspagesDeatils){
				$cmspages = $cmspagesDeatils;
				if(!empty($cmspages)){
					$cmspage_real = array();
					foreach($cmspages as $key=>$value){
						if(!empty($value->cms_id) && !empty($value->cmspages_var_title)){
							$cmspage_real[$key]['cms_id'] = $value->cms_id;
							$cmspage_real[$key]['name'] = ucwords($value->cmspages_var_title);
							$cmspage_real[$key]['alias_name'] = $value->cms_alias;
							$cmspage_real[$key]['image_url'] = $image_url;
							$cmspage_real[$key]['type']='pages';	
							$cmspage_real[$key]['title']='Cms Page';	
							$arrChunks = explode(" ",$value->cmspages_var_title);
							$arrGuessKeywords[] = $value->cmspages_var_title;
							foreach ($arrChunks as $value) {
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$cmspage_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$banner_search_query = "SELECT";
			$banner_search_query.= " `banner`.`id` as `banner_id`,";
			$banner_search_query.= " `banner`.`title` as `title`,";
			$banner_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$banner_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$banner_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$banner_search_query.= " FROM";
			$banner_search_query.= " `banner`";
			$banner_search_query.=" LEFT JOIN `images` ON `banner`.`image`=`images`.`id`";
			$banner_search_query.= " WHERE";
			$banner_search_query.= " `banner`.`chr_publish` = 'Y'";
			$banner_search_query.= " AND `banner`.`chr_delete` = 'N'";
			$banner_search_query.= " AND ( ";
			$banner_search_query.="soundex_match('".$searchGlobalValue."',banner.title, ' ') ";
			foreach ($arrSearchKeywords as $value) {
				$banner_search_query.=" OR ";
				$banner_search_query.=" CONCAT_WS(' ',banner.title) LIKE '%".$value."%' ";
			}
			$banner_search_query.= " ) ";
			$banner_search_query.= " GROUP BY `banner`.`id`";
			$banner_search_query.= " ORDER BY `banner`.`title` ASC";
			$banner_search_query.=" LIMIT 5";
			$bannerDetails = DB::select(DB::raw($banner_search_query));
			if($bannerDetails){
				$banner = $bannerDetails;
				if(!empty($banner)){
					$banner_real = array();
					foreach($banner as $key=>$value){
						if(!empty($value->banner_id) && !empty($value->title)){
							$banner_real[$key]['banner_id'] = $value->banner_id;
							$banner_real[$key]['name'] = $value->title;
							$banner_real[$key]['alias_name'] = Crypt::encrypt($value->banner_id);
							if(!empty($value->thumb_url) && !empty($value->image_alt_tag) && !empty($value->image_extension)){
								$banner_real[$key]['image_url'] = $value->thumb_url.'/'.$value->image_alt_tag.'.'.$value->image_extension;
							}else{
								$banner_real[$key]['image_url'] = $image_url;
							}
							$banner_real[$key]['type']='banners';	
							$banner_real[$key]['title']='Banner';	
							$arrChunks = explode(" ",$value->title);
							$arrGuessKeywords[] = $value->title;
							foreach ($arrChunks as $value){
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$banner_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$service_search_query = "SELECT";
			$service_search_query.= " `services`.`id` as `service_id`,";
			$service_search_query.= " `services`.`title` as `service_title`,";
			$service_search_query.= " `alias`.`varAlias` as `service_alias`,";
			$service_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$service_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$service_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$service_search_query.= " FROM";
			$service_search_query.= " `services`";
			$service_search_query.=" LEFT JOIN `alias` ON `services`.`id`=`alias`.`fk_record_code`";
			$service_search_query.=" LEFT JOIN `images` ON `services`.`img_id`=`images`.`id`";
			$service_search_query.= " WHERE";
			$service_search_query.= " `services`.`chr_delete` = 'N'";
			$service_search_query.= " AND `services`.`chr_publish` = 'Y'";
			$service_search_query.= " AND `alias`.`fk_module_code` = '$service_code'";
			$service_search_query.= " AND ( ";
			$service_search_query.="soundex_match('".$searchGlobalValue."',services.title,' ') ";
			foreach ($arrSearchKeywords as $value){
				$service_search_query.=" OR ";
				$service_search_query.=" CONCAT_WS(' ',services.title) LIKE '%".$value."%' ";
			}
			$service_search_query.=" ) ";
			$service_search_query.=" GROUP BY `services`.`id`";
			$service_search_query.=" ORDER BY `services`.`title` ASC";
			$service_search_query.=" LIMIT 5";
			$serviceDetails = DB::select(DB::raw($service_search_query));
			if ($serviceDetails){
				$services = $serviceDetails;
				if(!empty($services)){
					$service_real = array();
					foreach($services as $key=>$value){
						if(!empty($value->service_id) && !empty($value->service_title)){
							$service_real[$key]['service_id'] = $value->service_id;
							$service_real[$key]['name'] = ucwords($value->service_title);
							$service_real[$key]['alias_name'] = $value->service_alias;
							if(!empty($value->thumb_url) && !empty($value->image_alt_tag) && !empty($value->image_extension)){
								$service_real[$key]['image_url'] = $value->thumb_url.'/'.$value->image_alt_tag.'.'.$value->image_extension;
							}else{
								$service_real[$key]['image_url'] = $image_url;
							}
							$service_real[$key]['type']='services';
							$service_real[$key]['title']='Services';
							$arrChunks = explode(" ",$value->service_title);
							$arrGuessKeywords[] = $value->service_title;
							foreach ($arrChunks as $value) {
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$service_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$staticblock_search_query = "SELECT";
			$staticblock_search_query.= " `static_blocks`.`id` as `staticblock_id`,";
			$staticblock_search_query.= " `static_blocks`.`title` as `staticblock_title`,";
			$staticblock_search_query.= " `alias`.`varAlias` as `staticblock_alias`";
			$staticblock_search_query.= " FROM";
			$staticblock_search_query.= " `static_blocks`";
			$staticblock_search_query.=" LEFT JOIN `alias` ON `static_blocks`.`id`=`alias`.`fk_record_code`";
			$staticblock_search_query.= " WHERE";
			$staticblock_search_query.= " `static_blocks`.`chr_delete` = 'N'";
			$staticblock_search_query.= " AND `static_blocks`.`chr_publish` = 'Y'";
			$staticblock_search_query.= " AND `alias`.`fk_module_code` = '$staticblock_code'";
			$staticblock_search_query.= " AND ( ";
			$staticblock_search_query.="soundex_match('".$searchGlobalValue."',static_blocks.title,' ') ";
			foreach ($arrSearchKeywords as $value){
				$staticblock_search_query.=" OR ";
				$staticblock_search_query.=" CONCAT_WS(' ',static_blocks.title) LIKE '%".$value."%' ";
			}
			$staticblock_search_query.=" ) ";
			$staticblock_search_query.=" GROUP BY `static_blocks`.`id`";
			$staticblock_search_query.=" ORDER BY `static_blocks`.`title` ASC";
			$staticblock_search_query.=" LIMIT 5";
			$staticblockDetails = DB::select(DB::raw($staticblock_search_query));
			if ($staticblockDetails){
				$staticblocks = $staticblockDetails;
				if(!empty($staticblocks)){
					$staticblock_real = array();
					foreach($staticblocks as $key=>$value){
						if(!empty($value->staticblock_id) && !empty($value->staticblock_title)){
							$staticblock_real[$key]['staticblock_id'] = $value->staticblock_id;
							$staticblock_real[$key]['name'] = ucwords($value->staticblock_title);
							$staticblock_real[$key]['alias_name'] = $value->staticblock_alias;
							$staticblock_real[$key]['image_url'] = $image_url;
							$staticblock_real[$key]['type']='staticblocks';
							$staticblock_real[$key]['title']='Static Blocks';
							$arrChunks = explode(" ",$value->staticblock_title);
							$arrGuessKeywords[] = $value->staticblock_title;
							foreach ($arrChunks as $value) {
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$staticblock_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$blog_search_query = "SELECT";
			$blog_search_query.= " `blog`.`id` as `blog_id`,";
			$blog_search_query.= " `blog`.`title` as `blog_title`,";
			$blog_search_query.= " `alias`.`varAlias` as `blog_alias`,";
			$blog_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$blog_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$blog_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$blog_search_query.= " FROM";
			$blog_search_query.= " `blog`";
			$blog_search_query.=" LEFT JOIN `alias` ON `blog`.`id`=`alias`.`fk_record_code`";
			$blog_search_query.=" LEFT JOIN `images` ON `blog`.`img_id`=`images`.`id`";
			$blog_search_query.= " WHERE";
			$blog_search_query.= " `blog`.`chr_delete` = 'N'";
			$blog_search_query.= " AND `blog`.`chr_publish` = 'Y'";
			$blog_search_query.= " AND `alias`.`fk_module_code` = '$blog_code'";
			$blog_search_query.= " AND ( ";
			$blog_search_query.="soundex_match('".$searchGlobalValue."',blog.title,' ') ";
			foreach ($arrSearchKeywords as $value){
				$blog_search_query.=" OR ";
				$blog_search_query.=" CONCAT_WS(' ',blog.title) LIKE '%".$value."%' ";
			}
			$blog_search_query.=" ) ";
			$blog_search_query.=" GROUP BY `blog`.`id`";
			$blog_search_query.=" ORDER BY `blog`.`title` ASC";
			$blog_search_query.=" LIMIT 5";
			$blogDetails = DB::select(DB::raw($blog_search_query));
			if ($blogDetails){
				$blogs = $blogDetails;
				if(!empty($blogs)){
					$blog_real = array();
					foreach($blogs as $key=>$value){
						if(!empty($value->blog_id) && !empty($value->blog_title)){
							$blog_real[$key]['blog_id'] = $value->blog_id;
							$blog_real[$key]['name'] = ucwords($value->blog_title);
							$blog_real[$key]['alias_name'] = $value->blog_alias;
							if(!empty($value->thumb_url) && !empty($value->image_alt_tag) && !empty($value->image_extension)){
								$blog_real[$key]['image_url'] = $value->thumb_url.'/'.$value->image_alt_tag.'.'.$value->image_extension;
							}else{
								$blog_real[$key]['image_url'] = $image_url;
							}
							$blog_real[$key]['type']='blog';
							$blog_real[$key]['title']='Blog';
							$arrChunks = explode(" ",$value->blog_title);
							$arrGuessKeywords[] = $value->blog_title;
							foreach ($arrChunks as $value) {
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$blog_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$testimonial_search_query = "SELECT";
			$testimonial_search_query.= " `testimonial`.`id` as `testimonial_id`,";
			$testimonial_search_query.= " `testimonial`.`testimonialby` as `testimonial_testimonialby`,";
			$testimonial_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$testimonial_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$testimonial_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$testimonial_search_query.= " FROM";
			$testimonial_search_query.= " `testimonial`";
			$testimonial_search_query.=" LEFT JOIN `images` ON `testimonial`.`fk_image_id`=`images`.`id`";
			$testimonial_search_query.= " WHERE";
			$testimonial_search_query.= " `testimonial`.`chr_delete` = 'N'";
			$testimonial_search_query.= " AND `testimonial`.`chr_publish` = 'Y'";
			$testimonial_search_query.= " AND ( ";
			$testimonial_search_query.="soundex_match('".$searchGlobalValue."',testimonial.testimonialby, ' ') ";
			foreach ($arrSearchKeywords as $value) {
				$testimonial_search_query.=" OR ";
				$testimonial_search_query.=" CONCAT_WS(' ',testimonial.testimonialby) LIKE '%".$value."%' ";
			}
			$testimonial_search_query.= " ) ";
			$testimonial_search_query.= " GROUP BY `testimonial`.`id`";
			$testimonial_search_query.= " ORDER BY `testimonial`.`testimonialby` ASC";
			$testimonial_search_query.=" LIMIT 5";
			$testimonialDetails = DB::select(DB::raw($testimonial_search_query));
			if($testimonialDetails){
				$testimonials = $testimonialDetails;
				if(!empty($testimonials)){
					$testimonial_real = array();
					foreach($testimonials as $key=>$value){
						if(!empty($value->testimonial_id) && !empty($value->testimonial_testimonialby)){
							$testimonial_real[$key]['testimonial_id'] = $value->testimonial_id;
							$testimonial_real[$key]['name'] = ucwords($value->testimonial_testimonialby);
							$testimonial_real[$key]['alias_name'] = Crypt::encrypt($value->testimonial_id);
							if(!empty($value->thumb_url) && !empty($value->image_alt_tag) && !empty($value->image_extension)){
								$testimonial_real[$key]['image_url'] = $value->thumb_url.'/'.$value->image_alt_tag.'.'.$value->image_extension;
							}else{
								$testimonial_real[$key]['image_url'] = $image_url;
							}
							$testimonial_real[$key]['type']='testimonials';	
							$testimonial_real[$key]['title']='Testimonial';	
							$arrChunks = explode(" ",$value->testimonial_testimonialby);
							$arrGuessKeywords[] = $value->testimonial_testimonialby;
							foreach ($arrChunks as $value){
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$testimonial_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$contact_search_query = "SELECT";
			$contact_search_query.= " `contactinfo`.`id` as `contact_id`,";
			$contact_search_query.= " `contactinfo`.`varTitle` as `contact_name`";
			$contact_search_query.= " FROM";
			$contact_search_query.= " `contactinfo`";
			$contact_search_query.= " WHERE";
			$contact_search_query.= " `contactinfo`.`is_delete` = 'N'";
			$contact_search_query.= " AND `contactinfo`.`is_publish` = 'Y'";
			$contact_search_query.= " AND ( ";
			$contact_search_query.="soundex_match('".$searchGlobalValue."',contactinfo.name, ' ') ";
			foreach ($arrSearchKeywords as $value) {
				$contact_search_query.=" OR ";
				$contact_search_query.=" CONCAT_WS(' ',contactinfo.name) LIKE '%".$value."%' ";
			}
			$contact_search_query.= " ) ";
			$contact_search_query.= " GROUP BY `contactinfo`.`id`";
			$contact_search_query.= " ORDER BY `contactinfo`.`varTitle` ASC";
			$contact_search_query.=" LIMIT 5";
			$contactDetails = DB::select(DB::raw($contact_search_query));
			if($contactDetails){
				$contacts = $contactDetails;
				if(!empty($contacts)){
					$contact_real = array();
					foreach($contacts as $key=>$value){
						if(!empty($value->contact_id) && !empty($value->contact_name)){
							$contact_real[$key]['contact_id'] = $value->contact_id;
							$contact_real[$key]['name'] = ucwords($value->contact_name);
							$contact_real[$key]['alias_name'] = Crypt::encrypt($value->contact_id);
							$contact_real[$key]['image_url'] = $image_url;
							$contact_real[$key]['type']='contacts';	
							$contact_real[$key]['title']='Contact';	
							$arrChunks = explode(" ",$value->contact_name);
							$arrGuessKeywords[] = $value->contact_name;
							foreach ($arrChunks as $value){
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$contact_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$user_search_query = "SELECT";
			$user_search_query.= " `users`.`id` as `user_id`,";
			$user_search_query.= " `users`.`varTitle` as `user_name`";
			$user_search_query.= " FROM";
			$user_search_query.= " `users`";
			$user_search_query.= " WHERE";
			$user_search_query.= " `users`.`chr_delete` = 'N'";
			$user_search_query.= " AND `users`.`chr_publish` = 'Y'";
			$user_search_query.= " AND ( ";
			$user_search_query.="soundex_match('".$searchGlobalValue."',users.name, ' ') ";
			foreach ($arrSearchKeywords as $value) {
				$user_search_query.=" OR ";
				$user_search_query.=" CONCAT_WS(' ',users.name) LIKE '%".$value."%' ";
			}
			$user_search_query.= " ) ";
			$user_search_query.= " GROUP BY `users`.`id`";
			$user_search_query.= " ORDER BY `users`.`varTitle` ASC";
			$user_search_query.=" LIMIT 5";
			$userDetails = DB::select(DB::raw($user_search_query));
			if($userDetails){
				$users = $userDetails;
				if(!empty($users)){
					$user_real = array();
					foreach($users as $key=>$value){
						if(!empty($value->user_id) && !empty($value->user_name)){
							$user_real[$key]['user_id'] = $value->user_id;
							$user_real[$key]['name'] = ucwords($value->user_name);
							$user_real[$key]['alias_name'] = Crypt::encrypt($value->user_id);
							$user_real[$key]['image_url'] = $image_url;
							$user_real[$key]['type']='users';	
							$user_real[$key]['title']='User';	
							$arrChunks = explode(" ",$value->user_name);
							$arrGuessKeywords[] = $value->user_name;
							foreach ($arrChunks as $value){
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$user_real=array();
						}
					}
				}
			}
		}		
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$sponsor_search_query = "SELECT";
			$sponsor_search_query.= " `sponser`.`id` as `sponsor_id`,";
			$sponsor_search_query.= " `sponser`.`varTitle` as `sponsor_name`,";			
			$sponsor_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$sponsor_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$sponsor_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$sponsor_search_query.= " FROM";
			$sponsor_search_query.= " `sponser`";			
			$sponsor_search_query.=" 	LEFT JOIN `images` ON `sponser`.`fk_image_id`=`images`.`id`";			
			$sponsor_search_query.= " WHERE";
			$sponsor_search_query.= " `sponser`.`chr_delete` = 'N'";
			$sponsor_search_query.= " AND `sponser`.`chr_publish` = 'Y'";			
			$sponsor_search_query.= " AND ( ";
			$sponsor_search_query.= "soundex_match('".$searchGlobalValue."',sponser.name,' ') ";
			foreach ($arrSearchKeywords as $value){
				$sponsor_search_query.= " OR ";
				$sponsor_search_query.= " CONCAT_WS(' ',sponser.name) LIKE '%".$value."%' ";
			}
			$sponsor_search_query.= " ) ";
			$sponsor_search_query.= " GROUP BY `sponser`.`id`";
			$sponsor_search_query.= " ORDER BY `sponser`.`varTitle` ASC";
			$sponsor_search_query.= " LIMIT 5";			
			$sponsorDetails = DB::select(DB::raw($sponsor_search_query));			
			if ($sponsorDetails){
				$sponsors = $sponsorDetails;
				if(!empty($sponsors)){
					$sponsor_real = array();					
					foreach($sponsors as $key=>$value){
						if(!empty($value->sponsor_id) && !empty($value->sponsor_name)){
							$sponsor_real[$key]['sponsor_id'] = $value->sponsor_id;
							$sponsor_real[$key]['name'] = ucwords($value->sponsor_name);
							$sponsor_real[$key]['alias_name'] = Crypt::encrypt($value->sponsor_id);
							$sponsor_real[$key]['image_url'] = $image_url;
							$sponsor_real[$key]['type']='sponsors';	
							$sponsor_real[$key]['title']='Sponsors';	
							$arrChunks = explode(" ",$value->sponsor_name);
							$arrGuessKeywords[] = $value->sponsor_name;
							foreach ($arrChunks as $value){
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$sponsor_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$video_album_search_query = "SELECT";
			$video_album_search_query.= " `video_album`.`id` as `video_album_id`,";
			$video_album_search_query.= " `video_album`.`title` as `video_album_title`,";
			$video_album_search_query.= " `alias`.`varAlias` as `video_album_alias`,";
			$video_album_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$video_album_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$video_album_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$video_album_search_query.= " FROM";
			$video_album_search_query.= " `video_album`";
			$video_album_search_query.=" LEFT JOIN `alias` ON `video_album`.`id`=`alias`.`fk_record_code`";
			$video_album_search_query.=" LEFT JOIN `modules` ON `alias`.`fk_module_code`=`modules`.`int_code`";
			$video_album_search_query.=" LEFT JOIN `images` ON `video_album`.`video_id`=`images`.`id`";
			$video_album_search_query.= " WHERE";
			$video_album_search_query.= " `video_album`.`chr_delete` = 'N'";
			$video_album_search_query.= " AND `video_album`.`chr_publish` = 'Y'";
			$video_album_search_query.= " AND `modules`.`var_module_name` = 'video-album'";
			$video_album_search_query.= " AND ( ";
			$video_album_search_query.="soundex_match('".$searchGlobalValue."',video_album.title,' ') ";
			foreach ($arrSearchKeywords as $value){
				$video_album_search_query.=" OR ";
				$video_album_search_query.=" CONCAT_WS(' ',video_album.title) LIKE '%".$value."%' ";
			}
			$video_album_search_query.=" ) ";
			$video_album_search_query.=" GROUP BY `video_album`.`id`";
			$video_album_search_query.=" ORDER BY `video_album`.`title` ASC";
			$video_album_search_query.=" LIMIT 5";
			$video_albumDetails = DB::select(DB::raw($video_album_search_query));
			if ($video_albumDetails){
				$video_album = $video_albumDetails;
				if(!empty($video_album)){
					$video_album_real = array();
					foreach($video_album as $key=>$value){
						if(!empty($value->video_album_id) && !empty($value->video_album_title)){
							$video_album_real[$key]['video_album_id'] = $value->video_album_id;
							$video_album_real[$key]['name'] = ucwords($value->video_album_title);
							$video_album_real[$key]['alias_name'] = $value->video_album_alias;
							if(!empty($value->thumb_url) && !empty($value->image_alt_tag) && !empty($value->image_extension)){
								$video_album_real[$key]['image_url'] = $value->thumb_url.'/'.$value->image_alt_tag.'.'.$value->image_extension;
							}else{
								$video_album_real[$key]['image_url'] = $image_url;
							}
							$video_album_real[$key]['type']='video-album';
							$video_album_real[$key]['title']='Video album';
							$arrChunks = explode(" ",$value->video_album_title);
							$arrGuessKeywords[] = $value->video_album_title;
							foreach ($arrChunks as $value) {
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$video_album_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$photo_album_search_query = "SELECT";
			$photo_album_search_query.= " `photo_album`.`id` as `photo_album_id`,";
			$photo_album_search_query.= " `photo_album`.`title` as `photo_album_title`,";
			$photo_album_search_query.= " `alias`.`varAlias` as `photo_album_alias`,";
			$photo_album_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$photo_album_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$photo_album_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$photo_album_search_query.= " FROM";
			$photo_album_search_query.= " `photo_album`";
			$photo_album_search_query.=" LEFT JOIN `alias` ON `photo_album`.`id`=`alias`.`fk_record_code`";
			$photo_album_search_query.=" LEFT JOIN `modules` ON `alias`.`fk_module_code`=`modules`.`int_code`";
			$photo_album_search_query.=" LEFT JOIN `images` ON `photo_album`.`img_id`=`images`.`id`";
			$photo_album_search_query.= " WHERE";
			$photo_album_search_query.= " `photo_album`.`chr_delete` = 'N'";
			$photo_album_search_query.= " AND `photo_album`.`chr_publish` = 'Y'";
			$photo_album_search_query.= " AND `modules`.`var_module_name` = 'photo-album'";
			$photo_album_search_query.= " AND ( ";
			$photo_album_search_query.="soundex_match('".$searchGlobalValue."',photo_album.title,' ') ";
			foreach ($arrSearchKeywords as $value){
				$photo_album_search_query.=" OR ";
				$photo_album_search_query.=" CONCAT_WS(' ',photo_album.title) LIKE '%".$value."%' ";
			}
			$photo_album_search_query.=" ) ";
			$photo_album_search_query.=" GROUP BY `photo_album`.`id`";
			$photo_album_search_query.=" ORDER BY `photo_album`.`title` ASC";
			$photo_album_search_query.=" LIMIT 5";
			$photo_albumDetails = DB::select(DB::raw($photo_album_search_query));
			if ($photo_albumDetails){
				$photo_album = $photo_albumDetails;
				if(!empty($photo_album)){
					$photo_album_real = array();
					foreach($photo_album as $key=>$value){
						if(!empty($value->photo_album_id) && !empty($value->photo_album_title)){
							$photo_album_real[$key]['photo_album_id'] = $value->photo_album_id;
							$photo_album_real[$key]['name'] = ucwords($value->photo_album_title);
							$photo_album_real[$key]['alias_name'] = $value->photo_album_alias;
							if(!empty($value->thumb_url) && !empty($value->image_alt_tag) && !empty($value->image_extension)){
								$photo_album_real[$key]['image_url'] = $value->thumb_url.'/'.$value->image_alt_tag.'.'.$value->image_extension;
							}else{
								$photo_album_real[$key]['image_url'] = $image_url;
							}
							$photo_album_real[$key]['type']='photo-album';
							$photo_album_real[$key]['title']='Photo album';
							$arrChunks = explode(" ",$value->photo_album_title);
							$arrGuessKeywords[] = $value->photo_album_title;
							foreach ($arrChunks as $value) {
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$photo_album_real=array();
						}
					}
				}
			}
		}
		if(!empty($searchGlobalValue)){
			$arrSearchKeywords = explode(" ", $searchGlobalValue);
			$news_search_query = "SELECT";
			$news_search_query.= " `news`.`id` as `news_id`,";
			$news_search_query.= " `news`.`title` as `news_title`,";
			$news_search_query.= " `alias`.`varAlias` as `news_alias`,";
			$news_search_query.= " `images`.`txt_image_url` as `thumb_url`,";
			$news_search_query.= " `images`.`txt_image_alt_tag` as `image_alt_tag`,";
			$news_search_query.= " `images`.`var_image_extension` as `image_extension`";
			$news_search_query.= " FROM";
			$news_search_query.= " `news`";
			$news_search_query.=" LEFT JOIN `alias` ON `news`.`id`=`alias`.`fk_record_code`";
			$news_search_query.=" LEFT JOIN `modules` ON `alias`.`fk_module_code`=`modules`.`int_code`";
			$news_search_query.=" LEFT JOIN `images` ON `news`.`img_id`=`images`.`id`";
			$news_search_query.= " WHERE";
			$news_search_query.= " `news`.`chr_delete` = 'N'";
			$news_search_query.= " AND `news`.`chr_publish` = 'Y'";
			$news_search_query.= " AND `modules`.`var_module_name` = 'news'";
			$news_search_query.= " AND ( ";
			$news_search_query.="soundex_match('".$searchGlobalValue."',news.title,' ') ";
			foreach ($arrSearchKeywords as $value){
				$news_search_query.=" OR ";
				$news_search_query.=" CONCAT_WS(' ',news.title) LIKE '%".$value."%' ";
			}
			$news_search_query.=" ) ";
			$news_search_query.=" GROUP BY `news`.`id`";
			$news_search_query.=" ORDER BY `news`.`title` ASC";
			$news_search_query.=" LIMIT 5";
			$newsDetails = DB::select(DB::raw($news_search_query));
			if ($newsDetails){
				$news = $newsDetails;
				if(!empty($news)){
					$news_real = array();
					foreach($news as $key=>$value){
						if(!empty($value->news_id) && !empty($value->news_title)){
							$news_real[$key]['news_id'] = $value->news_id;
							$news_real[$key]['name'] = ucwords($value->news_title);
							$news_real[$key]['alias_name'] = $value->news_alias;
							if(!empty($value->thumb_url) && !empty($value->image_alt_tag) && !empty($value->image_extension)){
								$news_real[$key]['image_url'] = $value->thumb_url.'/'.$value->image_alt_tag.'.'.$value->image_extension;
							}else{
								$news_real[$key]['image_url'] = $image_url;
							}
							$news_real[$key]['type']='news';
							$news_real[$key]['title']='News';
							$arrChunks = explode(" ",$value->news_title);
							$arrGuessKeywords[] = $value->news_title;
							foreach ($arrChunks as $value) {
								if(strlen($value) >= 4){
									//$arrGuessKeywords[] = strtolower($value);
								}
							}
						}else{
							$news_real=array();
						}
					}
				}
			}
		}
		$response['guess_words'] =  false;
		if(!empty($arrGuessKeywords)){
			$percent = null;
			$found = GlobalSearch::closest_word($searchGlobalValue,$arrGuessKeywords,$percent);
			$match = round($percent*100,2);
			$response['guess_words'] = $found;
		}
		$response['matches'] = array_merge($news_real,$photo_album_real,$video_album_real,$sponsor_real,$team_real,$faq_real,$cmspage_real,$banner_real,$service_real,$staticblock_real,$blog_real,$testimonial_real,$contact_real,$user_real);
		return $response;
	}
	static function closest_word($input,$words,&$percent=null) {
		$shortest = -1;
		foreach ($words as $word) {
			$lev = levenshtein($input,$word);
			if ($lev == 0) {
				$closest = $word;
				$shortest = 0;
				break;
			}
			if ($lev <= $shortest || $shortest < 0) {
				$closest  = $word;
				$shortest = $lev;
			}
		}
		$percent = 1-levenshtein($input,$closest)/max(strlen($input),strlen($closest));
		return $closest;
	}
}