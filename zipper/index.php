<?php

function zipper($pathToFile){
	$zip = new ZipArchive();
	if ($zip->open(basename($pathToFile).'.zip',ZipArchive::CREATE)!==true)
		return false;
	if (is_dir($pathToFile)){
		$iterator=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pathToFile));
		foreach ($iterator as $key=>$value){
			if (basename($key)!='.'&&basename($key)!='..')
				$zip->addFile(realpath($key),$key);
		}
	}
	else
		$zip->addFile($pathToFile);
	$zip->close();
	header('Content-Disposition: attachment; filename="'.basename($pathToFile).'.zip"');
	print readfile(basename($pathToFile).'.zip');
	return true;
}


zipper('/var/www/html/zipper');