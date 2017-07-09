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
if ($objUser->showListingIDs && in_array('tl_module', $objUser->showListingIDs)) {
  // manipulate listing to show ID
  $GLOBALS['TL_DCA']['tl_module']['list']['sorting']['child_record_callback'] = array('Bastibuck\BackendHelper\Resources\Backend\BackendUtils', 'listModuleWithID');
}


// show where modules are used
if ($objUser->showModuleUsage) {

  if(version_compare(VERSION, '4.0', '<=')) // contao 3.5
  {
    $fileIcon = 'system/modules/backendhelper/assets/modules_info.gif';
  }
  else {
    $fileIcon = 'diff.svg';
  }

  $GLOBALS['TL_DCA']['tl_module']['list']['operations']['showUsage'] = array
  (
    'label'               => &$GLOBALS['TL_LANG']['tl_module']['showUsage'],
    'href'                => 'key=showUsage&amp;popup=1',
    'icon'                => $fileIcon,
    'attributes'          => 'onclick="Backend.openModalIframe({\'width\':768,\'title\':\''.$GLOBALS['TL_LANG']['tl_module']['showUsage'][0].'\',\'url\':this.href});return false";'
  );
}
