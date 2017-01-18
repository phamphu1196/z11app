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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $limit = 8;
            $page = $request->exists('page') ? $request->input('page') : 1;
            $offset = ($page - 1) * $limit;           

            $client = new GuzzleHttpClient();
            $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 
            $content = json_decode($categories->getBody()->getContents(), true);
            $categories= $content['metadata'];
            // dd($categories);

            $folders = $client->request('GET', 'http://kien.godfath.com/api/v1/folders/'.$limit.'/'.$offset); 
            $contents = json_decode($folders->getBody()->getContents(), true);
            $folders = $contents['metadata'];
            $total_folder = $folders[0]['count'];
            // dd($folders);

            $total_page = ceil($total_folder / $limit) ;

            return view('frontend.index')->with('categories', $categories)->with('folders',$folders)->with('total_page', $total_page)->with('current_page', $page);
        } catch (RequestException $re) {
            echo "Error!";
        }
        
    }
}
