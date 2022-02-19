drop database agoraAgricultureUrbaine3;

create database agoraAgricultureUrbaine3;

use agoraAgricultureUrbaine3;

create table droits(
	idDroit int primary key auto_increment not null,
    typeDroits varchar(50) not null
);

create table utilisateurs(
	idUtilisateur int primary key auto_increment not null,
    nomUtilisateur varchar(50) not null,
    prenomUtilisateur varchar(50) not null,
    pseudoUtilisateur varchar(50) not null,
    mailUtilisateur varchar(100) not null,
    mdpUtilisateur varchar(100) not null,
    activationCode tinyint not null,
    clef int,
    idDroit int
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

create table composer(
	idIngrediant int,
    idRecette int,
    primary key(idIngrediant, idRecette)
);

create table ingrediants(
	idIngrediant int primary key auto_increment not null,
    nomIngrediant varchar(50) not null
);

create table concerner(
	idRecette int,
    idSaison int,
    primary key(idRecette, idSaison)
);

create table saisonsRecettes(
	idSaison int primary key auto_increment not null,
    nomSaison varchar(50) not null
);

create table decerner(
	idNotation int,
    idUtilisateur int,
    primary key(idNotation, idUtilisateur)
    );
    
create table notations(
	idNotation int primary key auto_increment not null,
    noteNotation tinyint not null,
    idRecette int
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

create table vegetauxTroc(
	idVegetalTroc int primary key auto_increment not null,
    nomVegetalTroc varchar(50) not null,
    infosVegetalTroc text not null,
    imageVegetalTroc varchar(50) not null,
    quantiteGlobaleVegetalTroc float not null
);

create table familleVegetaux(
	idFamilleVegetal int primary key auto_increment not null,
    nomFamilleVegetal varchar(50) not null
);

create table appartenir(
	idTypeVegetal int,
    idVegetal int,
    primary key(idTypeVegetal, idVegetal)
);

create table typeVegetaux(
	idTypeVegetal int primary key auto_increment not null,
    nomTypeVegetal varchar(50) not null
);

create table trocs(
	idTroc int primary key auto_increment not null,
    nomTroc varchar(50) not null,
    infoTroc text not null,
    idUtilisateur_propose int,
    idService int,
    idUtilisateur_accept int
);

create table avoir(
	idVegetalTroc int,
    idTroc int,
    quantite float not null,
    primary key(idVegetalTroc, idTroc)
);

create table services(
	idService int primary key auto_increment not null,
    nomService varchar(50) not null
);

create table participer(
	idEvenement int,
    idUtilisateur int,
    primary key(idEvenement, idUtilisateur)
);

create table evenements(
	idEvenement int primary key auto_increment not null,
    nomEvenement varchar(50) not null,
    dateEvenement date not null,
    contenuEvenement text not null,
    idUtilisateur int,
    idLieu int
);

create table lieux(
	idLieu int primary key auto_increment not null,
    nomLieu varchar(50) not null
);







