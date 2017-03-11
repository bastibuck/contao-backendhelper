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
if (in_array('tl_member', $objUser->showListingIDs)) {
  $GLOBALS['TL_DCA']['tl_member']['list']['label']['fields'][] = 'id';
  $GLOBALS['TL_DCA']['tl_member']['fields']['id']['label'] = &$GLOBALS['TL_LANG']['MSC']['id'];
}
