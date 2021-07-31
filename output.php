<?php 
// echo "Entry"; exit;
	$response = [];
	$response['status'] = "Failure";
	$response['data'] = $_FILES['video_file'];

	if ($_FILES["audio_file"]["error"] > 0)
	$response['message']['audio'] = "Return Code: " . $_FILES["audio_file"]["error"];
	else
	{
	  move_uploaded_file($_FILES["audio_file"]["tmp_name"],
	  "upload/" . $_FILES["audio_file"]["name"]);

	  // echo "Audio"; exit;

	  $response['message']['audio'] = "Stored in: ";
	}

	if ($_FILES["video_file"]["error"] > 0)
	$response['message']['video'] = "Return Code: " . $_FILES["video_file"]["error"];
	else
	{
	  move_uploaded_file($_FILES["video_file"]["tmp_name"],
	  "upload/" . $_FILES["video_file"]["name"]);

	  $response['message']['video'] = "Stored in: ";
	}
	if(file_exists('upload/audio_filevideo_file.webm'))
	{
		 unlink('upload/audio_filevideo_file.webm');
	}
	if(shell_exec('ffmpeg -i upload/audio.mp4' . ' -i upload/video.mp4 -c copy upload/audio_filevideo_file.webm'))
	{
		$response['message']['upload'] = "uploaded in: ";
	}

 //    unlink('upload/' . $_FILES["audio_file"]["name"]);
	// unlink('upload/' . $_FILES["video_file"]["name"]);

	$response['status'] = "Success";

	echo json_encode($response);

?>