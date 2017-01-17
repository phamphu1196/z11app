<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Google;
use Google_Service_Drive;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Session;
use Input;
use Google_ParentReference;

class TestController extends Controller
{
    public function test(Request $request) {
    	$name = $request->file('file')->getClientOriginalName();
    	$request->file('file')->move('images', 'save.jpg');

    	$client = Google::getClient();
    	
    	// if (!$client->getAccessToken() && !Session::get('token')) {
	    //     $authUrl = $client->createAuthUrl();
	    //     echo "<p><a class='login' href='$authUrl'>Login in</a></p>";
     //  	}
     //  	// Step 2: The user accepted your access now you need to exchange it.
     //  	if (Input::has('code')) {
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
	        $file->setMimeType('image/jpeg');
			$file->setParents(array('0B8UMM8ddaNq0Um1YTEdVbVJDRVE'));
	        
	        $data = file_get_contents('F:\xampp\htdocs\nguyen\z11app\public\images\save.jpg');
	        $createdFile = $drive->files->create($file, array(
	          'data' => $data,
	          'uploadType' => 'media',
	          'mimeType' => 'image/jpeg',
        	));
        	$id = $createdFile->getId();
        	$content = 'https://docs.google.com/uc?export=download&id='.$id;
        	echo " <img src='".$content."' alt=''> ";
        	
        	return $content;
    	//}
    }
}
