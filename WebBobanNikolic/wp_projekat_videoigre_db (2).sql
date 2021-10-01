-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2020 at 10:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wp_projekat_videoigre_db`
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
(28870, 'Milomir', 'Pekovic', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0644222243', 'miloje@gmail.com', 'M', 'user'),
(387792, 'Pike', 'Pikic', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0645779003', 'pikic@gmail.com', 'M', 'user'),
(398560, 'Nikola', 'Pekic', '0ddb5877c896f43e8734e10b001e7f1eb92889cd', '0621772999', 'nikola@its.edu.rs', 'M', 'admin'),
(429051, 'Janko', 'Jankovic', '7c4a8d09ca3762af61e59520943dc26494f8941b', '066333222', 'janko@its.edu.rs', 'M', 'user');

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
('NAR229222', 387792, '2020-04-16 18:50:41', 'Mike Alasa 45', 'Beograd', 11000, 10997),
('NAR255196', 387792, '2020-04-17 02:25:05', 'Vojvode Milenka 25', 'Beograd', 11000, 2499.5),
('NAR298368', 387792, '2020-03-31 06:36:35', 'Vojvode Milenka', 'Beograd', 11000, 19996),
('NAR517928', 387792, '2020-04-17 02:25:48', 'Mike Alasa 45', 'Beograd', 11050, 8023.65),
('NAR528256', 387792, '2020-04-18 03:26:15', 'Vojvode Milenka', 'Beograd', 11050, 9448.4),
('NAR601393', 387792, '2020-04-07 04:43:16', 'Bircaninova 17a', 'Beograd', 11000, 4999),
('NAR671703', 387792, '2020-05-15 05:52:20', 'Bircaninova 17a', 'Beograd', 11000, 2999),
('NAR695777', 387792, '2020-04-16 21:47:54', 'Bircaninova 17a', 'Beograd', 11000, 19996),
('NAR752891', 387792, '2020-03-31 06:33:24', 'Vojvode Milenka 4', 'Beograd', 11000, 42719.95),
('NAR789835', 387792, '2020-04-16 21:11:12', 'Kneza Milosa 5', 'Beograd', 11030, 25871.7),
('NAR819502', 387792, '2020-05-06 04:00:10', 'Bircaninova 17a', 'Beograd', 11000, 9448.4),
('NAR960217', 28870, '2020-05-06 06:50:28', 'Mike Alasa 45', 'Beograd', 11050, 6299.3);

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
('NAR229222', 'PC331181', 1, 1, 4999),
('NAR229222', 'PC455', 2, 2, 5998),
('NAR255196', 'PC93122', 1, 1, 2499.5),
('NAR298368', 'XB43339', 1, 4, 19996),
('NAR517928', 'PC93122', 2, 1, 2499.5),
('NAR517928', 'PS72346', 1, 1, 5524.15),
('NAR528256', 'PC9411', 1, 1, 3149.1),
('NAR528256', 'PS3233', 2, 1, 6299.3),
('NAR601393', 'PC331181', 1, 1, 4999),
('NAR671703', 'PC455', 1, 1, 2999),
('NAR695777', 'PS4222', 2, 2, 9998),
('NAR695777', 'XB43339', 1, 2, 9998),
('NAR752891', 'PS4222', 3, 1, 4999),
('NAR752891', 'XB74003', 1, 3, 24222.45),
('NAR752891', 'XB77732', 2, 2, 13498.5),
('NAR789835', 'PS37022', 1, 3, 19122.45),
('NAR789835', 'XB77732', 2, 1, 6749.25),
('NAR819502', 'PC9411', 2, 1, 3149.1),
('NAR819502', 'PS3233', 1, 1, 6299.3),
('NAR960217', 'PS3233', 1, 1, 6299.3);

-- --------------------------------------------------------

--
-- Table structure for table `video_igra`
--

CREATE TABLE `video_igra` (
  `idProizvoda` varchar(30) NOT NULL,
  `naziv` varchar(120) NOT NULL,
  `platforma` enum('pc','ps4','xbox1') NOT NULL,
  `kolicina` int(11) NOT NULL,
  `opis` text NOT NULL,
  `cena` int(11) NOT NULL,
  `developer` varchar(50) NOT NULL,
  `popust` int(11) DEFAULT NULL,
  `slika` varchar(200) DEFAULT NULL,
  `alt_slika` varchar(220) DEFAULT NULL,
  `ukupnaCena` double DEFAULT NULL,
  `stanje` enum('nova','koriscena') NOT NULL,
  `datumIzlaska` date NOT NULL,
  `pegi` varchar(200) DEFAULT NULL,
  `zanr` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video_igra`
--

INSERT INTO `video_igra` (`idProizvoda`, `naziv`, `platforma`, `kolicina`, `opis`, `cena`, `developer`, `popust`, `slika`, `alt_slika`, `ukupnaCena`, `stanje`, `datumIzlaska`, `pegi`, `zanr`) VALUES
('PC331181', 'PCG Metro Exodus', 'pc', 9, 'Baziran na romanima Dmitrija Gluhovskog serijal igara Metro vas stavlja u svet nakon nuklearne katastrofe gde se većina preživelih povukla u moskovski metro. Nakon Metro 2033 i Metro Last Light treći nastavak - Egzodus vodi glavnog junaka, Artjoma, po prvi put izvan metroa u ogromno otvoreno prostranstvo Rusije gde ga očekuju potpuno novi izazovi!\r\n\r\nGodina 2036.\r\nČetvrtina veka nakon nuklearnog rata koji je unistio planetu, nekoliko hiljada preživelih i dalje žive pod zemljom ispod Moskve u tunelima Metro-a. Vodili su borbu sa otrovnim elementima, borili se protiv mutiranih zveri i paranormalnim hororima i patili pod mukama gradjanskog rata. Ali sada, kao Artyom, moraš pobeći iz Metro-a i voditi grupu Spartan Rangers kroz neverovatno kontinentalno putovanje kroz post-apokalipticnu Rusiju u potrazi za novim životom na Istoku. Metro Exodus je epska first person pucačina koja spaja smrtonosnu borbu i šunjanje.', 4999, 'Deep Silver', 0, 'metro-exodus.jpg', 'Slika PCG Metro Exodus | Gamer\'s shopping area', 4999, 'nova', '2019-02-15', 'pegi/18.png', 'FPS - First Person Shooter'),
('PC455', 'PCG Tom Clancys - Ghost Recon Wildlands', 'pc', 35, 'BIENVENIDOS A BOLIVIA\r\nWildlands je najveće Ubisoft open world igra. Bolivija je postala najveći proizvođač kokaina na svetu. Santa Blanca kartel je odveo državu u strah, nepravdu i nasilje.\r\nRat nije izbor. Skriven, precizan, smrtonosni pristup je jedini način da se ova bolest zaustavi u korenu. Ghost, elitne specijalne jedinice su poslate iza neprijateljskih linija da destabilizuju, naprave haos i prekinu savez između kartela i korumpirane države.\r\nSuočite se sa zastrašujućim protivnikom u masivno i neprijateljskom okruženju, Ghost jedinice će morati da donose kritične moralne odluke i da ulaze u teške bitke da bi završili svoju misiju.', 2999, 'Ubisoft', 0, 'PCG Tom Clancy\'s - Ghost Recon Wildlands1.jpg', 'Slika PCG Tom Clancys - Ghost Recon Wildlands | Gamer\'s shopping area', 2999, 'nova', '2018-09-18', 'pegi/18.png', 'FPS - First Person Shooter'),
('PC8521', 'PCG Sekiro - Shadows Die Twice', 'pc', 18, 'U Sekiro ti si jednoruki borac, osramoćeni i unakaženi shinobi spašen sa ivice smrti. Zavetovao si se da ćeš čuvati mladog gospodara koji je naslednik stare loze zbog čega postaješ meta mnogih opasnih neprijatelja, uključujući i opasni Ashina klan. Kada mladog gospodara zarobe ništa te neće sprečiti u pohodu da povratiš čast. Istraži Japan kasnog XVI veka u brutalnom periodu gde se boriš ne samo protiv ljudi već i mitskih bića. Na raspolaganju imaš veliki arsenal oružija i nindža sposobnosti koje kombinuju stealth, vertikalne borbe i vrhunske mačevalačke veštine u borbi 1 na 1. Igru razvija studio From Software poznat po Dark Souls i Bloodborne igrama.', 5999, 'ActiVision', 15, 'pcg-sekiro-shadow-die-twice.jpg', 'Slika PCG Sekiro - Shadows Die Twice | Gamer\'s shopping area', 5099.15, 'nova', '2019-03-22', 'pegi/16.png', 'Akcija - Avantura'),
('PC93122', 'PCG Battlefield 5', 'pc', 4, 'Uđite u najveći sukob u istoriji čovečanstva sa Battlefield V pošto se serija igara vraća svojim korenima u nikad ranije viđenom prikazu Drugog svetskog rata. Igrajte mutiplayer širom sveta ili učestvujte u ljudskoj drami naspram globalne borbe u Pričama iz rata za jednog igrača.\r\nNovi Firestorm mod igranja donosi po prvi put Battle Royale u jednu Battlefield igru. Zaigrajte Battle Royale na potpuno novi način!', 4999, 'EA', 50, 'pcg-battlefield5.jpg', 'Slika PCG Battlefield 5 | Gamer\'s shopping area', 2499.5, 'koriscena', '2018-11-20', 'pegi/16.png', 'FPS - First Person Shooter'),
('PC9411', 'PCG Far Cry 5', 'pc', 10, 'Far Cry dolazi u Ameriku. Dobrodošao u Hope County u Montani, zemlju slobodnih i hrabrih, ali takođe dom fanatične sekte Eden\'s Gate. Suprotstavi se vođi sekte Joseph Seed i njegovoj braći, Glasnicima. Bori se protiv smrtonosne sekte, oslobodi Hope Country sam ili u co-op za dva igrača. Opustoši sektu i njene članove, ali se čuvaj besa Joseph Seeda. Iskleši svoj put, napravi like prema sebi, mlađeg zamenika šerifa i izaberi svoju avanturu u kojoj te očekuju muscle kola, ATV, avioni i još mnogo toga što možeš da koristite protiv sekte u epskim borbama. Na tom putu pomoći će ti Jerome, sveštenik koje je izgubio svoje vernike, Mary May, konobarica sa zapaljivim koktelima i Nick Rye, pilot koji želi bolju budućnost za svoje dete.', 3499, 'Ubisoft', 10, 'pcg-far-cry-5.jpg', 'Slika PCG Far Cry 5 | Gamer\'s shopping area', 3149.1, 'nova', '2018-03-27', 'pegi/18.png', 'Akcija'),
('PS3233', 'PS4 Call of Duty - Modern Warfare', 'ps4', 19, 'Preuzmi ulogu smrtonosnog Tier One operativca u uzbudljivoj sagi koja će uticati na svetski balans moći.\r\n\r\nJedan narativ povezuje kampanju, multiplayer i Special Ops modove, dok Cross play spaja celu Call of Duty zajednicu. Besplatne mape i modovi dolaze na sve platforme u isto vreme. Novi grafički engine pruža najrealniju grafiku u istoriji franšize. Call of Duty Modern Warfare donosi najveći tehnički skok u istoriji COD serijala.\r\n\r\nPovratak Modern Warfare nam donosi brzu akciju i čizme na zemlji. Omiljeni modovi i epski Killstreakovi se vraćaju i donose dinamiku koje dugo nije bilo u CoD igrama.\r\nPodesi svoj arsenal prema tvom stilu igre u Gunsmith opciji, gde te čeka najveći izbor oružija i opcija u istoriji CoD.\r\n\r\nNajveći plus za sve stare fanove je povratak kapetana Price. Udruži se sa specijalnim jedinicama i borcima za slobodu širom sveta kako bi povratio ukradeno hemijsko oružije. Tajne operacije te vode kroz Evropu i Bliski istok. Od tvog uspeha zavisi mir u celom svetu.\r\nOd tebe se očekuje da uradiš sve kako bi sprečio katastrofu.', 8999, 'ActiVision', 30, 'PS4-Call-of-Duty-Modern-Warfare.jpg', 'Slika PS4 Call of Duty - Modern Warfare | Gamer\'s shopping area', 6299.3, 'nova', '2019-10-25', 'pegi/18.png', 'FPS - First Person Shooter'),
('PS37022', 'PS4 Yakuza Remastered Collection - Day One Edition', 'ps4', 12, 'Završi putovanje Zmaja od Kamurocho sa Yakuza Remastered kolekcijom. Ali ovo je daleko od obično porta na novu konzolnu generaciju. Pored grafičkog unapređenja, tu su pojačane performanse(720p>1080p na 30>60fps), sve tri igre su prošle kroz rigorozni proces relokalizacije. Engleski prevod zasvaku igru je ponovo pregledan, i sređen, a sadržaj koji je predhodno isečen iz Yakuza 3, 4 i 5 su dodate u Yakuza Remastered kolekciju. Ovo izdanje sadrži Yakuzu 5 po prvi put dostupnu na našem tržištu u fizičkom izdanju.', 7499, 'Sega', 15, 'ps4-yakuza.jpg', 'Slika PS4 Yakuza Remastered Collection - Day One Edition | Gamer\'s shopping area', 6374.15, 'nova', '2020-02-11', 'pegi/18.png', 'Akcija - Avantura'),
('PS4222', 'PS4 Batman - Arkham Collection', 'ps4', 8, 'Batman: Arkham Collection predstavlja definitivnu verziju Rocksteady-jevog Arkhama Trilogy igara, uključujući dodatne DLC-jeve i sve te u jednom izdanju.\r\n\r\nBATMAN AKRHAM COLLECTION SADRŽI TRI IGRE U JEDNOM PAKOVANJU: \r\n Batman Akrham Asylum\r\n Batman Arkham City\r\n Batman Akrham Knight', 4999, 'WB Games', 0, 'ps4-batman-arkham-collection.jpg', 'PS4 Batman - Arkham Collection | Gamer\'s shopping area', 4999, 'nova', '2020-01-31', 'pegi/18.png', 'Akcija - Avantura'),
('PS72346', 'PS4 Terminator Resistance', 'ps4', 19, 'Zvanična Terminator FPS igra, smeštena za vreme ratova u budućnosti. Priča je smeštena u post-apokaliptični Los Anđeles, skoro 30 godina nakon Sudnjeg dana. Potpuno novi heroj otpora Jacob je na meti Skyneta i markiran za terminaciju. ', 6499, 'Teyon', 15, 'terminator-resistance-ps4.jpg', 'Slika PS4 Terminator Resistance | Gamer\'s shopping area', 5524.15, 'nova', '2019-11-15', 'pegi/16.png', 'FPS - First Person Shooter'),
('PS7991', 'PS4 The Last Of Us Remastered', 'ps4', 15, 'PS4 The Last Of Us Remastered je revidinarana verzija svetskog hita The Last of Us iz 2013. godine. Donosi nam novi DLC Left Behind, dodatna singleplayer avantura visoko ocenjena od strane kritika i fanova. ', 2700, 'Naughty Dog', 20, 'The-Last-of-Us-Remastered2.jpg', 'Slika - PS4 The Last Of Us Remastered | Gamer\'s shopping area', 2160, 'nova', '2014-07-30', 'pegi/18.png', 'Akcija - Avantura'),
('PS86681', 'PS4 Death Stranding', 'ps4', 4, 'Od legendarnog kreatora Hideo Kojime stiže nam potpuno novo PlayStation 4 iskustvo koje redefiniše žanr.\r\nSam Bridges mora vratiti hrabrost u svet potpuno preobražen fenomenom DEATH STRANDING, noseći u svojim rukama nasukane ostatke naše budućnosti. On kreće na put kako bi ponovo ujedinio razrušeni svet, korak po korak.\r\nSa spektralnim bićima koja su svuda oko njega i čovečanstvom na ivici masovnog izumiranja, na Samu je da prođe preko opustošenog kontinenta i spasi čovečanstvo od nadolazećeg uništenja.\r\nKoja misterija se krije iza Death Strandinga? Šta će Sam otkriti na putu koji je pred njim? Do sada neviđeno gameplay iskustvo otkriće nam ove tajne i još puno toga.\r\n\r\nU glavnim ulogama Norman Reedus, Mads Mikkelsen, Léa Seydoux i Lindsay Wagner', 7999, 'Kojima Productions', 50, 'death_stranding_ps4_cover_final.jpg', 'Slika PS4 Death Stranding | Gamer\'s shopping area', 3999.5, 'koriscena', '2019-11-08', 'pegi/18.png', 'Akcija - Avantura'),
('PS8844', 'PS4 Star Wars - Jedi Fallen Order', 'ps4', 20, 'Star Wars: Jedi Fallen Order je nova single player igra od Respawn Entertainment nam donosi priču o džedaju koji je preživeo Order 66 i odvija se nakon Ratova Zvezda Epizoda 3: Osveta Sitha. \r\n\r\nNova priča počinje - kao bivši Padawan u begu od Imperije, moraš završiti trening i krenuti sa oživljavanjem reda Džedaja pre nego što Imperijalni Inkvizitori saznaju za tvoj plan. Uz pomoć nekadašnjeg Džedaj Viteza, gadnog pilota i neustrašivog droida, moraš pobeći zloj mašineriji Imperije u Star Wars avanturi.\r\nGalaksija te očekuje - Istraži drevne šume, stenovite planete, džungle sa slobodom da odlučiš kada i gde ćeš da ideš. Otključavanjem novih moći i sposobnosti, otvaraju se nove mogućnosti za prelazak starih zona, koristeći snagu Sile za pronalazak novih puteva. Ali moraš se brzo kretati, Imperija te aktivno lovi, kako bi istrebila i poslednje ostatke Džedaja.\r\nStar Wars Jedi Fallen Order donosi fantaziju Džedaja kroz inovativni borbeni sistem - napad, blok i izbegavanje udruženi sa moćima Sile biće tvoj oslonac na teškom putu ispred tebe. Ovaj sistem je intuitivan i brzo se uči, ali da bi postao pravi Džedaj, trebaće trening i fokus.', 7999, 'EA', 20, 'star_wars_jedi_fallen_order_ps4.jpg', 'Slika PS4 Star Wars - Jedi Fallen Order | Gamer\'s shopping area', 6399.2, 'nova', '2019-11-15', 'pegi/16.png', 'Akcija - Avantura'),
('XB34561', 'XBOX ONE Hunt - Showdown', 'xbox1', 15, 'Udružite se sa još dva igrača kako biste prikupili tragove o lokaciji određenog boss-a. Tragovi su vidljivi kao plave kugle kada koristite poseban režim vida i pronalaženje ih postepeno smanjuje područje karte što pokazuje gde je boss. Prebijanje boss-a nije lak zadatak, ali to nije kraj meča, jer postoje i drugi timovi igrača koji pokušavaju da prikupe isti unos, a drugi put kada ubijete šefa, tačno znaju gde ste.', 4999, 'Crytek', 0, 'xbox1-hunt-showdown.jpg', 'Slika XBOX ONE Hunt - Showdown | Gamer\'s shopping area', 4999, 'nova', '2020-02-18', 'pegi/18.png', 'Horor'),
('XB43339', 'XBOX ONE DayZ', 'xbox1', 4, 'DayZ je zastrašujuća open world survival igra gde svaki igrač ima isti cilj, a to je da preživi što je duže moguće. Uskoči u centar apokalipse i bori se za svoj život zajedno sa čak 60 ljudi na serveru, gde će te inficirani zombiji proganjati. Oni su samo jedna od mnogo stvari koje su opasne po život u ovoj neverovatnoj igri. Bolesti, infekcije, gubitak krvi i drugi igrači će se postarati da ti ovaj dan bude poslednji. Da li ćeš preživljavati sam ili sa prijateljima? Donesi pravu odluku.', 4999, 'Bohemia Interactive', 0, 'xbox1-dayz.jpg', 'Slika XBOX ONE DayZ | Gamer\'s shopping area', 4999, 'nova', '2019-10-15', 'pegi/18.png', 'Akcija - Avantura'),
('XB74003', 'XBOX ONE Borderlands 3 Deluxe Edition', 'xbox1', 9, 'Luda i uzbudljiva vožnja vas očekuje u Borderlands 3, originalnom looter-shooteru u kojem vas očekuje puno loota, tačnije milijarde različitih oružija! Zaustavi Calypso bliznakinje u njihovom pohodu da ujedine banditske klanove i uzmu najveću moć u galaksiji. Samo ti, Vault Hunter, željan uzbuđenja, imaš arsenal i saveznike sa kojim ih možeš zaustaviti.\r\n\r\nTvoj Vault lovac, tvoja pravila, tvoj stil. Postani jedan od četiri Vault lovca, sa jedinstvenim sposobnostima, stilom igre, unapređenjima i tonom opcija za personalizaciju. Svaki Vault lovac je sposoban da napravi haos sam, ali zajedno su nezaustavljivi.\r\n\r\nNapuni, repetiraj i lutuj. Sa zilion oružija i gedžeta, svaka borba je šansa da dobiješ novu opremu. Pištolji sa metkovima koje ima sopstveni pogon i štit, tu su. Puške koje prave vulkano koji bljuje vatru? Naravno, tu je. Puške kojima rastu noge i jure protivnike dok ih nemilosrdno vređaju? Da ima i toga.\r\n\r\nIstraži nove svetove van Pandore, svaki svet sa jedinstvenim okruženjem da istražiš i protivnicima da ih uništiš. Razaraj kroz neprijateljsku pustinju, bori se kroz grad uništen ratom, plovi rečnim rukavcom i, pa uništavaj, pucaj, šta drugo, i naravno još mnogo različitih lokacija!\r\n\r\nIgraj sa bilo kim bilo kad, online ili dok delite ekran i kauč, bez obzira na tvoj nivo ili napredak u misijama. Sredite protivnike i izazove kao tim, ali skupljaj nagrade koje su samo tvoje, niko ne propušta svoj loot.\r\n\r\nDelux izdanje sadrži:\r\n\r\n Retro Cosmetic Pack\r\n Neon Cosmetic Pack\r\n Gearbox Cosmetic Pack\r\n Toy Box Weapon Pack\r\n XP & Loot Drop Boost Mods', 9499, '2K', 15, 'xbox1-borderland3-deluxe-edition.jpg', 'Slika XBOX ONE Borderlands 3 Deluxe Edition | Gamer\'s shopping area', 8074.15, 'nova', '2019-09-13', 'pegi/18.png', 'FPS - First Person Shooter'),
('XB77732', 'XBOX ONE Star Wars - Jedi Fallen Order', 'xbox1', 14, 'Star Wars: Jedi Fallen Order je nova single player igra od Respawn Entertainment nam donosi priču o džedaju koji je preživeo Order 66 i odvija se nakon Ratova Zvezda Epizoda 3: Osveta Sitha. \r\n\r\nNova priča počinje - kao bivši Padawan u begu od Imperije, moraš završiti trening i krenuti sa oživljavanjem reda Džedaja pre nego što Imperijalni Inkvizitori saznaju za tvoj plan. Uz pomoć nekadašnjeg Džedaj Viteza, gadnog pilota i neustrašivog droida, moraš pobeći zloj mašineriji Imperije u Star Wars avanturi.\r\nGalaksija te očekuje - Istraži drevne šume, stenovite planete, džungle sa slobodom da odlučiš kada i gde ćeš da ideš. Otključavanjem novih moći i sposobnosti, otvaraju se nove mogućnosti za prelazak starih zona, koristeći snagu Sile za pronalazak novih puteva. Ali moraš se brzo kretati, Imperija te aktivno lovi, kako bi istrebila i poslednje ostatke Džedaja.\r\nStar Wars Jedi Fallen Order donosi fantaziju Džedaja kroz inovativni borbeni sistem - napad, blok i izbegavanje udruženi sa moćima Sile biće tvoj oslonac na teškom putu ispred tebe. Ovaj sistem je intuitivan i brzo se uči, ali da bi postao pravi Džedaj, trebaće trening i fokus.', 8999, 'EA', 25, 'xbox1-starwars.jpg', 'Slika XBOX ONE Star Wars - Jedi Fallen Order | Gamer\'s shopping area', 6749.25, 'nova', '2019-11-15', 'pegi/16.png', 'Akcija - Avantura'),
('XB89322', 'XBOX ONE Crash Team Racing - Nitro Fueled - Nitros Oxide Edition', 'xbox1', 16, 'Stisnite gas do daske sa Crash Team Racing Nitro-Fueled. Autentično iskustvo zabavnog karting trkanja sada potpuno remasterovano i podignuto do maksimuma:\r\n- Pokrenite motore sa originalnim modovima igranja, karakterima, stazama, oružjima i kontrolama.\r\n- Proklizavajte do slave u novim kartinzima i stazama koje su dodate u odnosu na originalnu igru\r\n- Trkajte se online sa prijateljima i u Crash takmičenju sa online tabelama\r\nSa Crash Team Racing Nitro-Fueled ulozi su visoki a konkurencija nemilosrdna. To je CTR koji volite od ranije samo sada ubačen u najvišu brzinu.\r\n\r\nNitros Oxide izdanje sadrži:\r\n\r\n Nitros Oxide karakter\r\n Oxide\'s Hovercraft vozilo\r\n Nitros Oxide - Skin za karaktera\r\n Star Crash - Skin za karaktera\r\n Star Coco - Skin za karaktera\r\n Star Cortex - Skin za karaktera', 6499, 'ActiVision', 10, 'xbox1-crash-team-racing.jpg', 'Slika XBOX ONE Crash Team Racing - Nitro Fueled - Nitros Oxide Edition | Gamer\'s shopping area', 5849.1, 'nova', '2019-06-21', 'pegi/3.png', 'Vožnja');

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
-- Indexes for table `stavka_narudzbenice`
--
ALTER TABLE `stavka_narudzbenice`
  ADD PRIMARY KEY (`idNarudzbenice`,`idProizvoda`),
  ADD KEY `idProizvoda` (`idProizvoda`);

--
-- Indexes for table `video_igra`
--
ALTER TABLE `video_igra`
  ADD PRIMARY KEY (`idProizvoda`);

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
  ADD CONSTRAINT `stavka_narudzbenice_ibfk_2` FOREIGN KEY (`idProizvoda`) REFERENCES `video_igra` (`idProizvoda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
