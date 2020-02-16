-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Feb 2020 um 09:36
-- Server-Version: 10.4.6-MariaDB
-- PHP-Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bachelorarbeit_massenänderung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ma_auftrag`
--

CREATE TABLE `ma_auftrag` (
  `id` int(11) NOT NULL,
  `inr` int(3) NOT NULL,
  `auftrags_nr_spk` int(8) NOT NULL COMMENT 'ticketnr',
  `auftrags_nr_bws` int(4) NOT NULL COMMENT 'auftragsnr',
  `auftrags_status` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'R',
  `auftrags_typ` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `aend_pgm` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'MAD01010',
  `bearbeiter_bws` varchar(7) COLLATE utf8_unicode_ci NOT NULL COMMENT 'j-user',
  `beschreibung` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `prozess_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ausfuehr_adtm` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '01.01.0001',
  `ausfuehr_edtm` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '31.12.9999',
  `przs_commit_rate` int(11) NOT NULL DEFAULT 1,
  `przs_afrf_QS_lim` int(11) NOT NULL DEFAULT 50000
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='beinhaltet alle Tabellenspalten, welche anpassbar sind';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ma_def`
--

CREATE TABLE `ma_def` (
  `feldname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `länge` int(11) DEFAULT NULL,
  `standard` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='beinhaltet alle Tabellenspalten + def + standard; wenn standard=null, dann Pflichtfeld';

--
-- Daten für Tabelle `ma_def`
--

INSERT INTO `ma_def` (`feldname`, `type`, `länge`, `standard`) VALUES
('aend_anz', 2, NULL, '0'),
('aend_ltzt_ts', 3, NULL, 'CURRENT TIMESTAMP'),
('aend_ltzt_uid', 1, NULL, ''),
('aend_pgm', 1, NULL, 'MAD01010'),
('aend_pgm_parm', 1, NULL, 'MAIL=NEIN'),
('aend_zeilen', 2, NULL, '0'),
('atg_refresh_kz', 1, NULL, 'N'),
('auftrags_id', 3, 0, 'CURRENT TIMESTAMP'),
('auftrags_nr_bws', 2, 4, NULL),
('auftrags_nr_spk', 2, 8, NULL),
('auftrags_status', 1, 1, 'R'),
('auftrags_typ', 1, 1, 'A'),
('ausfuehr_adtm', 4, NULL, '01.01.0001'),
('ausfuehr_art_ltzt', 1, NULL, 'K'),
('ausfuehr_art_nhst', 1, NULL, 'K'),
('ausfuehr_datum', 4, NULL, '31.12.9999'),
('ausfuehr_edtm', 4, NULL, '31.12.9999'),
('ausfuehr_lts', 3, NULL, 'CURRENT TIMESTAMP'),
('ausfuehr_zeilen_nhst', 2, NULL, '0'),
('bearbeiter_bws', 1, 7, NULL),
('beschreibung', 1, 60, NULL),
('commit_ts', 3, NULL, '0001-01-01-00.00.00.0000'),
('eingangs_datum', 4, NULL, 'CURRENT DATE'),
('frgb_uid', 1, NULL, ''),
('inr', 2, 3, NULL),
('liegezeit_ref_dtm', 4, NULL, 'CURRENT DATE'),
('mass_aend_grps_schl', 1, NULL, '1'),
('mass_aend_spk_kst', 1, NULL, ''),
('prozess_name', 1, 60, NULL),
('przs_afrf_anz_fehl_d', 2, NULL, '0'),
('przs_afrf_anz_fehl_p', 2, NULL, '0'),
('przs_afrf_anz_info', 2, NULL, '0'),
('przs_afrf_anz_ok', 2, NULL, '0'),
('przs_afrf_qs_kz', 1, NULL, 'N'),
('przs_afrf_qs_lim', 2, NULL, '50000'),
('przs_afrf_qs_text', 1, NULL, ''),
('przs_commit_rate', 2, NULL, '1'),
('sbtr_uid', 1, NULL, 'SYSTEM'),
('sql_ausfuehr_dtm', 4, NULL, 'CURRENT DATE'),
('sql_fehler_text', 1, NULL, ''),
('ticket_ktgr_2', 1, NULL, 'Daten-/Schnittstellenmanagement'),
('ticket_ktgr_3', 1, NULL, 'Spk-individuelle Datenänderungen'),
('ticket_ktgr_4', 1, NULL, 'Änderungsdienst'),
('vp_wltg_mm', 1, NULL, 'N');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ma_sql`
--

CREATE TABLE `ma_sql` (
  `id` int(11) NOT NULL,
  `bezugs_objekt_id` int(11) NOT NULL,
  `bezugs_objekt_typ` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `prozess_nr` int(11) NOT NULL,
  `prozess_afrf_rang` int(11) NOT NULL,
  `sql_testliste` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sql_selektion` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_01` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_01` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_01` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_02` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_02` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_02` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_03` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_03` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_03` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_04` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_04` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_04` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_05` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_05` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_05` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_06` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_06` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_06` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_07` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_07` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_07` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_08` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_08` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_08` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_09` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_09` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_09` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_10` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_10` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_10` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_11` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_11` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_11` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_12` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_12` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_12` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_13` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_13` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_13` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feld_14` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatz_14` varchar(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wert_14` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rn_data_type`
--

CREATE TABLE `rn_data_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `rn_data_type`
--

INSERT INTO `rn_data_type` (`id`, `name`) VALUES
(1, 'String'),
(2, 'Integer'),
(3, 'Timestamp'),
(4, 'Date');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ma_auftrag`
--
ALTER TABLE `ma_auftrag`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ma_def`
--
ALTER TABLE `ma_def`
  ADD PRIMARY KEY (`feldname`),
  ADD KEY `ma_auftrag_def rn_data_type` (`type`);

--
-- Indizes für die Tabelle `rn_data_type`
--
ALTER TABLE `rn_data_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ma_auftrag`
--
ALTER TABLE `ma_auftrag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `rn_data_type`
--
ALTER TABLE `rn_data_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `ma_def`
--
ALTER TABLE `ma_def`
  ADD CONSTRAINT `ma_auftrag_def rn_data_type` FOREIGN KEY (`type`) REFERENCES `rn_data_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
