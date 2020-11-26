<?php

require 'HTTPClient.php';

$HttpClient = new HTTPClient('http://jsonplaceholder.typicode.com', '', '');
$post = [
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1,
];
$result = $HttpClient->run('posts', (object)$post);
print_r($result);