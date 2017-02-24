<?php
$error='';
$status='';
$status2='';
if($_SERVER["REQUEST_METHOD"] == "POST") {
$target_dir = "image/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
        $status = "File is Ok - " . $FileType  . ".<br>";
        $uploadOk = 1;

//	For Debuging
//      echo $target_file . " " . $FileType . " " . $_FILES["fileToUpload"]["name"] ;
}
// Check if file already exists
if (file_exists($target_file)) {
    $error = "Sorry, file already exists.<br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5242880) {
    $error = "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
&& $FileType != "mp3" && $FileType != "wav" && $FileeType != "gif" ) {
    $error = "Sorry, only JPG, JPEG, PNG, GIF, MP3, WAV  files are allowed.<br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $status = "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	$status2 = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
    } else {
        $error = "Sorry, there was an error uploading your file.<br>";
    }
}
}
?>

<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>
<?php echo $status; ?>
<?php echo $status2; ?>
<?php echo $error; ?>
</body>
</html>
