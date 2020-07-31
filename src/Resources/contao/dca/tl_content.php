<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   fen
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2013
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['chessresults'] = '{type_legend},type,headline;{chessresults_legend},chessresults_id,chessresults_type,chessresults_mode,chessresults_colsView,chessresults_round,chessresults_cache,chessresults_live;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['chessresults_id'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chessresults_id'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'mandatory'           => true,
		'tl_class'            => 'w50',
		'maxlength'           => 8,
	),
	'sql'                     => "int(8) unsigned NOT NULL default 0"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chessresults_mode'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chessresults_mode'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'select',
	'options'                 => &$GLOBALS['TL_LANG']['tl_content']['chessresults_mode_array'],
	'eval'                    => array
	(
		'mandatory'           => true,
		'includeBlankOption'  => true,
		'chosen'              => true,
		'tl_class'            => 'long clr'
	),
	'sql'                     => "int(2) unsigned NOT NULL default 0"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chessresults_round'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chessresults_round'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array
	(
		'tl_class'            => 'w50',
		'maxlength'           => 3,
	),
	'sql'                     => "smallint(3) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chessresults_cache'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chessresults_cache'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'default'                 => 300,
	'eval'                    => array
	(
		'tl_class'            => 'w50',
		'maxlength'           => 5,
	),
	'sql'                     => "int(5) unsigned NOT NULL default 0"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chessresults_colsView'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chessresults_colsView'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'checkboxWizard',
	'options'                 => &$GLOBALS['TL_LANG']['tl_content']['chessresults_colsView_array'],
	'default'                 => is_array($GLOBALS['TL_LANG']['tl_content']['chessresults_colsView_array']) ? array_keys($GLOBALS['TL_LANG']['tl_content']['chessresults_colsView_array']) : '',
	'eval'                    => array
	(
		'multiple'            => true,
		'tl_class'            => 'w50'
	),
	'sql'                     => 'blob NULL'
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chessresults_live'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chessresults_live'],
	'exclude'                 => true,
	'default'                 => 1,
	'inputType'               => 'checkbox',
	'eval'                    => array
	(
		'tl_class'            => 'w50'
	),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chessresults_cacheStorage'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chessresults_cacheStorage'],
	'sql'                     => 'blob NULL'
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chessresults_type'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chessresults_type'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'radio',
	'default'                 => 1,
	'options'                 => &$GLOBALS['TL_LANG']['tl_content']['chessresults_type_array'],
	'eval'                    => array
	(
		'mandatory'           => true,
		'tl_class'            => 'w50'
	),
	'sql'                     => "char(1) NOT NULL default ''"
);

