<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;



class UserController extends Controller
{
	//------Login-----------
	public function getLogin(Request $request)
	{
        if ($request->session()->has('token')) {
            return redirect('/');
        }
		return view('frontend.login');
	}
	public function postLogin(Request $request)
	{
		try {
            $data = $request->all();
        // dd($data);
            $client = new GuzzleHttpClient();
            $res = $client->request('POST', 'http://kien.godfath.com/api/v1/users/login', [
                'form_params' => [
                    'grant_type' => 'password',
                    'email' => $data['email'],
                    'password' => $data['password']
                ]
            ]);
            // dd($res);
            $json = json_decode($res->getBody(),true);
            // echo $res->getBody();
            // echo $json['metadata']['token'];
            // dd($json);
            if ($json['code'] ==200) {
                $request->session()->put('token', $json['metadata']['token']);
                $request->session()->put('id', $json['metadata']['user']['id']);
                $request->session()->put('type', $json['metadata']['user']['grant_type']);
                $request->session()->put('name', $json['metadata']['user']['profile']['name']);
                $request->session()->put('type_user', $json['metadata']['user']['type_user'][0]['name_role']);
                $request->session()->put('deadline', $json['metadata']['user']['type_user'][0]['deadline']);
                return redirect('/');

            }else {
                return redirect('login');
            }       
        } catch (ClientErrorResponseException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
        }
	}
    public function postLogout(Request $request)
    {
        $request->session()->forget('token');
        $request->session()->forget('id');
        return redirect('login');
    }


	//--------Register------------
	public function getRegister()
	{
		return view('frontend.register');
	}
	public function postRegister(Request $request)
	{
		$data = $request->all();
		$client = new GuzzleHttpClient();
        $result = $client->post('http://kien.godfath.com/api/v1/users/register', [
            'form_params' => [
                'name' => $data['name'],
                'email' => $data['email'],
                'gender' => $data['sex'],
                'password' => $data['password'],
                'password_confirmation' => $data['password_confirmation']
            ]
        ]);
        return redirect('/');
	}

	//--------------------------------------
    public function showDocument()
    {
    	return view('frontend.timeline');
    }


    public function editUser(Request $request)
    {
        // $client = new GuzzleHttpClient();
        // $res = $client->request('GET', 'http://kien.godfath.com/api/v1/users/profile', [
        //     'form_params' => [
        //         'authorization' => $request->session()->get('token')
        //     ]
        // ]);
        // $content = json_decode($res->getBody()->getContents(), true);
        // echo $content;
    	return view('frontend.edituser');
    }
    public function postEditUser(Request $request)
    {
        $data = $request->all();
        if ($data['name'] != '') {
            
        }
    }

    public function getTimeline(Request $request)
    {
        $headers = array([
                'Authorization'=> 'Bearer {'.$request->session()->get('token').'}'
            ]);
        $client = new GuzzleHttpClient(['headers' => $headers]);
        // dd($client);
        return view('frontend.timeline');
    }


    public function postLanguage(Request $request)
    {
        $language = $request->all();
        $request->session()->put('language', $language);
        return redirect('/');
    }

    public function getPurchases()
    {
        return view('frontend.purchases');
    }
}
