<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Trash extends Model
{ 

	static function total_deleted_faqs()
	{
		return DB::table('faq')   
		->where('faq.chr_delete','=','Y')   
		->count();
	}

	static function list_faq($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$emailtypeFilter = false)
	{

			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('faq')             
							->where('faq.chr_delete','=','Y')             
							->groupBy('faq.id');              
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
			}else{
					$data = $query->orderBy('faq.id','ASC')->get();
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit)->get();
			}
			if(!empty($searchFilter)){
					$data = $query->whereRaw('(faq.question LIKE "%'.$searchFilter.'%" or faq.answer LIKE "%'.$searchFilter.'%")')->get();
			}

			if(!empty($data)){
					$response = true;
					return $data;
			}
	}



	static function total_deleted_team()
	{
		return DB::table('team')
		->leftJoin('alias','team.id','=','alias.fk_record_code')
		->select('team.*','alias.alias')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','team')
		->where('team.chr_delete','=','Y')
		->count();
	}

	static function list_team($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$emailtypeFilter = false)
	{
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('team')
							->leftJoin('alias','team.id','=','alias.fk_record_code')
							->select('team.*','alias.alias')
							->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
							->where('modules.var_module_name','=','team')
							->where('team.chr_delete','=','Y')
							->groupBy('team.id');
							
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
			}else{
					$data = $query->orderBy('team.id','ASC')->get();
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit)->get();
			}
			if(!empty($searchFilter)){
					$data = $query->whereRaw('(team.name LIKE "%'.$searchFilter.'%" or team.description LIKE "%'.$searchFilter.'%"  or team.tag_line LIKE "%'.$searchFilter.'%")')->get();
			}

			if(!empty($data)){
					$response = true;
					return $data;
			}
	}

	static function total_deleted_banner()
	{
		return DB::table('banner')      
			->where('banner.chr_delete','=','Y')->count();
	}

	static function list_banner($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false, $bannerFilter = false)
	{
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('banner')      
			->where('banner.chr_delete','=','Y')
			->groupBy('banner.id');
		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
			$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
		}else{
			$data = $query->orderBy('banner.id','ASC')->get();
		}
		if(!empty($limit)){
			$data = $query->skip($start)->take($limit)->get();
		}
		if(!empty($searchFilter)){
			$data = $query->whereRaw('(banner.title LIKE "%'.$searchFilter.'%")')->get();
		}
		if(!empty($statusFilter)){
			$data = $query->where('banner.display_order',$statusFilter)->get();  
		}
		if(!empty($bannerFilter)){
			$data = $query->where('banner.banner_type',$bannerFilter)->get();   
		}
		if(!empty($data)){
			$response = $data;
		}
		return $response;
	}

	static function total_deleted_cmsPage()
	{

		return DB::table('cms_pages')
		->select('cms_pages.*','alias.alias')
		->leftJoin('alias','cms_pages.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','cms-page')
		->where('cms_pages.chr_publish','=','N')
		->where('cms_pages.chr_delete','=','Y')
		->count();
	}
	
	static function list_cmsPage($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false)
	{
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('cms_pages')
						->select('cms_pages.*','alias.alias')
						->leftJoin('alias','cms_pages.id','=','alias.fk_record_code')
						->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
						->where('modules.var_module_name','=','cms-page')
						->where('cms_pages.chr_publish','=','N')
						->where('cms_pages.chr_delete','=','Y')
						->groupBy('cms_pages.id');

		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
				$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
		}else{
				$data = $query->orderBy('cms_pages.id','ASC')->get();
		}

		if(!empty($limit)){
				$data = $query->skip($start)->take($limit)->get();
		}

		if(!empty($searchFilter)) 
		{
				$data = $query->whereRaw('(cms_pages.var_title LIKE "%'.$searchFilter.'%" or cms_pages.chr_display LIKE "%'.$searchFilter.'%")')->get();
		}

		if(!empty($statusFilter))
		{
				$data = $query->where('cms_pages.chr_display',$statusFilter)->get();  
		}

		if(!empty($data))
		{
				$response = $data;
		}   
		return $response;
	}

	static function total_deleted_user()
	{
		return DB::table('users')
		->leftJoin('role_user','users.id','=','role_user.user_id')
		->leftJoin('roles','role_user.role_id','=','roles.id')
		->where('users.chr_delete','=','Y')
		->select('users.*','role_user.role_id','roles.display_name')
		->count();
	}

	static function list_user($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$emailtypeFilter = false) 
	{
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('users')
			->leftJoin('role_user','users.id','=','role_user.user_id')
			->leftJoin('roles','role_user.role_id','=','roles.id')
			->where('users.chr_delete','=','Y')
			->select('users.*','role_user.role_id','roles.display_name')
			->groupBy('users.id');
		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
			$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
		}else{
			$data = $query->orderBy('users.id','ASC')->get();
		}
		if(!empty($limit)){
			$data = $query->skip($start)->take($limit)->get();
		}
		if(!empty($searchFilter)){
			$data = $query->whereRaw('(users.name LIKE "%'.$searchFilter.'%" or users.email LIKE "%'.$searchFilter.'%")')->get();
		}
		if(!empty($data)){
			$response = true;
			return $data;
		}
	}

	static function total_deleted_services()
	{
		return DB::table('services')
		->select('services.*','alias.alias')
		->leftJoin('alias','services.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','services')
		->where('services.chr_publish','=','N')
		->where('services.chr_delete','=','Y')
		->count();
	}

	static function list_services($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {      
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('services')
				->select(
					'services.*',
					'alias.alias'       
				)       
				->leftJoin('alias','services.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','services')
				->where('services.chr_delete','=','Y')        
				->groupBy('services.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('services.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(services.title LIKE "%'.$searchFilter.'%" or services.description LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('services.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_testimonial()
	{
		return DB::table('testimonial')     
			->where('testimonial.chr_delete','=','Y')->count();
	}

	static function list_testimonial($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false)
	{
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('testimonial')     
			->where('testimonial.chr_delete','=','Y')
			->groupBy('testimonial.id');
		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
			$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
		}else{
			$data = $query->orderBy('testimonial.id','ASC')->get();
		}
		if(!empty($limit)){
			$data = $query->skip($start)->take($limit)->get();
		}
		if(!empty($searchFilter)){
			$data = $query->whereRaw('(testimonial.testimonialby LIKE "%'.$searchFilter.'%")')->get();
		}
		if(!empty($statusFilter)){
			$data = $query->where('testimonial.chr_publish',$statusFilter)->get();  
		}   
		if(!empty($data)){
			$response = $data;
		}
		return $response;
	}

	static function total_deleted_contacts()
	{
		return DB::table('contactinfo')     
			->where('contactinfo.is_delete','=','Y')
			->where('contactinfo.is_publish','=','N')
			->count();
	}

	static function list_contactinfo($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false)
	{
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('contactinfo')     
			->where('contactinfo.is_delete','=','Y')
			->where('contactinfo.is_publish','=','N')
			->groupBy('contactinfo.id');
		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
			$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
		}else{
			$data = $query->orderBy('contactinfo.id','ASC')->get();
		}
		if(!empty($limit)){
			$data = $query->skip($start)->take($limit)->get();
		}
		if(!empty($searchFilter)){
			$data = $query->whereRaw('(contactinfo.name LIKE "%'.$searchFilter.'%")')->get();
		}
		if(!empty($statusFilter)){
			$data = $query->where('contactinfo.is_publish',$statusFilter)->get();  
		}   
		if(!empty($data)){
			$response = $data;
		}
		return $response;
	}

	static function total_deleted_roles()
	{
		return DB::table('roles')     
			->where('roles.chr_delete','=','Y')->count();
	}

	static function list_roles($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false)
	{
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('roles')     
			->where('roles.chr_delete','=','Y')
			->groupBy('roles.id');
		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
			$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
		}else{
			$data = $query->orderBy('roles.id','ASC')->get();
		}
		if(!empty($limit)){
			$data = $query->skip($start)->take($limit)->get();
		}
		if(!empty($searchFilter)){
			$data = $query->whereRaw('(roles.name LIKE "%'.$searchFilter.'%")')->get();
		}
		if(!empty($statusFilter)){
			$data = $query->where('roles.chr_publish',$statusFilter)->get();  
		}   
		if(!empty($data)){
			$response = $data;
		}
		return $response;
	}

	static function total_deleted_menu()
	{
		return DB::table('menu')      
			->where('menu.chr_delete','=','Y')->count();
	}

	static function list_menu($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false)
	{
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('menu')      
			->where('menu.chr_delete','=','Y')
			->groupBy('menu.id');
		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
			$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
		}else{
			$data = $query->orderBy('menu.id','ASC')->get();
		}
		if(!empty($limit)){
			$data = $query->skip($start)->take($limit)->get();
		}
		if(!empty($searchFilter)){
			$data = $query->whereRaw('(menu.title LIKE "%'.$searchFilter.'%")')->get();
		}
		if(!empty($statusFilter)){
			$data = $query->where('menu.chr_publish',$statusFilter)->get();  
		}   
		if(!empty($data)){
			$response = $data;
		}
		return $response;
	}

	static function total_deleted_statick_blocks()
	{
		return DB::table('static_blocks')
		->select('static_blocks.*','alias.alias')
		->leftJoin('alias','static_blocks.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','staticblocks')
		->where('static_blocks.chr_publish','=','N')
		->where('static_blocks.chr_delete','=','Y')
		->count();
	}

	static function list_statick_blocks($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {      
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('static_blocks')
				->select(
					'static_blocks.*',
					'alias.alias'       
				)       
				->leftJoin('alias','static_blocks.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code') 
				->where('modules.var_module_name','=','staticblocks')         
				->where('static_blocks.chr_delete','=','Y')       
				->groupBy('static_blocks.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('static_blocks.id','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(static_blocks.title LIKE "%'.$searchFilter.'%" or static_blocks.description LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('static_blocks.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_sponsors()
	{
		return DB::table('sponser')     
			->where('sponser.chr_delete','=','Y')->count();
	}

	static function list_sponsors($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false)
	{
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('sponser')     
			->where('sponser.chr_delete','=','Y')
			->groupBy('sponser.id');
		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
			$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc)->get();
		}else{
			$data = $query->orderBy('sponser.id','ASC')->get();
		}
		if(!empty($limit)){
			$data = $query->skip($start)->take($limit)->get();
		}
		if(!empty($searchFilter)){
			$data = $query->whereRaw('(sponser.name LIKE "%'.$searchFilter.'%")')->get();
		}
		if(!empty($statusFilter)){
			$data = $query->where('sponser.chr_publish',$statusFilter)->get();  
		}   
		if(!empty($data)){
			$response = $data;
		}
		return $response;
	}

	static function total_deleted_blogs()
	{
		return DB::table('blog')
		->select('blog.*','alias.alias')
		->leftJoin('alias','blog.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','blog')
		->where('blog.chr_delete','=','Y')
		->count();
	}

	static function list_blogs($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('blog')
				->select(
					'blog.*',
					'alias.alias'       
				)       
				->leftJoin('alias','blog.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','blog')
				->where('blog.chr_delete','=','Y')        
				->groupBy('blog.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('blog.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(blog.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('blog.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_news()
	{
		return DB::table('news')
		->select('news.*','alias.alias')
		->leftJoin('alias','news.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','news')
		->where('news.chr_delete','=','Y')
		->count();
	}

	static function list_news($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {      
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('news')
				->select(
					'news.*',
					'alias.alias'       
				)       
				->leftJoin('alias','news.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','news')
				->where('news.chr_delete','=','Y')        
				->groupBy('news.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('news.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(news.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('news.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_news_category()
	{
		return DB::table('news_category')
		->select('news_category.*','alias.alias')
		->leftJoin('alias','news_category.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','news-category')
		->where('news_category.chr_delete','=','Y')
		->count();
	}

	static function list_news_category($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('news_category')
				->select(
					'news_category.*',
					'alias.alias'       
				)       
				->leftJoin('alias','news_category.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','news-category')
				->where('news_category.chr_delete','=','Y')       
				->groupBy('news_category.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('news_category.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(news_category.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('news_category.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_blog_category()
	{
		return DB::table('blog_category')
		->select('blog_category.*','alias.alias')
		->leftJoin('alias','blog_category.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','blog-category')
		->where('blog_category.chr_delete','=','Y')
		->count();
	}

	static function list_blog_category($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('blog_category')
				->select(
					'blog_category.*',
					'alias.alias'       
				)       
				->leftJoin('alias','blog_category.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','blog-category')
				->where('blog_category.chr_delete','=','Y')       
				->groupBy('blog_category.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('blog_category.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(blog_category.name LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('blog_category.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}	

	static function total_deleted_service_category()
	{
		return DB::table('services_category')
		->select('services_category.*','alias.alias')
		->leftJoin('alias','services_category.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','services-category')
		->where('services_category.chr_delete','=','Y')
		->count();
	}

	static function list_service_category($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('services_category')
				->select(
					'services_category.*',
					'alias.alias'       
				)       
				->leftJoin('alias','services_category.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','services-category')
				->where('services_category.chr_delete','=','Y')       
				->groupBy('services_category.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('services_category.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(services_category.name LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('services_category.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}



	static function total_deleted_photo_album()
	{
		return DB::table('photo_album')
		->select('photo_album.*','alias.alias')
		->leftJoin('alias','photo_album.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','photo-album')
		->where('photo_album.chr_delete','=','Y')
		->count();
	}

	static function list_photo_album($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('photo_album')
				->select(
					'photo_album.*',
					'alias.alias'       
				)       
				->leftJoin('alias','photo_album.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','photo-album')
				->where('photo_album.chr_delete','=','Y')       
				->groupBy('photo_album.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('photo_album.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(photo_album.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('photo_album.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}


	static function total_deleted_video_album()
	{
		return DB::table('video_album')
		->select('video_album.*','alias.alias')
		->leftJoin('alias','video_album.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','video-album')
		->where('video_album.chr_delete','=','Y')
		->count();
	}

	static function list_video_album($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('video_album')
				->select(
					'video_album.*',
					'alias.alias'       
				)       
				->leftJoin('alias','video_album.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','video-album')
				->where('video_album.chr_delete','=','Y')       
				->groupBy('video_album.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('video_album.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(video_album.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('video_album.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}


	static function total_deleted_events()
	{
		return DB::table('events')
		->select('events.*','alias.alias')
		->leftJoin('alias','events.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','events')
		->where('events.chr_delete','=','Y')
		->count();
	}

	static function list_events($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('events')
				->select(
					'events.*',
					'alias.alias'       
				)       
				->leftJoin('alias','events.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','events')
				->where('events.chr_delete','=','Y')       
				->groupBy('events.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('events.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(events.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('events.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_show_category()
	{
		return DB::table('show_category')
		->select('show_category.*','alias.alias')
		->leftJoin('alias','show_category.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','show-category')
		->where('show_category.chr_delete','=','Y')
		->count();
	}

	static function get_show_category_list($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('show_category')
				->select(
					'show_category.*',
					'alias.alias'       
				)       
				->leftJoin('alias','show_category.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','show-category')
				->where('show_category.chr_delete','=','Y')       
				->groupBy('show_category.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('show_category.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(show_category.name LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('show_category.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_product_category()
	{
		return DB::table('product_category')
		->select('product_category.*','alias.alias')
		->leftJoin('alias','product_category.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','product-category')
		->where('product_category.chr_delete','=','Y')
		->count();
	}

	static function get_product_category_list($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('product_category')
				->select(
					'product_category.*',
					'alias.alias'       
				)       
				->leftJoin('alias','product_category.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','product-category')
				->where('product_category.chr_delete','=','Y')       
				->groupBy('product_category.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('product_category.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(product_category.name LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('product_category.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}


	static function total_deleted_products()
	{
		return DB::table('products')
		->select('products.*','alias.alias')
		->leftJoin('alias','products.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','product')
		->where('products.chr_delete','=','Y')
		->count();
	}

	static function list_products($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('products')
				->select(
					'products.*',
					'alias.alias'       
				)       
				->leftJoin('alias','products.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','product')
				->where('products.chr_delete','=','Y')       
				->groupBy('products.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('products.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(products.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('products.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}


	static function total_deleted_shows()
	{
		return DB::table('shows')
		->select('shows.*','alias.alias')
		->leftJoin('alias','shows.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','shows')
		->where('shows.chr_delete','=','Y')
		->count();
	}

	static function list_shows($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('shows')
				->select(
					'shows.*',
					'alias.alias'       
				)       
				->leftJoin('alias','shows.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','shows')
				->where('shows.chr_delete','=','Y')       
				->groupBy('shows.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('shows.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(shows.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('shows.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_authors()
	{
		return DB::table('authors')
		->select('authors.*','alias.alias')
		->leftJoin('alias','authors.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','author')
		->where('authors.chr_delete','=','Y')
		->count();
	}

	static function list_authors($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('authors')
				->select(
					'authors.*',
					'alias.alias'       
				)       
				->leftJoin('alias','authors.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','author')
				->where('authors.chr_delete','=','Y')       
				->groupBy('authors.id');
			if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
					$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
			}else{
					$data = $query->orderBy('authors.display_order','ASC');
			}
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(authors.title LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('authors.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_adv_slots()
	{
		return DB::table('adv_slots')
		->select('adv_slots.*','alias.alias')
		->leftJoin('alias','adv_slots.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','adv-slot')
		->where('adv_slots.chr_delete','=','Y')
		->count();
	}

	static function list_adv_slots($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('adv_slots')
				->select(
					'adv_slots.*',
					'alias.alias'       
				)       
				->leftJoin('alias','adv_slots.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','adv-slot')
				->where('adv_slots.chr_delete','=','Y')       
				->groupBy('adv_slots.id');
			
			$data = $query->orderBy('adv_slots.updated_at','DESC');
			
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(adv_slots.slot_name LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('adv_slots.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}

	static function total_deleted_adv()
	{
		return DB::table('adv')
		->select('adv.*','alias.alias')
		->leftJoin('alias','adv.id','=','alias.fk_record_code')
		->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
		->where('modules.var_module_name','=','adv')
		->where('adv.chr_delete','=','Y')
		->count();
	}

	static function list_adv($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$statusFilter = false) {     
			$response = false;
			$data = '';
			$query = '';
			$query = DB::table('adv')
				->select(
					'adv.*',
					'alias.alias'       
				)       
				->leftJoin('alias','adv.id','=','alias.fk_record_code')
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=','adv')
				->where('adv.chr_delete','=','Y')       
				->groupBy('adv.id');
			
			$data = $query->orderBy('adv.updated_at','DESC');
			
			if(!empty($limit)){
					$data = $query->skip($start)->take($limit);
			}
			if(!empty($searchFilter)){
				$data = $query->whereRaw('(adv.slot_name LIKE "%'.$searchFilter.'%")');
			}   
			if(!empty($statusFilter) && $statusFilter != ' '){
				$data = $query->where('adv.chr_publish','=',$statusFilter);  
			}
			if(!empty($data)){
				$response = $data->get();
			}
			return $response;
	}


	static function destroySingle($id,$table,$moduleName=null)
	{
		if($table == 'blog'){           
				echo 'Delete has been disabled for blogs!';
				// $blog = Blog::find($id);
				// $blog->alias()->delete();
				// $blog->delete();     
		}else{
			DB::table($table)->where('id','=',$id)->delete();
			//Query only for alias enabled records
			$ignore = array('users','faq','banner','testimonial','contactinfo','roles','sponser','menu');
			if(!in_array($table, $ignore) && $moduleName!=null ){ 
				DB::table('alias')->where('fk_record_code','=',$id)
				->leftJoin('modules','modules.int_code','=','alias.fk_module_code')
				->where('modules.var_module_name','=',$moduleName)
				->delete();
			}
			//Query only for galary images records
			if($table=='photo_album'){
				DB::table('photo_gallery')->where('fk_album_id','=',$id)->delete();
			}

			if($table=='video_album'){
				DB::table('video_gallery')->where('fk_album_id','=',$id)->delete();
			}

		}
	}

	static function restoreSingle($id,$table)
	{
		
		$total = DB::table($table)->where(['chr_delete' => 'N','chr_publish' => 'Y'])->count();
		$ignore = array('contactinfo');
		
		if( in_array($table, $ignore) ){
			DB::table($table)
			->where('id', $id)
			->update([
				'is_publish' => 'Y', 
				'is_delete' => 'N',
				'display_order' => ($total)
			]);
		}else{

			$dataUpdate=['chr_publish' => 'Y', 'chr_delete' => 'N'];
			if($table!='adv_slots' && $table!='adv'){ $dataUpdate['display_order'] = $total; }
			DB::table($table)->where('id', $id)->update($dataUpdate);

			//Query only for galary images records
			if($table=='photo_album'){        
				DB::table('photo_gallery')->where('fk_album_id','=',$id)->update(['chr_publish' => 'Y', 'chr_delete' => 'N','display_order' => ($total)]);
			}

			if($table=='video_album'){        
				DB::table('video_gallery')->where('fk_album_id','=',$id)->update(['chr_publish' => 'Y', 'chr_delete' => 'N','display_order' => ($total)]);
			}

		}
	}
}