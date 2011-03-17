<?php

$file = time() % 10 < 5 ? 'a' : 'b';

sleep(1);

if (isset($_SERVER['HTTP_IF_NONE_MATCH']) AND $_SERVER['HTTP_IF_NONE_MATCH'] === "\"$file\"")
{
	// Client is checking ETag and it's valid
	header('HTTP/1.1 304 Not Modified');
	header("ETag: \"$file\"");
}
else
{
	// Serve content
	header("ETag: \"$file\"");
	header('Content-Type: image/png');

	echo file_get_contents("$file.png");
}

