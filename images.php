<?php
 
require 'config.php';
require 'functions.php';
 
if(isset($_FILES['fupload'])) {
     
    if(preg_match('/[.](jpg)|(gif)|(png)$/', $_FILES['fupload']['name'])) {
         
        $filename = $_FILES['fupload']['name'];
        $source = $_FILES['fupload']['tmp_name'];   
        $target = $path_to_image_directory . $filename;
         
        move_uploaded_file($source, $target);
         
        createThumbnail($filename);     
    }
}
?>
 

<html>
      <link rel="stylesheet" type="text/css" href="style.css">
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="author" content="" />
<head>
    
    <title>Image Uploads</title>
</head>
 
<body>
    <h1 style="color: white;">Photos</h1>
    <div style="margin-left:100px;margin-top:100px;">
    <form enctype="multipart/form-data" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
        <div style="background-color: white;border: 4px solid black;background-image: url(Plus_button.png);width: 219px;height:  219px;">
            <input type="file" name="fupload"style="opacity:  0; width: 100%;height:  100%;" /></div>
        <input type="submit" value="Submit!" style="margin-top:40px;"/>
    </form>
    </div>
  
</body>
</html>