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

$GLOBALS['TL_LANG']['tl_content']['chessresults_legend'] = 'Einstellungen';

$GLOBALS['TL_LANG']['tl_content']['chessresults_id'] = array('Turnier-ID ChessResults', 'Turnier-ID ChessResults');
$GLOBALS['TL_LANG']['tl_content']['chessresults_mode'] = array('Liste', 'Art der Liste');
$GLOBALS['TL_LANG']['tl_content']['chessresults_round'] = array('Runde', 'Nummer der Runde');
$GLOBALS['TL_LANG']['tl_content']['chessresults_cache'] = array('Cache', 'Cachezeit in Sekunden angeben, 0 = kein Cache');
$GLOBALS['TL_LANG']['tl_content']['chessresults_cacheStorage'] = array('Cachespeicher', 'Im Cachespeicher werden die von ChessResults geladenen Daten mit Zeitstempel gespeichert.');
$GLOBALS['TL_LANG']['tl_content']['chessresults_colsView'] = array('Spalten einblenden', 'Diese Spalten werden eingeblendet, wenn sie in der Ansicht vorhanden sind.');
$GLOBALS['TL_LANG']['tl_content']['chessresults_live'] = array('Live-Abfrage', 'Wenn aktiviert, werden die Daten von ChessResults geladen. Cachezeiten werden berücksichtigt. Ist eine Offlinedarstellung nicht möglich, erfolgt trotzdem eine einmalige Abfrage bei ChessResults. Die Live-Abfrage ist ungefähr 500 mal langsamer. Bitte deshalb immer cachen, wenn kein Offline-Modus möglich ist!');
$GLOBALS['TL_LANG']['tl_content']['chessresults_type'] = array('Turnierart', 'Turnierart');

$GLOBALS['TL_LANG']['tl_content']['chessresults_mode_array'] = array
(
	'1'  => 'Teilnehmerliste, alphabetisch',
	'2'  => 'Teilnehmerliste, nach TWZ',
	'3'  => 'Rangliste, nach Runde ... (Bitte Runde angeben!)',
	'10' => 'Fortschrittstabelle',
	'20' => 'Paarungen/Ergebnisse, nach Runde ... (Bitte Runde angeben!)',
);

$GLOBALS['TL_LANG']['tl_content']['chessresults_type_array'] = array
(
	'1'  => 'Schweizer System',
);

$GLOBALS['TL_LANG']['tl_content']['chessresults_colsView_array'] = array
(
	'Nr.|Snr'    => 'Nr.',
	'Rg.'        => 'Pl.',
	'Br.'        => 'Br.',
	'EloI'       => 'Elo',
	'EloN'       => 'DWZ',
	'Land'       => 'Land',
	'Name'       => 'Name',
	''           => 'Titel',
	'Verein/Ort' => 'Verein',
	'FideID'     => 'FIDE-ID',
	'Ergebnis'   => 'Erg.',
	'[Ergebnis]' => '(Ergebnis)',
	'Pkt.'       => 'Pkt.',
	'Wtg1'       => 'Wtg1',
	'Wtg2'       => 'Wtg2',
	'Wtg3'       => 'Wtg3',
);
