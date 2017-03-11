<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


// get logged in user
$objUser = BackendUser::getInstance();

// show ID for pages in listing
if (in_array('tl_page', $objUser->showListingIDs)) {
  $GLOBALS['TL_DCA']['tl_page']['list']['label']['fields'][] = 'id';
  $GLOBALS['TL_DCA']['tl_page']['list']['label']['format'] .= '<span class="be_ID_container">[ID: %s]</span>';
}
