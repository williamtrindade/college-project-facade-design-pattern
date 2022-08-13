<?php

namespace App\Http\Controllers;

use App\Services\Facades\Mail\MailFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mail(Request $request): JsonResponse
    {
        $mail = new MailFacade();
        $mail->to('Wil', $request->to)
            ->from('William', $request->from)
            ->subject($request->subject)
            ->message($request->message)
            ->cc('tests@ggg.net')
            ->bcc('willafdsfssiam@fsdd.net')
            ->send();
        return response()->json($mail->getStatus());
    }
}
