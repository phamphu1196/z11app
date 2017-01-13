<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getAllUser(Request $request)
    {
    	$headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
      	$client = new GuzzleHttpClient(['headers'=> $headers]);
      	$users = $client->request('GET', 'http://kien.godfath.com/api/v1/users/all/0'); 

      	$content = json_decode($users->getBody()->getContents(), true);
      	$users = $content['metadata'];
      	return view('admin.manager-member')->with('users', $users);
    }

    public function getUserId(Request $request,$id)
    {
    	$headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
      	$client = new GuzzleHttpClient(['headers'=> $headers]);
      	$users = $client->request('GET', 'http://kien.godfath.com/api/v1/users/'.$id); 
      	$content = json_decode($users->getBody()->getContents(), true);
      	$user = $content['metadata'];
      	return response()->json($user);
    }
    public function deleteUserId(Request $request)
    {
    	
    }
}
