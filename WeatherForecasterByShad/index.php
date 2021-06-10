<?php  
	$notification='';
	
	$cityName='';$country='';
	
	$hello='';$comma='';$latlong='';$degree='';$skyInfo='';$tempInfo='';$windInfo='';
	
	$lat='';$lon='';
	
	$sky='';$skyDescription='';$windSpeed='';$windSpeedDeg='';

	$temp_max='';$temp_min='';$feels_like='';$pressure='';$humidity='';
	function get_text($string)
	{
	 $string = trim($string);
	 $string = stripslashes($string);
	 $string = htmlspecialchars($string);
	 return $string;
	}
	if(isset($_POST["search"])){
		if (empty($_POST["cityName"])){
			$notification .='<p><label class="text-danger">Please Enter A City Name First</label></p>';
		}
		else{
			$cityName=get_text($_POST["cityName"]);
			if(!preg_match("/^[a-zA-Z ]*$/",$cityName)){
   			$notification .= '<p><label class="text-danger">Only letters and white space allowed in name.</label></p>';
  			}
  			if ($notification=='') {
  				error_reporting(0);
  				$url="https://openweathermap.org/data/2.5/weather?q=".$cityName."&lang=en&appid=439d4b804bc8187953eb36d2a8c26a02";
				
				$contents=file_get_contents($url);
				$climate=json_decode($contents);

				if ($climate->coord=='') {
					$notification='<p><label class="text-danger">Enter a valid city name.</label></p>';
				} else {
					$hello='Showing Results For';
					$comma=',';
					$latlong='Latitude & Longitude: ';
					$degree='&deg';
					$skyInfo='Sky';
					$tempInfo='Temperature';
					$windInfo='Wind';


					
					$lon=$climate->coord->lon;
					$lat=$climate->coord->lat;

					$sky=$climate->weather[0]->main;
					$skyDescription="(".$climate->weather[0]->description.")";
					
					$windSpeed="Wind Speed: ".$climate->wind->speed." knots";
					$windSpeedDeg="Wind Direction: ".$climate->wind->deg.$degree;
					
					$temp_max="Max Temp. : ".$climate->main->temp_max.$degree." C";
					$temp_min="Min Temp. : ".$climate->main->temp_min.$degree." C";
					$feels_like="Feels Like: ".$climate->main->feels_like.$degree." C";
					
					$pressure="Pressure: ".$climate->main->pressure."pa";
					$humidity="Humidity: ".$climate->main->humidity."%";
					
					$today=date("F j,y,g:i a");
					
					$cityName=$climate->name;
					$country=$climate->sys->country;
				}
				

				
				


				//echo $pressure."<br>";//+.$lat+"<br>"+.$sky+"<br>"+.$skyDescription+"<br>"+.$windSpeedDeg+"<br>"s+.$feels_like+"<br>";
				//echo $contents;
  			}
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Shad's Web Forecaster</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- font-Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div class="col-xl header">
		
			<h2>
				Demo Weather Forecast Application By Shad
			</h2>
		
		
			<p id="heading">
				Created With
			</p>
			<p id="context">
				PHP,HTML5,CSS3,Bootstrap4
			</p>
		
	</div>
	<div class="container">
		<form method="post">	
			<div class="row" align="center" >
				<div class="col-2">
					
				</div>
				<div class="form-group col-8" align="center">
					<input type="text" name="cityName" placeholder="Enter City Name" class="form-control" style="text-align: center;">
				</div>
				<div class="col-2">
					
				</div>
			</div>
			<div class="form-group" align="center">
	      		<input type="submit" name="search" class="btn btn-info" value="Search" style="background: #D8EEFE;padding-right: 30px;padding-left: 30px;margin-bottom: 20px;color: darkblue;" />
		   	</div>
		</form>
		<?php  echo $notification; ?>
		<div class="cityInfo">
			<?php echo $hello."<br>".$cityName.$comma.$country."<br>".$latlong.$lat.$degree.$comma.$lon.$degree; ?>
		</div>
		<div class="row">
			<div class="col sky">
				<h4>
					<?php echo $skyInfo; ?>
				</h4>
				<p>
					<?php echo $sky.$skyDescription; ?>
				</p>
			</div>
			<div class="col wind">
				<h4>
					<?php echo $windInfo; ?>
				</h4>
				<p>
					<?php echo $windSpeed."<br>".$windSpeedDeg."<br>".$pressure."<br>".$humidity; ?>
				</p>
			</div>
			<div class="col temparature">
				<h4>
					<?php echo $tempInfo; ?>
				</h4>
				<p>
					<?php echo $temp_max."<br>".$temp_min."<br>".$feels_like; ?>
				</p>
			</div>
			
		</div>
		
	</div>
	

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>