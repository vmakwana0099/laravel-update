<?php

namespace App\Http\Controllers;

use DB;
use Config;
use Illuminate\Http\Request;
use Session;
use Cookie;
use App\Careers;
use App\CareersDetails;
use App\CareersCategory;
use App\Helpers\MyLibrary;
use App\Helpers\Email_sender;

class CareersController extends FrontController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request){

        /*$companyIp=['27.54.170.98'];
        $IP='';
        if(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])){
            $IP = $_SERVER['HTTP_X_REAL_IP'];
        }else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR']; 
        }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
            $IP = $_SERVER['REMOTE_ADDR']; 
        }
        if (!in_array($IP,$companyIp)){ return redirect('/'); }*/

        $CareersData = [];

        // $filterArr['rangeFilter']['from']=date('Y-m-d');
        // $filterArr['rangeFilter']['to']=date('Y-m-d',strtotime('+1 year'));
        $filterArr['orderByFieldName'] = "intDisplayOrder";
        $filterArr['orderTypeAscOrDesc'] = "ASC";

        $CareersData['CareersData'] = Careers::getFrontList($filterArr);
        $CareersData['CareersCategoryData'] = CareersCategory::getFrontList();

        $responce['CareersData']=[];$i=0;
        foreach ($CareersData['CareersCategoryData'] as $key => $val) {
            $responce['CareersData'][$i]['varTitle']=$val;
            $responce['CareersData'][$i]['id']=$key;
            $j=0;
            foreach ($CareersData['CareersData'] as $careerskey => $careersval) {
                $categoryIDs=unserialize($careersval->txtCategories);
                if ($categoryIDs==$key) {

                    $responce['CareersData'][$i]['careers'][$j]=$careersval->toArray();
                    $j++;

                }
            }
            $i++;
        }
        // echo '<pre>';print_r($responce['CareersData']);exit;
        return view('careers', $responce);
    }

    public function careerDetails(Request $request){
        // echo '<pre>';print_r($request->all());exit;
        if (isset($request) && !empty($request)) {
            $CareersData['Experiences'] = Careers::getExperienceList();
            $CareersData['CareersCategoryData'] = CareersCategory::getFrontList();
            $CareersData['requestData'] = $request->all();
            // echo '<pre>';print_r($CareersData);exit;
            return view('career_details',$CareersData);
        }else{
            return redirect('/careers');
        }
    }

    public function careerDetailsStore(Request $request){
        //---------------- Google Captcha validation start -----------------
        // echo '<pre>';print_r($request->grecaptcha);exit;
        if(isset($request->grecaptcha) && !empty($request->grecaptcha)){ $captcha=$request->grecaptcha; 
        }else { return false; }
        $captcha = trim($captcha);
        $secretKey = Config::get('Constant.GOOGLE_CAPCHA_SECRATE');
        $secretKey = trim($secretKey);
        $gcaptchaurl = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);

         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $gcaptchaurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        //echo '<pre>';print_r($result);echo '</pre>';exit;
        curl_close($ch);
        
        // $response = file_get_contents($gcaptchaurl);
        // echo '<pre>';print_r($response);exit;
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) { } else { echo "Invalid Captcha";exit; }
        //---------------- Google Captcha validation end -----------------

        if(!$request->ajax() && !empty($request->grecaptcha)){
            try {
                $EmailID = MyLibrary::encrypt_decrypt('encrypt', trim($request->careers_email));
                $data=$request->all();
                $careerdetails = new CareersDetails;
                $careerdetails->varfirstname=trim($request->first_name)??"";
                $careerdetails->varlastname=trim($request->last_name)??"";
                $careerdetails->varemail=$EmailID??"";
                $careerdetails->txtfile=trim($request->filename)??"";
                $careerdetails->intphonenumber=trim($request->phone_number)??"";
                $careerdetails->intcareercat=trim($request->career_category)??"";
                $careerdetails->varexperience=trim($request->yearofexperience)??"";
                $careerdetails->txtmessage=trim($request->user_message)??"";
                $careerdetails->save();

                if (!empty($careerdetails->id)) {
                    $data['insertedData']=$careerdetails;

                    Email_sender::careersMail($data, $careerdetails->id);
                    return redirect("/careers/thankyou")->with(['form_submit' => true, 'message' => 'Thank you for contacting us, We will get back to you shortly.']);
                } else {
                    return redirect('/');
                }
                /*return redirect("/careers/thankyou")->with(['form_submit' => true, 'message' => 'Thank you for contacting us, We will get back to you shortly.']);*/
            } catch (Exception $e) {
                return redirect("/careers")->withErrors(['msg' => $e->getMessage()]);
            }
        }else{
            return redirect('/');
        }

    }

    public function careerDetailsFileupload(Request $request){
        // echo '<pre>';print_r($request->all());exit;
        $destinationPath=public_path('/careers_uploads/'.date('Y'));
        if (!file_exists($destinationPath)){
            mkdir($destinationPath, 0777, true);
        }

        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:5150', /*max upload file size 10mb*/
        ]);
        $file = $request->file('file');

        $fileName = (isset($request->first_name) && $request->last_name)?trim($request->first_name).'_'.trim($request->last_name)."_":"".date('YmdHis').'_CV'.'.'.$request->file('file')->extension();

        $errormsg='';
        if ($file->move($destinationPath, $fileName)){
            $uploadOk=1;
        }else{
            $errormsg="Sorry, there was an error uploading your file.";$uploadOk=0;
        }

        $responseArr = ["status" => $uploadOk,"msg" => $errormsg, "targetfile" => $fileName];
        echo json_encode($responseArr); exit;
    }

    public function thankyou(){
        if (Session::get('form_submit')) {
            view()->share('META_TITLE', Config::get('Constant.DEFAULT_META_TITLE'));
            view()->share('META_KEYWORD', Config::get('Constant.DEFAULT_META_KEYWORD'));
            view()->share('META_DESCRIPTION', Config::get('Constant.DEFAULT_META_DESCRIPTION'));
            return view('thankyou', ['message' => Session::get('message')]);
        } else {
            return redirect('/');
        }
    }

    
}