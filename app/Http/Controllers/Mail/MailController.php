<?php

namespace App\Http\Controllers\Mail;

use App\Mail\ReviewNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function getReview(Request $request)
    {
	    Mail::to(['timur.latypov@gmail.com'])
		    ->bcc('timur.e61@gmail.com')
		    ->send(new ReviewNotification($request));

	    return response()->json([
	    	'status' => Response::HTTP_OK
	    ], 200);
    }
}
