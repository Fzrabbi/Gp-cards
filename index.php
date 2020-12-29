<?php
require 'vendor/autoload.php';

function calculateTextBox($text,$fontFile,$fontSize,$fontAngle) {
	$rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text);
	$minX = min(array($rect[0],$rect[2],$rect[4],$rect[6]));
	$maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6]));
	$minY = min(array($rect[1],$rect[3],$rect[5],$rect[7]));
	$maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7]));

	return array(
		"left"   => abs($minX) - 1,
		"top"    => abs($minY) - 1,
		"width"  => $maxX - $minX,
		"height" => $maxY - $minY,
		"box"    => $rect
	);
}

$dest = 'img'.uniqid();
$dest1= 'img'.uniqid();


if (!empty($_POST["name"])){
	$name = strtoupper($_REQUEST['name']);

	$target_dir = "uploads/";
	$uploadOk = 1;

// Check if image file is a actual image or fake image
	if(!empty($_POST["fileToUpload"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}

// Check if file already exists
	// if (file_exists($target_file)) {
	// 	echo "Sorry, file already exists.";
	// 	$uploadOk = 0;
	// }

// Check file size


// Allow certain file formats
	

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo ", your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	
	


	
		// echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";


		    

	

		    

		    $pp = @imagecreatefrompng('uploads/'.$dest1 . '.' .'png');
 			

		 



		//$pp = imagecreatefromjpeg('uploads/'.$newfilename);

}


}
else {
	$name = '';
}

if (!empty($_POST["designation"])){
	$designation = $_REQUEST['designation'];
}
else {
	$designation = '';
}



// if (!empty($_FILES["fileToUpload"])){
// 	 $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
// 	$pp = $_FILES["fileToUpload"]["tmp_name"];
// }
// else {
// 	$pp = '';
// }


if (!empty($_POST["template"])){
	$template = $_REQUEST['template'];
}
else {
	$template = 1;
}

function fn_resize($image_resource_id,$width,$height) {
$target_width =235;
$target_height =235;
$target_layer=imagecreatetruecolor($target_width,$target_height);
imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$target_width,$target_height, $width,$height);
return $target_layer;
}

function calcPos($d, $t){
	
	if($t == 1){
		$textlength = calculateTextBox($d, dirname(__FILE__) . '/Telenor-Bold.ttf', 30, 0);
		return 560 - ($textlength["width"] / 2);
	}
	else{
		
		return 335 ;
	}
}

function calcPoss($d, $t){
	
	if($t == 1){
		$textlength = calculateTextBox($d, dirname(__FILE__) . '/Telenor-Light.ttf', 30, 0);
		return 560 - ($textlength["width"] / 2);
	}
	else
		return 335 ;
}

function calcPosss($d, $t){
	$textlength = calculateTextBox($d, dirname(__FILE__) . '/Telenor-Light.ttf', 15, 0);
	if($t == 1)
		return 776 - ($textlength["width"] / 2);
	else
		return 500 - ($textlength["width"] / 2);
}
// Create image
$image = new \NMC\ImageWithText\Image(dirname(__FILE__) . '/refs/'.$template.'.png');


// Add styled text to image
$text1 = new \NMC\ImageWithText\Text($name, 1, 40);
if($template == 1){
	$text1->color = '595757';
	$text1->size = 30;
}

else if($template == 2){
	$text1->color = 'ffffff';
	$text1->size = 25;
}

$text1->font = dirname(__FILE__) . '/Telenor-Bold.ttf';
$text1->lineHeight = 20;

$text1->startX = calcPos($text1->text, $template);
$text1->startY = ($template == 1) ? 890 : (($template == 2)  ? 890 : 910);
$image->addText($text1);



// Add another styled text to image
$text2 = new \NMC\ImageWithText\Text($designation, 1, 40);
if($template == 1){
	$text2->color = '595757';
	$text2->size = 30;
}
else if($template == 2){
	$text2->color = 'ffffff';
	$text2->size = 25;
}
$text2->font = dirname(__FILE__) . '/Telenor-Light.ttf';
$text2->lineHeight = 20;
$text2->startX = calcPoss($text2->text, $template);;
$text2->startY = ($template == 1) ? 930 : (($template == 2)  ? 930 : 940);
$image->addText($text2);

// Add another styled text to image
$text3 = new \NMC\ImageWithText\Text('', 1, 40);
$text3->color = 'ffffff';
$text3->font = dirname(__FILE__) . '/Telenor-Light.ttf';
$text3->lineHeight = 20;
$text3->size = 15;
$text3->startX = calcPosss($text3->text, $template);;
$text3->startY = ($template == 1) ? 610 : (($template == 3)  ? 700 : 960);
$image->addText($text3);


// Render image
if (!empty($_POST["template"])){
	$image->render(dirname(__FILE__) . '/outputs/'.$dest.'.png');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Grameenphone Superbrand</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="row row-cols-1 py-4">
			<div class="col">
				<div class="float-right">
					<svg width="51" height="48" viewBox="0 0 51 48" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M25.221 14.4173C25.9354 14.5299 26.0799 14.3816 26.1746 13.6882C26.3296 12.6303 26.699 10.8466 27.5622 9.01821C28.4969 7.04658 29.9854 4.88017 32.0673 3.42958C33.8208 2.22364 36.6948 0.887949 38.9198 0.403463C40.7399 0.00162001 42.4453 -0.0750825 43.9085 0.0638832C46.9155 0.3412 48.5789 1.22057 49.4138 2.35871C49.7235 2.7839 49.8929 3.30843 49.8998 3.64801C49.9237 4.21411 49.6828 4.95287 48.89 5.67812C48.1186 6.37674 46.473 7.26061 44.2289 8.03459C41.8995 8.83009 38.7163 9.67013 35.5433 10.419C32.8864 11.0468 31.3747 11.581 30.1125 12.02C28.013 12.75 27.3802 14.8935 28.6885 15.5481C30.5794 16.494 31.7621 17.4831 32.77 18.324C34.2818 19.596 36.0375 21.0927 38.2173 23.792C40.1922 26.2673 43.4229 30.9916 44.5857 35.5772C45.8727 40.6117 45.0685 45.3861 42.2923 46.7193C39.5703 48.0286 35.943 46.1393 33.3967 43.4301C30.9742 40.8589 29.2834 37.8303 27.6936 33.1588C26.3148 29.1435 25.7559 23.3209 25.7582 20.275C25.7582 19.2603 25.7422 19.0438 25.7822 18.1275C25.8746 17.329 23.7764 16.6685 21.5213 18.1573C18.955 19.8514 16.4408 22.9217 14.9565 24.7048C14.3108 25.4831 13.4355 26.6269 12.5081 27.8264C11.2854 29.3999 9.93574 31.0385 8.70537 31.9546C6.85373 33.3395 3.8788 33.912 1.79502 32.3869C0.636703 31.5373 0.0201208 29.9332 0.000758975 28.3024C-0.0165069 27.1543 0.260945 26.1156 0.819642 25.091C1.51766 23.8332 2.6669 22.4833 4.4888 20.9374C6.37278 19.3488 9.38024 17.552 12.3941 16.3098C16.9912 14.411 21.9409 13.8136 25.221 14.4173" fill="#19AAF8"></path> </svg>
				</div>
			</div>
		</div>
		<?php if (!empty($_POST["name"])){
			$dd = imagecreatefrompng('outputs/'.$dest.'.png');
			//var_dump($pp);

			$marge_right = -110;
			$marge_bottom = 557.4;
			$sx = imagesx($dd);
			

			// Copy the stamp image onto our photo using the margin offsets and the photo 
			// width to calculate positioning of the stamp. 
			

			imagepng($dd, 'outputs/'.$dest.'.png');
			imagedestroy($dd);

			?>
			<div class="row pb-3">
				<div class="col-lg-2">

				</div>

				<div class="col-lg-8 text-center py-4">
					<img src="outputs/<?php echo $dest; ?>.png" class="img img-fluid mb-3">
					<a class="py-2" download="outputs/<?php echo $dest; ?>.png" href="outputs/<?php echo $dest; ?>.png" title="<?php echo $dest; ?>">
						<button class="btn btn-primary"> Download</button>
					</a>
					<br>
					<br>
					<a href="https://gpinternalcomm.com/" class="py-2"><button class="btn btn-secondary">Generate New Card</button></a>
				</div>
				<div class="col-lg-2">

				</div>
			</div>
			
		<?php } ?>
		<?php if(empty($_POST["name"])){
			?>
			<div class="row pb-3" id="step-one">
				<div class="col-lg-2">

				</div>
				<div class="col-lg-8 text-center">
					<h3 class="py-2">Welcome</h3>
					<h4 class="py-2">Steps to follow</h4>
					<p>1. Input your Name</p>
					<p>2. Click generate card and download</p>
					<button class="btn btn-primary btn-lg" id="step-two">Proceed</button>
				</div>
				<div class="col-lg-2">

				</div>
			</div>
		<?php } ?>
		<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: none;" id="card-form">
			<div class="row row-cols-1 text-center">
				<div class="col text-center">
					<h4 class="text text-primary">GP Superbrand Template</h4>
				</div>
			</div>
			<div class="row row-cols-2  pb-4 ">
				<div class="col text-center pb-3" onclick="selTem(1)">
					<img src="refs/1.jpg" class="img img-fluid ref">
				</div>
				<div class="col text-center pb-3" onclick="selTem(2)">
					<img src="refs/2.jpg" class="img img-fluid ref">
				</div>

			</div>
			<div class="row row-cols-1 row-cols-lg-3 py-4">

				<div class="col ">
					<input type="hidden" name="template" id="template" value="1" />
					<div class="form-group">
						<label for="exampleInputEmail1">Your Name</label>
						<input type="text" class="form-control" name="name">
					</div>
				</div>
				<div class="col ">
					<div class="form-group">
						<label for="exampleInputEmail1">Your Designation</label>
						<input type="text" class="form-control" name="designation">
					</div>
				</div>

				<div class="col ">
					<label for="exampleInputPassword1" style="color:white;">Generate</label>
					<button type="submit" class="btn btn-primary form-control">Generate Card</button>
				</div>
			</div>
		</form>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</div>
	<script>
		function selTem(id){
			document.getElementById('template').value = id;
		}
		$('.ref').click( function(){
			$(this).css({ 'opacity': 1});
			$(".ref").not($(this)).css({ 'opacity': 0.3});
		});

		$("#step-two").on('click', function(){
			$("#card-form").css({"display": "block"});
			$("#step-one").css({"display": "none"});
		})

	</script>
</body>
</html>