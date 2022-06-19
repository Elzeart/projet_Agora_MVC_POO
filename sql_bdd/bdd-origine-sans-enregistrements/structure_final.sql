drop database agoraAgricultureUrbaine;

create database agoraAgricultureUrbaine;

use agoraAgricultureUrbaine;

create table utilisateurs(
	idUtilisateur int primary key auto_increment not null,
    nomUtilisateur varchar(50) not null,
    prenomUtilisateur varchar(50) not null,
    pseudoUtilisateur varchar(50) not null,
    mailUtilisateur varchar(100) not null,
    mdpUtilisateur varchar(100) not null,
    imageUtilisateur varchar(100),
    activationCode tinyint not null,
    clef int,
    idDroit int
);

create table droits(
	idDroit int primary key auto_increment not null,
    typeDroits varchar(50) not null
);

create table realisations(
	idRealisation int primary key auto_increment not null,
    nomRealisation varchar(50) not null,
    infosRealisation text not null,
    imageRealisation varchar(50),
    idUtilisateur int
);

create table commentaires(
	idCommentaire int primary key auto_increment not null,
    titreCommentaire varchar(100) not null,
    contenuCommentaire text not null,
    dateCommentaire date not null,
	idRecette int,
    idUtilisateur int
);

create table recettes(
	idRecette int primary key auto_increment not null,
    nomRecette varchar(50) not null,
    contenuRecette text not null,
    idUtilisateur int
);

create table noter(
	idUtilisateur int null,
    idRecette int null,
    note tinyint null,
    primary key(idUtilisateur, idRecette)
);

create table composer(
	idIngrediant int null,
    idRecette int null,
    primary key(idIngrediant, idRecette)
);

create table ingrediants(
	idIngrediant int primary key auto_increment not null,
    nomIngrediant varchar(50) not null
);

create table concerner(
	idRecette int null,
    idSaison int null,
    primary key(idRecette, idSaison)
);

create table saisonsRecettes(
	idSaison int primary key auto_increment not null,
    nomSaison varchar(50) not null
);
    
create table vegetaux(
	idVegetal int primary key auto_increment not null,
    nomVegetal varchar(50) not null,
    infosVegetal text not null,
    imageVegetal varchar(50) not null,
    plantationVegetal text not null,
	idUtilisateur int,
	idFamilleVegetal int
);

create table familleVegetaux(
	idFamilleVegetal int primary key auto_increment not null,
    nomFamilleVegetal varchar(50) not null
);

create table appartenir(
	idTypeVegetal int null,
    idVegetal int null,
    primary key(idTypeVegetal, idVegetal)
);

create table typeVegetaux(
	idTypeVegetal int primary key auto_increment not null,
    nomTypeVegetal varchar(50) not null
);

create table evenements(
	idEvenement int primary key auto_increment not null,
    nomEvenement varchar(50) not null,
    dateEvenement date not null,
    contenuEvenement text not null,
    idUtilisateur int,
    idLieu int
);

create table participer(
	idEvenement int null,
    idUtilisateur int null,
    primary key(idEvenement, idUtilisateur)
);

create table lieux(
	idLieu int primary key auto_increment not null,
    nomLieu varchar(50) not null
);

create table trocs(
	idTroc int primary key auto_increment not null,
    nomTroc varchar(50) not null,
    infoTroc text not null,
    idUtilisateur int
);

create table avoir(
	idVegetalTroc int null,
    idTroc int null,
    quantite float null,
    primary key(idVegetalTroc, idTroc)
);

create table vegetauxTroc(
	idVegetalTroc int primary key auto_increment not null,
    nomVegetalTroc varchar(50) not null,
    infosVegetalTroc text not null,
    imageVegetalTroc varchar(50) not null,
    quantiteGlobaleVegetalTroc float not null
);

create table services(
	idService int primary key auto_increment not null,
    nomService varchar(50) not null
);

create table dependre(
	idService int null,
    idTroc int null,
    primary key(idService, idTroc)
);







