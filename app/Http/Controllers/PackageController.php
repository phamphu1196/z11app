<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class PackageController extends Controller
{
    public function getListOfChapters(Request $request, $text_value)
    {

        try {           
            $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
            $client = new GuzzleHttpClient(['headers'=> $headers]);

            // Get package with ID
            $arr = explode('-', $text_value);
            $package_id = end($arr);
            $package = $client->request('GET', 'http://kien.godfath.com/api/v1/package/'.$package_id);
            $contents = json_decode($package->getBody()->getContents(), true);
            $package = $contents['metadata'];

            // Get folders
            $folder_id = $package['folder_id'];
            $folder = $client->request('GET', 'http://kien.godfath.com/api/v1/folder/'.$folder_id);
            $contents = json_decode($folder->getBody()->getContents(), true);
            $folder = $contents['metadata'];

            return view('frontend.package')->with('package', $package)->with('folder', $folder);
        } catch (RequestException $re) {
            echo "Error!";
        }     
    }

    public function purchasePackage(Request $request) {
        $data = $request->all();

        $user_coin = $request->session()->get('coin');
        $url = $data['url'];
        $coin = $data['coin'];
        $cur_url = $data['cur_url'];

        if ($user_coin < $coin) {
            return redirect($cur_url)->with('failedNoti', "Bạn không đủ coin để mua gói này.");
        }
        else {
            $token = 'Bearer {'.$request->session()->get('token').'}';
            $client = new GuzzleHttpClient();
            $result = $client->put('http://kien.godfath.com/api/v1/users/chargecoin', [
                'headers' => ['Authorization' => $token],
                'form_params' => [
                    'coin' => -$coin
                ]
            ]);
            $result = json_decode($result->getBody(), true);
            $coin_current = $result['coin current'];
            $request->session()->put('coin', $coin_current);
            return redirect($url)->with('successNoti', "Mua gói thành công. Hiện tại bạn còn ".$coin_current." coin.");
        }
    }

    public function postAddPackage(Request $request) {
    	try {
            $data = $request->all();
            // dd($data);

            $folder_id = $data['folder_id'];
            $package_cost = $data['package_cost'];
            $name_text = $data['name_text'];

            $text_value_vi = $data['text_value'];
            $text_value_en = $data['text_value']."_en";
            $text_value = '{"vi":"'.$text_value_vi.'","en":"'.$text_value_en.'"}';

            $describe_value_vi = $data['describe_value'];
            $describe_value_en = $data['describe_value']."_en";
            $describe_value = '{"vi":"'.$describe_value_vi.'","en":"'.$describe_value_en.'"}';

            $token = 'Bearer {'.$request->session()->get('token').'}';
            $client = new GuzzleHttpClient();
            $result = $client->post('http://kien.godfath.com/api/v1/packages', [
                'headers' => ['Authorization' => $token],
                'form_params' => [
                    'folder_id' => $folder_id,
                    'text_value' => $text_value,
                    'describe_value' => $describe_value,
                    'package_cost' => $package_cost
                ]
            ]);
            $result = json_decode($result->getBody(), true);
            return redirect('/folder/'.$name_text);

        } catch (ClientErrorResponseException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
        }
    }
}
