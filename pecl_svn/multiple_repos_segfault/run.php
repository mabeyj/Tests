<?php

// Create 100 repositories in the same folder as this script (repo0 to repo99)
// for ($i = 0; $i < 100; $i++)
// {
//	`svnadmin create repo$i`;
// }

// Run this script several times and there should be Segmentation Faults logged
// in Apache's error.log

class Subversion
{
	public static $locks = array();

	public function __construct($path)
	{
		self::$locks[] = svn_repos_open($path);
	}
}

header('Content-Type: text/plain');

echo "Starting\n";

for ($i = 0; $i < 100; $i++)
{
	new Subversion("repo$i");
}

echo "Done\n";


