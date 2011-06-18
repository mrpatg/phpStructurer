<?
extract($_GET);

$zipfilename = $name;

$zip = new ZipArchive;
if ($zip->open('cache/'.$zipfilename, ZipArchive::CREATE) === TRUE) {
	$zip->addEmptyDir("dir"); 
    $zip->addFromString('dir/test.txt', 'file content goes here');
    $zip->close();

	header("Content-type: Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$zipfilename");
	header("Pragma: no-cache");
	header("Expires: 0");
	readfile("cache/$zipfilename");

	unlink("cache/$zipfilename");

	exit;

} else {
    echo 'failed';
}

?>