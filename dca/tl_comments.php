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
if (in_array('tl_comments', $objUser->showListingIDs)) {
  // manipulate listing to show ID
  $GLOBALS['TL_DCA']['tl_comments']['list']['label']['label_callback'] = array('Bastibuck\BackendHelper\Resources\Backend\ShowIDs', 'listCommentsWithID');
}
