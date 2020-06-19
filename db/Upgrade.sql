ALTER TABLE `utilisateur` ADD UNIQUE( `email`);
ALTER TABLE `commande` CHANGE `idUtilisateur` `idUtilisateur` INT(11) NULL;
ALTER TABLE `commande` ADD `dateCommande` DATE NULL AFTER `idStatutCommande`;
