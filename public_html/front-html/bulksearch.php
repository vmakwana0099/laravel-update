<?php include('Templates/header_section_inner.php') ?>
<div class="vps_main bulksearch-main">
	<div class="banner-inner bulksearch-banner" style="background-image:url(assets/images/bulksearch-b.jpg)">
		<div class="container">		
			<div class="banner-content">
				<div class="banner-image aos-init" data-aos="zoom-in" data-aos-delay="100">
				</div>
				<h1 class="banner-title aos-init" data-aos="fade-up" data-aos-delay="100">
					BULK SEARCH
				</h1>
				<span class="banner-subtitle aos-init d-sm-block d-none" data-aos="fade-up" data-aos-delay="200">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled 
				</span>
			</div>
		</div>
	</div>
</div>

<div class="bulksearch_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                    <textarea class="form-control" placeholder="Separate domains by commas or whitespace"></textarea>
                </div>
                <div class="tld_radio" data-aos="fade-up" data-aos-delay="300">
                    <div class="radio_label">
                        <input type="radio" id="f-option1" name="selector">
                        <label for="f-option1" title="I entered complete domain names with TLDs.">I entered complete domain names with TLDs.</label>
                        <div class="check"></div>
                    </div>
                    <div class="radio_label">
                        <input type="radio" id="f-option2" name="selector">
                        <label for="f-option2" title="Choose TLDs to search for">Choose TLDs to search for</label>
                        <div class="check"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="checked_domain_list">
                    <div class="tlds_show btn" id="checked_tlds" title="Hide Tlds" data-aos="fade-up" data-aos-delay="500">
                        <span>Hide Tlds</span><i class="fa fa-chevron-up" aria-hidden="true"></i>
                    </div>
                    <div class="bulktage_list" data-aos="fade-up" data-aos-delay="700">
                        <span class="tag">.in<i class="fa fa-times"></i></span>    
                        <span class="tag">.af<i class="fa fa-times"></i></span>    
                        <span class="tag">.ax<i class="fa fa-times"></i></span>    
                        <span class="tag">.ar<i class="fa fa-times"></i></span>    
                        <span class="tag">.am<i class="fa fa-times"></i></span>    
                        <span class="tag">.au<i class="fa fa-times"></i></span>    
                        <span class="tag">.az<i class="fa fa-times"></i></span>
                    </div>
                </div>
                <div class="domain-landing-section bulksearch_tabing">
                    <div class="country-filter-main">
	                   <div class="country-main">
                         <div class="filter-tabbing aos-init" data-aos="fade-left" data-aos-easing="ease-out-back" data-aos-delay="600">
                            <ul class="nav nav-tabs nav-country d-none d-md-block">
                              <li><a data-toggle="tab" href="#popular" class="active"><span>Popular</span></a></li>
                              <li><a data-toggle="tab" href="#generic" class=""><span>Generics</span></a></li>
                              <li><a data-toggle="tab" href="#america" class=""><span>America</span></a></li>
                              <li><a data-toggle="tab" href="#europe" class=""><span>Europe</span></a></li>
                              <li><a data-toggle="tab" href="#asia" class=""><span>Asia</span></a></li>
                              <li><a data-toggle="tab" href="#africa" class=""><span>Africa</span></a></li>
                              <li><a data-toggle="tab" href="#oceania" class=""><span>Oceania</span></a></li>
                              <li><a data-toggle="tab" href="#new-generics" class=""><span>New Generics</span></a></li>
                              <li><a data-toggle="tab" href="#view-all" class=""><span>View All</span></a></li>
                            </ul>
                            <div class="mob-country-combo d-md-none d-block">
                                <div class="col-12">
                                    <select class="selectpicker">
                                          <option>Popular</option>
                                          <option>Generics</option>
                                          <option>America</option>
                                          <option>Europe</option>
                                          <option>Asia</option>
                                          <option>Africa</option>
                                          <option>Oceania</option>
                                          <option>New Generics</option>
                                          <option>View All</option>
                                    </select>
                                </div>
                            </div>
                                <div class="tab-content">
                                  <div id="popular" class="tab-pane in active">
                                        <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div id="generic" class="tab-pane">
                                        <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div id="america" class="tab-pane">
                                    <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div id="europe" class="tab-pane">
                                        <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div id="asia" class="tab-pane">
                                        <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div id="africa" class="tab-pane">
                                        <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div id="oceania" class="tab-pane">
                                        <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div id="new-generics" class="tab-pane">
                                        <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div id="view-all" class="tab-pane">
                                        <div class="country_tabbing-main">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                           <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                    <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      India<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Afghanistan <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.af</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aland Islands<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ax</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Albania<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.al</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Algeria <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.dz </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      American <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.as</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Andorra  <input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ad</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">	   
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Angola<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ao</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Anguilla<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.ai</span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Antarctica<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.aq</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                      Antigua<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                     <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>  
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india"></div>
                                                                      Argentina <input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">ar</span>
                                                                </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-afga"></div>
                                                                      Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.am</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-aland"></div>
                                                                      Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                    <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-albania"></div>
                                                                      Australia<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.au</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-algeria"></div>
                                                                      Austria<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.at</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-america"></div>
                                                                      Azerbaijan<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.az</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-andorra"></div>
                                                                      Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-angola"></div>
                                                                      Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-anguilla"></div>
                                                                      Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bd</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antarctica"></div>
                                                                      Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.bb</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                                <div class="c-radio-btn d-flex">
                                                                   <label class="custom-radio">
                                                                      <div class="map-india map-antigua"></div>
                                                                        Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                                   </label>
                                                                   <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-12 col-12">
                                                    <div class="country-main-tabbing row">
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india"></div>
                                                                  Argentina<input type="checkbox" checked="checked"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.ar</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-afga"></div>
                                                                  Armenia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.am</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-aland"></div>
                                                                  Aruba<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.aw</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-albania"></div>
                                                                  Australia<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.au</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-algeria"></div>
                                                                  Austria<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.at</span> 
                                                             </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-america"></div>
                                                                  Azerbaijan<input type="checkbox"><span class="checkmark"></span>
                                                               </label>
                                                                <span class="domain-country ml-auto">.in
                                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="la la-question-circle" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i></a>
                                                                        <ul class="dropdown-menu tooltip-link-show">
                                                                            <li><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></li>
                                                                        </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-andorra"></div>
                                                                  Bahamas<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bs</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-angola"></div>
                                                                  Bahrain<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bx</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-anguilla"></div>
                                                                  Bangladesh<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bd</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antarctica"></div>
                                                                  Barbados<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.bb</span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-12">
                                                            <div class="c-radio-btn d-flex">
                                                               <label class="custom-radio">
                                                                  <div class="map-india map-antigua"></div>
                                                                    Belarus<input type="checkbox"> <span class="checkmark"></span>
                                                               </label>
                                                               <span class="domain-country ml-auto">.by</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
	               </div>
                </div>
                <hr/>
            </div>
            <div class="col-md-12">
                <a href="#" class="btn bulkserachbtn" title="Search Domain" data-aos="fade-up">Search Domain</a>
            </div>
        </div>
    </div>
</div>

<div class="vps-features bulksearch_features">
	<div class="container">
		<div class="row">
			<div class="features-main">
				<h2 class="features-title aos-init" data-aos="fade-up">All Domains come with</h2>
				<div class="features-start d-md-block d-none">
					<div class="row">
						<div class="feature-ul d-flex flex-wrap">
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="100">
									<div class="feature-icon">
										<i class="domain_sprite contact"></i>
									</div>
									<h3><a href="#" title="Domain Forwarding">Domain Forwarding</a></h3>
									<div class="content">
										Hit the ground running with the industry-standard control panel you
										already know & love.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="150">
									<div class="feature-icon">
										<i class="domain_sprite DNSSEC"></i>
									</div>
									<h3><a href="#" title="URL Masking">URL Masking</a></h3>
									<div class="content">
										We take care of patching, security monitoring, backups and more so you can focus on your business.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="200">
									<div class="feature-icon">
										<i class="domain_sprite managed-DNS"></i>
									</div>
									<h3><a href="#" title="DNS Management">DNS Management</a></h3>
									<div class="content">
										Some places take hours to get your server online. We’ll have you up &
										running in minutes.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="250">
									<div class="feature-icon">
										<i class="domain_sprite name-servers"></i>
									</div>
									<h3><a href="#" title="Domain Theft Protection">Domain Theft Protection</a></h3>
									<div class="content">
									You’re in charge with root (administrative) access to install PHP, modules, server level proxy, & much more.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="300">
									<div class="feature-icon">
										<i class="domain_sprite privacy-protected"></i>
									</div>
									<h3><a href="#" title="Easy-to-use Control Panel">Easy-to-use Control Panel</a></h3>
									<div class="content">
									Our servers are amped up & ready to go with the latest-gen Intel® processors.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="350">
									<div class="feature-icon">
										<i class="domain_sprite theft-protection"></i>
									</div>
									<h3><a href="#" title="24/7 Local Support">24/7 Local Support</a></h3>
									<div class="content">
									We won’t put your success on hold. Upgrade your plan anytime without having to re-provision.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!--features-start end -->
				<div class="features-start features-start-mob d-md-none d-block"> <!-- features-start-mob -->
					<div class="owl-carousel owl-theme">					    
					    <div class="item">
				    		<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic1.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Feel at home with cPanel</a></h3>
									<div class="content">
										Hit the ground running with the industry-standard control panel you
										already know & love.
									</div>
								</div>
							</div>

					    </div>
					    <div class="item">
				    		<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic2.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Managed services come standard</a></h3>
									<div class="content">
										We take care of patching, security monitoring, backups and more so you can focus on your business.
									</div>
								</div>
							</div>

					    </div>
			    	 	<div class="item">
						    <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
									<div class="content-main align-self-start">
										<div class="feature-icon">
											<img src="assets/images/vps_hosting/feature-ic3.svg" alt="" title=""/>
										</div>
										<h3><a href="#" title="">Provisioning that’ll rock your world.</a></h3>
										<div class="content">
											Some places take hours to get your server online. We’ll have you up &
											running in minutes.
										</div>
									</div>
								</div>
						</div>
						 <div class="item">
							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic4.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Find your roots</a></h3>
									<div class="content">
									You’re in charge with root (administrative) access to install PHP, modules, server level proxy, & much more.
									</div>
								</div>
							</div>
						</div>
						 <div class="item">
							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic5.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Processing power to spare</a></h3>
									<div class="content">
									Our servers are amped up & ready to go with the latest-gen Intel® processors.
									</div>
								</div>
							</div>
						</div>
						 <div class="item">
							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic6.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Provision-free upgrades</a></h3>
									<div class="content">
									We won’t put your success on hold. Upgrade your plan anytime without having to re-provision.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- features-start-mob  end-->
			</div> <!-- features-main end -->
		</div>
	</div>
</div>



<div class="row promotional-banner for-green-banner-col-width banner-for-vps-hosting bulksearch_deal">
			   <div class="col-lg-4 col-md-4 col-12 z-index-1 padding-0" >
				  <div class="row">
					 <div class="banner-1 justify-content-end d-flex"><div class="banner-wp-logo-green"></div><h2 class="banner-text" data-aos="fade-left">VPS Hosting Deals</h2><div class="banner-wp-blue-logo"></div></div>
				  </div>
			   </div>
			   <div class="col-lg-3 col-md-4 col-12 z-index-0 padding-0">
						<div class="row">
								<div class="banner-text2"><span class="starting-from">Today Starting From</span> <span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">199</span><span class="per-month">/mo*</span></span></div>
						</div>
			   </div>
			   <div class="col-lg-4 col-md-4 col-12 padding-0 d-flex">
					<div class="row align-self-center" data-aos="fade-right">
							<div class="banner-button"><a class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
					</div>
			  </div>
</div>



<div class="getquestion-div bulksearch_faq">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3 data-aos="fade-up">Got a Question? We've the Answer!</h3>
				</div>
				<div class="col-12">
					<div id="accordion">
					  <div class="card" data-aos="fade-up">
						<h4 class="mb-0">
							<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							  What is WordPress Hosting?
							</button>
						</h4>
						<div id="collapseOne" class="collapse" data-parent="#accordion" style="display:block;">
						  <div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
						  </div>
						</div>
					  </div>
					  <div class="card" data-aos="fade-up">
						<h4 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							  Can I upgrade my Wordpress Hosting plan?
							</button>
						</h4>
						<div id="collapseTwo" class="collapse" data-parent="#accordion">
						  <div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						  </div>
						</div>
					  </div>
					  <div class="card" data-aos="fade-up">
						<h4 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							  Can I add more sites to an existing plan?
							</button>
						</h4>
						<div id="collapseThree" class="collapse" data-parent="#accordion">
						  <div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						  </div>
						</div>
					  </div>
					  <div class="card" data-aos="fade-up">
						<h4 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
							  Can I use an external email service with Wordpress Hosting?
							</button>
						</h4>
						<div id="collapsefour" class="collapse" data-parent="#accordion">
						  <div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						  </div>
						</div>
					  </div>
					  <div class="card" data-aos="fade-up">
						<h4 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
							  Can I use an existing certificate with my blog?
							</button>
						</h4>
						<div id="collapsefive" class="collapse" data-parent="#accordion">
						  <div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						  </div>
						</div>
					  </div>
					  <div class="card" data-aos="fade-up">
						<h4 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
							  Will Wordpress be updated automatically?
							</button>
						</h4>
						<div id="collapsesix" class="collapse" data-parent="#accordion">
						  <div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				<div class="col-12 aos-init" data-aos="fade-up">
					<a href="#" title="More" class="more_link">More</a>
				</div>
			</div>
		</div>
</div>

<?php include('Templates/common_landing.php') ?>
<?php include('Templates/footer_section.php') ?>

<script src="assets/js/main.js"></script>
</body>
</html>