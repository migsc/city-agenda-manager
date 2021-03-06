<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

function getStatusPos($text){
	$statuses = config('statuses');

	foreach($statuses as $status){

		$statusPos = strpos($text, $status);

		if($statusPos !== false){
			return $statusPos;
		}
	}

	return false;
}

$app->get('/', function () {
    return view('agenda');
});

$app->get('api/config', function () {
    return response()->json([
    	'statuses' => config('statuses'),
			'itemUnderDiscussionFilePath' => env('ITEM_UNDER_DISCUSSION_FILE_PATH'),
			'meetingAgendaFilePath' => env('MEETING_AGENDA_FILE_PATH')
	]);
});


$app->get('api/meetings', function () {
	$meetingsPath = env('MEETING_AGENDA_FILE_PATH');
	$meetingsFileContents = Storage::disk('s3')->get($meetingsPath);
	$meetingList = preg_split('/\n|\r\n?/', $meetingsFileContents);
	$body = array();


	foreach($meetingList as $index => $line){
		if(!empty($line)){

			$statusPos = getStatusPos($line);

			if($statusPos !== false){
				$body[$index]['title'] = trim(substr($line, 0, $statusPos));
				$body[$index]['status'] = substr($line, $statusPos);
			} else {
				$body[$index]['title'] = $line;
				$body[$index]['status'] = '';
			}

			$body[$index]['id'] = $index;

		}
	}

	return response()->json($body);
});

$app->put('api/meetings',function(Request $request){
	$meetingLines = [];
	$meetings = $request->json()->all();


	foreach($meetings as $meeting){
		$meetingLines[$meeting['id']] = $meeting['title'] . ' ' . $meeting['status'];
	}

	$meetingsFileContents = implode(PHP_EOL, $meetingLines);
	$meetingsPath = env('MEETING_AGENDA_FILE_PATH');

	$result = Storage::disk('s3')->put($meetingsPath, $meetingsFileContents);

	if($result){
		return response()->json([
	    	'success' => true
	    ]);
	} else {
		return response()->json([
    		'success' => false
    	]);
	}
});

$app->get('api/meetings/current', function () {
	$currentItemPath = env('ITEM_UNDER_DISCUSSION_FILE_PATH');
	$currentItemFileContents = Storage::disk('s3')->get($currentItemPath);

    return response()->json([
    	'title' => trim($currentItemFileContents)
    ]);
});

$app->put('api/meetings/current', function (Request $request) {
	$currentItemPath = env('ITEM_UNDER_DISCUSSION_FILE_PATH');
	$newTitle = $request->json('title');

	$result = Storage::disk('s3')->put($currentItemPath, $newTitle);

	if($result){
		return response()->json([
			'success' => true,
    	'title' => $newTitle
    ]);
	} else {
		return response()->json([
    		'success' => false
    	]);
	}

});
