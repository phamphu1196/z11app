<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class ChapterController extends Controller
{
    // public function getListOfChapters(Request $request, $text_value)
    // {

    //     try {           
    //         $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
    //         $client = new GuzzleHttpClient(['headers'=> $headers]);

    //         // Get categories
    //         // $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 
    //         // $content = json_decode($categories->getBody()->getContents(), true);
    //         // $categories= $content['metadata'];



    //         // Get package with ID
    //         $arr = explode('-', $text_value);
    //         $package_id = end($arr);
    //         $package = $client->request('GET', 'http://kien.godfath.com/api/v1/package/'.$package_id);
    //         $contents = json_decode($package->getBody()->getContents(), true);
    //         $package = $contents['metadata'];
    //         // dd($package);

    //         // Get folders
    //         $folder_id = $package['folder_id'];
    //         $folder = $client->request('GET', 'http://kien.godfath.com/api/v1/folder/'.$folder_id);
    //         $contents = json_decode($folder->getBody()->getContents(), true);
    //         $folder = $contents['metadata'];
    //         // dd($folder);

    //         return view('frontend.package')->with('package', $package)->with('folder', $folder);
    //     } catch (RequestException $re) {
    //         echo "Error!";
    //     }     
    // }

    public function postAddChapter(Request $request) {
        try {
            $data = $request->all();

            $package_id = $data['package_id'];
            $name_text_id = $data['name_text_id'];

            $token = 'Bearer {'.$request->session()->get('token').'}';
            $client = new GuzzleHttpClient();
            $result = $client->post('http://kien.godfath.com/api/v1/chapters', [
                'headers' => ['Authorization' => $token],
                'form_params' => [
                    'package_id' => $package_id,
                    'name_text' => $data['name_text'],
                    'describe_text' => $data['describe_text']
                ]
            ]);
            $result = json_decode($result->getBody(), true);
            return redirect('/package/'.$name_text_id);

        } catch (ClientErrorResponseException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
        }
    }
}
