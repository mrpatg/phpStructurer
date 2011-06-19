<?
require("filetemplates.php");
require("fileplacements.php");
$zipfilename = $_POST['name'];
$dirs = explode("\n", $_POST[config]);

$zip = new ZipArchive;
if ($zip->open('cache/'.$zipfilename, ZipArchive::CREATE) === TRUE) {

	foreach ($dirs as $key => $value){
		if(strstr($value, "/")){
			$subdir = explode("/", $value);
			if($subdir){
				if(strstr($value, ".") && strstr($value, ":")){
				//	echo "$value is a file template<br/>";
				$file = explode(":", $value);
				$filename = $file[0];
				$filetemplate = fileTemplates($file[1]);
				$zip->addFile($filetemplate, $filename);
				}else{		
					if(strstr($value, ".")){
					//	echo "$value is a file<br/>";
					}else{
						if(strstr($value, ":")){
						//	echo "$value is a file placement<br/>";
						}else{
							// This is a directory
							$value=trim($value);
							$zip->addEmptyDir("$value"); 
						}
					}
				}
			}
		}else{
			if(strstr($value, ".") && strstr($value, ":")){
			//	echo "$value is a file template<br/>";
				$file = explode(":", $value);
				$filename = $file[0];
				$filetemplate = fileTemplates($file[1]);
				$zip->addFromString("$filename", "$filetemplate");
			}else{
				if(strstr($value, ".")){
				//	echo "$value is a file<br/>";
				$value=trim($value);
					$zip->addFromString("$value", '');
				}else{
					if(strstr($value, ":")){
				//		echo "$value is a file placement<br/>";
					}
				}
			}
		}
	}

//	$zip->addEmptyDir("dir"); 
//  $zip->addFromString('dir/test.txt', 'file content goes here');
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








echo "<pre>";
print_r($_POST);
echo "</pre>";
?>


<form action=test.php method=POST>
<input type=text name=name><br/>
<textarea name=config></textarea>
<input type=submit>
</form>