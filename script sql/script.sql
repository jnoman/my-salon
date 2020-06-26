/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de creation :  23/06/2020 22:09:20                      */
/*==============================================================*/

drop schema if exists mySalon;

create schema mySalon;

drop table if exists Employe;

drop table if exists Resrvation;

drop table if exists Salon;

drop table if exists Service;

drop table if exists Users;

/*==============================================================*/
/* Table : Employe                                              */
/*==============================================================*/
create table Employe
(
   id_employe           int not null,
   id_salon             int not null,
   primary key (id_employe)
);

/*==============================================================*/
/* Table : Resrvation                                           */
/*==============================================================*/
create table Resrvation
(
   id_reservation       int not null,
   id_employe           int not null,
   idUser               int not null,
   date_debut           datetime not null,
   duree_reservation    datetime not null,
   etat_reservation     varchar(254) not null,
   primary key (id_reservation)
);

/*==============================================================*/
/* Table : Salon                                                */
/*==============================================================*/
create table Salon
(
   id_salon             int not null,
   idUser               int,
   nom_salon            varchar(254),
   telephone            varchar(254),
   ville                varchar(254),
   adresse              varchar(254),
   nombre_employes      int,
   date_fin             datetime,
   genre                varchar(254),
   image                varchar(254),
   date_debut_travail   datetime,
   date_fin_travail     datetime,
   primary key (id_salon)
);

/*==============================================================*/
/* Table : Service                                              */
/*==============================================================*/
create table Service
(
   id_service           int not null,
   id_salon             int not null,
   duree                datetime not null,
   prix                 numeric(8,0) not null,
   primary key (id_service)
);

/*==============================================================*/
/* Table : Users                                                */
/*==============================================================*/
create table Users
(
   idUser               int not null,
   nom                  varchar(254) not null,
   prenom               varchar(254) not null,
   email                varchar(254) not null,
   password_user        varchar(254) not null,
   roles                varchar(254) not null,
   primary key (idUser)
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


insert into users(nom,prenom,email,password_user,roles) values('admin','admin','admin@gmail.com','Admin@123','admin');