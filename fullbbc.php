<?php
function fetch_news(){
  $data = file_get_contents('https://rssbridge.net/fulltext/makefulltextfeed.php?url=feeds.bbci.co.uk%2Fnews%2Frss.xml&max=5&links=preserve&exc=&submit=Create+Feed');
  $data = simplexml_load_string($data);
  $articles = array();
  foreach($data->channel->item as $item){
    $media = $item->children('http://search.yahoo.com/mrss/');
    $image = array();
    foreach ($media->thumbnail[0]->attributes()as $key => $value) {
      $image[$key] = (string)$value;
    }
    $articles[] = array(
      'title'       => (string)$item->title,
      'description'   =>(string)$item->description,
      'link'        =>(string)$item->link,
      'image'         => $image,
    );
  }
$article[] = $articles[0];
 return $article;
}

 ?>
