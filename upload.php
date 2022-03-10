<?php
$ch = curl_init('https://jsonplaceholder.typicode.com/posts');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$posts_json = curl_exec($ch);
curl_close($ch);

$posts = json_decode($posts_json,true);

include "connect.php";
$pdo->exec("set names utf8");

$p = 0;
foreach ($posts as $post){
    $data = array( 
        'userId' => $post['userId'], 
        'id' => $post['id'],
        'title' => $post['title'],
        'body' => $post['body'],
        );
        
        $query = $pdo->prepare("INSERT INTO posts (userId, id, title, body) values (:userId, :id, :title, :body)");  
        $indicator = $query->execute($data); 
        if ($indicator) {
            $p++;  
        }    
           

}

$ch2 = curl_init('https://jsonplaceholder.typicode.com/comments');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_HEADER, false);
$comments_json = curl_exec($ch2);
curl_close($ch2);

$comments = json_decode($comments_json,true);

$c = 0;
foreach ($comments as $comment){
    $data2 = array( 
        'postId' => $comment['postId'], 
        'id' => $comment['id'],
        'name' => $comment['name'],
        'email' => $comment['email'],
        'body' => $comment['body'],
        );        
        $query2 = $pdo->prepare("INSERT INTO comments (postId, id, name, email, body) values (:postId, :id, :name, :email, :body)");  
        $indicator2 = $query2->execute($data2);
        if($indicator2 ) {
            $c++; 
        }                  

}
echo "Загружено" .$p."записей и ".$c." комментариев";
?> 