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
  $navList .= "<li><a href='/phpmotors8/' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors8/vehicles?action=classification&classificationName="
      . urlencode($classification['classificationName']) .
      "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  return $navList;
}

// Wrap vehicles by classification in a list
function buildVehicleDisplay($vehicles)
{
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= '<a href="/phpmotors8/vehicles?action=vehicle&' . 'vid=' . $vehicle['invId'] . '" title="View ' . $vehicle['invMake'] . ' ' . $vehicle['invModel'] . ' details"><img src=' . $vehicle['invThumbnail'] . ' alt="Image of ' . $vehicle['invMake'] . ' ' . $vehicle['invModel'] . ' on phpmotors8.com"></a>';
    $dv .= '<div class="namePrice">';
    $dv .= '<hr>';
    $dv .= "<h2><a href='/phpmotors8/vehicles?action=vehicle&vid=$vehicle[invId]' title='View $vehicle[invMake] $vehicle[invModel] details'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
    $dv .= '<span>$' . number_format($vehicle['invPrice']) . '</span>';
    $dv .= '</div>';
    $dv .= '</li>';
  }
  $dv .= '</ul>';
  return $dv;
}

// function buildVehicleDisplay($vehicles)
// {
// 	$dv = '<ul id="inv-display">';
// 	foreach ($vehicles as $vehicle) {
// 		$dv .= '<li>';
// 		$dv .= '<a href="/phpmotors8/vehicles?action=vehicle&' . 'vid=' . $vehicle['invId'] . '" title="View ' . $vehicle['invMake'] . ' ' . $vehicle['invModel'] . ' details"><img src=' . $vehicle['invThumbnail'] . ' alt="Image of ' . $vehicle['invMake'] . ' ' . $vehicle['invModel'] . ' on phpmotors.com"></a>';
// 		$dv .= '<div class="namePrice">';
// 		$dv .= '<hr>';
// 		$dv .= "<h2><a href='/phpmotors8/vehicles?action=vehicle&vid=$vehicle[invId]' title='View $vehicle[invMake] $vehicle[invModel] details'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
// 		$dv .= '<span>$' . number_format($vehicle['invPrice']) . '</span>';
// 		$dv .= '</div>';
// 		$dv .= '</li>';
// 	}
// 	$dv .= '</ul>';
// 	return $dv;
// }


// Build single vehicle information
function buildSingleVehicleDisplay($vehicle)
{
  $svd = '<section id="vehicle-display">';
  $svd .= "<h1>$vehicle[invMake] $vehicle[invModel]</h1>";
  $svd .= '<div>';
  $svd .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com' id='mainImage'>";
  $svd .= '<h2>Price: $' . number_format($vehicle['invPrice']) . '</h2>';
  $svd .= '</div>';
//	$svd .= '<hr>';
  $svd .= "<h3>$vehicle[invMake] $vehicle[invModel] Details</h3>";
  $svd .= '<ul id="vehicle-details">';
  $svd .= "<li>$vehicle[invDescription]</li>";
  $svd .= "<li><h4>Color:</h4> $vehicle[invColor]</li>";
  $svd .= "<li><h4># in Stock:</h4> $vehicle[invStock]</li>";
  $svd .= '</ul>';
  $svd .= '</section>';
  return $svd;
}

function daniel($vehicle)
{
  $svd = '<section class="flex-container" id="vehicle-display">';
  $svd .= '<div class="flex-child magenta">';
  $svd .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com' id='mainImage'>";
  $svd .= '<h2>Price: $' . number_format($vehicle['invPrice']) . '</h2>';
  $svd .= '</div>';
  $svd .= '<div class="flex-child green">';
  $svd .= "<h3>$vehicle[invMake] $vehicle[invModel] Details</h3>";
  $svd .= '<ul id="vehicle-details">';
  $svd .= "<li>$vehicle[invDescription]</li>";
  $svd .= "<li><h4>Color:</h4> $vehicle[invColor]</li>";
  $svd .= "<li><h4># in Stock:</h4> $vehicle[invStock]</li>";
  $svd .= '</ul>';
  $svd .= '</div>';
  $svd .= '</section>';
  return $svd;
}





