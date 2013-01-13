<?

$targetdir = "spooled/";

echo "What file do you want to minify:\n";

$cmd_input = read_stdin();

echo "Minifying $cmd_input...\n";

function read_stdin() {
	$fr=fopen("php://stdin","r");
	$input = fgets($fr,128);
	$input = rtrim($input);
	fclose ($fr);
	return $input;
}
$substrings = explode( '.', $cmd_input );
$name = $substrings[0];
$ext = $substrings[1];

$string = file_get_contents($cmd_input);
$string = str_replace(array("\r\n", "\r"), "\n", $string);
$lines = explode("\n", $string);
$new_lines = array();

foreach ($lines as $i => $line) {
	if(!empty($line))
		$new_lines[] = trim($line);
	}
	$string = implode($new_lines);
					
$currentfilepath=$targetdir.$name."-min.".$ext;
$currentfilehandler= fopen($currentfilepath, 'w') or die('ERROR: Could not open current file file!');
fwrite($currentfilehandler,$string) or die('ERROR: Could not write to file');
fclose($currentfilehandler);			
?>
