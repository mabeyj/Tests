<?php

$zip = new ZipArchive;
if ( ! $zip->open('example.docx'))
{
	echo "Failed to open Word document\n";
	exit;
}

if ( ! $xml_file = $zip->getStream('word/document.xml'))
{
	echo "Failed to open Word document XML file";
	exit;
}

// This is the raw XML for the document's contents
$xml = stream_get_contents($xml_file);

$doc = new DOMDocument;
if ( ! $doc->loadXML($xml))
{
	echo "Failed to parse Word document XML\n";
	exit;
}

$xpath = new DOMXPath($doc);
$list = $xpath->query('//w:t');

foreach ($list as $node)
{
	echo $node->firstChild->wholeText."\n";
}

echo "Done\n";
