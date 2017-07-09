<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
  'Bastibuck',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
  'Bastibuck\BackendHelper\BackendHelperBundle'            => 'system/modules/backendhelper/BackendHelperBundle.php',
  // Resources
  'Bastibuck\BackendHelper\Resources\Backend\BackendUtils' => 'system/modules/backendhelper/Resources/Backend/BackendUtils.php',
  'Bastibuck\BackendHelper\Resources\Backend\Hooks'        => 'system/modules/backendhelper/Resources/Backend/Hooks.php',
  'Bastibuck\BackendHelper\ContaoManager\Plugin'           => 'system/modules/backendhelper/Resources/ContaoManager/Plugin.php',
));
