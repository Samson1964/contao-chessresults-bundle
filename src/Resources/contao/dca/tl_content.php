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
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'chesstable_lightbox';
$GLOBALS['TL_DCA']['tl_content']['palettes']['chesstable'] = '{type_legend},type,headline;{chesstable_legend_csv},chesstable_csv;{chesstable_legend_aufab},chesstable_aufsteiger,chesstable_absteiger,chesstable_markieren;{chesstable_legend_lightbox},chesstable_lightbox;{chesstable_legend_optionen},chesstable_namendrehen,chesstable_flaggen,chesstable_date,chesstable_ende,chesstable_note;{protected_legend:hide},protected;{expert_legend:hide},guest,cssID,space;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['chesstable_lightbox'] = 'chesstable_linktext,chesstable_hinweis';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_csv'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_csv'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'textarea',
	'eval'                    => array
	(
		'allowHtml'           => true,
		'class'               => 'monospace',
		'rows'                => 30,
		'rte'                 => 'ace',
		'helpwizard'          => true
	),
	'explanation'             => 'chesstable_csv',
	'sql'                     => "mediumtext NULL",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_file'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_file'],
	'inputType'               => 'fileTree',
	'eval'                    => array
	(
		'files'               => true,
		'filesOnly'           => true,
		'fieldType'           =>'radio',
		'extensions'          => 'csv,txt',
		'maxlength'           => 255,
		'helpwizard'          => true
	),
	'sql'                     => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_aufsteiger'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_aufsteiger'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'tl_class'            => 'long',
		'maxlength'           => 255,
		'helpwizard'          => true,
	),
	'explanation'             => 'chesstable_aufsteiger',
	'sql'                     => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_absteiger'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_absteiger'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'tl_class'            => 'long',
		'maxlength'           => 255,
		'helpwizard'          => true,
	),
	'explanation'             => 'chesstable_absteiger',
	'sql'                     => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_markieren'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_markieren'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'tl_class'            => 'long',
		'maxlength'           =>255,
		'helpwizard'          => true,
	),
	'explanation'             => 'chesstable_markieren',
	'sql'                     => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_namendrehen'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_namendrehen'],
	'inputType'               => 'checkbox',
	'eval'                    => array
	(
		'tl_class'            => 'w50',
		'isBoolean'           => true,
		'helpwizard'          => true,
	),
	'explanation'             => 'Hilfetext',
	'sql'                     => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_flaggen'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_flaggen'],
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
	'sql'                     => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_date'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_date'],
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
	'sql'                     => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_ende'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_ende'],
	'inputType'               => 'text',
	'exclude'                 => false,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 8,
	'filter'                  => true,
	'eval'                    => array
	(
		'rgxp'                => 'date',
		'datepicker'          => true,
		'tl_class'            => 'w50 wizard',
		'doNotCopy'           => true
	),
	'sql'                     => "varchar(11) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_note'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_note'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'tl_class'            => 'w50 long',
		'maxlength'           => 255,
	),
	'sql'                     => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_lightbox'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_lightbox'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50 clr','isBoolean' => true,'submitOnChange'=>true),
	'sql'                     => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_hinweis'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_hinweis'],
	'eval'                    => array('tl_class'=>'long clr'),
	'input_field_callback'    => array('tl_chesstable', 'jshinweis'),
);

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstable_linktext'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['chesstable_linktext'],
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=> 'w50 clr', 'maxlength'=>32),
	'sql'                     => "varchar(32) NOT NULL default ''",
);

class tl_chesstable extends Backend
{

	public function jshinweis(DataContainer $dc)
	{
		return '<div class="tl_message clr">
			<p class="tl_info">'.sprintf($GLOBALS['TL_LANG']['tl_content']['includeTemplate'], 'j_colorbox').'</p>
			</div>';
	}
}

?>
