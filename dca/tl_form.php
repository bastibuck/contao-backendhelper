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
if ($objUser->showListingIDs && ('tl_form', $objUser->showListingIDs)) {
  $GLOBALS['TL_DCA']['tl_form']['list']['label']['fields'][] = 'id';
  $GLOBALS['TL_DCA']['tl_form']['list']['label']['format'] .= '<span class="be_ID_container">[ID: %s]</span>';
}