<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Datatables;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json() 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://gmedia.bz/DemoCase/main/list_karyawan',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "start":0,
            "count":10
        }',
        CURLOPT_HTTPHEADER => array(
            'Client-Service: gmedia-recruitment',
            'Auth-Key: demo-admin',
            'User-Id: 1',
            'Token: 8godoajVqNNOFz21npycK6iofUgFXl1kluEJt/WYFts9C8IZqUOf7rOXCe0m4f9B'
        ),
        ));

        $x = curl_exec($curl);
        $data = json_decode($x, true);
        
        curl_close($curl);
        
        // return DataTables::of($data['response'])->make(true);
        return Datatables::of($data['response'])
        ->addColumn('action', function($datax) {
            return ' <form action="'.route('karyawan.destroy', $datax["nip"]).'" method="post">
            '.csrf_field().'
            '.method_field("DELETE").'
                        <a href="'.route('karyawan.edit', $datax["nip"]).'" class="fa fa-edit" ></a>
                        <button class="fa fa-trash" onclick="return DeleteFunction()"></button>
                    </form>'; 
                })->make(true);  

    }

    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambahkaryawan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $curl = curl_init();
        
        $date = date('d-m-Y', strtotime($request->tgl_lahir));

        $postData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
            'tgl_lahir' => $date
        ];

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://gmedia.bz/DemoCase/main/add_karyawan',
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
            'Auth-Key: demo-admin',
            'User-Id: 1',
            'Token: 8godoajVqNNOFz21npycK6iofUgFXl1kluEJt/WYFts9C8IZqUOf7rOXCe0m4f9B'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return redirect(route('karyawan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curl = curl_init();

        $postData = [
            'nip' => $id,
        ];

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://gmedia.bz/DemoCase/main/detail_karyawan',
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
            'Auth-Key: demo-admin',
            'User-Id: 1',
            'Token: 8godoajVqNNOFz21npycK6iofUgFXl1kluEJt/WYFts9C8IZqUOf7rOXCe0m4f9B'
        ),
        ));

        $response = curl_exec($curl);
        $data = json_decode($response, true);
        curl_close($curl);
        //dd($data['response']['alamat']);
        return view('editkaryawan',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $curl = curl_init();

        $date = date('d-m-Y', strtotime($request->tgl_lahir));

        $postData = [
            'nip' => $id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
            'tgl_lahir' => $date
        ];

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://gmedia.bz/DemoCase/main/update_karyawan',
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
            'Auth-Key: demo-admin',
            'User-Id: 1',
            'Token: 8godoajVqNNOFz21npycK6iofUgFXl1kluEJt/WYFts9C8IZqUOf7rOXCe0m4f9B'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return redirect(route('karyawan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curl = curl_init();

        $postData = [
            'nip' => $id
        ];

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://gmedia.bz/DemoCase/main/delete_karyawan',
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
            'Auth-Key: demo-admin',
            'User-Id: 1',
            'Token: 8godoajVqNNOFz21npycK6iofUgFXl1kluEJt/WYFts9C8IZqUOf7rOXCe0m4f9B'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return redirect(route('karyawan.index'));
    }

    public function search(Request $request){
        $curl = curl_init();

        $postData = [
            'nip' => $request->nip,
        ];

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://gmedia.bz/DemoCase/main/detail_karyawan',
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
            'Auth-Key: demo-admin',
            'User-Id: 1',
            'Token: 8godoajVqNNOFz21npycK6iofUgFXl1kluEJt/WYFts9C8IZqUOf7rOXCe0m4f9B'
          ),
        ));
        
        $x = curl_exec($curl);
        $data = json_decode($x, true);
        //dd($data);
        curl_close($curl);
        // echo $response;
        return view('index',compact('data'));
    }
}
