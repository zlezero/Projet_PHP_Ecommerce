-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  Dim 21 juin 2020 à 17:39
-- Version du serveur :  8.0.18
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `php_ecommerce`
--
CREATE DATABASE IF NOT EXISTS `php_ecommerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `php_ecommerce`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idArticle` int(11) NOT NULL AUTO_INCREMENT,
  `nomArticle` varchar(255) NOT NULL,
  `descriptionArticle` text NOT NULL,
  `urlPhoto` text NOT NULL,
  `prix` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `nomArticle`, `descriptionArticle`, `urlPhoto`, `prix`, `quantite`, `idCategorie`) VALUES
(2, 'Winnie L\'ourson', 'Winnie l\'ourson est un personnage de la littérature d\'enfance créé le 15 octobre 1926 par Alan Alexander Milne. ', 'https://cdn.laredoute.com/products/641by641/b/2/a/b2a334ae585089828020ace85366c525.jpg', 10, 12, 1),
(3, 'Maya L\'abeille', 'Maya l\'abeille est à l\'origine un livre pour la jeunesse publié par l\'écrivain allemand Waldemar Bonsels en 1912.', 'https://i.pinimg.com/originals/c9/9c/96/c99c96823e4a98156587916e43359c80.png', 12, 1, 1),
(4, 'Porcinet', 'Porcinet est un personnage de fiction, créé par l\'auteur Alan Alexander Milne, appartenant à l\'univers de Winnie l\'ourson.', 'https://vignette.wikia.nocookie.net/disneyfanon/images/b/be/Free_walt_disney_piglet_wallpaper_1.png/revision/latest/scale-to-width-down/340?cb=20160222164428', 3, 2, 1),
(5, 'Pikachu', 'Pikachu est une espèce de Pokémon, une créature de fiction issue de la franchise médiatique Pokémon de Nintendo.', 'https://i.pinimg.com/originals/f5/1d/08/f51d08be05919290355ac004cdd5c2d6.png', 12, 20, 1),
(6, 'Mickey Mouse', 'Mickey Mouse est un personnage de fiction nord-américain appartenant à l\'univers Disney, apparaissant principalement dans des dessins animés, dans des bandes dessinées et des jeux vidéo.', 'https://kidscreen.com/wp/wp-content/uploads/2018/03/Mickey_Mous.jpg', 6, 4, 1),
(8, 'Jerry', 'Jerry la souris est un personnage fictif appartenant à la série d\'animation américaine Tom et Jerry, et l\'un des deux principaux protagonistes de la série, le deuxième étant Tom le chat.', 'https://www.lesdentsdelait.com/wp-content/uploads/2020/04/jerry-768x507.jpg', 3, 2, 1),
(9, 'Tom', 'Tom le chat est un personnage fictif appartenant à la série d\'animation américaine Tom et Jerry, et l\'un des deux principaux protagonistes de la série, le deuxième étant Jerry.', 'https://i.ya-webdesign.com/images/jerry-drawing-baby-2.png', 5, 9, 1),
(10, 'Titi', 'Titi est un personnage des Looney Tunes. Créé par Bob Clampett et Friz Freleng en 1942, ce petit canari jaune est la proie préférée de Sylvestre le chat dit « Grosminet ».', 'https://api.arretsurimages.net/api/public/media/nouveau-media-35014/action/show?format=public&t=2017-11-15T16:42:22+01:00', 3, 4, 1),
(11, 'Bugs Bunny', 'Bugs Bunny est un personnage américain de dessin animé, créé officiellement en 1940 dans les studios de la société Leon Schlesinger Productions. ', 'https://www.muralsticker.com/23777-thickbox/vinyle-pour-enfants-bugs-bunny.jpg', 7, 9, 1),
(15, 'Pluto', 'Pluto est un personnage de fiction de l\'univers de Mickey Mouse créé par la Walt Disney Company en 1930. ', 'https://vignette.wikia.nocookie.net/lemondededisney/images/9/90/Pluto2.jpg/revision/latest?cb=20151221203109&path-prefix=fr', 1, 0, 1),
(16, 'Dingo', 'Dingo est un personnage de fiction de l\'univers de Mickey Mouse créé par la Walt Disney Company en 1932. Ce chien anthropomorphe est l\'un des meilleurs amis de Mickey. ', 'https://www2.mes-coloriages-preferes.biz/colorino/Images/Large/Personnages-celebres-Walt-Disney-Mickey-Mouse-Dingo-684095.png', 10, 0, 1),
(17, 'Sylvestre', 'Sylvestre le chat, dit Grosminet, est un personnage américain de dessin animé créé en 1945. C\'est l\'ennemi du canari Titi. Grosminet est un chat noir et blanc avec un patron « tuxedo ». Il est aussi doté d\'une grosse « truffe » rouge.', 'https://coloriagesaimprimer.com/image/dessins-animes/coloriage-titi-et-grosminet-169.png', 2, 2, 1),
(21, 'Alvin', 'Alvin et les Chipmunks est un groupe de musique fictif, créé aux États-Unis en 1958. Il est composé de trois tamias, Alvin, Simon et Théodore, aidés de leur père adoptif Dave Seville.', 'https://i.pinimg.com/originals/3d/e9/da/3de9daead1949e515293c5fc4375352c.jpg', 8, 2, 1),
(22, 'Taz ', 'Taz ou le Diable de Tasmanie est un personnage de dessin animé figurant dans les séries de dessins animés de Warner Bros. ', 'https://poptuning.fr/11397-large_default/dessin-adhesif-sticker-cartoon-taz-13.jpg', 5, 2, 1),
(23, 'Daffy Duck', 'Daffy Duck est un personnage d\'animation américain appartenant à la grande famille de Warner Bros.', 'https://i.pinimg.com/originals/dd/06/82/dd0682c2832fc584d475b37944b7b7d5.png', 2, 2, 1),
(24, 'The Last Of Us 2', 'Cinq ans plus tard... Une aventure intense, éprouvante et émouvante vous attend. Retrouvez Ellie et Joel dans la suite du jeu Naughty Dog salué par la critique.', 'https://images-na.ssl-images-amazon.com/images/I/51E%2BeFMX-jL._AC_.jpg', 64, 5, 2),
(25, 'Just Dance 2020', 'Entre amis ou en famille, déchaînez-vous sur le dancefloor avec Just Dance 2020 ! La plus grande franchise de jeu vidéo musical de tous les temps*, avec plus de 67 millions d’exemplaires vendus**, revient cet automne. Just Dance fait peau neuve et célèbre les 10 ans de convivialité de la franchise avec 40 nouvelles chansons, des univers éblouissants et des surprises exclusives !', 'https://ubistatic19-a.akamaihd.net/ubicomstatic/fr-fr/global/buy-now/jd20_website_packshot_560x698_mobile-2_350421.jpg', 52, 4, 2),
(26, 'Mario Kart 8', 'Appuyez sur le champignon et affûtez vos carapaces, Mario Kart 8 Deluxe va tout retourner sur\r\n\r\nNintendo Switch ! Foncez à fond les ballons la tête à l\'envers avec les pneus anti-gravité ! Irez-vous plus vite en passant par le plafond ? Ou allez-vous tracer au sol entre les bananes et les batailles de carapace ? Tous les coups les plus fourbes sont permis pour se hisser à la première place !', 'https://static.fnac-static.com/multimedia/Images/FR/NR/00/4a/82/8538624/1505-1/tsp20170113080050/Mario-Kart-8-Deluxe-Nintendo-Switch.jpg', 50, 8, 2),
(27, 'FIFA 2020', 'Doté du moteur Frostbite™, EA SPORTS™ FIFA 20 sur PlayStation®4, Xbox One et PC vous propose deux facettes du Jeu Universel : le prestige du football professionnel et une nouvelle expérience réaliste de street football avec EA SPORTS VOLTA. FIFA 20 innove sur tous les plans : le FOOTBALL INTELLIGENT vous offre un réalisme sans précédent, FIFA Ultimate Team™ vous propose de nouvelles façons de créer votre équipe de rêve et EA SPORTS VOLTA vous plonge dans le monde du street avec des terrains réduits.', 'https://e-leclerc.scene7.com/is/image/gtinternet/Titelive_5030945123477_G_5030945123477?op_sharpen=1&resmode=bilin&wid=600&hei=600', 20, 30, 2),
(28, 'Call of Duty Modern Warfare PS4', 'Préparez-vous pour le retour de Modern Warfare® !\r\nDans un tout nouvel opus aux enjeux plus élevés que jamais, les joueurs incarneront des agents d’élite des forces spéciales pris dans l’engrenage haletant d’un conflit à l’échelle globale qui menace l\'équilibre du pouvoir. Call of Duty®: Modern Warfare® entrainera les joueurs dans une expérience à l\'intensité sans pareille, brute, sombre et provocatrice ; mettant en avant la nature changeante de la guerre contemporaine. Développé par le studio Infinity Ward à l’origine de la série, Call of Duty: Modern Warfare propose une expérience épique, réimaginée de fond en comble.', 'https://static.fnac-static.com/multimedia/Images/FR/NR/24/7a/aa/11172388/1520-1/tsp20190531105129/Call-of-Duty-Modern-Warfare-PS4.jpg', 64, 3, 2),
(29, 'Coffret Barbie Voyage', 'Les enfants peuvent découvrir de nouveaux horizons avec Barbie ! Le coffret Voyage inspiré de Barbie Dreamhouse Adventures inclut un chien, une valise et plus de 10 accessoires !  La valise rose de Barbie est équipée d\'une poignée rétractable ; elle s\'ouvre et se ferme pour que les enfants puissent s\'amuser à la remplir et à la vider. Ils peuvent même la décorer avec la feuille d’autocollants fournie (incluant des smileys et un passeport violet). ', 'https://www.maxitoys.fr/media/catalog/product/cache/2ac0aa552501c65c166fc916d5ef14d5/1/5/15207445-15207445-mt_picture2-0887961683820_fwv25_6.jpg', 15, 12, 3),
(30, 'Playset Barbie Supermarché', 'Votre enfant emmène sa poupée Barbie faire un tour à l\'épicerie grâce à ce coffret Supermarché qui dispose de tous les ingrédients pour s\'amuser : Inclut une poupée Barbie, un comptoir-caisse et son tapis roulant, un présentoir, un caddie roulant, des accessoires produits à ranger sur les étagères. Déposez vos achats sur le tapis roulant du comptoir-caisse et faites glisser le levier pour les déplacer jusqu\'à les faire tomber dans le sac de course suspendu au crochet à l\'autre bout. Barbie fait ses courses : trois côtés ont des étagères pour les aliments, il y a un panier pour les produits et une balance qui bouge pour alimenter le jeu de rôle. ', 'https://static.fnac-static.com/multimedia/Images/FR/MDM/a8/6d/7e/8285608/1540-1/tsp20200619091605/Playset-Barbie-Supermarche.jpg', 24, 27, 3),
(31, 'Monopoly', 'Achetez, vendez et négociez pour gagner la partie. Attention à la faillite, à vous de bien choisir les rues pour ruiner vos adversaires et être le dernier sur le plateau de jeu ! Monopoly, le plus célèbre des jeux de société, a changé certains de ses pions. Retrouvez les trois petits nouveaux qui vont arpenter vos rues: le T-rex, le canard et le pingouin. ', 'https://images-na.ssl-images-amazon.com/images/I/915OVR%2BujIL._AC_SX679_.jpg', 14, 18, 4),
(32, 'Uno', 'Le jeu de cartes si populaire qui consiste à associer des couleurs ou chiffres, comprend désormais des cartes Joker personnalisables! Les joueurs se débarrassent de leurs cartes en recouvrant la carte en haut de la pile par 1 carte correspondante de leur main. Des cartes Action vous aident à battre vos adversaires.', 'https://media.picwictoys.com/images/products/420166/420166_3.png', 9, 13, 4),
(33, 'Loup-Garou', 'Comment, vous ne connaissez pas Thiercelieux ? Un si joli petit village de l\'est, bien à l\'abri des vents et du froid, niché entre de charmantes forêts et de bons pâturages.\r\nLes habitants de Thiercelieux sont d\'affables paysans, heureux de leur tranquillité et fiers de leur travail. Autour d\'eux, on trouve des personnages aussi divers qu\'une voyante, une sorcière, un voleur, le capitaine (qui radote sans cesse), Cupidon (qui noue les coeurs et les idylles), et même une petite fille aux couettes charmantes.\r\nPourtant, la nuit, le paisible village est envahi par les loups-garous qui attrapent et dévorent un à un les paysans. Si personne ne réagit, c\'est tout le village qui est menacé!', 'https://p9.storage.canalblog.com/98/39/1355275/103540675.jpg', 8, 12, 4),
(34, 'Burger Quiz', 'Jouez à toutes les épreuves du jeu le plus marrant et inventif de la TV ! Dans cette nouvelle version, la gagne, la pop culture, la mauvaise foi, les imitations, la musique et les vannes cohabitent dans le plus joyeux des chaos.', 'https://cdn1.philibertnet.com/415063/burger-quiz.jpg', 26, 9, 4),
(35, 'Scrabble', 'Plateau, 102 lettres, 1 sac de rangement et 4 chevalets. Avec Scrabble chacun a son mot à dire ! 2 à 4 joueurs, à partir de 10 ans. 10 ans et +', 'https://media.picwictoys.com/images/products/1683727/1683727_1.png', 8, 12, 5),
(36, 'Robot éducatif Powerman Lexibook', 'POWERGIRL, mon robot interactif pour apprendre et jouer ! POWERGIRL se contrôle dans toutes directions grâce à sa télécommande ! Du fun à l\'infini ! Choisis ta cible, vise et POWERGIRL va tirer des disques en mousse ! POWERGIRL adore danser et jouer de la musique ! Le plein de contenus éducatifs : Des quizz éducatifs de culture générale. Des problèmes de mathématique et de logique. ', 'https://www.micromania.fr/dw/image/v2/BCRB_PRD/on/demandware.static/-/Sites-masterCatalog_Micromania/default/dw5f438c5b/images/high-res/visuels%20produits%20news/100781_10.jpg?sw=480&sh=480&sm=fit', 30, 10, 5),
(37, 'Skateboard', 'Les plus jeunes vont pouvoir débuter avec le skateboard Cruise et découvrir les sensations de glisse urbaine. Il est conçu pour l\'apprentissage du skateboard et est idéal afin de travailler son équilibre. Faites de la rue votre terrain de jeu et mettez à profit tous les obstacles que vous rencontrerez afin d\'imiter les plus grands skateurs.', 'https://www.cdiscount.com/pdt2/2/2/5/1/300x300/egs0789458347225/rw/egsii-80cm-skateboard-adulte-longboard-planche-a-r.jpg', 12, 23, 6),
(38, 'Trottinette', 'La trottinette électrique Micro Merlin a été conçue pour les personnes qui souhaitent privilégier le confort et effectuer de longues distances. Avec une autonomie de 25 km*, la trottinette Micro Merlin sera plébiscitée par les citadins qui pratiquent de longs trajets quotidiennement.', 'https://www.micro-mobility.fr/6840-large_default/trottinette-electrique-micro-merlin.jpg', 199, 8, 6),
(39, 'Toboggan', 'Le toboggan GM sera parfait pour les premières glisses de vos enfants !\r\nAvec sa hauteur de 1m, ses marches antidérapantes et ses poignées ergonomiques, il est particulièrement adapté aux enfants de 2 ans et plus.\r\nEn cas de grosse chaleur il vous suffira de raccorder un tuyau d\'arrosage sous la glisse pour créer une cascade d\'eau et rafraîchir vos petits !\r\nVous n\'aurez aucun mal à le ranger car il est facilement démontable.', 'https://static.fnac-static.com/multimedia/Images/FR/MDM/81/fb/3c/3996545/1540-1/tsp20191220150541/Toboggan-Smoby-Grand-modele-Bleu-et-Vert.jpg', 30, 4, 6),
(40, 'Nerf Fortnite TS et Fléchettes Nerf Officielles', 'Transpose tes combats de Fortnite dans la vraie vie avec ce blaster Nerf Mega disposant d’un mécanisme à pompe ! Le blaster Nerf Fortnite TS est inspiré du blaster utilisé dans le jeu vidéo populaire Fortnite, reproduisant l’apparence et les couleurs de l’arme dans le jeu. ', 'https://static.fnac-static.com/multimedia/Images/FR/MDM/c4/6e/b5/11890372/1540-1/tsp20200516031057/Nerf-Fortnite-HC-E-et-Flechettes-Nerf-Mega-Officielles.jpg', 10, 10, 6),
(41, 'Playmobil SuperSet Unité de plongée sous-marine', 'Les bouées flottent pour y suspendre le coffre au trésor dans l’eau. Avec cachette secrète pour le trésor.', 'https://www.cdiscount.com/pdt2/1/1/7/1/550x550/pla4008789700117/rw/playmobil-70011-city-action-superset-unite-de.jpg', 24.29, 5, 7),
(42, 'Lego Harry Potter', 'Tous à bord du Magicobus™ LEGO® avec Harry Potter™, pour une folle épopée pleine de magie ! Ce formidable ensemble de jeu permet de recréer des scènes de Harry Potter et le Prisonnier d\'Azkaban™.', 'https://cdn.laredoute.com/products/641by641/3/9/d/39d569165bd78d20c36e8eeea8e451ee.jpg', 23, 4, 7),
(43, 'Kit créatif Vertical Activity Set 2 Tubes IDO3D', 'Contient 2 tubes avec torche intégrée pour faire sécher, un dépliant avec des exemples à suivre pour t\'aider ; Jusqu\'à 10 modèles uniques à réaliser.', 'https://static.fnac-static.com/multimedia/Images/FR/NR/d0/87/7c/8161232/1520-1/tsp20161117172901/Kit-creatif-Vertical-Activity-Set-2-Tubes-IDO3D.jpg', 8, 5, 8),
(44, 'Kit créatif So Slime Ice Cream Shop', 'Crée ta slime parfumée en mélangeant ta poudre à de l\'eau.', 'https://static.fnac-static.com/multimedia/Images/27/27/8A/B1/11635239-3-1520-2/tsp20200312131549/Kit-creatif-So-Slime-Ice-Cream-Shop-Slimelicious.jpg', 4.99, 5, 8),
(45, 'Minecraft', 'Minecraft est un jeu vidéo de type « bac à sable » (construction complètement libre) développé par le Suédois Markus Persson, alias Notch, puis par la société Mojang Studios. Il s\'agit d\'un univers composé de voxels et généré aléatoirement, qui intègre un système d\'artisanat axé sur l\'exploitation puis la transformation de ressources naturelles (minéralogiques, fossiles, animales et végétales).', 'https://www.minecraft.net/content/dam/games/minecraft/key-art/Games_Subnav_Minecraft-300x465.jpg', 34, 28, 2),
(46, 'GTA', 'Lorsqu\'un jeune arnaqueur, un braqueur de banque à la retraite et un terrifiant psychopathe se retrouvent piégés par de grands criminels, le gouvernement américain et l\'industrie du divertissement, ils décident de se lancer dans une série de braquages pour survivre dans une ville sans pitié où ils ne peuvent se fier à personne, même entre eux.', 'https://www.gameclub.fr/dynaimg/src/game371src.jpg', 27, 18, 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(255) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Peluches & Doudous'),
(2, 'Jeux vidéos'),
(3, 'Barbies'),
(4, 'Jeux de société'),
(5, 'Jeux éducatifs'),
(6, 'Jeux de plein air'),
(7, 'Jeux de construction'),
(8, 'Loisirs créatifs');

-- --------------------------------------------------------

--
-- Structure de la table `cb`
--

DROP TABLE IF EXISTS `cb`;
CREATE TABLE IF NOT EXISTS `cb` (
  `idCB` int(11) NOT NULL AUTO_INCREMENT,
  `numCB` varchar(16) NOT NULL,
  `dateExpirationCB` date NOT NULL,
  `cryptoCB` int(3) NOT NULL,
  `nomCompletCB` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idCB`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cb`
--

INSERT INTO `cb` (`idCB`, `numCB`, `dateExpirationCB`, `cryptoCB`, `nomCompletCB`) VALUES
(1, '123456789115115', '2020-06-25', 121, 'Sebastien Zonchello');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) DEFAULT NULL,
  `idStatutCommande` int(11) NOT NULL,
  `dateCommande` date DEFAULT NULL,
  `cookieUtilisateur` text NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `idUtilisateur` (`idUtilisateur`),
  KEY `idStatutCommande` (`idStatutCommande`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `idUtilisateur`, `idStatutCommande`, `dateCommande`, `cookieUtilisateur`) VALUES
(14, NULL, 1, '2020-06-21', '46fc650939f37f33980503ebf60d50fd2d8adbc20b617ff7b4e5149c4ad22bed79fb5a2cdb9b3a4d968a55f17694507f2665a8aa2b65323b52621167a44f13f4'),
(15, NULL, 1, '2020-06-21', '81c259b6daa3d690dae749623e9b07058ceaf7abb7747dedd7936a82629c7841867588a99d89d73206c1e3981b399887c4d131a1a0dd0e0a415f6337930f4922');

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `defaultOrder` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `config`
--

INSERT INTO `config` (`defaultOrder`) VALUES
('prixDecroissant');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `idCommande` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  KEY `idArticle` (`idArticle`),
  KEY `idCommande` (`idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`idCommande`, `idArticle`, `quantite`) VALUES
(13, 2, 1),
(14, 2, 1),
(14, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int(11) NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(255) NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idRole`, `nomRole`) VALUES
(1, 'Administrateur'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `statutcommande`
--

DROP TABLE IF EXISTS `statutcommande`;
CREATE TABLE IF NOT EXISTS `statutcommande` (
  `idStatutCommande` int(11) NOT NULL AUTO_INCREMENT,
  `nomStatutCommande` varchar(255) NOT NULL,
  PRIMARY KEY (`idStatutCommande`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `statutcommande`
--

INSERT INTO `statutcommande` (`idStatutCommande`, `nomStatutCommande`) VALUES
(1, 'En cours'),
(2, 'Validé'),
(3, 'Payé');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `idRole` int(11) NOT NULL,
  `idCB` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`),
  KEY `idRole` (`idRole`),
  KEY `idCB` (`idCB`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `email`, `mdp`, `idRole`, `idCB`) VALUES
(13, 'Doe', 'John', 'user@gmail.com', '$2y$10$WO9NGkkIjaBHZW1s4lYk/uRLM/uzBcCOai0Wq4h9/2Iz5fy.vH0Ne', 2, NULL),
(14, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$bAPVN2eQW9ZQn0EjidBddeO2nB10lFc.o0VTbN6a5rBtrxyOoDlD6', 1, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`idStatutCommande`) REFERENCES `statutcommande` (`idStatutCommande`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`idCB`) REFERENCES `cb` (`idCB`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
