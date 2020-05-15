<?php //header("Cache-Control: no-cache, must-revalidate");
// session_start();

/*
 This file will generate our CSV table. There is nothing to display on this page, it is simply used
 to generate our CSV file and then exit. That way we won't be re-directed after pressing the export
 to CSV button on the previous page.
*/

// convert the sent data into a flat array
$data = json_decode(file_get_contents('php://input'), true);

// extract the headers from the array
$headers = array_keys($data);

// our main csv file
$file_name = '../../results/results.csv';
$exists = file_exists($file_name);

// open a file handle to append new data
$handle = fopen($file_name, 'a+');

// if the file is empty, write a header line first
if (!$exists){
	fputcsv($handle, $headers);
}

// add the received data to the file
fputcsv($handle, $data);

// close the file
fclose($handle);
exit;

?>
