<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $name=$request['name'];
        $email=$request['sourceUser'];
        $phone = $request['phone'];
        $msg=$request['msg'];
        $body = "Nova mensagem do formulário do site Frutos do Oeste.\n\n"."Corpo do formulário:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$msg";
        
        if($request->has('name') && $request->has('msg') && $request->has('sourceUser') && $request->has('phone') ){
            
            Mail::raw($body, function ($message) use ($name, $email, $phone, $msg) {
                $message->to('sousajoao07@hotmail.com')->subject("Mensagem de um utilizador do site: $name")->from($email,"Frutos Oeste Formulário");
            });
        }
        return response()->json(['message'=>'Email sent']);

    }

}
