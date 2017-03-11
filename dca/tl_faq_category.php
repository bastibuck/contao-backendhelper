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
if ($objUser->showListingIDs && in_array('tl_faq_category', $objUser->showListingIDs)) {
  $GLOBALS['TL_DCA']['tl_faq_category']['list']['label']['fields'][] = 'id';
  $GLOBALS['TL_DCA']['tl_faq_category']['list']['label']['format'] .= '<span class="be_ID_container">[ID: %s]</span>';
}
