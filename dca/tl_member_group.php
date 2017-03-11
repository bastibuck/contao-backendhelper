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
if ($objUser->showListingIDs && ('tl_member_group', $objUser->showListingIDs)) {
  $GLOBALS['TL_DCA']['tl_member_group']['list']['label']['fields'][] = 'id';
  $GLOBALS['TL_DCA']['tl_member_group']['list']['label']['format'] .= '<span class="be_ID_container">[ID: %s]</span>';
}
