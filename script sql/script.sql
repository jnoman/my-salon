/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de creation :  23/06/2020 22:09:20                      */
/*==============================================================*/

drop schema if exists mySalon;

create schema mySalon;

use mySalon;

drop table if exists Employe;

drop table if exists Resrvation;

drop table if exists Salon;

drop table if exists Service;

drop table if exists Users;

drop table if exists ligneReservation;

drop table if exists ville;

/*==============================================================*/
/* Table : Employe                                              */
/*==============================================================*/
create table ville
(
   id_ville              int not null auto_increment,
   nom_ville             varchar(50) not null,
   primary key (id_ville)
);

/*==============================================================*/
/* Table : Employe                                              */
/*==============================================================*/
create table Employe
(
   id_employe           int not null auto_increment,
   id_salon             int not null,
   primary key (id_employe)
);

/*==============================================================*/
/* Table : Resrvation                                           */
/*==============================================================*/
create table Resrvation
(
   id_reservation       int not null auto_increment,
   id_employe           int not null,
   idUser               int not null,
   date_debut           datetime not null,
   duree_reservation    time not null,
   etat_reservation     varchar(254) not null,
   prixT                numeric(8,0) not null,
   primary key (id_reservation)
);

/*==============================================================*/
/* Table : Salon                                                */
/*==============================================================*/
create table Salon
(
   id_salon             int not null auto_increment,
   idUser               int not null,
   nom_salon            varchar(254),
   telephone            varchar(254),
   ville                varchar(254),
   adresse              varchar(254),
   nombre_employes      int not null,
   date_fin             datetime not null,
   genre                varchar(254) not null,
   image                longblob,
   date_debut_travail   time default '09:00:00',
   date_fin_travail     time default '21:00:00',
   primary key (id_salon)
);

/*==============================================================*/
/* Table : Service                                              */
/*==============================================================*/
create table Service
(
   id_service           int not null auto_increment,
   nom_service          varchar(254) not null,
   id_salon             int not null,
   duree                time not null,
   prix                 numeric(8,0) not null,
   primary key (id_service)
);

/*==============================================================*/
/* Table : Users                                                */
/*==============================================================*/
create table Users
(
   idUser               int not null auto_increment,
   nom                  varchar(254) not null,
   prenom               varchar(254) not null,
   email                varchar(254) not null unique,
   password_user        varchar(254) not null,
   roles                varchar(254) not null,
   primary key (idUser)
);

/*==============================================================*/
/* Table : ligneReservation                                     */
/*==============================================================*/
create table ligneReservation
(
   id_ligne_reservation int not null auto_increment,
   id_reservation       int not null,
   id_service           int not null,
   primary key (id_ligne_reservation)
);

alter table Employe add constraint FK_Association_3 foreign key (id_salon)
      references Salon (id_salon) on delete restrict on update restrict;

alter table Resrvation add constraint FK_Association_4 foreign key (idUser)
      references Users (idUser) on delete restrict on update restrict;

alter table Resrvation add constraint FK_Association_5 foreign key (id_employe)
      references Employe (id_employe) on delete restrict on update restrict;

alter table Salon add constraint FK_Association_1 foreign key (idUser)
      references Users (idUser) on delete restrict on update restrict;

alter table Service add constraint FK_Association_2 foreign key (id_salon)
      references Salon (id_salon) on delete restrict on update restrict;
      
alter table ligneReservation add constraint FK_Reference_6 foreign key (id_reservation)
      references Resrvation (id_reservation) on delete restrict on update restrict;

alter table ligneReservation add constraint FK_Reference_7 foreign key (id_service)
      references Service (id_service) on delete restrict on update restrict;



insert into users(nom,prenom,email,password_user,roles) values('admin','admin','admin@gmail.com','Admin@123','admin');

insert into ville(nom_ville) values('Casablanca'),('Marrakech'),('Fès'),('Tanger'),('Salé'),('Meknès'),('Rabat'),('Oujda'),('Kénitra'),('Agadir'),('Tétouan'),('Témara'),('Safi'),('Mohammédia'),('Khouribga'),('El Jadida'),('Béni Mellal'),('Nador'),('Taza'),('Khémisset');

DROP TRIGGER IF EXISTS add_employe;
DELIMITER &&
Create Trigger add_employe 
after insert 
on Salon
For each ROW 
BEGIN 
	DECLARE i INT DEFAULT 1;
	WHILE i <= new.nombre_employes DO
    	insert into Employe(id_salon) values(new.id_salon);
        SET i = i + 1;
    END WHILE;
END&& 
DELIMITER ;