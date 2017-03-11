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
if ($objUser->showListingIDs && in_array('tl_calendar_events', $objUser->showListingIDs)) {
  // manipulate listing to show ID
  $GLOBALS['TL_DCA']['tl_calendar_events']['list']['sorting']['child_record_callback'] = array('Bastibuck\BackendHelper\Resources\Backend\ShowIDs', 'listEventsWithID');
}
