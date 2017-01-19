<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Google;



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
            $client = new GuzzleHttpClient();
            $res = $client->request('POST', 'http://kien.godfath.com/api/v1/users/login', [
                'form_params' => [
                    'grant_type' => 'password',
                    'email' => $data['email'],
                    'password' => $data['password']
                ]
            ]);
            $json = json_decode($res->getBody(),true);
            // dd($json);
            if ($json['code'] ==200) {
                $user = $json['metadata'];
                $request->session()->put('language','1');
                $request->session()->put('token', $user['token']);
                $request->session()->put('id', $user['user']['id']);
                $request->session()->put('type', $user['user']['grant_type']);
                $request->session()->put('name', $user['user']['profile']['name']);
                $request->session()->put('coin', $user['user']['profile']['coin']);
                $request->session()->put('email', $user['user']['email']);
                $request->session()->put('type_user', $user['user']['type_user'][0]['name_role']);
                $request->session()->put('deadline', $user['user']['type_user'][0]['deadline']);
                if ($user['user']['profile']['image']) {
                    $request->session()->put('image', $user['user']['profile']['image']);
                }
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
        $request->session()->forget('language');
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
    	return view('frontend.edituser');
    }

    public function uploadToDrive($request) {
        $name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move('drive', 'save.jpg');
        $client = Google::getClient();
        $refreshToken = '1/EQf9qw6bDhAYVVfHZf5k8aFs_mAV2-AGKX6dTAh2Alk';
        $client->refreshToken($refreshToken);

        $drive = Google::make('drive');
        $file = Google::make('Drive_DriveFile');
        $file->setName($name);
        $file->setDescription('Profile picture');
        $file->setMimeType('image/jpeg');
        $file->setParents(array('0B4P1fd8eFWewcE9Xa2hZWUVFSUE'));
        
        $data = file_get_contents('drive/save.jpg');
        $createdFile = $drive->files->create($file, array(
          'data' => $data,
          'uploadType' => 'media',
          'mimeType' => 'image/jpeg',
        ));
        $id = $createdFile->getId();
        $image_url = 'https://docs.google.com/uc?export=download&id='.$id;

        return $image_url;
    }

    public function putEditUser(Request $request)
    {
        $token = 'Bearer {'.$request->session()->get('token').'}';
        $client = new GuzzleHttpClient();

        if ($request->hasFile('image')) {
            // dd(1);
            $image_url = $this->uploadToDrive($request);
        
            $result = $client->put('http://kien.godfath.com/api/v1/users/profile', [
                'headers' => ['Authorization' => $token],
                'form_params' => [
                    'name' => $request->name,
                    'image' => $image_url
                ]
            ]);
           
            $request->session()->put('name', $request->name);
            $request->session()->put('image', $image_url);
        }
        else {
            $result = $client->put('http://kien.godfath.com/api/v1/users/profile', [
                'headers' => ['Authorization' => $token],
                'form_params' => [
                    'name' => $request->name
                ]
            ]);
            $request->session()->put('name', $request->name);
        }

        $result = json_decode($result->getBody(), true);
        $status = $result['status'];

        return redirect('/edituser')->with('status', $status);
    }

    public function getTimeline(Request $request)
    {
        $headers = array([
                'Authorization'=> 'Bearer {'.$request->session()->get('token').'}'
            ]);
        $client = new GuzzleHttpClient(['headers' => $headers]);
        return view('frontend.timeline');
    }

    public function postLanguage(Request $request)
    {
        $language = $request->all();
        // dd($language['language']);
        if ($request->session()->has('language')){
            $request->session()->forget('language');
        }
        $request->session()->put('language', $language['language']);
        return redirect('/');
    }

    public function getPurchases()
    {
        return view('frontend.purchases');
    }
}
