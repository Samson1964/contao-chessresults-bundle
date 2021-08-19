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

	var $Spalte = array();
	var $SpaltePos = array();
	var $SichtbareSpalten = array();
	var $Tabellenzeilentyp = array();
	var $debug = array();
	var $cache;

	/**
	 * Generate the module
	 */
	protected function compile()
	{

		\System::loadLanguageFile('tl_content'); // Sprachdateien laden

		$beginn = microtime(true);

		// Spalte-Array füllen, dazu definierte Spalten auslösen
		foreach($GLOBALS['TL_LANG']['tl_content']['chessresults_colsView_array'] as $key => $value)
		{
			if($key == '[Ergebnis]')
			{
				// Ergebnisspalten generieren
				for($x = 1; $x < 21; $x++)
				{
					$this->Spalte[$x.'.Rd'] = $x;
				}
			}
			else
			{
				// Normale Spalte ggfs. mit Mehrfachdefinitionen
				$keys = explode('|', $key); // Key am | auftrennen, z.B. Nr.|Snr
				foreach($keys as $item)
				{
					$this->Spalte[$item] = $value;
				}
			}
		}

		// Bei eingetragener ID von ChessResults geht es weiter mit der Datenabfrage
		if($this->chessresults_id)
		{

			// ======================================================
			// URL BAUEN UND SPALTEN FESTLEGEN
			// ======================================================

			// Gewünschte sichtbare Spalten laden
			if($this->chessresults_colsView) 
			{
				$temp = unserialize($this->chessresults_colsView);
				foreach($temp as $key => $value)
				{
					if($value == '[Ergebnis]')
					{
						// Ergebnisspalten generieren
						for($x = 1; $x < 21; $x++)
						{
							$this->SichtbareSpalten[] = $x.'.Rd';
						}
					}
					else
					{
						// Normale Spalte ggfs. mit Mehrfachdefinitionen
						$keys = explode('|', $value); // Werte am | auftrennen, z.B. Nr.|Snr
						foreach($keys as $item)
						{
							$this->SichtbareSpalten[] = $item;
						}
					}
				}
			}

			$url = 'http://chess-results.com/tnr'.$this->chessresults_id.'.aspx?iframe=NOADV&css=2&lan=0';
			switch($this->chessresults_mode)
			{
				case '1': // Teilnehmerliste, alphabetisch
					$url .= '&art=3'; break;
				case '2': // Teilnehmerliste, nach TWZ
					$url .= '&art=0'; break;
				case '3': // Rangliste, nach Runde x
					$url .= '&art=1'; break;
				case '10': // Fortschrittstabelle
					$url .= '&art=4'; break;
				case '20': // Paarungen/Ergebnisse, nach Runde x
					$url .= '&art=2'; break;
				default:
			}
			if($this->chessresults_round) $url .= '&rd='.$this->chessresults_round;

			// ======================================================
			// CACHE-ABFRAGE
			// ======================================================
			$cache = self::getCache(); // Cache laden
			if($cache)
			{
				// Daten aus dem Cache verarbeiten
				self::AnalysiereTabelle($cache);
				self::checkTabellentyp($cache);
				$result = self::ImportTabelle($cache);
			}
			else
			{
				// Daten von ChessResults abholen
				$daten = file_get_contents($url);
				$tabelle = self::ImportHTML($daten);
				self::AnalysiereTabelle($tabelle);
				self::checkTabellentyp($tabelle);
				$result = self::ImportTabelle($tabelle);
			}

			// ======================================================
			// CACHE ERNEUERN
			// ======================================================
			self::setCache($tabelle); // Cache setzen, wenn nötig

		}

		$dauer = microtime(true) - $beginn;
		$this->debug['Abfragezeit'] = sprintf('%.5f', $dauer).' Sekunden';

		// Template befüllen
		$this->Template->class = 'ce_chessresults ce_table';
		$this->Template->raw = print_r($result['raw'], true);
		$this->Template->tabelle = $result['content'];
		$url = str_replace('iframe=NOADV&css=2&', '', $url); // URL bereinigen
		$this->Template->chessresults_link = '<a href="'.$url.'" target="_blank">Anzeigen auf ChessResults</a>';
		$this->Template->debug = print_r($this->debug, true);;
		$this->Template->meta = 'Aktualisiert am '.$this->debug['Letzte Aktualisierung'];

		return;

	}

	private function checkTabellentyp($tabelle)
	{
		$this->Tabellenzeilentyp = array(); // Array für Tabellenzeilentypen initialisieren

		for($row = 0; $row < count($tabelle); $row++)
		{
			$spalten = count($tabelle[$row]);
			if($spalten == 1) 
			{
				$this->Tabellenzeilentyp[$row] = 'Runde';
				$this->Tabellenzeilentyp[$row + 1] = 'Kopf';
			}
			else
			{
				// Wenn Typ noch nicht festgelegt, dann jetzt machen
				if(!$this->Tabellenzeilentyp[$row])
				{
					if($row == 0) $this->Tabellenzeilentyp[$row] = 'Kopf';
					else $this->Tabellenzeilentyp[$row] = 'Daten';
				}
			}
		}

		$this->debug['this-Tabellenzeilentyp'] = $this->Tabellenzeilentyp;
	}

	private function ImportHTML($string)
	{
		//$string = iconv('windows-1251', 'utf-8', $string); // Bug in paquettg/php-html-parser umgehen, https://github.com/paquettg/php-html-parser/issues/209#event-3327333893
		// Umwandeln von ANSI westeuropäisch in UTF8
		$string = iconv('windows-1252', 'utf-8', $string); // Bug in paquettg/php-html-parser umgehen, https://github.com/paquettg/php-html-parser/issues/209#event-3327333893

		$tabelle = array();

		$dom = new \PHPHtmlParser\Dom;
		$dom->load($string);
		$table = $dom->find('table[class=CRs1]')[0]; // Tabelle mit den Daten finden

		// Tabelle einlesen, wenn vorhanden
		if($table)
		{
			$rows = $table->find('tr'); // Zeilen extrahieren

			$rowNr = 0;
			foreach($rows as $row)
			{
				$cols = $row->find('td');
				$colNr = 0;
				$i = 0;
				foreach($cols as $col)
				{
					// Geschützte Leerzeichen ersetzen: kommen bei Wtg1 usw. vor
					$value = $col->innerHtml;
					$tabelle[$rowNr][$colNr] = trim(str_replace('&nbsp;', ' ', $value));
					$colNr++;
				}
				$rowNr++;
			}
		}

		return $tabelle;

	}

	private function AnalysiereTabelle($tabelle)
	{
		if(!$tabelle) return false; // Keine Tabelle vorhanden

		for($col = 0; $col < count($tabelle[0]); $col++)
		{
			// Kopfzeile der Tabelle, hier die Spaltenpositionen sichern

			// Spaltenname festlegen
			if($tabelle[0][$col]) $spaltenname = $tabelle[0][$col];
			else $spaltenname = 'Titel';
			$this->SpaltePos[$spaltenname] = $col;

		}

		$this->debug['this-Spalte'] = $this->Spalte;
		$this->debug['this-SpaltePos'] = $this->SpaltePos;

	}

	private function ImportTabelle($tabelle)
	{

		$this->debug['this-SichtbareSpalten'] = $this->SichtbareSpalten;
		if(!$tabelle) return array('raw' => '', 'content' => '');

		// Tabelle in table schreiben
		$content = '<table>';
		for($x = 0; $x < count($tabelle); $x++)
		{
			$content .= '<tr>';
			for($y = 0; $y < count($tabelle[$x]); $y++)
			{
				if(!in_array($tabelle[0][$y], $this->SichtbareSpalten))
				{
					//echo 'Spaltenname = |'.$tabelle[0][$y].'| nicht gefunden<br>';
					continue; // Unsichtbare Spalten überspringen
				}

				$content .= $x ? '<td>' : '<th>'; // Kopf- oder Datenzeile
				if($x)
				{
					// Datenzeile
					switch($tabelle[0][$y])
					{
						case 'Name': $value = self::getName($tabelle[$x][$y]); break; // Name konvertieren
						case 'Ergebnis': $value = self::getErgebnis($tabelle[$x][$y]); break; // Ergebnis konvertieren
						default: $value = $tabelle[$x][$y];
							if(self::is_utf8($value)) $value = utf8_decode($value);
					}
				}
				else
				{
					// Kopfzeile
					if($tabelle[$x][$y]) $spaltenname = $tabelle[$x][$y];
					else $spaltenname = '';
					$value = $this->Spalte[$spaltenname];
				}
				$content .= $value;
				$content .= $x ? '</td>' : '</th>'; // Kopf- oder Datenzeile
			}
			$content .= '</tr>';
		}
		$content .= '</table>';

		return array('raw' => $tabelle, 'content' => $content);
	}

	private function setSpalte($tabelle)
	{
		$addSpalten = array();

		// In den Spalten der Kopfzeile der Tabelle nach Runden suchen
		for($col = 0; $col < count($tabelle[0]); $col++)
		{
			switch($tabelle[0][$col])
			{
				case '1.Rd':
				case '2.Rd':
				case '3.Rd':
				case '4.Rd':
				case '5.Rd':
				case '6.Rd':
				case '7.Rd':
				case '8.Rd':
				case '9.Rd':
				case '10.Rd':
				case '11.Rd':
				case '12.Rd':
				case '13.Rd':
				case '14.Rd':
					$runde = explode('.', $tabelle[0][$col]);
					$addSpalten[] = $runde[0];
					break;
				default:
			}
		}

		// Neues Array schreiben
		$neu = array();
		foreach($this->Spalte as $spalte1)
		{
			if($spalte1 == '[Runden]')
			{
				foreach($addSpalten as $spalte2)
				{
					$neu[] = $spalte2;
				}
			}
			else
			{
				$neu[] = $spalte1;
			}
		}

		$this->Spalte = $neu;
	}

	function is_utf8($str)
	{
		$strlen = strlen($str);
		for($i=0; $i < $strlen; $i++)
		{
			$ord = ord($str[$i]);
			if($ord < 0x80) continue; // 0bbbbbbb
			elseif(($ord&0xE0)===0xC0 && $ord>0xC1) $n = 1; // 110bbbbb (exkl C0-C1)
			elseif(($ord&0xF0)===0xE0) $n = 2; // 1110bbbb
			elseif(($ord&0xF8)===0xF0 && $ord<0xF5) $n = 3; // 11110bbb (exkl F5-FF)
			else return false; // ungültiges UTF-8-Zeichen
			for($c=0; $c<$n; $c++) // $n Folgebytes? // 10bbbbbb
				if(++$i===$strlen || (ord($str[$i])&0xC0)!==0x80)
					return false; // ungültiges UTF-8-Zeichen
		}
		return true; // kein ungültiges UTF-8-Zeichen gefunden
	}

	private function getName($string)
	{
		if(self::is_utf8($string)) $string = utf8_decode($string);
		$temp = strip_tags($string); // HTML-Tags entfernen
		$temp = str_replace(' *)', '', $temp); // Hinweis fixes Brett entfernen
		$temp = str_replace(',', ', ', $temp); // Leerzeichen hinter Komma einfügen
		$temp = str_replace('  ', ' ', $temp); // Doppelte Leerzeichen auf ein Leerzeichen reduzieren

		// Nach Komma(s) im Namen suchen, falls "Nachname,Vorname" übergeben wurde
		$komma = strpos($temp, ','); // 1. Komma suchen
		if(!$komma)
		{
			// Keine Kommas im Namen, dann welche setzen
			$leerzeichen = strpos($temp, ' '); // 1. Leerzeichen suchen
			if($leerzeichen)
			{
				$temp = substr($temp, 0, $leerzeichen).','.substr($temp, $leerzeichen);
			}
		}

		return $temp;
	}

	private function getErgebnis($string)
	{
		$temp = str_replace(' - ', ':', $string);
		return $temp;
	}

	private function getCache()
	{
		$this->debug['Live-Modus'] = $this->chessresults_live;
		$this->debug['Cache-Zeit'] = $this->chessresults_cache . ' Sekunden';

		// Cache abfragen
		if($this->chessresults_cacheStorage)
		{

			$this->cache = unserialize($this->chessresults_cacheStorage); // Cache-Daten laden zum Weiterverarbeiten

			$this->debug['Cache vorhanden'] = true;
			$this->debug['Cache-Datum'] = date('d.m.Y H:i:s', $this->cache['zeit']);
			$this->debug['Letzte Aktualisierung'] = date('d.m.Y H:i', $this->cache['zeit']);
			$this->debug['Cache benutzt'] = false;

			if($this->chessresults_live)
			{
				// Im Live-Modus den evtl. gültigen Cache berücksichtigen
				if($this->cache['zeit'] + $this->chessresults_cache < time())
				{
					return false; // Cache ist abgelaufen, Live-Modus wird erzwungen
				}
				else
				{
					$this->debug['Cache benutzt'] = true;
					return $this->cache['daten']; // Cache noch gültig, diesen zurückgeben
				}
			}
			else
			{
				$this->debug['Cache benutzt'] = true;
				return $this->cache['daten']; // Im Offline-Modus immer Cache benutzen
			}

		}
		else
		{
			$this->debug['Cache vorhanden'] = false;
			$this->debug['Cache-Datum'] = false;

			return false; // Cache ist leer, Live-Modus wird erzwungen
		}

	}

	private function setCache($tabelle)
	{

		$cacheNeu = false;

		// Cache abfragen
		if($this->cache)
		{
			// Alter Cache vorhanden, diesen laden

			if($this->cache['zeit'] + $this->chessresults_cache < time())
			{
				$cacheNeu = true; // Cache ist abgelaufen, jetzt erneuern
			}

		}
		else
		{
			$cacheNeu = true; // Cache ist leer
		}

		if($cacheNeu)
		{
			// Cache neu schreiben
			$daten = array
			(
				'zeit'  => time(),
				'daten' => $tabelle
			);

			$this->debug['Letzte Aktualisierung'] = date('d.m.Y H:i', $daten['zeit']);

			$set = array
			(
				'chessresults_cacheStorage' => serialize($daten)
			);
			\Database::getInstance()->prepare('UPDATE tl_content %s WHERE id = ?')
			                        ->set($set)
			                        ->execute($this->id);
		}

	}

}
