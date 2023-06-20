<html>
	<head>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
/* 
| Developed by: Tauseef Ahmad
| Last Upate: 01-19-2021 08:45 PM
| Facebook: www.facebook.com/ahmadlogs
| Twitter: www.twitter.com/ahmadlogs
| YouTube: https://www.youtube.com/channel/UCOXYfOHgu-C-UfGyDcu5sYw/
| Blog: https://ahmadlogs.wordpress.com/
 */ 
 
 
include_once 'Zoom_Api.php';

$zoom_meeting = new Zoom_Api();

$data = array();
$data['topic'] 		= 'Telehealth Appiontment';
$data['start_date'] = date("Y-m-d h:i:s", strtotime('tomorrow'));
$data['duration'] 	= 30;
$data['type'] 		= 2;
$data['password'] 	= "12345";

try {
	if($_POST['flag']=="1")
	{
		$data['start_date'] = $_POST['start_date'].''.$_POST['start_time'];
		$data['start_time'] = $_POST['start_time'];
		$data['duration'] 	= $_POST['duration'];
	
	$response = $zoom_meeting->createMeeting($data);
	
	// echo "<pre>";
	$response=(array)$response;
	print_r($response);

	// echo "<pre>";
	die();
	// echo "Meeting ID: ". $response->id;
	// echo "<br>";
	// echo "Topic: "	. $response->topic;
	// echo "<br>";
	// echo "Start URL: ". $response->start_url ."<a href='". $response->start_url ."'>Open URL</a>";
	// echo "<br>";
	// echo "Join URL: ". $response->join_url ."<a href='". $response->join_url ."'>Open URL</a>";
	// echo "<br>";
	// echo "Meeting Password: ". $response->password;
}
else if($_GET['flag']=="2")
{
	$response = $zoom_meeting->GetMeetingList();
	?>
	<div class="container table-responsive py-5"> 
	<br><br>
		<a href="index.php?flag=1"  class='btn btn-primary'>Create Meeting</a>
		<br><br>
<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">MeetingID</th>
      <th scope="col">StartDate</th>
	  <th scope="col">Topic</th>
      <th scope="col">Duration</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
	  $i=1;
	  foreach($response->meetings as $rows)
	  {
		   $row=(array)$rows;
		   $time = strtotime($row['start_time'] .' UTC');
		   $dt = new DateTime($row['start_time']);
		   $tz = new DateTimeZone('Asia/Kolkata');
		   $dt->setTimezone($tz);
		   $dateInLocal = $dt->format('Y-m-d H:i:s');
   echo" <tr>
      <th scope='row'>".$i."</th>
      <td>".$row['id']."</td>
      <td>".$dateInLocal."</td>
      <td>".$row['topic']."</td>
	  <td>".$row['duration']."</td>
      <td><a href=".$row['join_url']." target='_blank' class='btn btn-primary'>Start meeting</a> <a href='index.php?flag=4&&meeting_id=".$row['id']."' class='btn btn-primary'>Update meeting</a> <a href='index.php?flag=3&&meeting_id=".$row['id']."' class='btn btn-danger'>Cancel meeting</a></td>
    </tr>";
	$i++;
	  }
   ?>

  </tbody>
</table>
</div>
<?php
	// echo "<pre>";
	// print_r($response->meetings);
	// echo "<pre>";
}
else if($_GET['flag']=="3")
{
	$response1 = $zoom_meeting->deleteMeeting($_GET['meeting_id']);
	if($response1)
{
		$response = $zoom_meeting->GetMeetingList();
	?>
	<div class="container table-responsive py-5"> 
		<br><br>
		<a href="index.php?flag=1"  class='btn btn-primary'>Create Meeting</a>
		<br><br>
		<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">MeetingID</th>
      <th scope="col">StartDate</th>
	  <th scope="col">Topic</th>
      <th scope="col">Duration</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
	  $i=1;
	  foreach($response->meetings as $rows)
	  {
		   $row=(array)$rows;
   echo" <tr>
      <th scope='row'>".$i."</th>
      <td>".$row['id']."</td>
      <td>".$row['start_time']."</td>
      <td>".$row['topic']."</td>
	  <td>".$row['duration']."</td>
      <td><a href=".$row['join_url']." target='_blank' class='btn btn-primary'>Start meeting</a> <a href='index.php?flag=4&&meeting_id=".$row['id']."' class='btn btn-primary'>Update meeting</a> <a href='index.php?flag=3&&meeting_id=".$row['id']."' class='btn btn-danger'>Cancel meeting</a></td>
    </tr>";
	$i++;
	  }
   ?>

  </tbody>
</table>

</div>
<?php

echo "<p class='text-center'>".$response1."</p>";
	}

	

}	
else if($_GET['flag']=="4")
{
	$response1 = $zoom_meeting->updateMeeting($data,$_GET['meeting_id']);
	if($response1=="")
{
		$response = $zoom_meeting->GetMeetingList();
	?>
	<div class="container table-responsive py-5"> 
		<br><br>
		<a href="index.php?flag=1"  class='btn btn-primary'>Create Meeting</a>
		<br><br>
		<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">MeetingID</th>
      <th scope="col">StartDate</th>
	  <th scope="col">Topic</th>
      <th scope="col">Duration</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
	  $i=1;
	  foreach($response->meetings as $rows)
	  {
		   $row=(array)$rows;
   echo" <tr>
      <th scope='row'>".$i."</th>
      <td>".$row['id']."</td>
      <td>".$row['start_time']."</td>
      <td>".$row['topic']."</td>
	  <td>".$row['duration']."</td>
      <td><a href=".$row['join_url']." target='_blank' class='btn btn-primary'>Start meeting</a> <a href='index.php?flag=4&&meeting_id=".$row['id']."' class='btn btn-primary'>update meeting</a> <a href='index.php?flag=3&&meeting_id=".$row['id']."' class='btn btn-danger'>Cancel meeting</a></td>
    </tr>";
	$i++;
	  }
   ?>

  </tbody>
</table>

</div>
<?php
						}
						else
						{
							print_r($response1);
						}

	

	

}	
} catch (Exception $ex) {
    echo $ex;
}


?>
</body>
<html>