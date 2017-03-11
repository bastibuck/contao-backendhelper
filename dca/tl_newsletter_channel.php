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
if ($objUser->showListingIDs && in_array('tl_newsletter_channel', $objUser->showListingIDs)) {
  $GLOBALS['TL_DCA']['tl_newsletter_channel']['list']['label']['fields'][] = 'id';
  $GLOBALS['TL_DCA']['tl_newsletter_channel']['list']['label']['format'] .= '<span class="be_ID_container">[ID: %s]</span>';
}
