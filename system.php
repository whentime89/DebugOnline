<?php
	$code = $_POST["code"];
	$title = $_POST["title"];
	$debug = $_POST["debug"];
	$debugs = $_POST["debugs"];
	$next = $_POST["next"];
	$action = $_POST["action"];
	$debugline = $_POST["debugline"];
	$barname = $_POST["barname"];
	//echo $code.$title.$action;
	function getResult($file)
	{
		$result = file_get_contents($file);	
		return $result;		
	}
	//echo $code.$title.$debugline.$barname;
	
	//echo $action;	
	$dir = "/var/www/debugonline/temp/";
	$filename = $dir.$title;
	$fp = fopen($filename,"w");
	fputs($fp,$code);
	fclose($fp);
	if($action == "run")
	{	
		$command = "cd temp && make run" ;
		//echo $command;
		exec($command);
		$resultfile = $dir."run_output";
		$result = getResult($resultfile);
		unlink($filename);
		echo $result;
		
	}
	else if($action == "compile")
	{
		$command = "cd temp && make";
		shell_exec($command);
		$resultfile = $dir."compile_output";
		$result = getResult($resultfile);
		if($result == "")
			echo "compile good";
		else echo $result;
		
	}
	else if($action == "debug")
	{	
		$command = "make gdb";
		shell_exec($command);
	}
	
	
	
	
?>
