<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Google;
use Session;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class TestController extends Controller
{
    public function test(Request $request) {
    	$name = $request->file('file')->getClientOriginalName();
    	$request->file('file')->move('images', 'save.mp3');

    	$client = Google::getClient();
    	
    	// if (!$client->getAccessToken() && !Session::get('token')) {
	    //     $authUrl = $client->createAuthUrl();
	    //     echo "<p><a class='login' href='$authUrl'>Login in</a></p>";
     //  	}
     //  	// Step 2: The user accepted your access now you need to exchange it.
     //  	if (Input::has('code')) {
     //  		dd(Input::get('code'));
     //    	$accessToken = $client->authenticate(Input::get('code'));
     //    	dd($client->getRefreshToken());
        	$refreshToken = '1/4bhwjA7MeBeeFVQ-r5yGv_YjVCrZLcpi9f3-Scbc4Vs';
        	$client->refreshToken($refreshToken);
      	//}
      	// if($client->getAccessToken()) {
      		$drive = Google::make('drive');
	    	$file = Google::make('Drive_DriveFile');

	    	
	        $file->setName($name);
	        $file->setDescription('A test picture');
	        $file->setMimeType('audio/mp3');
			$file->setParents(array('0B8UMM8ddaNq0Um1YTEdVbVJDRVE'));
	        
	        $data = file_get_contents('F:\xampp\htdocs\nguyen\z11app\public\images\save.mp3');
	        $createdFile = $drive->files->create($file, array(
	          'data' => $data,
	          'uploadType' => 'media',
	          'mimeType' => 'audio/mp3',
        	));
        	$id = $createdFile->getId();
        	$content = 'https://docs.google.com/uc?export=download&id='.$id;
        	// echo " <img src='".$content."' alt=''> ";
            echo " <audio src='".$content."' autobuffer autoloop loop controls></audio> ";
        	
        	return $content;
    	//}
    }
}
