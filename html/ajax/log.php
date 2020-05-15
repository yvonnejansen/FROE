<?php 
/*
 This file will generate our CSV table. There is nothing to display on this page, it is simply used
 to generate our CSV file and then exit. That way we won't be re-directed after pressing the export
 to CSV button on the previous page.
*/

// convert the sent data into a flat array
$data = json_decode(file_get_contents('php://input'), true);


// write individual file
$indiv_file = "../../results/individual/" . $data["participant_id"] . '.csv';
$exists = file_exists($indiv_file);
$indiv_handle = fopen($indiv_file, "a+");

// write a column header
if (!$exists) {
	fwrite($indiv_handle, $LOG_HEADER . PHP_EOL);
}

// add the received data to the file
fputcsv($indiv_handle, $data);
// close the file
fclose($indiv_handle);

exit;

?>
