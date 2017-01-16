<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class PackageController extends Controller
{
    public function getpackage(Request $request, $category_code, $translate_name_text, $translate_name_text_package)
    {
		    	
    }

    public function postAddPackage(Request $request) {
    	try {
            $data = $request->all();
            // dd($data);

            $folder_id = $data['folder_id'];
            $package_cost = $data['package_cost'];

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
            return redirect('/');

        } catch (ClientErrorResponseException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
        }
    }
}
