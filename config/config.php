<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


// Add quicklink to install-tool
$GLOBALS['TL_HOOKS']['parseBackendTemplate'][] = array('\Bastibuck\BackendHelper\Resources\Backend\Hooks', 'addInstallToolLink');


// Method for showing module usage
$GLOBALS['BE_MOD']['design']['themes']['showUsage'] = array('Bastibuck\BackendHelper\Resources\Backend\BackendUtils', 'showUsage');

// load CSS in backend
if (TL_MODE == 'BE') {
  if(version_compare(VERSION, '4.0', '<=')) // contao 3.5
  {
    $GLOBALS['TL_CSS'][] = "system/modules/backendhelper/assets/be_helper.css";
  }
  else {
    $GLOBALS['TL_CSS'][] = "bundles/backendhelper/be_helper.css";
  }
}
