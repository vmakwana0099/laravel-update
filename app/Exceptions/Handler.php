<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Helpers\MyLibrary;

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
     * @param  \Throwable  $exception
     * @return void
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        try {
            if ($this->shouldReport($exception)) {
                // Skip logging 404 errors
                if (method_exists($exception, 'getStatusCode') && $exception->getStatusCode() == 404) {
                    return;
                }

                $ip = MyLibrary::get_client_ip();
                $host = $_SERVER['HTTP_HOST'] ?? 'cli';
                $requestUri = $_SERVER['REQUEST_URI'] ?? '';
                $url = "https://".$host.$requestUri;
                $referralurl = $_SERVER['HTTP_REFERER'] ?? '';

                $logData = [];
                if (!empty($ip)) $logData['varIpAddress'] = $ip;
                if (!empty($url)) $logData['varUrl'] = $url;
                if (!empty($referralurl)) $logData['varReferralurl'] = $referralurl;

                $logData['varText'] = $exception->getMessage();

                // Prevent logging for internal IP (adjust IPs as needed)
                if (app()->bound('db') && $ip !== '85.209.11.20') {
                    DB::table('clientactivityerror_log')->insert($logData);
                }
            }
        } catch (\Throwable $e) {
            // Optionally log to file or ignore
            // file_put_contents(storage_path('logs/custom-error.log'), $e->getMessage(), FILE_APPEND);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
