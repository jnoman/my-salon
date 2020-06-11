/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de creation :  08/06/2020 18:23:49                      */
/*==============================================================*/

drop schema if exists mySalon;

create schema mySalon;

use mySalon;

drop table if exists Users;

drop table if exists coiffeur;

drop table if exists employe;

drop table if exists resrvation;

drop table if exists service;

/*==============================================================*/
/* Table : Users                                                */
/*==============================================================*/
create table Users
(
   idUser               int not null auto_increment,
   nom                  varchar(254) not null,
   prenom               varchar(254) not null,
   email                varchar(254) not null,
   password_user        varchar(254) not null,
   role                 varchar(254) not null,
   primary key (idUser)
);

/*==============================================================*/
/* Table : coiffeur                                             */
/*==============================================================*/
create table coiffeur
(
   id_coiffeur          int not null auto_increment,
   idUser               int not null,
   telephone            varchar(254) not null,
   ville                varchar(254) not null,
   adresse              varchar(254) not null,
   nombre_employes      int not null,
   date_fin             datetime not null,
   primary key (id_coiffeur)
);

/*==============================================================*/
/* Table : employe                                              */
/*==============================================================*/
create table employe
(
   id_employe           int not null auto_increment,
   id_coiffeur          int not null,
   primary key (id_employe)
);

/*==============================================================*/
/* Table : resrvation                                           */
/*==============================================================*/
create table resrvation
(
   id_reservation       int not null auto_increment,
   idUser               int not null,
   id_employe           int not null,
   date_debut           datetime not null,
   duree_reservation    datetime not null,
   etat_reservation     varchar(254) not null,
   primary key (id_reservation)
);

/*==============================================================*/
/* Table : service                                              */
/*==============================================================*/
create table service
(
   id_service           int not null auto_increment,
   id_coiffeur          int,
   duree                datetime not null,
   prix                 numeric(8,0) not null,
   primary key (id_service)
);

alter table coiffeur add constraint FK_Association_1 foreign key (idUser)
      references Users (idUser) on delete restrict on update restrict;

alter table employe add constraint FK_Association_3 foreign key (id_coiffeur)
      references coiffeur (id_coiffeur) on delete restrict on update restrict;

alter table resrvation add constraint FK_Association_4 foreign key (idUser)
      references Users (idUser) on delete restrict on update restrict;

alter table resrvation add constraint FK_Association_5 foreign key (id_employe)
      references employe (id_employe) on delete restrict on update restrict;

alter table service add constraint FK_Association_2 foreign key (id_coiffeur)
      references coiffeur (id_coiffeur) on delete restrict on update restrict;

