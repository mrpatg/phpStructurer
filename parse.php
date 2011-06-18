<?
$dirs = explode("\n", $_POST[config]);

foreach ($dirs as $key => $value){
	if(strstr($value, "/")){
		$subdir = explode("/", $value);
		if($subdir){
			if(strstr($value, ".") && strstr($value, ":")){
				echo "$value is a file template<br/>";
			}else{		
				if(strstr($value, ".")){
					echo "$value is a file<br/>";
				}else{
					if(strstr($value, ":")){
						echo "$value is a file placement<br/>";
					}else{
						echo "$value is a subdir<br/>";
					}
				}
			}
		}
	}else{
		if(strstr($value, ".") && strstr($value, ":")){
			echo "$value is a file template<br/>";
		}else{
			if(strstr($value, ".")){
				echo "$value is a file<br/>";
			}else{
				if(strstr($value, ":")){
					echo "$value is a file placement<br/>";
				}
			}
		}
	}
}

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>


<form action=parse.php method=POST>
<textarea name=config></textarea>
<input type=submit>
</form>