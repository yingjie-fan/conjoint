<?php
// Code to randomly generate conjoint profiles to send to a Qualtrics instance

// Terminology clarification: 
// Task = Set of choices presented to respondent in a single screen (i.e. pair of candidates)
// Profile = Single list of attributes in a given task (i.e. candidate)
// Attribute = Category characterized by a set of levels (i.e. education level)
// Level = Value that an attribute can take in a particular choice task (i.e. "no formal education")

// Attributes and Levels stored in a 2-dimensional Array 

// Function to generate weighted random numbers
function weighted_randomize($prob_array, $at_key)
{
	$prob_list = $prob_array[$at_key];
	
	// Create an array containing cutpoints for randomization
	$cumul_prob = array();
	$cumulative = 0.0;
	for ($i=0; $i<count($prob_list); $i++){
		$cumul_prob[$i] = $cumulative;
		$cumulative = $cumulative + floatval($prob_list[$i]);
	}

	// Generate a uniform random floating point value between 0.0 and 1.0
	$unif_rand = mt_rand() / mt_getrandmax();

	// Figure out which integer should be returned
	$outInt = 0;
	for ($k = 0; $k < count($cumul_prob); $k++){
		if ($cumul_prob[$k] <= $unif_rand){
			$outInt = $k + 1;
		}
	}

	return($outInt);

}
                    

$featurearray = array("&#36139;&#23500;&#24046;&#36317;" => array("&#26368;&#23500;&#26377;&#30340;10%&#30340;&#23478;&#24237;&#21344;&#26377;&#20840;&#27665;&#36130;&#23500;&#30340;20%&#12290;","&#26368;&#23500;&#26377;&#30340;10%&#30340;&#23478;&#24237;&#21344;&#26377;&#20840;&#27665;&#36130;&#23500;&#30340;40%&#12290;","&#26368;&#23500;&#26377;&#30340;10%&#30340;&#23478;&#24237;&#21344;&#26377;&#20840;&#27665;&#36130;&#23500;&#30340;60%&#12290;","&#26368;&#23500;&#26377;&#30340;10%&#30340;&#23478;&#24237;&#21344;&#26377;&#20840;&#27665;&#36130;&#23500;&#30340;80%&#12290;","&#26368;&#23500;&#26377;&#30340;10%&#30340;&#23478;&#24237;&#21344;&#26377;&#20840;&#27665;&#36130;&#23500;&#30340;95%&#12290;"),"&#25910;&#20837;&#22686;&#38271;" => array("&#25187;&#38500;&#36890;&#32960;&#21518;&#65292;&#20154;&#22343;&#21487;&#25903;&#37197;&#25910;&#20837;&#27809;&#26377;&#22686;&#38271;&#12290;","&#25187;&#38500;&#36890;&#32960;&#21518;&#65292;&#20154;&#22343;&#21487;&#25903;&#37197;&#25910;&#20837;&#20197;&#27599;&#24180;2%&#30340;&#36895;&#24230;&#22686;&#38271;&#12290;","&#25187;&#38500;&#36890;&#32960;&#21518;&#65292;&#20154;&#22343;&#21487;&#25903;&#37197;&#25910;&#20837;&#20197;&#27599;&#24180;6%&#30340;&#36895;&#24230;&#22686;&#38271;&#12290;","&#25187;&#38500;&#36890;&#32960;&#21518;&#65292;&#20154;&#22343;&#21487;&#25903;&#37197;&#25910;&#20837;&#20197;&#27599;&#24180;10%&#30340;&#36895;&#24230;&#22686;&#38271;&#12290;","&#25187;&#38500;&#36890;&#32960;&#21518;&#65292;&#20154;&#22343;&#21487;&#25903;&#37197;&#25910;&#20837;&#20197;&#27599;&#24180;14%&#30340;&#36895;&#24230;&#22686;&#38271;&#12290;"),"&#24184;&#31119;&#24863;" => array("&#20154;&#20204;&#26222;&#36941;&#24863;&#21040;&#27604;&#36739;&#24184;&#31119;&#12290;","&#22823;&#37096;&#20998;&#20154;&#30340;&#24184;&#31119;&#24863;&#19968;&#33324;&#12290;","&#20154;&#20204;&#26222;&#36941;&#24863;&#21040;&#27604;&#36739;&#28966;&#34385;&#12290;"),"&#29983;&#27963;&#27700;&#24179;" => array("&#22823;&#37096;&#20998;&#20154;&#35273;&#24471;&#29289;&#36136;&#29983;&#27963;&#20016;&#35029;&#12290;","&#22823;&#37096;&#20998;&#20154;&#35273;&#24471;&#29289;&#36136;&#29983;&#27963;&#36824;&#36807;&#24471;&#21435;&#12290;","&#22823;&#37096;&#20998;&#20154;&#35273;&#24471;&#29289;&#36136;&#29983;&#27963;&#31384;&#36843;&#12290;"),"&#23433;&#20840;&#24863;" => array("&#31038;&#20250;&#27835;&#23433;&#24773;&#20917;&#33391;&#22909;&#65292;&#19968;&#33324;&#19981;&#20250;&#24863;&#21040;&#20154;&#36523;&#23433;&#20840;&#21463;&#21040;&#23041;&#32961;&#12290;","&#31038;&#20250;&#27835;&#23433;&#24773;&#20917;&#19968;&#33324;&#65292;&#20598;&#23572;&#20250;&#24863;&#21040;&#20154;&#36523;&#23433;&#20840;&#21463;&#21040;&#23041;&#32961;&#12290;","&#31038;&#20250;&#27835;&#23433;&#24773;&#20917;&#24456;&#24046;&#65292;&#32463;&#24120;&#20250;&#24863;&#21040;&#20154;&#36523;&#23433;&#20840;&#21463;&#21040;&#23041;&#32961;&#12290;"),"&#25919;&#24220;&#21709;&#24212;&#33021;&#21147;" => array("&#25919;&#24220;&#33021;&#22815;&#24555;&#36895;&#22238;&#24212;&#27665;&#20247;&#30340;&#35785;&#27714;&#12290;","&#25919;&#24220;&#33021;&#22815;&#22238;&#24212;&#27665;&#20247;&#30340;&#35785;&#27714;&#65292;&#20294;&#38656;&#35201;&#19968;&#20123;&#26102;&#38388;&#12290;","&#22823;&#22810;&#25968;&#24773;&#20917;&#19979;&#65292;&#25919;&#24220;&#23545;&#27665;&#20247;&#30340;&#35785;&#27714;&#26080;&#21160;&#20110;&#34935;&#12290;"),"&#25919;&#24220;&#20915;&#31574;&#25928;&#29575;" => array("&#25919;&#24220;&#20915;&#31574;&#25928;&#29575;&#39640;&#65292;&#25919;&#24220;&#37096;&#38376;&#25191;&#34892;&#36895;&#24230;&#24555;&#12290;","&#25919;&#24220;&#20915;&#31574;&#25928;&#29575;&#27604;&#36739;&#20302;&#65292;&#20294;&#25919;&#31574;&#24418;&#25104;&#21518;&#65292;&#25919;&#24220;&#37096;&#38376;&#25191;&#34892;&#36895;&#24230;&#24555;&#12290;","&#25919;&#24220;&#20915;&#31574;&#25928;&#29575;&#20302;&#65292;&#25919;&#24220;&#37096;&#38376;&#25191;&#34892;&#25919;&#31574;&#30340;&#36895;&#24230;&#20063;&#24456;&#24930;&#12290;"),"&#23448;&#20698;&#33104;&#36133;" => array("&#23448;&#21592;&#33104;&#36133;&#30340;&#29616;&#35937;&#27604;&#36739;&#26222;&#36941;&#12290;","&#23448;&#21592;&#33104;&#36133;&#30340;&#29616;&#35937;&#23384;&#22312;&#65292;&#20294;&#19981;&#22810;&#35265;&#12290;","&#23448;&#21592;&#33104;&#36133;&#30340;&#29616;&#35937;&#38750;&#24120;&#23569;&#35265;&#12290;"),"&#36873;&#20030;&#26435;" => array("&#20154;&#27665;&#21487;&#20197;&#30452;&#25509;&#36873;&#20030;&#26412;&#34892;&#25919;&#21306;&#30340;&#39046;&#23548;&#20154;&#65288;&#22914;&#26412;&#22320;&#24066;&#38271;&#65289;&#12290;","&#20154;&#27665;&#19981;&#33021;&#30452;&#25509;&#36873;&#20030;&#26412;&#34892;&#25919;&#21306;&#30340;&#39046;&#23548;&#20154;&#65288;&#22914;&#26412;&#22320;&#24066;&#38271;&#65289;&#12290;"),"&#21442;&#19982;&#20915;&#31574;&#26435;" => array("&#20154;&#27665;&#21487;&#20197;&#36890;&#36807;&#25919;&#27835;&#21442;&#19982;&#23545;&#25919;&#31574;&#12289;&#27861;&#35268;&#20135;&#29983;&#23454;&#36136;&#24615;&#24433;&#21709;&#12290;","&#20154;&#27665;&#19981;&#33021;&#36890;&#36807;&#25919;&#27835;&#21442;&#19982;&#23545;&#25919;&#31574;&#12289;&#27861;&#35268;&#20135;&#29983;&#23454;&#36136;&#24615;&#24433;&#21709;&#12290;"),"&#23186;&#20307;&#33258;&#30001;" => array("&#23186;&#20307;&#26426;&#26500;&#20139;&#21463;&#27861;&#24459;&#20445;&#38556;&#30340;&#26032;&#38395;&#20986;&#29256;&#33258;&#30001;&#65307;&#25919;&#24220;&#19981;&#33021;&#30452;&#25509;&#24178;&#39044;&#38750;&#23448;&#26041;&#23186;&#20307;&#30340;&#36816;&#33829;&#12290;","&#23448;&#26041;&#21644;&#38750;&#23448;&#26041;&#30340;&#23186;&#20307;&#26426;&#26500;&#37117;&#21463;&#21040;&#25919;&#24220;&#37096;&#38376;&#30340;&#20005;&#26684;&#30417;&#31649;&#21644;&#24341;&#23548;&#12290;"),"&#34920;&#36798;&#33258;&#30001;" => array("&#20154;&#20204;&#22312;&#31038;&#20132;&#23186;&#20307;&#24179;&#21488;&#34920;&#36798;&#21508;&#31181;&#30475;&#27861;&#65292;&#19988;&#19981;&#20250;&#22240;&#27492;&#36973;&#21040;&#20219;&#20309;&#22788;&#32602;&#12290;","&#20154;&#20204;&#22312;&#31038;&#20132;&#23186;&#20307;&#24179;&#21488;&#34920;&#36798;&#21508;&#31181;&#30475;&#27861;&#65292;&#21487;&#33021;&#20250;&#34987;&#21024;&#36148;&#12289;&#31105;&#35328;&#65292;&#25110;&#36973;&#21040;&#26356;&#20005;&#37325;&#30340;&#22788;&#32602;&#12290;"),"&#36130;&#20135;&#26435;" => array("&#26222;&#36890;&#20154;&#30340;&#36130;&#20135;&#26435;&#21033;&#21463;&#21040;&#27861;&#24459;&#30340;&#20005;&#26684;&#20445;&#25252;&#12290;","&#26222;&#36890;&#20154;&#30340;&#36130;&#20135;&#26435;&#21033;&#21487;&#33021;&#21463;&#21040;&#25919;&#24220;&#25110;&#20854;&#20182;&#20154;&#30340;&#20405;&#23475;&#12290;"));

$restrictionarray = array();

// Indicator for whether weighted randomization should be enabled or not
$weighted = 0;

// K = Number of tasks displayed to the respondent
$K = 15;

// N = Number of profiles displayed in each task
$N = 2;

// num_attributes = Number of Attributes in the Array
$num_attributes = count($featurearray);


$attrconstraintarray = array();


// Re-randomize the $featurearray

// Place the $featurearray keys into a new array
$featureArrayKeys = array();
$incr = 0;

foreach($featurearray as $attribute => $levels){	
	$featureArrayKeys[$incr] = $attribute;
	$incr = $incr + 1;
}

// Backup $featureArrayKeys
$featureArrayKeysBackup = $featureArrayKeys;

// If order randomization constraints exist, drop all of the non-free attributes
if (count($attrconstraintarray) != 0){
	foreach ($attrconstraintarray as $constraints){
		if (count($constraints) > 1){
			for ($p = 1; $p < count($constraints); $p++){
				if (in_array($constraints[$p], $featureArrayKeys)){
					$remkey = array_search($constraints[$p],$featureArrayKeys);
					unset($featureArrayKeys[$remkey]);
				}
			}
		}
	}
} 
// Re-set the array key indices
$featureArrayKeys = array_values($featureArrayKeys);
// Re-randomize the $featurearray keys
shuffle($featureArrayKeys);

// Re-insert the non-free attributes constrained by $attrconstraintarray
if (count($attrconstraintarray) != 0){
	foreach ($attrconstraintarray as $constraints){
		if (count($constraints) > 1){
			$insertloc = $constraints[0];
			if (in_array($insertloc, $featureArrayKeys)){
				$insert_block = array($insertloc);
				for ($p = 1; $p < count($constraints); $p++){
					if (in_array($constraints[$p], $featureArrayKeysBackup)){
						array_push($insert_block, $constraints[$p]);
					}
				}
				
				$begin_index = array_search($insertloc, $featureArrayKeys);
				array_splice($featureArrayKeys, $begin_index, 1, $insert_block);
			}
		}
	}
}


// Re-generate the new $featurearray - label it $featureArrayNew

$featureArrayNew = array();
foreach($featureArrayKeys as $key){
	$featureArrayNew[$key] = $featurearray[$key];
}
// Initialize the array returned to the user
// Naming Convention
// Level Name: F-[task number]-[profile number]-[attribute number]
// Attribute Name: F-[task number]-[attribute number]
// Example: F-1-3-2, Returns the level corresponding to Task 1, Profile 3, Attribute 2 
// F-3-3, Returns the attribute name corresponding to Task 3, Attribute 3

$returnarray = array();

// For each task $p
for($p = 1; $p <= $K; $p++){

	// For each profile $i
	for($i = 1; $i <= $N; $i++){

		// Repeat until non-restricted profile generated
		$complete = False;

		while ($complete == False){

			// Create a count for $attributes to be incremented in the next loop
			$attr = 0;
			
			// Create a dictionary to hold profile's attributes
			$profile_dict = array();

			// For each attribute $attribute and level array $levels in task $p
			foreach($featureArrayNew as $attribute => $levels){	
				
				// Increment attribute count
				$attr = $attr + 1;

				// Create key for attribute name
				$attr_key = "F-" . (string)$p . "-" . (string)$attr;

				// Store attribute name in $returnarray
				$returnarray[$attr_key] = $attribute;

				// Get length of $levels array
				$num_levels = count($levels);

				// Randomly select one of the level indices
				if ($weighted == 1){
					$level_index = weighted_randomize($probabilityarray, $attribute) - 1;

				}else{
					$level_index = mt_rand(1,$num_levels) - 1;	
				}	

				// Pull out the selected level
				$chosen_level = $levels[$level_index];
			
				// Store selected level in $profileDict
				$profile_dict[$attribute] = $chosen_level;

				// Create key for level in $returnarray
				$level_key = "F-" . (string)$p . "-" . (string)$i . "-" . (string)$attr;

				// Store selected level in $returnarray
				$returnarray[$level_key] = $chosen_level;

			}

			$clear = True;
			// Cycle through restrictions to confirm/reject profile
			if(count($restrictionarray) != 0){

				foreach($restrictionarray as $restriction){
					$false = 1;
					foreach($restriction as $pair){
						if ($profile_dict[$pair[0]] == $pair[1]){
							$false = $false*1;
						}else{
							$false = $false*0;
						}
						
					}
					if ($false == 1){
						$clear = False;
					}
				}
			}
			$complete = $clear;
		}
	}


}

// Return the array back to Qualtrics
print  json_encode($returnarray);
?>
