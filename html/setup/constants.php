<?php
	// General parameters of your experiment

	// number of conditions
	static $NUM_CONDITIONS = 4; // assuming fully crossed factors

	// The structure of your factors (used for naming condition parameters)
	// change only values (values to the right of => arrow operators) but not the keys (factor1, factor2, name, levels ...) because those are referenced elsewhere.
	// Add or remove factors as needed
	static $FACTORS = array("factor1", "factor2");
	static $FACTOR_LEVELS = array(
		"factor1" => array(
					"name" => "factor1", // change her the factor name
					"levels" => array("f1_level1", "f1_level2") // change these level names
				),
		"factor2" => array(
					"name" => "factor2", // change here the factor name
					"levels" => array("f2_level1", "f2_level2") // change here the level names
				)
	);

	
	static $EXCLUDE_RELOADERS = 1; // 1 = yes, 0 = no

/* Prolific specific data */

	// Completion URL. Fill in the one provided in their inteface
	static $COMPLETION_URL = "https://app.prolific.co/submissions/complete?cc=6B23E247";
	
	// The information below is meant to be filled in automatically in the consent form. Adjust to the value corresponding to your experiment.
	// Experiment duration in minutes
	static $EXP_DURATION = 3;
	// Payment to participants in British Pound
	static $EXP_PAYMENT = 0.45;



	static $ATTENTION_QUESTION_OPTIONS = array(
											'malaria' => "People getting malaria",
											'tuberculosis' => "People getting tuberculosis",
											'cold' => "People getting the common cold",
											'HIV' => "People getting infected with HIV",
											'flu' => "People getting exposed to flu viruses"
										);
	// indicate which of the array keys has the right answer as value
	static $ATT_CORRECT_ANSWER = "cold";

	// column header for the individual log files (for the main results file the header row is automatically extracted from the data)
	$LOG_HEADER = 'participant_id,
							study_id,
							session_id,
							condition,
							' . $FACTOR_LEVELS["factor1"]["name"] . ',
							' . $FACTOR_LEVELS["factor2"]["name"] . ',
							timestamp_0,
							browser_name,
							browser_version,
							os,
							timestamp_1,
							timestamp_2,
							timestamp_3,
							timestamp_4,
							response,
							timestamp_5,
							timestamp_6,
							timestamp_7';
?>
