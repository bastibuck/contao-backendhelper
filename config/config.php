<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


// Add quicklink to install-tool
$GLOBALS['TL_HOOKS']['parseBackendTemplate'][] = array('\Bastibuck\BackendHelper\Resources\Backend\Hooks', 'addInstallToolLink');


if (TL_MODE == 'BE') {
  $GLOBALS['TL_CSS'][] = "bundles/backendhelper/be_helper.css";
  $GLOBALS['TL_CSS'][] = "system/modules/contao-backendhelper/assets/be_helper.css";
}
