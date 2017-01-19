<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
class FolderController extends Controller
{
    public function getListOfPackages(Request $request, $translate_name_text)
    {

    	try {           
            $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
            $client = new GuzzleHttpClient(['headers'=> $headers]);

            // Get categories
            $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 
            $content = json_decode($categories->getBody()->getContents(), true);
            $categories= $content['metadata'];

            // Get folder
            $arr = explode('-', $translate_name_text);
            $folder_id = end($arr);
            $folder = $client->request('GET', 'http://kien.godfath.com/api/v1/folder/'.$folder_id);
            $contents = json_decode($folder->getBody()->getContents(), true);
            $folder = $contents['metadata'];

            // Get list of package that user bought
            $user_id = $request->session()->get('id');
            $packages_purchased = $client->request('GET', 'http://kien.godfath.com/api/v1/purchases/users/'.$user_id);
            $contents = json_decode($packages_purchased->getBody()->getContents(), true);
            $packages_purchased = $contents['metadata'];

            return view('frontend.folder')->with('categories', $categories)->with('folder', $folder)->with('packages_purchased', $packages_purchased);
        } catch (RequestException $re) {
            echo "Error!";
        }     
    }

    public function postAddFolder(Request $request)
    {
    	try {
            $data = $request->all();

            $text_value_vi = $data['text_value'];
            $text_value_en = $data['text_value']."_en";
            $text_value = '{"vi":"'.$text_value_vi.'","en":"'.$text_value_en.'"}';

            $describe_value_vi = $data['describe_value'];
            $describe_value_en = $data['describe_value']."_en";
            $describe_value = '{"vi":"'.$describe_value_vi.'","en":"'.$describe_value_en.'"}';

            $token = 'Bearer {'.$request->session()->get('token').'}';
            $client = new GuzzleHttpClient();
            $result = $client->post('http://kien.godfath.com/api/v1/folders', [
                'headers' => ['Authorization' => $token],
                'form_params' => [
                    'category_id' => $data['category_id'],
                    'text_value' => $text_value,
                    'describe_value' => $describe_value
                ]
            ]);
            $result = json_decode($result->getBody(), true);
            return redirect('/');

        } catch (ClientErrorResponseException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
        }
      
    }
}
