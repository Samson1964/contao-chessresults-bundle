# Tabellen von ChessResults einbinden

## Version 1.1.1 (2023-03-22)

* Fix: Fehler bzgl. PHP 8
* Fix: An exception occurred while executing a query: SQLSTATE[22001]: String data, right truncated: 1406 Data too long for column 'chessresults_cacheStorage' at row 1 -> chessresults_cacheStorage -> LONGBLOB

## Version 1.1.0 (2023-03-22)

* Change: Abhängigkeit PHP 8 hergestellt
* Fix: Chessresults.php -> UTF8-Dekodierung ist unnötig, da UTF8 ausgeliefert wird

## Version 1.0.8 (2021-08-19)

* Add: Sprachdateien für Frontend eingebunden (Chessresults.php)

## Version 1.0.7 (2021-01-13)

* Fix: Abhängigkeit paquettg/php-html-parser ^2.2 statt >=2.2 - In Version 3.1.1 wurde die Funktion load entfernt

## Version 1.0.6 (2020-08-19)

* Neuer Versuch mit $this->Template->class = 'ce_chessresults ce_table'
* Template geändert und block_searchable und content ausgetauscht

## Version 1.0.5 (2020-08-19)

* ce_table als Klasse funktioniert nicht richtig - neuer Versuch

## Version 1.0.4 (2020-08-18)

* Changelog in UTF-8 umgewandelt
* Template ersetzt in ContentElement

## Version 1.0.3 (2020-08-18)

* TODO.md hinzugefügt
* ce_table als Klasse hinzugefügt
* UTF-8-Erkennung von ChessResults verbessert

## Version 1.0.2 (2020-07-31)

* Fix: Spalte Elo wurde nicht angezeigt
* Add: Anzeige der letzten Aktualisierung
* Fix: Komma im Namen

## Version 1.0.1 (2020-07-31)

* Template bereinigt von Debug-Ausgabe

## Version 1.0.0 (2020-07-31)

* Add Teilnehmerliste, alphabetisch und nach Startrang
* Add Rangliste normal
* Add Ergebnisse
* Add Live-Modus, Cache-Dauer und Offline-Cache in tl_content
* Spalten optional ausblenden
* Schweizer-System-Turniere fertiggestellt

## Version 0.0.2 (2020-07-29)

* Fix composer.json Komma-Fehler

## Version 0.0.1 (2020-07-29)

* Initiale Version