<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   chesstable
 * Version    1.0.0
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2013
 */

namespace Schachbulle\ContaoChessresultsBundle\ContentElements;

class Chessresults extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_chessresults';

	/**
	 * Generate the module
	 */
	protected function compile()
	{

		// Parameter zuweisen
		//$csv = $this->chesstable_csv;
		//$file = $this->chesstable_file;
		//$aufsteiger = explode(",",$this->chesstable_aufsteiger);
		//$absteiger = explode(",",$this->chesstable_absteiger);
		//$markieren = explode(",",$this->chesstable_markieren);
		//$namendrehen = $this->chesstable_namendrehen;
		//$lightbox = $this->chesstable_lightbox;
		//$linktext = $this->chesstable_linktext;
		//$flagge = $this->chesstable_flaggen;
        //
		//// Template ausgeben
		//$this->Template = new \FrontendTemplate($this->strTemplate);
		//$this->Template->class = "ce_chesstable";
		//$this->Template->tabelle = $content;
		//$this->Template->datum = $aktdatum;
		//$this->Template->turnierende = $this->chesstable_ende;
		//$this->Template->hinweis = $this->chesstable_note;

		return;

	}

}
