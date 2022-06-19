use agoraAgricultureUrbaine;

alter table utilisateurs
add constraint foreign key(idDroit) references droits(idDroit);

alter table commentaires
add constraint foreign key(idRecette) references recettes(idRecette),
add constraint foreign key(idUtilisateur) references utilisateurs(idUtilisateur);

alter table recettes
add constraint foreign key (idUtilisateur) references utilisateurs(idUtilisateur);

alter table composer
add constraint foreign key(idIngrediant) references ingrediants(idIngrediant),
add constraint foreign key(idRecette) references recettes(idRecette);

alter table concerner
add constraint foreign key(idRecette) references recettes(idRecette),
add constraint foreign key(idSaison) references saisonsRecettes(idSaison);

alter table noter
add constraint foreign key(idUtilisateur) references recettes(idUtilisateur),
add constraint foreign key(idRecette) references recettes(idRecette);

alter table vegetaux
add constraint foreign key(idUtilisateur) references utilisateurs(idUtilisateur),
add constraint foreign key(idFamilleVegetal) references famillevegetaux(idFamilleVegetal);

alter table appartenir
add constraint foreign key(idTypeVegetal) references typeVegetaux(idTypeVegetal),
add constraint foreign key(idVegetal) references vegetaux(idVegetal) ON DELETE CASCADE;

alter table participer
add constraint foreign key(idEvenement) references evenements(idEvenement),
add constraint foreign key(idUtilisateur) references utilisateurs(idUtilisateur);

alter table evenements
add constraint foreign key(idUtilisateur) references utilisateurs(idUtilisateur),
add constraint foreign key(idLieu) references lieux(idLieu);

alter table trocs
add constraint foreign key(idUtilisateur) references utilisateurs(idUtilisateur);

alter table avoir
add constraint foreign key(idVegetalTroc) references vegetauxTroc(idVegetalTroc),
add constraint foreign key(idTroc) references trocs(idTroc);

alter table dependre
add constraint foreign key(idService) references services(idService),
add constraint foreign key(idTroc) references trocs(idTroc);
