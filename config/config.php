<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


// Add quicklink to install-tool
$GLOBALS['TL_HOOKS']['parseBackendTemplate'][] = array('\Bastibuck\BackendHelper\Resources\Backend\Hooks', 'addInstallToolLink');
$GLOBALS['TL_CSS'][] = "bundles/backendhelper/be_helper_icon.css";
