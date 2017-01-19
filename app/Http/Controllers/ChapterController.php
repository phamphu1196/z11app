<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class ChapterController extends Controller
{
    public function getListOfGroupQuestion(Request $request, $name_text)
    {

        try {           
            $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
            $client = new GuzzleHttpClient(['headers'=> $headers]);

            // Get chapter with ID
            $arr = explode('-', $name_text);
            $chapter_id = end($arr);
            $chapter = $client->request('GET', 'http://kien.godfath.com/api/v1/chapter/'.$chapter_id);
            $contents = json_decode($chapter->getBody()->getContents(), true);
            $chapter = $contents['metadata'];
            // dd($chapter);

            return view('frontend.chapter')->with('chapter', $chapter);
        } catch (RequestException $re) {
            echo "Error!";
        }     
    }

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
