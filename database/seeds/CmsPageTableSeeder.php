<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Helpers\MyLibrary;
use App\Http\Traits\slug;

class CmsPageTableSeeder extends Seeder
{
		public function run()
		{
			$moduleCode = DB::table('module')->select('id')->where('varModuleName','pages')->first();		
							
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Home')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Home',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Home')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Home',
						'varMetaKeyword' => 'Home',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Blog')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Blog',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Blog')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Blog',
						'varMetaKeyword' => 'Blog',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Contact Lead')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Contact Lead',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Contact Lead')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Contact Lead',
						'varMetaKeyword' => 'Contact Lead',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);

					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Appointment Lead')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Book Appointment',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Book Appointment')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Book Appointment',
						'varMetaKeyword' => 'Book Appointment',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','FAQ')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'FAQ',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('FAQ')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'FAQ',
						'varMetaKeyword' => 'FAQ',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Services')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Services',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Services')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Services',
						'varMetaKeyword' => 'Services',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Testimonial')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Testimonial',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Testimonial')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Testimonial',
						'varMetaKeyword' => 'Testimonial',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Team')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Team',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Team')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Team',
						'varMetaKeyword' => 'Team',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Pages')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Pages',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Pages')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Pages',
						'varMetaKeyword' => 'Pages',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','News')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'News',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('News')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'News',
						'varMetaKeyword' => 'News',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Photo Album')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Photo Album',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Photo Album')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Photo Album',
						'varMetaKeyword' => 'Photo Album',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Video Album')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Video Album',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Video Album')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Video Album',
						'varMetaKeyword' => 'Video Album',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Video Gallery')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Video Gallery',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Video Gallery')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Video Gallery',
						'varMetaKeyword' => 'Video Gallery',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Sponsors')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Sponsors',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Sponsors')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Sponsors',
						'varMetaKeyword' => 'Sponsors',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Events')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Events',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Events')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Events',
						'varMetaKeyword' => 'Events',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Shows')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Shows',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Shows')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Shows',
						'varMetaKeyword' => 'Shows',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Contact Us')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Contact Us',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Contact Us')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Contact Us',
						'varMetaKeyword' => 'Contact Us',
						'varMetaDescription' => '',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','About Us')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'About Us',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('About Us')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '<section class="section aboutus_01 cms">
    <div class="nq_container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H1</span></h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h2 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H2</span></h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h3 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H3</span></h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H4</span></h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h5 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H5</span></h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h6 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H6</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-justify">
                <img src="{CDN_URL}assets/images/4x6_cms.jpg" alt="Alt Here" class="img_width">
                <h2 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H2</span></h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                <hr/>
            </div>
            <div class="col-md-12">
                <h3 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum List Property</span></h3>
                <ul class="initial">
                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
                    <li>It has survived not only five centuries, but also the leap into <a href="#" title="Title Here" class="link"><b>electronic typesetting</b></a>, remaining essentially unchanged.</li>
                    <li>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</li>
                    <li>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</li>
                </ul>
                <p class="text-center"><br><strong>Please use below class for different different new list style</strong> <br/>disc | circle | none | square | decimal | decimal_zero | lower_alpha | upper_alpha | upper_roman | initial</p>
                <hr>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Basic Table</span></h4>
                <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Striped Rows Table</span></h4>
                <p>The .table-striped class adds zebra-stripes to a table:</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Bordered Table</span></h4>
                <p>The .table-bordered class adds borders to a table:</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Hover Rows Table</span></h4>
                <p>The .table-hover class enables a hover state on table rows:</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Condensed Table</span></h4>
                <p>The .table-condensed class makes a table more compact by cutting cell padding in half:</p>
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Contextual Classes Table</span></h4>
                <p>Contextual classes can be used to color table rows or table cells. The classes that can be used are: .active, .success, .info, .warning, and .danger.</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr class="danger">
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr class="info">
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <h4 class="nqtitle align custom_nqtitle"><span>Blockquotes Options</span></h4>
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote class="blockquote-reverse">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12"><h4 class="nqtitle align custom_nqtitle"><span>select boxes Options</span></h4></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Standard select boxes</label>
                    <form>
                        <select class="form-control selectpicker">
                            <option selected="selected">All Position</option>
                            <option>Marketing Manager</option>
                            <option>Operation Manager</option>
                            <option>Accountant Manager</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select boxes with optgroups</label>
                    <form>
                        <select class="selectpicker">
                            <optgroup label="Picnic">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </optgroup>
                            <optgroup label="Camping">
                                <option>Tent</option>
                                <option>Flashlight</option>
                                <option>Toilet Paper</option>
                            </optgroup>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Multiple select boxes</label>
                    <form>
                        <select class="selectpicker" multiple>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Live search</label>
                    <form>
                        <select class="selectpicker" data-live-search="true" multiple>
                            <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                            <option data-tokens="mustard">Burger, Shake and a Smile</option>
                            <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Limit the number of selections</label>
                    <form>
                        <select class="selectpicker" multiple>
                            <optgroup label="Condiments" data-max-options="2">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </optgroup>
                            <optgroup label="Breads" data-max-options="2">
                                <option>Plain</option>
                                <option>Steamed</option>
                                <option>Toasted</option>
                            </optgroup>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Placeholder</label>
                    <form>
                        <select class="selectpicker" multiple title="Choose one of the following...">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Selected text</label>
                    <form>
                        <select class="selectpicker">
                            <option title="Combo 1">Hot Dog, Fries and a Soda</option>
                            <option title="Combo 2">Burger, Shake and a Smile</option>
                            <option title="Combo 3">Sugar, Spice and all things nice</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Selected text format</label>
                    <form>
                        <select class="selectpicker" multiple data-selected-text-format="count">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Checkmark on selected option</label>
                    <form>
                        <select class="selectpicker show-tick">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Style individual options</label>
                    <form>
                        <select class="selectpicker">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option style="background: #5cb85c; color: #fff;">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Icons</label>
                    <form>
                        <select class="selectpicker">
                            <option data-icon="fa fa-anchor">Ketchup</option>
                            <option data-icon="fa fa-cube">Ketchup</option>
                            <option data-icon="fa fa-glass">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Custom content</label>
                    <form>
                        <select class="selectpicker">
                            <option data-content="<span class="label label-success">Relish</span>">Relish</option>
                            <option data-content="<span class="label label-info">Ketchup</span>">Ketchup</option>
                            <option data-content="<span class="label label-danger">Relish</span>">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Subtext</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option data-subtext="Heinz">Ketchup</option>
                            <option data-subtext="Heinz">Relish</option>
                            <option data-subtext="Heinz">Ketchup</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Menu size</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select/deselect all options</label>
                    <form>
                        <select class="selectpicker" multiple data-actions-box="true">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Divider</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option data-divider="true">Ketchup</option>
                            <option>Relish</option>
                            <option data-divider="true">Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Menu header</label>
                    <form>
                        <select class="selectpicker" data-header="Select a condiment">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Container</label>
                    <form>
                        <select class="selectpicker" data-container="body">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Pagination Options</span></h4>
                <div class="pagination_cover">
                    <ul class="pagination">
                        <li><a aria-label="Previous" href="#" title="Previous"><i class="fa fa-arrow-left"></i></a></li>
                        <li><a href="#" title="1">1</a></li>
                        <li class="active" title="2"><a href="#">2</a></li>
                        <li><a href="#" title="3">3</a></li>
                        <li><a href="#" title="4">4</a></li>
                        <li><a href="#" title="5">5</a></li>
                        <li><a aria-label="Next" href="#" title="Next"><i class="fa fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Button Options</span></h4>
                <a class="btn" title="Download" href="#"><i class="fa fa-download"></i> Download</a>
                <a class="btn" title="Download PDF" href="#"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
                <a class="btn" title="Download Excel" href="#"><i class="fa fa-file-excel-o"></i> Download Excel</a>
                <a class="btn" title="Download Word" href="#"><i class="fa fa-file-word-o"></i> Download Word</a>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Tooltip Options</span></h4>
                <button type="button" class="btn" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</button>
            </div>

        </div>
    </div>
</section>',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'About Us',
						'varMetaKeyword' => 'About Us',
						'varMetaDescription' => '
    
        
            
                Lorem Ipsum Heading H1
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H2
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                Lorem Ipsum Heading H3
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H4
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                Lorem Ipsum Heading H5
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H6
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                
                Lorem Ipsum Heading H2
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.
                
            
            
                Lorem Ipsum List Property
                
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.
                
                Please use below class for different different new list style disc | circle | none | square | decimal | decimal_zero | lower_alpha | upper_alpha | upper_roman | initial
                
            
            
                Lorem Ipsum Basic Table
                The .table class adds basic styling (light padding and only horizontal dividers) to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Striped Rows Table
                The .table-striped class adds zebra-stripes to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Lorem Ipsum Bordered Table
                The .table-bordered class adds borders to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Hover Rows Table
                The .table-hover class enables a hover state on table rows:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Lorem Ipsum Condensed Table
                The .table-condensed class makes a table more compact by cutting cell padding in half:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Contextual Classes Table
                Contextual classes can be used to color table rows or table cells. The classes that can be used are: .active, .success, .info, .warning, and .danger.
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Blockquotes Options
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                
            
            
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                    Someone famous in Source Title
                
            
            
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                    Someone famous in Source Title
                
            
            
            select boxes Options
            
                
                    Standard select boxes
                    
                        
                            All Position
                            Marketing Manager
                            Operation Manager
                            Accountant Manager
                        
                    
                
            
            
                
                    Select boxes with optgroups
                    
                        
                            
                                Mustard
                                Ketchup
                                Relish
                            
                            
                                Tent
                                Flashlight
                                Toilet Paper
                            
                        
                    
                
            
            
                
                    Multiple select boxes
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Live search
                    
                        
                            Hot Dog, Fries and a Soda
                            Burger, Shake and a Smile
                            Sugar, Spice and all things nice
                        
                    
                
            
            
                
                    Limit the number of selections
                    
                        
                            
                                Mustard
                                Ketchup
                                Relish
                            
                            
                                Plain
                                Steamed
                                Toasted
                            
                        
                    
                
            
            
                
                    Placeholder
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Selected text
                    
                        
                            Hot Dog, Fries and a Soda
                            Burger, Shake and a Smile
                            Sugar, Spice and all things nice
                        
                    
                
            
            
                
                    Selected text format
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Checkmark on selected option
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Style individual options
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Icons
                    
                        
                            Ketchup
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Custom content
                    
                        
                            Relish
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Subtext
                    
                        
                            Ketchup
                            Relish
                            Ketchup
                        
                    
                
            
            
                
                    Menu size
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Select/deselect all options
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Divider
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Menu header
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Container
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
            
                Pagination Options
                
                    
                        
                        1
                        2
                        3
                        4
                        5
                        
                    
                
            
            
            
                Button Options
                 Download
                 Download PDF
                 Download Excel
                 Download Word
            
            
            
                Tooltip Options
                Tooltip on left

                Tooltip on top

                Tooltip on bottom

                Tooltip on right
            

        
    
',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Privacy policy')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Privacy policy',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Privacy policy')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '<section class="section aboutus_01 cms">
    <div class="nq_container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H1</span></h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h2 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H2</span></h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h3 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H3</span></h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H4</span></h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h5 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H5</span></h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h6 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H6</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-justify">
                <img src="{CDN_URL}assets/images/4x6_cms.jpg" alt="Alt Here" class="img_width">
                <h2 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H2</span></h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                <hr/>
            </div>
            <div class="col-md-12">
                <h3 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum List Property</span></h3>
                <ul class="initial">
                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
                    <li>It has survived not only five centuries, but also the leap into <a href="#" title="Title Here" class="link"><b>electronic typesetting</b></a>, remaining essentially unchanged.</li>
                    <li>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</li>
                    <li>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</li>
                </ul>
                <p class="text-center"><br><strong>Please use below class for different different new list style</strong> <br/>disc | circle | none | square | decimal | decimal_zero | lower_alpha | upper_alpha | upper_roman | initial</p>
                <hr>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Basic Table</span></h4>
                <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Striped Rows Table</span></h4>
                <p>The .table-striped class adds zebra-stripes to a table:</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Bordered Table</span></h4>
                <p>The .table-bordered class adds borders to a table:</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Hover Rows Table</span></h4>
                <p>The .table-hover class enables a hover state on table rows:</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Condensed Table</span></h4>
                <p>The .table-condensed class makes a table more compact by cutting cell padding in half:</p>
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Contextual Classes Table</span></h4>
                <p>Contextual classes can be used to color table rows or table cells. The classes that can be used are: .active, .success, .info, .warning, and .danger.</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr class="danger">
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr class="info">
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <h4 class="nqtitle align custom_nqtitle"><span>Blockquotes Options</span></h4>
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote class="blockquote-reverse">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12"><h4 class="nqtitle align custom_nqtitle"><span>select boxes Options</span></h4></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Standard select boxes</label>
                    <form>
                        <select class="form-control selectpicker">
                            <option selected="selected">All Position</option>
                            <option>Marketing Manager</option>
                            <option>Operation Manager</option>
                            <option>Accountant Manager</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select boxes with optgroups</label>
                    <form>
                        <select class="selectpicker">
                            <optgroup label="Picnic">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </optgroup>
                            <optgroup label="Camping">
                                <option>Tent</option>
                                <option>Flashlight</option>
                                <option>Toilet Paper</option>
                            </optgroup>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Multiple select boxes</label>
                    <form>
                        <select class="selectpicker" multiple>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Live search</label>
                    <form>
                        <select class="selectpicker" data-live-search="true" multiple>
                            <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                            <option data-tokens="mustard">Burger, Shake and a Smile</option>
                            <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Limit the number of selections</label>
                    <form>
                        <select class="selectpicker" multiple>
                            <optgroup label="Condiments" data-max-options="2">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </optgroup>
                            <optgroup label="Breads" data-max-options="2">
                                <option>Plain</option>
                                <option>Steamed</option>
                                <option>Toasted</option>
                            </optgroup>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Placeholder</label>
                    <form>
                        <select class="selectpicker" multiple title="Choose one of the following...">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Selected text</label>
                    <form>
                        <select class="selectpicker">
                            <option title="Combo 1">Hot Dog, Fries and a Soda</option>
                            <option title="Combo 2">Burger, Shake and a Smile</option>
                            <option title="Combo 3">Sugar, Spice and all things nice</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Selected text format</label>
                    <form>
                        <select class="selectpicker" multiple data-selected-text-format="count">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Checkmark on selected option</label>
                    <form>
                        <select class="selectpicker show-tick">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Style individual options</label>
                    <form>
                        <select class="selectpicker">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option style="background: #5cb85c; color: #fff;">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Icons</label>
                    <form>
                        <select class="selectpicker">
                            <option data-icon="fa fa-anchor">Ketchup</option>
                            <option data-icon="fa fa-cube">Ketchup</option>
                            <option data-icon="fa fa-glass">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Custom content</label>
                    <form>
                        <select class="selectpicker">
                            <option data-content="<span class="label label-success">Relish</span>">Relish</option>
                            <option data-content="<span class="label label-info">Ketchup</span>">Ketchup</option>
                            <option data-content="<span class="label label-danger">Relish</span>">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Subtext</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option data-subtext="Heinz">Ketchup</option>
                            <option data-subtext="Heinz">Relish</option>
                            <option data-subtext="Heinz">Ketchup</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Menu size</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select/deselect all options</label>
                    <form>
                        <select class="selectpicker" multiple data-actions-box="true">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Divider</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option data-divider="true">Ketchup</option>
                            <option>Relish</option>
                            <option data-divider="true">Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Menu header</label>
                    <form>
                        <select class="selectpicker" data-header="Select a condiment">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Container</label>
                    <form>
                        <select class="selectpicker" data-container="body">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Pagination Options</span></h4>
                <div class="pagination_cover">
                    <ul class="pagination">
                        <li><a aria-label="Previous" href="#" title="Previous"><i class="fa fa-arrow-left"></i></a></li>
                        <li><a href="#" title="1">1</a></li>
                        <li class="active" title="2"><a href="#">2</a></li>
                        <li><a href="#" title="3">3</a></li>
                        <li><a href="#" title="4">4</a></li>
                        <li><a href="#" title="5">5</a></li>
                        <li><a aria-label="Next" href="#" title="Next"><i class="fa fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Button Options</span></h4>
                <a class="btn" title="Download" href="#"><i class="fa fa-download"></i> Download</a>
                <a class="btn" title="Download PDF" href="#"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
                <a class="btn" title="Download Excel" href="#"><i class="fa fa-file-excel-o"></i> Download Excel</a>
                <a class="btn" title="Download Word" href="#"><i class="fa fa-file-word-o"></i> Download Word</a>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Tooltip Options</span></h4>
                <button type="button" class="btn" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</button>
            </div>

        </div>
    </div>
</section>',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Privacy policy',
						'varMetaKeyword' => 'Privacy policy',
						'varMetaDescription' => '
    
        
            
                Lorem Ipsum Heading H1
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H2
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                Lorem Ipsum Heading H3
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H4
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                Lorem Ipsum Heading H5
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H6
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                
                Lorem Ipsum Heading H2
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.
                
            
            
                Lorem Ipsum List Property
                
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.
                
                Please use below class for different different new list style disc | circle | none | square | decimal | decimal_zero | lower_alpha | upper_alpha | upper_roman | initial
                
            
            
                Lorem Ipsum Basic Table
                The .table class adds basic styling (light padding and only horizontal dividers) to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Striped Rows Table
                The .table-striped class adds zebra-stripes to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Lorem Ipsum Bordered Table
                The .table-bordered class adds borders to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Hover Rows Table
                The .table-hover class enables a hover state on table rows:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Lorem Ipsum Condensed Table
                The .table-condensed class makes a table more compact by cutting cell padding in half:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Contextual Classes Table
                Contextual classes can be used to color table rows or table cells. The classes that can be used are: .active, .success, .info, .warning, and .danger.
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Blockquotes Options
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                
            
            
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                    Someone famous in Source Title
                
            
            
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                    Someone famous in Source Title
                
            
            
            select boxes Options
            
                
                    Standard select boxes
                    
                        
                            All Position
                            Marketing Manager
                            Operation Manager
                            Accountant Manager
                        
                    
                
            
            
                
                    Select boxes with optgroups
                    
                        
                            
                                Mustard
                                Ketchup
                                Relish
                            
                            
                                Tent
                                Flashlight
                                Toilet Paper
                            
                        
                    
                
            
            
                
                    Multiple select boxes
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Live search
                    
                        
                            Hot Dog, Fries and a Soda
                            Burger, Shake and a Smile
                            Sugar, Spice and all things nice
                        
                    
                
            
            
                
                    Limit the number of selections
                    
                        
                            
                                Mustard
                                Ketchup
                                Relish
                            
                            
                                Plain
                                Steamed
                                Toasted
                            
                        
                    
                
            
            
                
                    Placeholder
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Selected text
                    
                        
                            Hot Dog, Fries and a Soda
                            Burger, Shake and a Smile
                            Sugar, Spice and all things nice
                        
                    
                
            
            
                
                    Selected text format
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Checkmark on selected option
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Style individual options
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Icons
                    
                        
                            Ketchup
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Custom content
                    
                        
                            Relish
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Subtext
                    
                        
                            Ketchup
                            Relish
                            Ketchup
                        
                    
                
            
            
                
                    Menu size
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Select/deselect all options
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Divider
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Menu header
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Container
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
            
                Pagination Options
                
                    
                        
                        1
                        2
                        3
                        4
                        5
                        
                    
                
            
            
            
                Button Options
                 Download
                 Download PDF
                 Download Excel
                 Download Word
            
            
            
                Tooltip Options
                Tooltip on left

                Tooltip on top

                Tooltip on bottom

                Tooltip on right
            

        
    
',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
				
					$pageModuleCode = DB::table('module')->select('id')->where('varTitle','Terms &amp; Conditions')->first();					
					if(isset($pageModuleCode->id) && !empty($pageModuleCode->id))
					{
						$intFKModuleCode = $pageModuleCode->id;		
					}else{
						$intFKModuleCode = $moduleCode->id;
					}

					DB::table('cms_page')->insert([
						'varTitle' =>  'Terms &amp; Conditions',
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Terms &amp; Conditions')[0],$moduleCode->id),
						'intFKModuleCode' => $intFKModuleCode,
						'txtDescription' => '<section class="section aboutus_01 cms">
    <div class="nq_container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H1</span></h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h2 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H2</span></h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h3 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H3</span></h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H4</span></h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h5 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H5</span></h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-6">
                <h6 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H6</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-justify">
                <img src="{CDN_URL}assets/images/4x6_cms.jpg" alt="Alt Here" class="img_width">
                <h2 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Heading H2</span></h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                <hr/>
            </div>
            <div class="col-md-12">
                <h3 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum List Property</span></h3>
                <ul class="initial">
                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
                    <li>It has survived not only five centuries, but also the leap into <a href="#" title="Title Here" class="link"><b>electronic typesetting</b></a>, remaining essentially unchanged.</li>
                    <li>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</li>
                    <li>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</li>
                </ul>
                <p class="text-center"><br><strong>Please use below class for different different new list style</strong> <br/>disc | circle | none | square | decimal | decimal_zero | lower_alpha | upper_alpha | upper_roman | initial</p>
                <hr>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Basic Table</span></h4>
                <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Striped Rows Table</span></h4>
                <p>The .table-striped class adds zebra-stripes to a table:</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Bordered Table</span></h4>
                <p>The .table-bordered class adds borders to a table:</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Hover Rows Table</span></h4>
                <p>The .table-hover class enables a hover state on table rows:</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Condensed Table</span></h4>
                <p>The .table-condensed class makes a table more compact by cutting cell padding in half:</p>
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="nqtitle align custom_nqtitle"><span>Lorem Ipsum Contextual Classes Table</span></h4>
                <p>Contextual classes can be used to color table rows or table cells. The classes that can be used are: .active, .success, .info, .warning, and .danger.</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr class="danger">
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr class="info">
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                <h4 class="nqtitle align custom_nqtitle"><span>Blockquotes Options</span></h4>
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote class="blockquote-reverse">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12"><h4 class="nqtitle align custom_nqtitle"><span>select boxes Options</span></h4></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Standard select boxes</label>
                    <form>
                        <select class="form-control selectpicker">
                            <option selected="selected">All Position</option>
                            <option>Marketing Manager</option>
                            <option>Operation Manager</option>
                            <option>Accountant Manager</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select boxes with optgroups</label>
                    <form>
                        <select class="selectpicker">
                            <optgroup label="Picnic">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </optgroup>
                            <optgroup label="Camping">
                                <option>Tent</option>
                                <option>Flashlight</option>
                                <option>Toilet Paper</option>
                            </optgroup>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Multiple select boxes</label>
                    <form>
                        <select class="selectpicker" multiple>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Live search</label>
                    <form>
                        <select class="selectpicker" data-live-search="true" multiple>
                            <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                            <option data-tokens="mustard">Burger, Shake and a Smile</option>
                            <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Limit the number of selections</label>
                    <form>
                        <select class="selectpicker" multiple>
                            <optgroup label="Condiments" data-max-options="2">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </optgroup>
                            <optgroup label="Breads" data-max-options="2">
                                <option>Plain</option>
                                <option>Steamed</option>
                                <option>Toasted</option>
                            </optgroup>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Placeholder</label>
                    <form>
                        <select class="selectpicker" multiple title="Choose one of the following...">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Selected text</label>
                    <form>
                        <select class="selectpicker">
                            <option title="Combo 1">Hot Dog, Fries and a Soda</option>
                            <option title="Combo 2">Burger, Shake and a Smile</option>
                            <option title="Combo 3">Sugar, Spice and all things nice</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Selected text format</label>
                    <form>
                        <select class="selectpicker" multiple data-selected-text-format="count">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Checkmark on selected option</label>
                    <form>
                        <select class="selectpicker show-tick">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Style individual options</label>
                    <form>
                        <select class="selectpicker">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option style="background: #5cb85c; color: #fff;">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Icons</label>
                    <form>
                        <select class="selectpicker">
                            <option data-icon="fa fa-anchor">Ketchup</option>
                            <option data-icon="fa fa-cube">Ketchup</option>
                            <option data-icon="fa fa-glass">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Custom content</label>
                    <form>
                        <select class="selectpicker">
                            <option data-content="<span class="label label-success">Relish</span>">Relish</option>
                            <option data-content="<span class="label label-info">Ketchup</span>">Ketchup</option>
                            <option data-content="<span class="label label-danger">Relish</span>">Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Subtext</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option data-subtext="Heinz">Ketchup</option>
                            <option data-subtext="Heinz">Relish</option>
                            <option data-subtext="Heinz">Ketchup</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Menu size</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select/deselect all options</label>
                    <form>
                        <select class="selectpicker" multiple data-actions-box="true">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Divider</label>
                    <form>
                        <select class="selectpicker" data-size="5">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option data-divider="true">Ketchup</option>
                            <option>Relish</option>
                            <option data-divider="true">Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Menu header</label>
                    <form>
                        <select class="selectpicker" data-header="Select a condiment">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Container</label>
                    <form>
                        <select class="selectpicker" data-container="body">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Pagination Options</span></h4>
                <div class="pagination_cover">
                    <ul class="pagination">
                        <li><a aria-label="Previous" href="#" title="Previous"><i class="fa fa-arrow-left"></i></a></li>
                        <li><a href="#" title="1">1</a></li>
                        <li class="active" title="2"><a href="#">2</a></li>
                        <li><a href="#" title="3">3</a></li>
                        <li><a href="#" title="4">4</a></li>
                        <li><a href="#" title="5">5</a></li>
                        <li><a aria-label="Next" href="#" title="Next"><i class="fa fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Button Options</span></h4>
                <a class="btn" title="Download" href="#"><i class="fa fa-download"></i> Download</a>
                <a class="btn" title="Download PDF" href="#"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
                <a class="btn" title="Download Excel" href="#"><i class="fa fa-file-excel-o"></i> Download Excel</a>
                <a class="btn" title="Download Word" href="#"><i class="fa fa-file-word-o"></i> Download Word</a>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12 text-center">
                <h4 class="nqtitle align custom_nqtitle"><span>Tooltip Options</span></h4>
                <button type="button" class="btn" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>

                <button type="button" class="btn" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</button>
            </div>

        </div>
    </div>
</section>',
						'chrPublish' => 'Y',
						'chrDelete'=> 'N',
						'varMetaTitle' => 'Terms &amp; Conditions',
						'varMetaKeyword' => 'Terms &amp; Conditions',
						'varMetaDescription' => '
    
        
            
                Lorem Ipsum Heading H1
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H2
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                Lorem Ipsum Heading H3
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H4
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                Lorem Ipsum Heading H5
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
                Lorem Ipsum Heading H6
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
            
            
            
                
                Lorem Ipsum Heading H2
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.
                
            
            
                Lorem Ipsum List Property
                
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.
                
                Please use below class for different different new list style disc | circle | none | square | decimal | decimal_zero | lower_alpha | upper_alpha | upper_roman | initial
                
            
            
                Lorem Ipsum Basic Table
                The .table class adds basic styling (light padding and only horizontal dividers) to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Striped Rows Table
                The .table-striped class adds zebra-stripes to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Lorem Ipsum Bordered Table
                The .table-bordered class adds borders to a table:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Hover Rows Table
                The .table-hover class enables a hover state on table rows:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Lorem Ipsum Condensed Table
                The .table-condensed class makes a table more compact by cutting cell padding in half:
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
                Lorem Ipsum Contextual Classes Table
                Contextual classes can be used to color table rows or table cells. The classes that can be used are: .active, .success, .info, .warning, and .danger.
                
                    
                        
                            
                                Firstname
                                Lastname
                                Email
                            
                        
                        
                            
                                John
                                Doe
                                john@example.com
                            
                            
                                Mary
                                Moe
                                mary@example.com
                            
                            
                                July
                                Dooley
                                july@example.com
                            
                        
                    
                
            
            
            
                Blockquotes Options
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                
            
            
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                    Someone famous in Source Title
                
            
            
                
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                    Someone famous in Source Title
                
            
            
            select boxes Options
            
                
                    Standard select boxes
                    
                        
                            All Position
                            Marketing Manager
                            Operation Manager
                            Accountant Manager
                        
                    
                
            
            
                
                    Select boxes with optgroups
                    
                        
                            
                                Mustard
                                Ketchup
                                Relish
                            
                            
                                Tent
                                Flashlight
                                Toilet Paper
                            
                        
                    
                
            
            
                
                    Multiple select boxes
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Live search
                    
                        
                            Hot Dog, Fries and a Soda
                            Burger, Shake and a Smile
                            Sugar, Spice and all things nice
                        
                    
                
            
            
                
                    Limit the number of selections
                    
                        
                            
                                Mustard
                                Ketchup
                                Relish
                            
                            
                                Plain
                                Steamed
                                Toasted
                            
                        
                    
                
            
            
                
                    Placeholder
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Selected text
                    
                        
                            Hot Dog, Fries and a Soda
                            Burger, Shake and a Smile
                            Sugar, Spice and all things nice
                        
                    
                
            
            
                
                    Selected text format
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Checkmark on selected option
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Style individual options
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Icons
                    
                        
                            Ketchup
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Custom content
                    
                        
                            Relish
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Subtext
                    
                        
                            Ketchup
                            Relish
                            Ketchup
                        
                    
                
            
            
                
                    Menu size
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Select/deselect all options
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Divider
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Menu header
                    
                        
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
                
                    Container
                    
                        
                            Mustard
                            Ketchup
                            Relish
                        
                    
                
            
            
            
                Pagination Options
                
                    
                        
                        1
                        2
                        3
                        4
                        5
                        
                    
                
            
            
            
                Button Options
                 Download
                 Download PDF
                 Download Excel
                 Download Word
            
            
            
                Tooltip Options
                Tooltip on left

                Tooltip on top

                Tooltip on bottom

                Tooltip on right
            

        
    
',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now(),
					]);
					
									}
}
