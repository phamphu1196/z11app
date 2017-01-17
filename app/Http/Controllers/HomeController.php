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
            $limit = 4;

            $client = new GuzzleHttpClient();
            $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 
            $content = json_decode($categories->getBody()->getContents(), true);
            $categories= $content['metadata'];

            $folders = $client->request('GET', 'http://kien.godfath.com/api/v1/folders/all/0'); 
            $contents = json_decode($folders->getBody()->getContents(), true);
            $folders = $contents['metadata'];
            // $folders_group = $folders->skip(0)->take(4);
            // dd($categories);
            // dd($folders);
            // dd($folders_group);
            return view('frontend.index')->with('categories', $categories)->with('folders',$folders);
        } catch (RequestException $re) {
            echo "Error!";
        }
        
    }
}
