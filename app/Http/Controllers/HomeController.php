<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
            $client = new GuzzleHttpClient(['headers'=> $headers]);
            $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 
            // dd($categories);
 
            $content = json_decode($categories->getBody()->getContents(), true);
            $categories= $content['metadata'];
            $languages = $client->request('GET', 'http://kien.godfath.com/api/v1/language');
            $contents = json_decode($languages->getBody()->getContents(), true);
            $languages = $contents['listlanguage'];
            return view('frontend.index')->with('categories', $categories)->with('languages',$languages);
        } catch (RequestException $re) {
            echo "con duy";
        }
        
    }
}
