/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     4/9/2025 1:07:04 PM                          */
/*==============================================================*/


alter table ARTIFACTS 
   drop foreign key FK_ARTIFACT_HAS_EXHIBITI;

alter table Academy 
   drop foreign key FK_ACADEMY_TYPE_EVENTS;

alter table Account 
   drop foreign key FK_ACCOUNT_HAS_USER;

alter table ContactForms 
   drop foreign key FK_CONTACTF_CONTACT_ACCOUNT;

alter table EXHIBITIONS 
   drop foreign key FK_EXHIBITI_TYPE_EVENTS;

alter table Guides 
   drop foreign key FK_GUIDES_HIRE_TICKET;

alter table Guides 
   drop foreign key FK_GUIDES_ROLE_ACCOUNT;

alter table Reviews 
   drop foreign key FK_REVIEWS_REVIEW_EVENTS;

alter table Reviews 
   drop foreign key FK_REVIEWS_WRITE_ACCOUNT;

alter table Ticket 
   drop foreign key FK_TICKET_BUY_ACCOUNT;

alter table Ticket 
   drop foreign key FK_TICKET_HIRE_GUIDES;

alter table User 
   drop foreign key FK_USER_HAS_ACCOUNT;


alter table ARTIFACTS 
   drop foreign key FK_ARTIFACT_HAS_EXHIBITI;

drop table if exists ARTIFACTS;


alter table Academy 
   drop foreign key FK_ACADEMY_TYPE_EVENTS;

drop table if exists Academy;


alter table Account 
   drop foreign key FK_ACCOUNT_HAS_USER;

drop table if exists Account;


alter table ContactForms 
   drop foreign key FK_CONTACTF_CONTACT_ACCOUNT;

drop table if exists ContactForms;

drop table if exists EVENTS;


alter table EXHIBITIONS 
   drop foreign key FK_EXHIBITI_TYPE_EVENTS;

drop table if exists EXHIBITIONS;


alter table Guides 
   drop foreign key FK_GUIDES_HIRE_TICKET;

alter table Guides 
   drop foreign key FK_GUIDES_ROLE_ACCOUNT;

drop table if exists Guides;

drop table if exists Navbar;


alter table Reviews 
   drop foreign key FK_REVIEWS_WRITE_ACCOUNT;

alter table Reviews 
   drop foreign key FK_REVIEWS_REVIEW_EVENTS;

drop table if exists Reviews;


alter table Ticket 
   drop foreign key FK_TICKET_BUY_ACCOUNT;

alter table Ticket 
   drop foreign key FK_TICKET_HIRE_GUIDES;

drop table if exists Ticket;


alter table User 
   drop foreign key FK_USER_HAS_ACCOUNT;

drop table if exists User;

/*==============================================================*/
/* Table: ARTIFACTS                                             */
/*==============================================================*/
create table ARTIFACTS
(
   Id                   char(10) not null  comment '',
   ExhId                char(10) not null  comment '',
   Title                national varchar(100)  comment '',
   Description          national varchar(256)  comment '',
   History              text  comment '',
   ImageUrl             varchar(256)  comment '',
   IsShow               bool  comment '',
   primary key (Id)
);

/*==============================================================*/
/* Table: Academy                                               */
/*==============================================================*/
create table Academy
(
   Id                   char(10) not null  comment '',
   Title                national varchar(100)  comment '',
   Description          text  comment '',
   TimeStart            datetime  comment '',
   TimeEnd              datetime  comment '',
   Location             national varchar(256)  comment '',
   Type                 national varchar(50)  comment '',
   IsActive             bool  comment '',
   IsFree               bool  comment '',
   Speaker              national varchar(100)  comment '',
   primary key (Id)
);

/*==============================================================*/
/* Table: Account                                               */
/*==============================================================*/
create table Account
(
   Username             varchar(50) not null  comment '',
   Id                   char(256) not null  comment '',
   Password             char(64)  comment '',
   IsActive             bool  comment '',
   primary key (Username)
);

/*==============================================================*/
/* Table: ContactForms                                          */
/*==============================================================*/
create table ContactForms
(
   Username             varchar(50) not null  comment '',
   Message              text  comment '',
   CreatedAt            datetime  comment '',
   primary key (Username)
);

/*==============================================================*/
/* Table: EVENTS                                                */
/*==============================================================*/
create table EVENTS
(
   Id                   char(10) not null  comment '',
   Title                national varchar(100)  comment '',
   Description          text  comment '',
   TimeStart            datetime  comment '',
   TimeEnd              datetime  comment '',
   Location             national varchar(256)  comment '',
   Type                 national varchar(50)  comment '',
   IsActive             bool  comment '',
   primary key (Id)
);

/*==============================================================*/
/* Table: EXHIBITIONS                                           */
/*==============================================================*/
create table EXHIBITIONS
(
   Id                   char(10) not null  comment '',
   Title                national varchar(100)  comment '',
   Description          text  comment '',
   TimeStart            datetime  comment '',
   TimeEnd              datetime  comment '',
   Location             national varchar(256)  comment '',
   Type                 national varchar(50)  comment '',
   IsActive             bool  comment '',
   primary key (Id)
);

/*==============================================================*/
/* Table: Guides                                                */
/*==============================================================*/
create table Guides
(
   Username             varchar(50) not null  comment '',
   Id                   char(10) not null  comment '',
   UseId                char(256)  comment '',
   Password             char(64)  comment '',
   IsActive             bool  comment '',
   Expertise            char(256)  comment '',
   Schedule             char(256)  comment '',
   primary key (Username)
);

/*==============================================================*/
/* Table: Navbar                                                */
/*==============================================================*/
create table Navbar
(
   Name                 national varchar(100) not null  comment '',
   Href                 varchar(256)  comment '',
   IsShow               bool  comment '',
   primary key (Name)
);

/*==============================================================*/
/* Table: Reviews                                               */
/*==============================================================*/
create table Reviews
(
   Id                   char(10) not null  comment '',
   EveId                char(10) not null  comment '',
   Username             varchar(50) not null  comment '',
   Rating               real  comment '',
   Comment              text  comment '',
   CreatedAt            datetime  comment '',
   IsShow               bool  comment '',
   primary key (Id)
);

/*==============================================================*/
/* Table: Ticket                                                */
/*==============================================================*/
create table Ticket
(
   Id                   char(10) not null  comment '',
   Username             varchar(50) not null  comment '',
   GuiUsername          varchar(50)  comment '',
   VisitDate            datetime  comment '',
   Status               national varchar(50)  comment '',
   PaymentSatus         national varchar(50)  comment '',
   Language             varchar(50)  comment '',
   primary key (Id)
);

/*==============================================================*/
/* Table: User                                                  */
/*==============================================================*/
create table User
(
   Id                   char(256) not null  comment '',
   Username             varchar(50)  comment '',
   Name                 char(256)  comment '',
   Role                 national varchar(50)  comment '',
   Email                varchar(50)  comment '',
   PhoneNumber          varchar(20)  comment '',
   primary key (Id)
);

alter table ARTIFACTS add constraint FK_ARTIFACT_HAS_EXHIBITI foreign key (ExhId)
      references EXHIBITIONS (Id) on delete restrict on update restrict;

alter table Academy add constraint FK_ACADEMY_TYPE_EVENTS foreign key (Id)
      references EVENTS (Id) on delete restrict on update restrict;

alter table Account add constraint FK_ACCOUNT_HAS_USER foreign key (Id)
      references User (Id) on delete restrict on update restrict;

alter table ContactForms add constraint FK_CONTACTF_CONTACT_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table EXHIBITIONS add constraint FK_EXHIBITI_TYPE_EVENTS foreign key (Id)
      references EVENTS (Id) on delete restrict on update restrict;

alter table Guides add constraint FK_GUIDES_HIRE_TICKET foreign key (Id)
      references Ticket (Id) on delete restrict on update restrict;

alter table Guides add constraint FK_GUIDES_ROLE_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Reviews add constraint FK_REVIEWS_REVIEW_EVENTS foreign key (EveId)
      references EVENTS (Id) on delete restrict on update restrict;

alter table Reviews add constraint FK_REVIEWS_WRITE_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Ticket add constraint FK_TICKET_BUY_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Ticket add constraint FK_TICKET_HIRE_GUIDES foreign key (GuiUsername)
      references Guides (Username) on delete restrict on update restrict;

alter table User add constraint FK_USER_HAS_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

