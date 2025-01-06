<?php //echo "<pre>"; print_r($INRMinPrice); exit; ?>
<?php //echo "<pre>"; print_r($productData); exit; ?>


@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
@include('cart.cartscripts');

<div class="checkout-main">
   <div class="checkout-nav">
      <div class="container">
         <div class="row">
            <div class="line">
                  <div class="chckout-tab1 active" data-aos="zoom-in" data-aos-delay="100">
                     <i class="tab-icon config-icon sprite-image"></i>
                     <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Configuration">Configuration</span>
               </div>
                  <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                  <i class="tab-icon sign-icon sprite-image"></i>
                     <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Sign In">Sign In / Sign up</span>
               </div>
               <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                  <i class="tab-icon billinfo-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="BillingInfo">Billing Info</span>
               </div>
               <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="300">
                  <i class="tab-icon card-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Payment">Payment</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

    <div class="cart-configuration">
      <div class="container">
         

            <?php 

           if($productData['producttype']=="hosting" || $productData['producttype']=="email" || $productData['producttype']=="ssl" || $productData['producttype']=="dedicatedserver" || $productData['producttype']=="vps")
            {

            ?>

           @foreach($products as $keys=>$value)

            <?php 
            //$specification=explode('<br />',$key->txtSpecification);
                //echo '<pre>';print_r($productData);echo '</pre>';
            
                if(isset($value['title']) && $value['title'] == $productData['groupname'])
                {
                  ?> 
                    <div class="row">
                  <div class="col-sm-12">
                  <h3 class="c_c_title">Configure your {{$productData['groupname']}} plan as below</h3>
                  </div>
                  </div> 
                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
               <div class="c_c_box">
                  <h4 class="c_c_title c_c_blue-title">You've added {{$productData['planname']}} plan</h4>
                  <div class="c_c_select-plan">
                     <div class="c_c_title">Select term length</div>
                     <form id="cart_form_{{$key}}" action="#" method="post">
                      <input type="hidden" id="ele_key" name="ele_key" value="{{$key}}">
                      <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    @foreach($productData['pricing'] as $prokey =>  $pricing)
                      @if($pricing->price > 0)
                     <div class="c_c_plan-options c_c_plan_pricing_options">
                      <div class="c_c_plan-title">
                         <div class="radio_label">
                          @if($productData['billingcycle'] == $pricing->durationame)
                            
                          <input type="radio" @if($productData['producttype'] == 'vps') 
                                                onclick="updateServerItem('{{$key}}','{{$prokey}}');" 
                                              @else($productData['producttype'] == 'hosting')   
                                                onclick="updateHostingItem('{{$key}}','{{$prokey}}');" 
                                              @endif
                            name="sel_hostingregister_{{$key}}" id="sel_hostingregister_{{$key}}_{{$prokey}}" checked value="{{$pricing->durationame}}">
                          @else
                          <input type="radio" @if($productData['producttype'] == 'vps') 
                                                onclick="updateServerItem('{{$key}}','{{$prokey}}');" 
                                              @else($productData['producttype'] == 'hosting')   
                                                onclick="updateHostingItem('{{$key}}','{{$prokey}}');" 
                                              @endif name="sel_hostingregister_{{$key}}" id="sel_hostingregister_{{$key}}_{{$prokey}}" value="{{$pricing->durationame}}">
                          @endif
                          <label for="sel_hostingregister_{{$key}}_{{$prokey}}" class="d-flex align-items-center" title="Ending with 6598">@if($pricing->duration > 1)  
                            {{$pricing->duration}} Months  
                          @else 
                            {{$pricing->duration}} Month 
                          @endif</label>
                          <div class="check"></div>
                         </div>
                      </div>
                      <?php $_pr = $pricing->price; 
                            $strM = "";
                            if(isset($productData['producttype']) && $productData['producttype'] == 'ssl')
                            { $_pr = $pricing->price;  $strM = "yr";  }
                            else if(isset($productData['producttype']) && $productData['producttype'] != 'ssl')
                            { if(!empty($pricing->price) && !empty($pricing->duration)) { $_pr = $pricing->price / $pricing->duration; $strM = "mo"; }   }
                            ?>
                      <div class="c_c_plan-price">
                         <span class="p_p_main"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$_pr}}/<small>{{$strM}}</small></span>
                         <span class="p_p_linethrough"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$pricing->wrongprice}}/{{$strM}}</span>
                         <?php /*<span class="sale_discount">On Sale (Save 80%)</span>*/?>
                      </div>
                     </div>
                     @endif
                     @endforeach
                   </form>
                  </div>
               </div>
            </div>
            
             @foreach($suggestPro as $key=>$value)
             <?php 
              if(!isset($productData['groupname'])){ $productData['groupname'] = 'domain';  }

                 if(isset($value['title']) && $value['title'] != $productData['groupname'])
                  {
                    ?>
              <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
               <div class="c_c_box">
                  <h4 class="c_c_title c_c_blue-title">{{$value['title']}}</h4>
                  <div class="c_c_box_text">{{$value['TagLine']}}</div>
                  <div class="c_c_box_text blue_text">{{$value['ShortDescription']}}</div>
                   <div class="c_c_plan_features">
                     <div class="c_c_title">Plans & Features:</div>
                     <ul>
                       
                     </ul>
                  </div>             
                  <dl id="suggested_product" class="dropdown">
                       <dt><a href="javascript:void(0)"><span>No Thanks</span></a></dt>
                       <dd>
                           <ul>
                               <li><a href="javascript:void(0)">No Thanks</a></li>
                               
                                 @foreach($value['whmcsProductId'] as $key => $plans)
                                  @if(isset($INRMinPrice[$key]))
                                   <li>
                                    <a href="javascript:void(0)" onclick="return addSuggestedProduct('{{$value['producttype']}}','{{$key}}','{{$INRMinPrice[$key]['billingcycle']}}','India')">
                                    <?php 
                                        
                                    //echo "<pre>";print_r($INRMinPrice);exit;
                                        
                                    ?>
                                    @foreach($INRMinPrice as $keys=>$prices)
                                        @if($key==$keys)
                                        <span class="title">{{$plans}}</span>
                                        <span class="price">
                                          <span class="linethrough-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['oldPrice']; ?>/mo</span>
                                          <span class="final-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['newPrice']; ?>/mo</span>
                                        </span>

                                       @foreach($value['specifications'] as $keyss=>$specifications)
                                       <?php 
                                        $arr = nl2br($specifications);
                                        $arr = explode('<br />', $arr);
                                        $spec=$arr;
                                      ?>
                                        @if($key==$keyss)
                                        <div class="features">  
                                          @foreach($spec as $skey=>$svalue)
                                            <span>{{$svalue}}</span>
                                          @endforeach
                                         </div> 
                                        @endif
                                     @endforeach 

                                      @endif
                                   @endforeach
                                  </a>
                                 </li> 
                                 @endif
                                 @endforeach 

                              
                            </ul>
                       </dd>
                   </dl>
               </div>
            </div>
            <?php } ?>
              @endforeach 
             <?php /*<div class="col-sm-12 col-md-12 col-lg-4 d-flex">
               <div class="c_c_box">
                  <h4 class="c_c_title c_c_blue-title">{{$value['title']}}</h4>
                  <div class="c_c_box_text">{{$value['TagLine']}}</div>
                  <div class="c_c_box_text blue_text">{{$value['ShortDescription']}}</div>
                   <div class="c_c_plan_features">
                     <div class="c_c_title">Plans & Features:</div>
                     <ul>
                       
                     </ul>
                  </div>             
                  <dl id="custom-dropdown" class="dropdown">
                       <dt><a href="javascript:void(0)"><span>No Thanks</span></a></dt>
                       <dd>
                           <ul>
                               <li><a href="javascript:void(0)">No Thanks</a></li>
                                 
                                 @foreach($value['whmcsProductId'] as $keyw=>$plans)
                                    <li>     
                                 <a href="javascript:void(0)">
                                    @foreach($INRMinPrice as $keys=>$prices)
                                        @if($keyw==$keys)
                                  

                                    <span class="title">{{$plans}}</span>
                                    <span class="price">
                                      <span class="linethrough-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['oldPrice']; ?>/mo</span>
                                      <span class="final-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['newPrice']; ?>/mo</span>
                                        
                                      </span>
                                          @endif
                                     
                                      @endforeach


                                      @foreach($value['specifications'] as $keyss=>$specifications)

                                      <?php 
                                        $arr = nl2br($specifications);
                                        $arr = explode('<br />', $arr);
                                        $spec=$arr;

                                     ?>
                                        
                                     @if($keyw==$keyss)
                                        <div class="features">  
                                        @foreach($spec as $skey=>$svalue)
                                          <span>{{$svalue}}</span>
                                        @endforeach
                                         </div> 
                                     @endif
                                        
                                    @endforeach 

                                   </a>
                                 </li>      

                                 @endforeach 

                               
                           </ul>
                       </dd>
                   </dl>
               </div>
            </div>*/?>
          </div>

            <?php
                }
            

         ?>

            @endforeach
            <?php 
            if($productData['producttype']=="vps" || $productData['producttype']=="dedicatedserver")
            {

                ?>

                  <div class="row">
            <div class="col-sm-12">
               <h3 class="c_c_title">Select your Operating System and Hardware Upgrades</h3>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8">
               <div class="c_c_box">
                    
                   @if(!empty($productData['configfields']))
                    
                      @foreach($productData['configfields'] as $field) 
                        <h4 class="c_c_title c_c_blue-title">{{$field['name']}}</h4>
                        <div class="c_c_title-desc">Select Your {{$field['name']}}</div>
                         @php
                            $options = $field['options'];
                            $validationStr[] = " configfield_".$field['id'].": { required: true }";
                            $validationMsgStr[] = " configfield_".$field['id'].": { required: 'Please select configuration option.' }";
                        @endphp
                         <div class="c_c_select-plan c_c_vps_plans">
                          <input type="hidden" id="fieldName" value="{{$field['name']}}">
                     <div class="c_c_plan-options vps-plan-options" id="configfield_{{$field['id']}}">
                      
                          <?php 
                                //Openvz
                                $configoptionImgArr['578']="icon-none.png";
                                $configoptionImgArr['579']="icon-cwp.png";     
                                $configoptionImgArr['580']="icon-cpanel.png"; 
                                $configoptionImgArr['571']="icon-cpu.png";
                                $configoptionImgArr['572']="icon-cpu.png";
                                $configoptionImgArr['573']="icon-ram.png";
                                $configoptionImgArr['574']="icon-ram.png";
                                $configoptionImgArr['744']="icon-ram.png"; 
                                $configoptionImgArr['575']="icon-hardisk.png";
                                $configoptionImgArr['576']="icon-hardisk.png";
                                $configoptionImgArr['577']="icon-hardisk.png";
                                $configoptionImgArr['745']="icon-hardisk.png"; 
                                $configoptionImgArr['830']="icon-hardisk.png";
                                $configoptionImgArr['581']="icon-centOS.png";
                                $configoptionImgArr['582']="icon-centOS.png";
                                $configoptionImgArr['583']="icon_debian.png";
                                $configoptionImgArr['668']="icon-centOS.png";
                                $configoptionImgArr['584']="icon-ubuntu.png";
                                $configoptionImgArr['823']="icon_india.png";
                                $configoptionImgArr['824']="icon_india.png";
                                $configoptionImgArr['825']="icon_usa.png";
                                $configoptionImgArr['826']="icon_usa.png";
                                $configoptionImgArr['827']="icon_usa.png";
                                
                                //KVM
                                $configoptionImgArr['585']="icon-cpu.png";
                                $configoptionImgArr['598']="icon-cpu.png";     
                                $configoptionImgArr['587']="icon-ram.png"; 
                                $configoptionImgArr['588']="icon-ram.png";
                                $configoptionImgArr['746']="icon-ram.png";
                                $configoptionImgArr['589']="icon-hardisk.png";
                                $configoptionImgArr['590']="icon-hardisk.png";
                                $configoptionImgArr['591']="icon-hardisk.png"; 
                                $configoptionImgArr['747']="icon-hardisk.png";
                                $configoptionImgArr['597']="icon-none.png";
                                $configoptionImgArr['592']="icon-cwp.png";
                                $configoptionImgArr['593']="icon-cpanel.png"; 
                                $configoptionImgArr['594']="icon-centOS.png";
                                $configoptionImgArr['595']="icon-ubuntu.png";
                                $configoptionImgArr['596']="icon-centOS.png";
                                $configoptionImgArr['802']="icon-windows.png";
                                $configoptionImgArr['805']="icon-none.png";
                                $configoptionImgArr['804']="icon-sql-server.png";
                                $configoptionImgArr['850']="icon-sql-server.png";
                                $configoptionImgArr['851']="icon-sql-server.png";
                               
                                //Virtuozzo
                                $configoptionImgArr['763']="icon-ram.png";
                                $configoptionImgArr['764']="icon-ram.png";     
                                $configoptionImgArr['765']="icon-ram.png"; 
                                $configoptionImgArr['767']="icon-cpu.png";
                                $configoptionImgArr['766']="icon-cpu.png";
                                $configoptionImgArr['768']="icon-hardisk.png";
                                $configoptionImgArr['769']="icon-hardisk.png";
                                $configoptionImgArr['770']="icon-hardisk.png"; 
                                $configoptionImgArr['771']="icon-hardisk.png";
                                $configoptionImgArr['774']="icon-none.png";
                                $configoptionImgArr['772']="icon-cwp.png";
                                $configoptionImgArr['773']="icon-cpanel.png"; 
                                $configoptionImgArr['775']="icon-centOS.png";
                                $configoptionImgArr['776']="icon-ubuntu.png";
                                $configoptionImgArr['777']="icon_debian.png";
                                $configoptionImgArr['828']="icon-windows.png";

                                //Starter(Dedicated)
                                $configoptionImgArr['617']="icon-ram.png";
                                $configoptionImgArr['618']="icon-ram.png";     
                                $configoptionImgArr['599']="icon-ram.png"; 
                                $configoptionImgArr['601']="icon-hardisk.png";
                                $configoptionImgArr['642']="icon-hardisk.png";
                                $configoptionImgArr['643']="icon-hardisk.png";
                                $configoptionImgArr['603']="icon-centOS.png";
                                $configoptionImgArr['604']="icon-centOS.png"; 
                                $configoptionImgArr['605']="icon-centOS.png";
                                $configoptionImgArr['611']="icon-windows.png";
                                $configoptionImgArr['612']="icon-windows.png";
                                $configoptionImgArr['613']="icon-windows.png"; 
                                $configoptionImgArr['783']="icon-windows.png";
                                $configoptionImgArr['784']="icon-windows.png";
                                $configoptionImgArr['785']="icon-windows.png";
                                $configoptionImgArr['606']="icon_bandwidth.png";
                                $configoptionImgArr['607']="icon-none.png";
                                $configoptionImgArr['610']="icon-cwp.png";
                                $configoptionImgArr['608']="icon-cpanel.png";
                                $configoptionImgArr['614']="icon_plesk.png";
                                $configoptionImgArr['615']="icon_plesk.png";
                                $configoptionImgArr['669']="icon_plesk.png";
                                $configoptionImgArr['609']="icon_port.png";
                                $configoptionImgArr['678']="icon-none.png";
                                $configoptionImgArr['681']="icon-centOS.png";
                                $configoptionImgArr['682']="icon-centOS.png";
                                $configoptionImgArr['683']="icon-centOS.png";
                                $configoptionImgArr['798']="icon-none.png";
                                $configoptionImgArr['792']="icon-sql-server.png";
                                $configoptionImgArr['793']="icon-sql-server.png";
                                $configoptionImgArr['794']="icon-sql-server.png";


                                 //Performance(Dedicated)
                                $configoptionImgArr['621']="icon-ram.png";
                                $configoptionImgArr['637']="icon-ram.png";     
                                $configoptionImgArr['778']="icon-ram.png"; 
                                $configoptionImgArr['779']="icon-hardisk.png";
                                $configoptionImgArr['641']="icon-hardisk.png";
                                $configoptionImgArr['623']="icon-centOS.png";
                                $configoptionImgArr['622']="icon-centOS.png";
                                $configoptionImgArr['624']="icon-centOS.png";
                                $configoptionImgArr['625']="icon-centOS.png"; 
                                $configoptionImgArr['626']="icon-windows.png";
                                $configoptionImgArr['627']="icon-windows.png";
                                $configoptionImgArr['628']="icon-windows.png";
                                $configoptionImgArr['780']="icon-windows.png"; 
                                $configoptionImgArr['781']="icon-windows.png";
                                $configoptionImgArr['782']="icon-windows.png";
                                $configoptionImgArr['629']="icon-centOS.png";
                                $configoptionImgArr['630']="icon-none.png";
                                $configoptionImgArr['632']="icon-cwp.png";
                                $configoptionImgArr['631']="icon-cpanel.png";
                                $configoptionImgArr['633']="icon-centOS.png";
                                $configoptionImgArr['634']="icon-centOS.png";
                                $configoptionImgArr['635']="icon-centOS.png";
                                $configoptionImgArr['636']="icon-centOS.png";
                                $configoptionImgArr['640']="icon-hardisk.png";
                                $configoptionImgArr['678']="icon-none.png";
                                $configoptionImgArr['681']="icon-centOS.png";
                                $configoptionImgArr['682']="icon-centOS.png";
                                $configoptionImgArr['683']="icon-centOS.png";
                                $configoptionImgArr['639']="icon-hardisk.png";
                                $configoptionImgArr['800']="icon-none.png";
                                $configoptionImgArr['795']="icon-sql-server.png";
                                $configoptionImgArr['796']="icon-sql-server.png";
                                $configoptionImgArr['797']="icon-sql-server.png";


                                 //Business(Dedicated)
                                $configoptionImgArr['644']="icon-centOS.png";
                                $configoptionImgArr['645']="icon-centOS.png";     
                                $configoptionImgArr['646']="icon-centOS.png"; 
                                $configoptionImgArr['647']="icon-windows.png";
                                $configoptionImgArr['648']="icon-windows.png";
                                $configoptionImgArr['649']="icon-windows.png";
                                $configoptionImgArr['786']="icon-windows.png";
                                $configoptionImgArr['787']="icon-windows.png";
                                $configoptionImgArr['788']="icon-windows.png"; 
                                $configoptionImgArr['664']="icon-hardisk.png";
                                $configoptionImgArr['650']="icon-hardisk.png";
                                $configoptionImgArr['651']="icon-hardisk.png";
                                $configoptionImgArr['653']="icon-ram.png"; 
                                $configoptionImgArr['652']="icon-ram.png";
                                $configoptionImgArr['654']="icon_bandwidth.png";
                                $configoptionImgArr['655']="icon-none.png";
                                $configoptionImgArr['657']="icon-cwp.png";
                                $configoptionImgArr['656']="icon-cpanel.png";
                                $configoptionImgArr['658']="icon_plesk.png";
                                $configoptionImgArr['659']="icon_plesk.png";
                                $configoptionImgArr['660']="icon_plesk.png";
                                $configoptionImgArr['661']="icon_port.png";
                                $configoptionImgArr['678']="icon-none.png";
                                $configoptionImgArr['681']="icon_plesk.png";
                                $configoptionImgArr['682']="icon_plesk.png";
                                $configoptionImgArr['683']="icon_plesk.png";
                                $configoptionImgArr['801']="icon-none.png";
                                $configoptionImgArr['663']="icon-hardisk.png";
                                $configoptionImgArr['662']="icon-hardisk.png";
                                $configoptionImgArr['799']="icon-none.png";
                                $configoptionImgArr['789']="icon-sql-server.png";
                                $configoptionImgArr['790']="icon-sql-server.png";
                                $configoptionImgArr['791']="icon-sql-server.png";
                                $configoptionImgArr['829']="icon-hardisk.png";
                                

                            ?> 
                         @foreach($options as $option)
                           <div class="box_radio_label">
                            <input type="radio" class="configele" value="{{$option['id']}}" id="cpu-option{{$option['id']}}" name="customfields_{{$field['id']}}" onclick="setConfigurationFieldValue('{{$_REQUEST['id']}}','{{$field['id']}}',this.value);" @if(isset($field['selectedOption']) && $field['selectedOption'] == $option['id']) checked="true" @endif >
                              <?php 
                                $optStr =  "";
                                if($option['pricing']['price'][$productData['regperiod']] > 0)
                                  $optStr .= " at <span class='rupee'>". Config::get('Constant.sys_currency_symbol') ."</span>".$option['pricing']['price'][$productData['regperiod']];
                                elseif($option['name'] != "None")   
                                  $optStr .= "FREE"
                                
                              ?>
                            <label for="cpu-option{{$option['id']}}" class="radio_options" title="">
                                @if(isset($configoptionImgArr[$option['id']]))
                                <img src="{{Config::get('Constant.CDNURL')}}/assets/images/{{$configoptionImgArr[$option['id']]}}" alt="CPU"/>
                                @endif
                               <span class="desc">{{$option['name']}}</span>

                               <span class="extra-text">{!!$optStr!!}</span>

                            </label>
                         </div>
                         @endforeach
                      </div>
                    </div>
                      @endforeach

                   @endif 

                  <?php /*<hr>
                  <div class="next-btn">
                    <a href="javascript:void(0);" id="next_btn_2" class="btn next_btn" title="Next">Next</a>
                  </div>*/?>
               </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
               <div class="c_c_box">
                  <h4 class="c_c_title c_c_blue-title c_c_vps_title">YOUR BASE SERVER CONFIG</h4>
                  
                  <div class="c_c_plan_features">
                    <?php /*<div class="addon_div" style="display:none">
                    <h3>H/W ADDONS AND OS</h3>
                    <ul class="addon_list" id="config_fields_list"></ul>
                    </div>

                    <div class="software_service" style="display:none">
                    <h3>SOFTWARE AND SERVICES</h3>
                    <ul class="service_list" id="custom_fields_list"></ul>
                    </div>*/?>
                    <ul class="base_config" id="vps_configuration_html">{!!$productData['confightml']!!}</ul>
                  </div>
                  <hr>
                  <div class="low-price-main" >
                     <div class="c_c_title" class="total_price" id="finalPrice"> 
                       Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['finalprice']}}</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>

            <div class="row">
            <div class="col-sm-12">
               <h3 class="c_c_title">Select Additional Software and Services</h3>
            </div>
         </div>

              <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8">
                
                 <div class="c_c_box">
                        @include('cart.customfields')
                  </div>
               </div>
            </div>

                <?php

            }
            else
            {

           
            ?>    
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8">
               <div class="c_c_box">
                  <h4 class="c_c_title c_c_blue-title">Select a domain</h4>
                  <input type="hidden" id="isproductvalid" name="isproductvalid" value="N">
                  <div class="select_domain_div">
                      <div class="form-group">
                          <label class="title">I have an existing domain name</label>
                          <div class="input-group">
                              <input maxlength="60" class="form-control" id="ihavedomain" name="ihavedomain" value="">
                              <button class="btn" id="ihavedomainbtn" title="Use This">Use This</button>
                          </div>
                      </div>
                      <span class="or">OR</span>
                      <div class="form-group">
                          <label class="title">I want to register a new domain name</label>
                          <div class="input-group">
                              <input class="form-control combo_input"  maxlength="60" id="bookdomaintxt" name="bookdomaintxt" value="">
                              <div class="domain_combo">
                                  <div class="bootstrap-select">
                                    <select class="selectpicker" id="selTld" name="selTld">
                                    @foreach($tlds as $tld)
                                    <option value="{{$tld}}">{{$tld}}</option>
                                    @endforeach
                                  </select>
                                </div> 
                              </div>
                              <button class="btn"  title="Use This" id="searchdomainbtn" name="searchdomainbtn">Search</button>
                          </div>
                        <div class="last-step-checkout" style="display:none;" id="domainavailmsg">
                        <span class="checkout-text">Please click on <strong> Continue to Checkout </strong> to complete this order.</span>
                        <button class="btn" id="addconfigdomainbtn">Use this</button>
                        </div>
                      </div>


                   </div>


                    <div class="last-step-checkout" style="display:none;" id="submitbtn">
                            <span class="checkout-text">Please click on <strong> Continue to Checkout </strong> to complete this order.</span>
                            <?php /*<button class="btn" onclick="window.location.href='/cart';">Checkout</button>*/?>
                          </div>

               </div>
              </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
               <div class="c_c_box">
                  <div class="c_c_plan_features">
                     <div class="c_c_title">All plans feature:</div>
                     <ul class="base_config">
                        @foreach($productData['specifications'] as $keysss=>$value)
                          <li>{{$value}}</li>    
                        @endforeach
                    </ul>
                  </div>
                  <hr>
                  <div class="low-price-main">
                     <div class="c_c_title" id="finalPrice"> 
                       Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['finalprice']}}</span>
                     </div>
                  </div>
               </div>
            </div>
         </div> 

         <?php 
         }
         }
          
         elseif($productData['producttype']=="domain")
         {

              ?>
            <div class="row">
              <div class="col-sm-12">
                 <h3 class="c_c_title">What do you want to do with your domain ( {{$productData['domain']}} ) ?</h3>
              </div>
            </div>
          
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
               <div class="c_c_box">
                  <h4 class="c_c_title c_c_blue-title">We've added privacy. Here's why.</h4>
                  <div class="c_c_box_text">
                     When you register a domain, your name, address, email address and phone number are automatically published for the world to see. Protect yourself from spam and scams with HostItSmart Privacy Protection, which replaces your personal information with ours.
                     <br>
                     <br>
                     We highly recommend domain privacy, but it is an <strong>optional</strong> feature.
                  </div>
                  <div class="c_c_select-plan">
                     <div class="c_c_title">Protect your website as below</div>
                     @foreach($productData['addonproducts'] as $addonkey => $addon)
                      @if(isset($addon['pid']))
                      @else
                      <div class="c_c_plan-options">
                          <div class="check_box">
                              <label class="custom-radio">
                                  <input onchange="addAddonsDomain('{{$addon['type']}}','{{$addon['did']}}','{{$addon['type']}}','{{$addon['type']}}','{{$addon['type']}}', this,'{{$key}}','{{$addonkey}}');" type="checkbox" id="{{$addon['type']}}" name="{{$addon['type']}}"  @if(isset($addon['added'])) checked  @endif> 
                                  <span class="checkmark"></span>
                                  {!!$addon['desc']!!}
                              </label>
                        </div>
                        <?php /*<div class="c_c_plan-price">
                           <span class="p_p_main"><span class="rupee">&#8377;</span>277.16/<small>domain per year</small></span>
                           <span class="p_p_linethrough"><span class="rupee">&#8377;</span>554.32</span>
                        </div>*/?>
                     </div>
                      @endif
                     @endforeach
                  </div>
               </div>
            </div>
            @foreach($suggestPro as $key=>$value)
             <?php 
              if(!isset($productData['groupname'])){ $productData['groupname'] = 'domain';  }

                 if(isset($value['title']) && $value['title'] != $productData['groupname'])
                  {
                    ?>
              <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
               <div class="c_c_box">
                <?php 
                  
                  if(!empty($value['title']) && $value['title'] == 'Google Apps')
                  {
                    $value['title']  = "Create Emails";
                    $value['ShortDescription'] .= "</br>Look professional and build trust with a custom email address like <strong>you@".$productData['domain']."</strong>";
                  }
                  ?>
                  <h4 class="c_c_title c_c_blue-title">{{$value['title']}}</h4>
                  <div class="c_c_box_text">{{$value['TagLine']}}</div>
                  <div class="c_c_box_text blue_text">{!!$value['ShortDescription']!!}</div>
                   <div class="c_c_plan_features">
                     <div class="c_c_title">Plans & Features:</div>
                     <ul>
                       
                     </ul>
                  </div>             
                  <dl id="suggested_product" class="dropdown">
                       <dt><a href="javascript:void(0)"><span>No Thanks</span></a></dt>
                       <dd>
                           <ul>
                               <li><a href="javascript:void(0)">No Thanks</a></li>
                                
                                 @foreach($value['whmcsProductId'] as $key => $plans)
                                  @if(isset($INRMinPrice[$key]))
                                   <li>
                                    <a href="javascript:void(0)" onclick="return addSuggestedProduct('{{$value['producttype']}}','{{$key}}','{{$INRMinPrice[$key]['billingcycle']}}','India','{{$productData['domain']}}')">
                                   
                                    @foreach($INRMinPrice as $keys=>$prices)
                                        @if($key==$keys)
                                        <span class="title">{{$plans}}</span>
                                        <span class="price">
                                          <span class="linethrough-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['oldPrice']; ?>/mo</span>
                                          <span class="final-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['newPrice']; ?>/mo</span>
                                        </span>

                                       @foreach($value['specifications'] as $keyss=>$specifications)
                                       <?php 
                                        $arr = nl2br($specifications);
                                        $arr = explode('<br />', $arr);
                                        $spec=$arr;
                                      ?>
                                        @if($key==$keyss)
                                        <div class="features">  
                                          @foreach($spec as $skey=>$svalue)
                                            <span>{{$svalue}}</span>
                                          @endforeach
                                         </div> 
                                        @endif
                                     @endforeach 

                                      @endif
                                   @endforeach
                                  </a>
                                 </li> 
                                 @endif
                                 @endforeach 

                              
                            </ul>
                       </dd>
                   </dl>
               </div>
            </div>

                    <?php

                  }
                
              ?>
              @endforeach  
            </div>
              <?php } 

              /*if($productData['producttype'] != "domain"){
              ?>
            <div class="row">
            <div class="col-sm-12">
            <br />
            <h3 class="c_c_title">Your Suggested Product(s)</h3>
            </div>
            </div>

              <div class="row">  

          
            //echo "<pre>"; print_r($INRMinPrice); exit; 
         

             @foreach($suggestPro as $key=>$value)
             <?php 
              if(!isset($productData['groupname'])){ $productData['groupname'] = 'domain';  }

                 if(isset($value['title']) && $value['title'] != $productData['groupname'])
                  {
                    ?>
              <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
               <div class="c_c_box">
                  <h4 class="c_c_title c_c_blue-title">{{$value['title']}}</h4>
                  <div class="c_c_box_text">{{$value['TagLine']}}</div>
                  <div class="c_c_box_text blue_text">{{$value['ShortDescription']}}</div>
                   <div class="c_c_plan_features">
                     <div class="c_c_title">Plans & Features:</div>
                     <ul>
                       
                     </ul>
                  </div>             
                  <dl id="suggested_product" class="dropdown">
                       <dt><a href="javascript:void(0)"><span>No Thanks</span></a></dt>
                       <dd>
                           <ul>
                               <li><a href="javascript:void(0)">No Thanks</a></li>
                                
                                 @foreach($value['whmcsProductId'] as $key => $plans)
                                  @if(isset($INRMinPrice[$key]))
                                   <li>
                                    <a href="javascript:void(0)" onclick="return addSuggestedProduct('{{$value['producttype']}}','{{$key}}','{{$INRMinPrice[$key]['billingcycle']}}','India')">
                                    @foreach($INRMinPrice as $keys=>$prices)
                                        @if($key==$keys)
                                        <span class="title">{{$plans}}</span>
                                        <span class="price">
                                          <span class="linethrough-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['oldPrice']; ?>/mo</span>
                                          <span class="final-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['newPrice']; ?>/mo</span>
                                        </span>

                                       @foreach($value['specifications'] as $keyss=>$specifications)
                                       <?php 
                                        $arr = nl2br($specifications);
                                        $arr = explode('<br />', $arr);
                                        $spec=$arr;
                                      ?>
                                        @if($key==$keyss)
                                        <div class="features">  
                                          @foreach($spec as $skey=>$svalue)
                                            <span>{{$svalue}}</span>
                                          @endforeach
                                         </div> 
                                        @endif
                                     @endforeach 

                                      @endif
                                   @endforeach
                                  </a>
                                 </li> 
                                 @endif
                                 @endforeach 

                              
                            </ul>
                       </dd>
                   </dl>
               </div>
            </div>
            <?php } ?>
              @endforeach  
            <?php } */?>


         </div>
        </div>
   </div>

    <div class="secure-payment-info">
      <div class="container">
         <div class="row">
            <div class="col-sm-5 col-xs-12">
               <div class="s_p_box d-flex">
                  <i class="s_p_icon"></i>
                  <div class="s_p_content">
                     <span class="title">SSL Secure Payment</span>
                     <span class="desc">Your encryption is protected by 256-bit SSL encryption</span>
                  </div>
               </div>
               <div class="payment-method-cart"></div>
            </div>
            <div class="col-sm-7 col-xs-12">
               <div class="continue-checkout-portion">
                  <div class="c_c_p_top">
                     <div class="c_c_p_links">
                        <a title="View offer disclaimers" href="javascript:void(0)" data-toggle="modal" data-target="#disclaimer-popup">View offer disclaimers</a>
                        <a href="javascript:void(0);" onclick="emptycart();" title="mpty Cart">Empty Cart</a>
                     </div>
                     <div class="c_c_p_btn">
                        <a href="javascript:void(0);" onclick="performCheckout();" class="btn primary-btn" title="Continue to Checkout">Continue to Checkout</a>
                     </div>
                  </div>
                  <div class="c_c_p_terms">
                     By clicking "Continue to Checkout", you agree to our <a href="{{url('/terms')}}" target="_blank" title="Terms & Conditions">Terms & Conditions</a> and <a target="_blank" href="{{url('/privacy-policy')}}" title="Privacy Policy"> privacy policy</a>.
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="about-support cart-about"> 
      <div class="container">
         <div class="row"> 
            <div class="col-sm-4 col-12">
               <div class="support-time" data-aos="fade-right">
                  <div class="support-t">
                     <i class="support-icon support-icon1"></i>
                     <span class="small-text">Call Us</span>
                     <span class="b-text">079-6605-0099</span>
                  </div>
               </div>
            </div>
            <div class="col-sm-4 col-12">
               <div class="support-time" data-aos="zoom-in">
                  <div class="support-t">
                     <i class="support-icon support-icon2"></i>
                     <span class="small-text">Chat with our</span>
                     <span class="b-text">Hosting Experts</span>
                  </div>
               </div>
            </div>
            <div class="col-sm-4 col-12"> 
               <div class="support-time" data-aos="fade-left">
                  <div class="support-t">
                     <i class="support-icon support-icon3"></i>
                     <span class="small-text">Email to our</span>
                     <span class="b-text">Support Team</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

 <script type="text/javascript">

          function addSuggestedProduct(producttype,packageId,billingcycle,Location,domain){
           
      var formData = {"_token":"{{ csrf_token() }}","producttype[]":producttype,"pid[]":packageId,"billingcycle[]":billingcycle,"location[]":Location,"domain[]":domain}
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/store')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
            }
        });
    }


    if($("#cpu-option802").is(':checked')){$("#cpu-option804").parent().show();$("#cpu-option850").parent().show();$("#cpu-option851").parent().show();}
    else{$("#cpu-option804").parent().show();$("#cpu-option850").parent().hide();$("#cpu-option851").parent().hide();}

    $("input[name='customfields_193']").click(function(){
      if($("#cpu-option805").is(':checked')){}else{
      $("#cpu-option805").click();}});


    if($("#cpu-option603").is(':checked') || $("#cpu-option604").is(':checked') || $("#cpu-option605").is(':checked')){
        $("#cpu-option614").parent().hide(); $("#cpu-option615").parent().hide(); $("#cpu-option669").parent().hide();
        $("#cpu-option792").parent().hide(); $("#cpu-option793").parent().hide(); $("#cpu-option794").parent().hide();}
       else{
        $("#cpu-option614").parent().show(); $("#cpu-option615").parent().show(); $("#cpu-option669").parent().show();}

        var nonevps=0;
        var ovzUbuntu=0;
        var sqlserver=0;

        function setConfigurationFieldValue(proid,fieldid,val){

        var harddisk=0;
        var ramconfig=0;
        
       //Dedicated Servers
       //Starter Plans
       if($("#cpu-option603").is(':checked') || $("#cpu-option604").is(':checked') || $("#cpu-option605").is(':checked')){
        $("#cpu-option614").parent().hide(); $("#cpu-option615").parent().hide(); $("#cpu-option669").parent().hide();}
       else{
        $("#cpu-option614").parent().show(); $("#cpu-option615").parent().show(); $("#cpu-option669").parent().show();}

        if($("#cpu-option611").is(':checked') || $("#cpu-option612").is(':checked') || $("#cpu-option613").is(':checked') || $("#cpu-option783").is(':checked') || $("#cpu-option784").is(':checked') || $("#cpu-option785").is(':checked')){
          $("#cpu-option610").parent().hide(); $("#cpu-option608").parent().hide();
          $("#cpu-option792").parent().show(); $("#cpu-option793").parent().show(); $("#cpu-option794").parent().show();}
      else{$("#cpu-option610").parent().show(); $("#cpu-option608").parent().show();
          $("#cpu-option792").parent().hide(); $("#cpu-option793").parent().hide(); $("#cpu-option794").parent().hide();}
      
      //Starter Plans Over 
      //Dedicated Server Over

      //VPS OpenVZ
      //584 = Ubuntu Operating System 
      if($("#cpu-option584").is(':checked')){ 
        $("#cpu-option579").parent().hide(); //Control Panel->CWP
        $("#cpu-option580").parent().hide(); //Control Panel->Cpanel
        if(ovzUbuntu=="cpn"){ovzUbuntu=0;}else{ovzUbuntu="cpn";}
      }else{
        $("#cpu-option579").parent().show(); //Control Panel->CWP
        $("#cpu-option580").parent().show(); //Control Panel->Cpanel
        ovzUbuntu=0;}

      //VPS OpenVZ

      //VPS KVM Start
       //595 = Ubuntu Operating System 
      if($("#cpu-option595").is(':checked') || $("#cpu-option802").is(':checked')){ 
        $("#cpu-option592").parent().hide(); //Control Panel->CWP
        $("#cpu-option593").parent().hide(); //Control Panel->Cpanel
        if(nonevps=="cpn"){nonevps=0;}else{nonevps="cpn";}
      }else{
        $("#cpu-option592").parent().show(); //Control Panel->CWP
        $("#cpu-option593").parent().show(); //Control Panel->Cpanel
        nonevps=0;}

       //802 = Windows Operating System
      
      if($("#cpu-option802").is(':checked')){
        $("#cpu-option589").parent().hide(); //20 GB Harddisk space Free
        //$("#cpu-option587").parent().hide(); //2 GB Ram Free
        $("#cpu-option804").parent().show(); //SQL Server 17
         $("#cpu-option850").parent().show(); // SQL Server 12
          $("#cpu-option851").parent().show(); // SQL Server 14
        if($("#cpu-option589").is(':checked')){$("#cpu-option590").attr('checked', 'checked');
          harddisk++;}
        //if($("#cpu-option587").is(':checked')){$("#cpu-option588").attr('checked','checked');
          //ramconfig++;}
        }else{$("#cpu-option589").parent().show(); //20 GB Harddisk space Free
        $("#cpu-option587").parent().show(); //2 GB Ram Free
        $("#cpu-option850").parent().hide(); //SQL Server 12
        $("#cpu-option851").parent().hide(); // SQL Server 14
      }
      //VPS KVM end
      if(val && val != ""){

      var formData = {"_token":"{{ csrf_token() }}","productid":proid,"fieldid":fieldid,"optionid":val }
      
      $.ajax({
            async:false,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/setconfigoptionvalue')}}",
            data:formData,
            type:"post",
            dataType: "json",
            success:function(response){
                //response = JSON.parse(response);
                var confightml = response.confightml;
                var finalprice = response.finalprice;
                $("#vps_configuration_html").html(confightml);
                $("#finalPrice").html(' <div class="low-price-main"><div class="c_c_title">Total:<span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + finalprice + '</span></div></div>');
                hideLoader();
            }
        });
      }


      if(harddisk==1){$("#cpu-option590").click();}
      if(ramconfig==1){$("#cpu-option588").click();}
      if(nonevps=='cpn'){$("#cpu-option597").click();}
      if(ovzUbuntu=='cpn'){$("#cpu-option578").click();}
    }

     function setCustomFieldValue(proid,fieldid,val){
      //alert(proid  + " " + fieldid + " " + val); 
      var formData = {"_token":"{{ csrf_token() }}","productid":proid,"fieldid":fieldid,"val":val }
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/setcustomoptionvalue')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
                 if(response == '1'){ $("isproductvalid").val('Y'); }
            }
        });
    }


          $("#next_btn_3").click(function(){
            showLoader();
            if($("#customfield_hostname"))
            { setCustomFieldValue('{{$_REQUEST['id']}}','customfield_hostname',$("#customfield_hostname").val()); }
            showLoader();
            
            if(!$('#customfields_{{$key}}').valid()){ return false; }
            $("#step_3").removeClass('active'); $("#step_4").addClass('active');
            $("#step_3 .toggle_div").hide();
            $("#step_4 .toggle_div").show();
            $(".last-step-checkout").show();
            $("#custom_fields_list").html('');
            $(".customele").each(function(i,ele){
                if(typeof $(ele).attr('type') != 'undefined' && $(ele).attr('type') == 'checkbox' && $(ele).attr('checked'))
                { 
                  var label = $(ele).parent().parent().parent().find('label').text(); 
                  var val =  '';
                }
              else 
                {   
                  var label = $(ele).parent().parent().find('label').text(); 
                  if(label == ''){ label = $(ele).parent().parent().parent().find('label').text(); }
                  var val =  $("#"+ $(ele).attr("id")).val();
                }        
                
                if(typeof val != 'undefined')
                  { $("#custom_fields_list").append("<li><strong>" + label + "</strong>" + val + "</li>").parent().show(); }
              });
              $("#icon_step_3").addClass('fa fa-check-circle').removeClass('number').html('');

      });


      $("#next_btn_2").click(function(){

        alert("{{$_REQUEST['id']}}");

      if(!$('#configfields_{{$key}}').valid()){ return false; }

      $("#step_2 .toggle_div").hide();
      $("#step_3 .toggle_div").show();
      $("#config_fields_list").html('');
      $(".configele").each(function(i,ele){
          var label = $(ele).parent().parent().parent().find('label').text();
          var val =  $("#"+ $(ele).attr("id") + " option:selected").html();
          if(typeof val != 'undefined')
          { $("#config_fields_list").append("<li><strong>" + label + "</strong>" + val + "</li>").parent().show(); }
      });
      $("#icon_step_2").addClass('fa fa-check-circle').removeClass('number').html('');
      $("#step_2").removeClass('active'); $("#step_3").addClass('active');
      $("#customfield_359, #customfield_358, #customfield_353, #customfield_356, #customfield_357").change();
    });

         $(function(){
       $("#config_fields_list").html('');
      $(".configele").each(function(i,ele){
          //var label = $('#fieldName').val();
          //var label =$("#"+ $(ele).attr("id") + ":checked").parent().parent().parent().find('label').text();  
          //var val =  $("#"+ $(ele).attr("id") + ":checked").val();
            
          if(typeof val != 'undefined')
          { $("#config_fields_list").append("<li><strong>" + label + " : </strong>" + val + "</li>").parent().show(); }
      });
    });


    $("#ihavedomainbtn").click(function(){
        $("#bookdomaintxt").val('');
        $("#domainavailmsg").html('');
        var dname = $("#ihavedomain").val();
        if(dname == ''){
          alert("Please enter your domain name.");
          return false;
        }
        
        var formData = {"_token":"{{ csrf_token() }}","productid":'{{$_REQUEST['id']}}',"domainname":$("#ihavedomain").val()}
        
        $.ajax({
              async:true,
              beforeSend: function () { showLoader(); },
              url:"{{url('cart/configdomain')}}",
              data:formData,
              type:"post",
              success:function(response){
                  $("#step_4 .select_domain_div").hide(); 
                  $("#submitbtn").show();
                  $("#icon_step_4").addClass('fa fa-check-circle').removeClass('number').html('');
                  hideLoader();
                  $("#isproductvalid").val('Y');
              }
          });
    });


         var domaindata = null;
    $("#searchdomainbtn").click(function(){
      $("#searchdomainbtn").val('');
      var dname = $("#bookdomaintxt").val();
      if(dname == ''){
        alert("Please enter your domain name.");
        return false;
      }
        var formData = {"_token":"{{ csrf_token() }}","bookdomaintxt":$("#bookdomaintxt").val(),"selTld":$("#selTld").val()}
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/checkconfigdomainname')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
                if(response.status == 'available'){
                  domaindata = response;
                  $("#domainavailmsg").show().find('.checkout-text').html(response.msg).css({"color":"green"});
                  $("#addconfigdomainbtn").show();
                }
                else{
                  domaindata = response;
                  $("#domainavailmsg").show().find('.checkout-text').html(response.msg).css({"color":"red"});;
                  $("#addconfigdomainbtn").hide();
                }
                
            }
        });
    });


$("#addconfigdomainbtn").click(function(){
      var formData = {"_token":"{{ csrf_token() }}","producttype":domaindata.producttype,"domain":domaindata.domain,"tld":domaindata.tld,"domaintype":domaindata.domaintype,"regperiod":domaindata.regperiod}
       showLoader();
      $.ajax({
            url:"{{url('cart/store')}}",
            data:formData,
            type:"post",
            async:false,
            success:function(response){
              hideLoader();
                //$("#step_4 .toggle_div").hide(); 
                var formData = {"_token":"{{ csrf_token() }}","productid":'{{$_REQUEST['id']}}',"domainname":domaindata.domain[0]}
                $.ajax({
                      url:"{{url('cart/configdomain')}}",
                      data:formData,
                      type:"post",
                      success:function(response){
                          $("#step_4 .select_domain_div").hide(); 
                          $("#submitbtn").show();
                          hideLoader();
                          $("#isproductvalid").val('Y');
                      }
                  });
            }
        });
    });


  
     $('#bookdomaintxt').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9-\b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });
    $('#ihavedomain').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9-.\b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });


        $(document).ready(function() {
            $(".dropdown dt a").click(function() {
                $(this).parents('.dropdown').find("dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
               if($(this).find('.title').html()){
                  var text = $(this).find('.title').html();
                  var price = $(this).find('.final-price').html();
                   $(this).parents('.dropdown').find("dt a span").html(text + price);
                   $(".dropdown dd ul").hide();
                }else{
                   var text = $(this).html();
                   $(this).parents('.dropdown').find("dt a span").html(text);
                   $(".dropdown dd ul").hide();
                }
                
            });
            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });
        });
        function getconfigfinalprice(proid){
      var formData = {"_token":"{{ csrf_token() }}","productid":proid}    
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/getconfigfinalprice')}}",
            data:formData,
            type:"post",
            success:function(response){
                $("#finalPrice").html('<strong>Total:</strong><i class="rp_icon">{!! Config::get('Constant.sys_currency_symbol') !!}</i>' + response);
                hideLoader();
            }
        });
    }
    @if($productData['producttype'] == 'vps' || $productData['producttype'] == 'dedicatedserver')
    function performCheckout(){
      /*if($("#isproductvalid").val() == 'Y')
      { window.location.href="{{url('cart/signin')}}"; }
      else
      {
        return false;
      }*/
      window.location.href="{{url('cart/signin')}}";
    }
    @elseif($productData['producttype'] == 'domain')
    function performCheckout(){
       window.location.href="{{url('cart/signin')}}"; 
    }
    @else
    function performCheckout(){
      if($("#isproductvalid").val() == 'Y')
      { window.location.href="{{url('cart/signin')}}"; }
      else
      {
        alert("Please select a domain.");$("#ihavedomain").focus();
        return false;
      }
    }
    @endif
    
    </script>

<div class="modal fade deal-popup" id="disclaimer-popup" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-popup" data-dismiss="modal"></button>
                <h2 class="modal-title" title="Disclaimers">Disclaimers</h2>
            </div>
            <div class="modal-body">
                <div class="deal-body">
                    <ul>
                            <li class="text-left">Information contained in this website is for general information purpose only, The information is provided by HostITSmart, a property of Hosting World Pvt Ltd. While we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose.Any conviction you place on such information is therefore strictly at your own risk.</li>
                            <li class="text-left">In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website. Through this website you are able to link to other websites which are not under the control of Hosting World Pvt Ltd. We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them. Every effort is made to keep the website up and running smoothly. However, Hosting World Pvt Ltd takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection