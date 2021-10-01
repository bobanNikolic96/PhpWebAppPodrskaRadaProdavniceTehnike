-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2020 at 10:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodavnicatehnike`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnik` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `brojTelefona` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pol` enum('M','Ž') NOT NULL,
  `usertype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnik`, `ime`, `prezime`, `password`, `brojTelefona`, `email`, `pol`, `usertype`) VALUES
(105739, 'Pera', 'Peric', 'be105a6ee5530d17d9f234baa85ac846b463edd6', '0642459926', 'pera96@gmail.com', 'M', 'admin'),
(387792, 'Pike', 'Pikic', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0645779003', 'pikic@gmail.com', 'M', 'user'),
(398560, 'Nikola', 'Pekic', '0ddb5877c896f43e8734e10b001e7f1eb92889cd', '0621772999', 'nikola@its.edu.rs', 'M', 'admin'),
(419009, 'Boban', 'Nikolic', 'b60947ea5f1d8f24dbaf4398af6e48c05d8db185', '0693868560', 'boban96@gmail.com', 'M', 'user'),
(429051, 'Janko', 'Jankovic', '7c4a8d09ca3762af61e59520943dc26494f8941b', '066333222', 'janko@its.edu.rs', 'M', 'user'),
(786929, 'Seka', 'Persa', 'ede0d93ea98223ada36ea65da568eac44444257c', '068753712', 'seka96@gmail.com', 'Ž', 'user'),
(847484, 'Bobi', 'Nikolic', 'b60947ea5f1d8f24dbaf4398af6e48c05d8db185', '0642459924', 'boban43@gmail.com', 'M', 'admin'),
(851693, 'Pera', 'Peric', 'be105a6ee5530d17d9f234baa85ac846b463edd6', '+381672512532', 'pera123@gmail.com', 'M', 'user'),
(909254, 'Marko', 'Vesic', 'c9aa572d1b9f64f146b5e098acfed98a530ae8d0', '0671234212', 'marko96@gmail.com', 'M', 'user'),
(954514, 'Nevena', 'Cosic', 'ab56daca29e7d6dc031209fc7c3ccaa175991520', '0642459924', 'nenac96@hotmail.com', 'Ž', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbenica`
--

CREATE TABLE `narudzbenica` (
  `idNarudzbenice` varchar(50) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `datumVreme` datetime NOT NULL,
  `adresa_za_isporuku` varchar(220) NOT NULL,
  `grad` varchar(50) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `totalCena` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `narudzbenica`
--

INSERT INTO `narudzbenica` (`idNarudzbenice`, `idKorisnik`, `datumVreme`, `adresa_za_isporuku`, `grad`, `zip_code`, `totalCena`) VALUES
('NAR142199', 419009, '2020-09-10 21:34:07', 'Kneya Milosa 12', 'Beograd', 21312, 15300),
('NAR267440', 847484, '2020-09-10 19:06:24', 'Bitke na neretvi 52', 'Beograd', 11212, 58440),
('NAR389222', 847484, '2020-09-10 18:53:58', 'Bitke na Neretvi 21', 'Beograd', 11220, 16000),
('NAR473882', 786929, '2020-09-10 15:51:53', 'Valentija 21', 'Beograd', 11241, 16800),
('NAR54726', 954514, '2020-09-09 18:22:25', 'Radnicka 25', 'Beograd', 11231, 65550),
('NAR598775', 847484, '2020-09-10 17:20:45', 'Alosina 12', 'Kragujevac', 21312, 77880),
('NAR615687', 847484, '2020-09-10 17:31:09', 'Bitke na Neretvi 21', 'Beograd', 11210, 15300),
('NAR659470', 954514, '2020-09-09 18:22:00', 'Kneza Milosa 15', 'Beograd', 16213, 20675),
('NAR793017', 419009, '2020-09-09 23:45:06', 'Korisnikova 123', 'Beograd', 11210, 20675),
('NAR826508', 847484, '2020-09-10 21:30:13', 'Londonska 12', 'Beograd', 12312, 37500),
('NAR897188', 419009, '2020-09-09 19:10:12', 'Bitke na neretvi 52', 'Beograd', 11211, 26900),
('NAR910303', 847484, '2020-09-10 19:58:57', 'Bitke na Neretvi 21', 'Beograd', 12101, 29000),
('NAR941350', 419009, '2020-09-09 18:58:15', 'Validna 12', 'Veograd', 11212, 29320);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `idProizvoda` varchar(30) NOT NULL,
  `naziv` varchar(120) NOT NULL,
  `vrsta` enum('mis','tastatura','monitor') NOT NULL,
  `kolicina` int(11) NOT NULL,
  `opis` text NOT NULL,
  `specifikacije` text NOT NULL,
  `cena` int(11) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `popust` int(11) DEFAULT NULL,
  `slika` varchar(200) DEFAULT NULL,
  `alt_slika` varchar(220) DEFAULT NULL,
  `ukupnaCena` double DEFAULT NULL,
  `stanje` enum('nova','koriscena') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`idProizvoda`, `naziv`, `vrsta`, `kolicina`, `opis`, `specifikacije`, `cena`, `marka`, `popust`, `slika`, `alt_slika`, `ukupnaCena`, `stanje`) VALUES
('MIS01', 'LOGITECH G502 HERO ', 'mis', 53, 'HERO 16K Senzor\r\nHERO je najtačniji igračski senzor ikada sa genijalnom preciznošću i osnovnom arhitekturom. Sa brzinom obrade najbrže frejmova, HERO je sposoban za 400+ IPS u rasponu od 100 - 16,000 DPI sa nultim izjednačavanjem, filtriranjem ili ubrzanjem. HERO postiže preciznost na nivou konkurencije i najefikasniji odgovor na to. Obavezno prilagodite i podesite podešavanja DPI koristeći Logitech Gaming Softvare (LGS).\r\n \r\n11 Programabilnih tastera\r\nKoristite Logitech Gaming Softwer da biste programirali svoje omiljene komande i makre na svakom od 11 dugmadi. Izgradite, zaklečite, zaležite, zacelite ... stavite svoju snagu na svoje ruke. Sačuvajte do 5 različitih profila direktno na miša da biste poneli svoja podešavanja sa vama bilo gde.\r\n \r\nPodesiva težina\r\nFino podešavanje osećaja miša i klizanje u svoju korist. Pet težina od 3.6 g dolaze sa G502 HERO i mogu se konfigurisati u različitim prednjim, zadnjim, levim, desnim i srednjim podesivim konfiguracijama. Eksperimentišite sa poravnanjem i balansom kako biste pronašli tačku kako biste optimizovali svoje igračke performanse.\r\n \r\nRGB Osvetljenje\r\nTehnologija RGB sledeće generacije koja može upravljati igricama, zvukom ili ekranom kako bi se ikada isporučilo najkvalitetnije RGB iskustvo. Izaberite čitav spektar od približno 16,8 miliona boja i sinhronizujte animacije i efekte osvetljenja sa vašim drugim Logitech G uređajima. Prilagodite sve to brzo i lako koristeći Logitech Gaming Software.', '•Model: Logitech G502 Hero\r\n<br>\r\n•Senzor: HERO\r\n<br>\r\n•Rezolucija: 100 -16000 dpi\r\n<br>\r\n•Životni vek: 50 miliona klikova\r\n<br>\r\n•Maksimalno ubrzanje: 40 G\r\n<br>\r\n•Brzina praćenja: 400 ips\r\n<br>\r\n•Broj tastera: 11\r\n<br>\r\n•Dužina kabla: 210 cm\r\n<br>\r\n•Dimenzije: 132 x 75 x 40\r\n<br>\r\n•Težina: 121 g\r\n<br>\r\n•Osvetljenje: Da RGB \r\n<br>\r\n•USB odziv: 1ms (1000Hz)\r\n<br>\r\n•Ostalo: Pogodno za obe ruke\r\n\r\n', 13000, 'Logitech', 5, 'g502Hero.jpg', 'Slika - LOGITECH Gejmerski miš G502 HERO SILVER EDITION', 12350, 'nova'),
('MIS02', 'RAZER BASILISK V2', 'mis', 36, 'Napravite svoj šampionski stil igre sa gejmerskim mišem Razer Basilisk V2.  Prebacite i prilagodite svoje performanse pomoću ovog vrlo prilagodljivog miša za igranje da biste stvorili svoj vlastiti brend dominacije koji će ostaviti trag na bojnom polju .', '- Senzor: Focus+ optički senzor sa 99,6% preciznosti\r\n<br>\r\n- DPI: 20.000 (mogućnost menjanja, osnovna podešavanja: 800/1800/4000/9000/20000)\r\n<br>\r\n- IPS: Do 650, 50G ubrzanje\r\n<br>\r\n- Povezivanje: Preko kabla, dužina kabla: 2,1m\r\n<br>\r\n- 11 programabilnih tastera\r\n<br>\r\n- Tasteri: Razer optički, do 70 miliona klikova\r\n<br>\r\n- 5 On-board memorijskih profila\r\n<br>\r\n- Dimenzije: 130 x 60 x 42 mm\r\n<br>\r\n- Težina: 92g', 11500, 'Razer', 0, 'basiliskV2.jpg', 'Slika - RAZER Gejmerski miš BASILISK V2', 11500, 'nova'),
('MIS1246', 'Redragon Mirage', 'mis', 1, 'Redragon Mirage M690 gaming miš nudi visoku preciznost sa 4800DPI senzorom, kao i potpunu slobodu uz 2.4G Wireless tehnologiju sa optimizovanim odzivom za visoke gaming performanse, 7 programabilnih tastera i 4 moda osvetljenja u 7 boja. ', 'Svrha -Gaming <br>\r\nPovezivanje uređaja -Bežična RF <br>\r\nTehnologija detekcije pokreta -Optički <br>\r\nTip pomeranja -Točkići <br>\r\nBroj tastera -7\r\n', 2400, 'Redragon', 0, 'redragonMirage.jpg', 'Slika - Redragon Mirage', 2400, 'nova'),
('MIS6206', 'Logitech MX Anywhere 2S', 'mis', 20, 'testtesttesttesttesttesttesttesttest', 'Svrha -Kancelarijske <br>\r\nPovezivanje uređaja -Bežična RF + Bluetooth <br>\r\nTip pomeranja -Točkići <br>\r\nBroj tastera -7\r\n', 10000, 'Logitech', 0, 'LogitechMXAnywhere2S.jpg', 'Slika - Logitech MX Anywhere 2S', 10000, 'nova'),
('MON01', 'Asus VA249HE VA monitor 24\"', 'monitor', 46, 'Izuzetan nivo detalja\r\nIskusite novu dimenziju svega što vidite. Ovaj monitor dijagonale 24\" pruža odlične performanse, bilo da je reč o igranju, gledanju filmova ili radu u Excel tabelama. Za to je zaslužan TFT LCD ekran, sa unapređenom reprodukcijom boja, većim kontrastom i izuzetnim fokusom slike. Rezolucija od 1.920 x 1.080 piksela (tačaka) prikazuje veoma oštru sliku, sve do poslednjeg detalja.\r\n \r\nDoživljaj gledanja bez premca.\r\nBoje visokog kvaliteta i odlične uglove gledanja obezbeđuje VA tehnologija panela koja Vam donosi pravo uživanje u gledanju. Unapređeno LED pozadinsko osvetljenje prikazuje prirodniju sliku bez obzira kako na to gledate, a 16:9 odnos stranica najoptimalnije prikazuje sadržaj na ekranu.\r\n \r\nEkran koji je uvek spreman za akciju\r\nŠta god da gledate, uživaćete u glatkom prikazu brzih akcionih scena na ekranu. Odziv piksela od 5ms je zaslužan za jasan prikaz bez mutnih slika. Maksimalno pozadinsko osvetljenje od 250cd/m² raspoređeno iza ekrana monitora slici daje upečatljiv kontrast tako što svetlo usmerava tamo gde je najpotrebnije. Krajnji rezultat je oštriji prikaz sa boljim doživljajem dubine, bez obzira na sadržaj koji se prikazuje.\r\n \r\nVaš monitor, Vaš stil\r\nZahvaljujući tankom dizajnu ovaj model unosi dodir stila u klasični izgled monitora. Iznenađujuće male dimenzije u odnosu na veličinu ekrana u kombinaciji sa kompaktnim, ali stabilnim postoljem olakšavaju postojanost ovog monitora. Novi oblik konkretno ovog modela postiže spoj estetike i funkcionalnosti, a male dimenzije štede prostor na Vašem radnom stolu.', 'Veličina ekrana 	24\" <br>\r\nRezolucija 	1.920 x 1.080 <br>\r\nTip ekrana 	TFT LCD <br>\r\nTip panela 	VA <br>\r\nPozadinsko osvetljenje 	LED <br>\r\nOdnos stranica 	16:9 <br>\r\nDinamički kontrast 	100.000.000:1 <br>\r\nOsvetljenje 	250cd/m² <br>\r\nOdziv 	5ms <br>\r\nUglovi gledanja   178° horizontalni, 178° vertikalni <br>\r\nVertikalno osvežavanje 	60Hz <br>\r\nPaleta boja 	16.7 miliona boja <br>\r\nPriključci / Slotovi\r\nHDMI priključci 	1x HDMI\r\nVGA D-sub 	1 <br>\r\nOstali priključci / Slotovi 	Kensington security lock slot \r\n', 13000, 'Asus', 0, 'asusVa249he.jpg', 'Slika - Asus VA249HE VA monitor 24\"', 13000, 'nova'),
('MON02', 'Dell S2421HGF TN 23.8\"', 'monitor', 36, 'Brzina sa stilom\r\nOstavite zaostajanje u prašini: Vreme odziva od 1 ms i brzina osvežavanja od 144 Hz pružaju glatko, neprekidno iskustvo. Brze promene boja piksela eliminišu zamućenost pokreta i zadržavaju vas usred akcije.\r\nBez seckanja: AMD FreeSync ™ Premium tehnologija dodaje još jedan sloj neometanog igranja eliminišući kidanje ekrana i seckanje.\r\nIzgubite se u pogledu: igrajte u Full HD rezoluciji i iskusite oštre, detaljne vizuelne prikaze koji vas vode dublje u igru.', 'Displej <br>\r\nDijagonala ekrana - 60,5 cm (23.8\")<br>\r\nRezolucije ekrana - 1920 x 1080 piksela<br>\r\n\r\nIzvorni odnos širina/visina - 16:9 <br>\r\n\r\nTip ekrana - TN <br>\r\nOsvetljenje ekrana (tipično) - 350 cd/m²\r\n<br>\r\nVreme odziva - 1 ms <br>\r\n\r\nTip visoke definicije (HD)- \r\nFull HD<br>\r\n\r\nTehnologija ekrana -LCD <br>\r\nOblik ekrana - Ravni <br>', 25000, 'Dell', 0, 'dellS2421HGF.jpg', 'Slika - Dell S2421HGF TN gejmerski monitor 23.8\"', 25000, 'nova'),
('MON5448', 'Philips 223V5LHSB2', 'monitor', 12, 'Test opis test  testtesttesttesttesttesttesttesttest\r\ntesttesttesttesttesttesttesttesttesttesttesttest\r\ntesttesttesttest', 'Dijagonala ekrana -54,6 cm (21.5\") <br>\r\nRezolucije ekrana -1920 x 1080 piksela <br>\r\nIzvorni odnos širina/visina -16:9 <br>\r\nTip ekrana -TFT\r\n', 11000, 'Philips ', 5, 'Philips223V5LHSB2.jpg', 'Slika - Philips 223V5LHSB2', 10450, 'nova'),
('MON8630', 'Philips 325E1C/00 VA', 'monitor', 21, 'dsasaddsadas', 'dsasaddsadas					\r\n					', 38000, 'Philips', 50, 'philips325e1c.jpg', 'Slika Philips 325E1C/00 VA', 19000, 'koriscena'),
('TAST01', 'Logitech K400 Plus', 'tastatura', 59, 'Logitech K400 Plus je bežična tastatura sa touchpadom, predviđena da pruži potpunu kontrolu za vaš Home Theater PC ili TV u jednom uređaju.\r\n\r\nSa dometom do 10m, malim dimenzijama, trajanjem baterije i do 18 meseci i podesivim prečicama za multimediju, ova tastatura omogućuje da iz fotelje ili kreveta uživate u filmovima, serijama i muzici i kontrolišete sve parametre vaših uređaja sa razdaljine.', 'Model	K400 PLUS WIFI US <br>\r\n\r\nTip tastera	Plitki + touchpad <br>\r\nPovezivanje	Wireless 2.4GHz <br>\r\nFont	US <br>\r\nKompatibilnost	Windows 7/8/10/Android 5.0/Chrome OS <br>\r\nTip	Bežična <br>\r\nBoja	Crna <br>\r\nPozadinsko osvetljenje	Ne <br>\r\nGaming	Ne <br>\r\nNapomena	Domet do 10m <br>\r\nOstalo	Unifying receiver, 2 AA  <br>baterije, vek baterije preko 18 meseci\r\nDimenzije	139.9x354.3x23.5mm <br>\r\nMasa	 390g <br>\r\nProfil	 Niski\r\n\r\n', 4800, 'Logitech', 10, 'logitechK400.jpg', 'Slika - Logitech K400 Plus ', 4320, 'nova'),
('TAST02', 'Genius Scorpion K215', 'tastatura', 66, 'Genius Scorpion K215 je gaming tastatura sa pozadinskim osvetljenjem, 10 dodatnih multimedijalnih tastera i posebno obeleženim WASD tasterima, a splash-proof dizajn štiti tastaturu u slučaju slučajnog kvašenja.', 'Tip tastature	Žična tastatura <br>\r\nTip tastera	Membranski tasteri <br>\r\nNisko-profilni tasteri	Ne <br>\r\nPozadinsko osvetljenje	Da <br>\r\nSlovni raspored	SRB (YU) <br>\r\nPovezivanje	USB <br>\r\nOslonac za dlanove	Ne <br>\r\nErgonomski raspored tastera	Ne <br>\r\nBoja	Crna <br>\r\nVeličina tastature	Velika tastatura <br> (Full Size - sa numeričkim delom)\r\nMultimedijalni tasteri	10 tastera <br>\r\nIzdržljivost tastera	Do 2 miliona pritisaka\r\n', 2000, 'Genius', 5, 'geniusScorpionK215.jpg', 'Slika - Genius Scorpion K215', 1900, 'nova'),
('TAST8966', 'Asus TUF Gaming K7', 'tastatura', 59, 'Dominacija na bojnom polju izaziva aktiviranje svetlosne brzine TUF Gaming K7 Optical-Mech prekidača. Izaberite linearno ili taktilno da odgovara vašem stilu igre i iskoristite kompaktni dizajn da biste ostali u komandi. K7 je otporna na vodu i prašinu, opremljena je aircraft-grade aluminijumom, dolazi sa odvojivim osloncem za ručni zglob i ima osvetljenje Aura Sync po tasteru - za brz i zabavan način osvetljenja vašeg sveta igara.', 'Dominacija na bojnom polju izaziva aktiviranje svetlosne brzine TUF Gaming K7 Optical-Mech prekidača. Izaberite linearno ili taktilno da odgovara vašem stilu igre i iskoristite kompaktni dizajn da biste ostali u komandi. K7 je otporna na vodu i prašinu, opremljena je aircraft-grade aluminijumom, dolazi sa odvojivim osloncem za ručni zglob i ima osvetljenje Aura Sync po tasteru - za brz i zabavan način osvetljenja vašeg sveta igara.					\r\n					', 20000, 'Asus', 50, 'asusTufGamingK7v2.jpg', 'Slika Asus TUF Gaming K7', 10000, 'koriscena');

-- --------------------------------------------------------

--
-- Table structure for table `stavka_narudzbenice`
--

CREATE TABLE `stavka_narudzbenice` (
  `idNarudzbenice` varchar(50) NOT NULL,
  `idProizvoda` varchar(30) NOT NULL,
  `redniBr` int(11) NOT NULL,
  `izabranaKolicina` int(11) NOT NULL,
  `ukupnaCena` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stavka_narudzbenice`
--

INSERT INTO `stavka_narudzbenice` (`idNarudzbenice`, `idProizvoda`, `redniBr`, `izabranaKolicina`, `ukupnaCena`) VALUES
('NAR142199', 'MIS02', 1, 1, 11500),
('NAR142199', 'TAST02', 2, 2, 3800),
('NAR267440', 'MON02', 2, 1, 25000),
('NAR267440', 'MON8630', 1, 1, 33440),
('NAR389222', 'TAST8966', 1, 1, 16000),
('NAR473882', 'MON01', 2, 1, 13000),
('NAR473882', 'TAST02', 1, 2, 3800),
('NAR54726', 'MIS02', 1, 6, 65550),
('NAR598775', 'MON8630', 2, 2, 66880),
('NAR615687', 'TAST8966', 1, 1, 15300),
('NAR659470', 'MIS01', 1, 1, 9750),
('NAR659470', 'MIS02', 2, 1, 10925),
('NAR793017', 'MIS01', 1, 1, 9750),
('NAR793017', 'MIS02', 2, 1, 10925),
('NAR826508', 'MIS02', 1, 1, 11500),
('NAR826508', 'MON01', 2, 2, 26000),
('NAR897188', 'MON02', 2, 1, 25000),
('NAR897188', 'TAST02', 1, 1, 1900),
('NAR910303', 'MIS6206', 2, 1, 10000),
('NAR910303', 'MON8630', 1, 1, 19000),
('NAR941350', 'MON02', 2, 1, 25000),
('NAR941350', 'TAST01', 1, 1, 4320);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnik`);

--
-- Indexes for table `narudzbenica`
--
ALTER TABLE `narudzbenica`
  ADD PRIMARY KEY (`idNarudzbenice`),
  ADD KEY `idKorisnikConstraint` (`idKorisnik`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`idProizvoda`);

--
-- Indexes for table `stavka_narudzbenice`
--
ALTER TABLE `stavka_narudzbenice`
  ADD PRIMARY KEY (`idNarudzbenice`,`idProizvoda`),
  ADD KEY `idProizvoda` (`idProizvoda`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `narudzbenica`
--
ALTER TABLE `narudzbenica`
  ADD CONSTRAINT `idKorisnikConstraint` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnik` (`idKorisnik`);

--
-- Constraints for table `stavka_narudzbenice`
--
ALTER TABLE `stavka_narudzbenice`
  ADD CONSTRAINT `stavka_narudzbenice_ibfk_1` FOREIGN KEY (`idNarudzbenice`) REFERENCES `narudzbenica` (`idNarudzbenice`),
  ADD CONSTRAINT `stavka_narudzbenice_ibfk_2` FOREIGN KEY (`idProizvoda`) REFERENCES `proizvod` (`idProizvoda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
