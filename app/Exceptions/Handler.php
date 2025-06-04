<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Request;
use App\Helpers\MyLibrary;
use DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {   
       
        //Write error file -----------------------------
        try {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException && $exception->getStatusCode() == 404) {
        // Skip logging 404 errors
        return;
        }
        $e = FlattenException::create($exception);
    
        $handler = new SymfonyExceptionHandler();
    
        $html = $handler->getHtml($e);
        
        $ip = Mylibrary::get_client_ip();
        $url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $text = $html;
        
        $logData = array();	
        if(isset($ip) && !empty($ip)){ $logData['varIpAddress'] = $ip; }
        if(isset($url) && !empty($url)){ $logData['varUrl'] = $url; }
        $referralurl = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'';
        
        if(isset($referralurl) && !empty($referralurl)){ 
            $logData['varReferralurl'] = $referralurl; 
        }
        // if(isset($text) && !empty($text)){ 
        //     $logData['varText'] = $html;
        //     if ($ip != 27.54.170.98 || $ip != 172.31.39.245) {   //internal IP
        //         DB::table('clientactivityerror_log')->insert($logData);	
        //     }
        // }
        if (isset($text) && !empty($text)) { 
            $logData['varText'] = $html;
            if ($ip != '85.209.11.20') {   // internal IP
                DB::table('clientactivityerror_log')->insert($logData); 
            }
        }

        
        } catch (Exception $ex) {
            dd($ex);
        }
        //----------------------------------------------

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
