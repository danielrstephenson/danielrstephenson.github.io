<?php

/* 
 * Custom functions for PHP Motors
 */

function checkEmail($clientEmail)
{
	$valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
	return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
	$pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
	return preg_match($pattern, $clientPassword);
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
	$classificationList = '<select name="classificationId" id="classificationList">';
	$classificationList .= "<option>Choose a Classification</option>";
	foreach ($classifications as $classification) {
		$classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
	}
	$classificationList .= '</select>';
	return $classificationList;
}

// Build the navigation links
function buildNavigation($classifications)
{
	$navList = '<ul>';
	$navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
	foreach ($classifications as $classification) {
		$navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName="
			. urlencode($classification['classificationName']) .
			"' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
	}
	$navList .= '</ul>';
	return $navList;
}

