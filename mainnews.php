<?php
include('fullbbc.php');

 ?>
 <html lang="en" dir="ltr">
   <head>
     <meta name="viewport" content="width=device-width, initial-scale=1 ">
     <link rel="stylesheet" type="text/css" href="style.css">
     <meta charset="utf-8">
     <title>News</title>
   </head>
   <body >
<h1 style="color: white;">News</h1>
     <?php
     foreach(fetch_news()as $article){
       ?>
       <img src="<?php echo $article['image']['url']; ?>" alt"" width="100%" style="display: block;/* margin: 46px 30%; */max-width: 600px;max-height:  300px;margin-left: auto;margin-right: auto;" />
       <h2 style="color:  white; text-align:  center;"><?php echo $article['title']; ?></h2>
       <div style="color:  white;text-align: center;">
       <p style="text-align:  center;color: white;"> <?php echo $article ['description']; ?></p>
         <?php
     }

     ?>
     </div>
   </body>


 </html>
