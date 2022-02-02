<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function actionlogin(Request $request)
    {
        $postData = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://gmedia.bz/DemoCase/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
            'Client-Service: gmedia-recruitment',
            'Auth-Key: demo-admin'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response, true);
        //dd($data);
        //return redirect(route('karyawan.index'));
        if($data['metadata']['status'] == '200') {
            return redirect(route('karyawan.index'));
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }

    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
