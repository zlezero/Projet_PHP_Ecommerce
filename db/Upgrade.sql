ALTER TABLE `utilisateur` ADD UNIQUE( `email`);
ALTER TABLE `commande` CHANGE `idUtilisateur` `idUtilisateur` INT(11) NULL;
