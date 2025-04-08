/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     3/27/2025 12:27:36 AM                        */
/*==============================================================*/


alter table ARTIFACTS 
   drop foreign key FK_ARTIFACT_RELATIONS_EXHIBITI;

alter table BOOKINGS 
   drop foreign key FK_BOOKINGS_BOOKINGS_TICKETS;

alter table BOOKINGS 
   drop foreign key FK_BOOKINGS_BOOKINGS2_GUIDES;

alter table CONTACT_FORMS 
   drop foreign key FK_CONTACT__RELATIONS_USER;

alter table EVENTS 
   drop foreign key FK_EVENTS_RELATIONS_EXHIBITI;

alter table NEWSLETTERS 
   drop foreign key FK_NEWSLETT_RELATIONS_USER;

alter table REVIEWS 
   drop foreign key FK_REVIEWS_RELATIONS_USER;

alter table REVIEWS 
   drop foreign key FK_REVIEWS_RELATIONS_EXHIBITI;

alter table REVIEWS 
   drop foreign key FK_REVIEWS_RELATIONS_EVENTS;

alter table TICKETS 
   drop foreign key FK_TICKETS_RELATIONS_USER;

alter table USER 
   drop foreign key FK_USER_RELATIONS_NEWSLETT;


alter table ARTIFACTS 
   drop foreign key FK_ARTIFACT_RELATIONS_EXHIBITI;

drop table if exists ARTIFACTS;


alter table BOOKINGS 
   drop foreign key FK_BOOKINGS_BOOKINGS_TICKETS;

alter table BOOKINGS 
   drop foreign key FK_BOOKINGS_BOOKINGS2_GUIDES;

drop table if exists BOOKINGS;


alter table CONTACT_FORMS 
   drop foreign key FK_CONTACT__RELATIONS_USER;

drop table if exists CONTACT_FORMS;


alter table EVENTS 
   drop foreign key FK_EVENTS_RELATIONS_EXHIBITI;

drop table if exists EVENTS;

drop table if exists EXHIBITIONS;

drop table if exists GUIDES;


alter table NEWSLETTERS 
   drop foreign key FK_NEWSLETT_RELATIONS_USER;

drop table if exists NEWSLETTERS;


alter table REVIEWS 
   drop foreign key FK_REVIEWS_RELATIONS_USER;

alter table REVIEWS 
   drop foreign key FK_REVIEWS_RELATIONS_EXHIBITI;

alter table REVIEWS 
   drop foreign key FK_REVIEWS_RELATIONS_EVENTS;

drop table if exists REVIEWS;


alter table TICKETS 
   drop foreign key FK_TICKETS_RELATIONS_USER;

drop table if exists TICKETS;


alter table USER 
   drop foreign key FK_USER_RELATIONS_NEWSLETT;

drop table if exists USER;

/*==============================================================*/
/* Table: ARTIFACTS                                             */
/*==============================================================*/
create table ARTIFACTS
(
   ID                   char(256) not null  comment '',
   EXH_ID               char(256) not null  comment '',
   TITLE                char(256)  comment '',
   DESCRIPTION          char(256)  comment '',
   HISTORY              char(256)  comment '',
   IMAGE_URL            char(256)  comment '',
   CREATE_AT            char(256)  comment '',
   UPDATE_AT            char(256)  comment '',
   primary key (ID)
);

/*==============================================================*/
/* Table: BOOKINGS                                              */
/*==============================================================*/
create table BOOKINGS
(
   ID                   char(256) not null  comment '',
   GUI_ID               char(256) not null  comment '',
   LANGUAGE             char(256)  comment '',
   CREATED_AT           char(256)  comment '',
   UPDATED_AT           char(256)  comment '',
   primary key (ID, GUI_ID)
);

/*==============================================================*/
/* Table: CONTACT_FORMS                                         */
/*==============================================================*/
create table CONTACT_FORMS
(
   ID                   char(256) not null  comment '',
   USE_ID               char(10)  comment '',
   MESSAGE              char(256)  comment '',
   CREATED_AT           char(256)  comment '',
   primary key (ID)
);

/*==============================================================*/
/* Table: EVENTS                                                */
/*==============================================================*/
create table EVENTS
(
   ID                   char(256) not null  comment '',
   EXH_ID               char(256) not null  comment '',
   TITLE                char(256)  comment '',
   DESCRIPTION          char(256)  comment '',
   EVENT_DATE           char(256)  comment '',
   LOCATION             char(256)  comment '',
   CREATE_AT            char(256)  comment '',
   UPDATE_AT            char(256)  comment '',
   primary key (ID)
);

/*==============================================================*/
/* Table: EXHIBITIONS                                           */
/*==============================================================*/
create table EXHIBITIONS
(
   ID                   char(256) not null  comment '',
   TITLE                char(256)  comment '',
   DESCRIPTION          char(256)  comment '',
   START_DATE           char(256)  comment '',
   END_DATE             char(256)  comment '',
   LOCATION             char(256)  comment '',
   IMAGE_URL            char(256)  comment '',
   CREATE_AT            char(256)  comment '',
   UPDATE_AT            char(256)  comment '',
   primary key (ID)
);

/*==============================================================*/
/* Table: GUIDES                                                */
/*==============================================================*/
create table GUIDES
(
   ID                   char(256) not null  comment '',
   EXPERTISE            char(256)  comment '',
   SCHEDULE             char(256)  comment '',
   CREATED_AT           char(256)  comment '',
   UPDATED_AT           char(256)  comment '',
   primary key (ID)
);

/*==============================================================*/
/* Table: NEWSLETTERS                                           */
/*==============================================================*/
create table NEWSLETTERS
(
   ID                   char(256) not null  comment '',
   USE_ID               char(10) not null  comment '',
   EMAIL                char(256)  comment '',
   SUBCRIBED_AT         char(256)  comment '',
   UNSUBSCRIBED_AT      char(256)  comment '',
   primary key (ID)
);

/*==============================================================*/
/* Table: REVIEWS                                               */
/*==============================================================*/
create table REVIEWS
(
   ID                   char(256) not null  comment '',
   EVE_ID               char(256) not null  comment '',
   USE_ID               char(10) not null  comment '',
   EXH_ID               char(256) not null  comment '',
   RATING               char(256)  comment '',
   COMMENT              char(256)  comment '',
   CREATED_AT           char(256)  comment '',
   primary key (ID)
);

/*==============================================================*/
/* Table: TICKETS                                               */
/*==============================================================*/
create table TICKETS
(
   ID                   char(256) not null  comment '',
   USE_ID               char(10) not null  comment '',
   VISIT_DATE           char(256)  comment '',
   STATUS               char(256)  comment '',
   PAYMENT_SATUS        char(256)  comment '',
   CREATED_AT           char(256)  comment '',
   UPDATED_AT           char(256)  comment '',
   primary key (ID)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID                   char(10) not null  comment '',
   NEW_ID               char(256)  comment '',
   USERNAME             char(10)  comment '',
   PASSWORD             char(10)  comment '',
   ROLE                 char(10)  comment '',
   EMAIL                char(256)  comment '',
   PHONE_NUMBER         char(256)  comment '',
   CREATE_AT            char(256)  comment '',
   UPDATE_AT            char(256)  comment '',
   primary key (ID)
);

alter table ARTIFACTS add constraint FK_ARTIFACT_RELATIONS_EXHIBITI foreign key (EXH_ID)
      references EXHIBITIONS (ID);

alter table BOOKINGS add constraint FK_BOOKINGS_BOOKINGS_TICKETS foreign key (ID)
      references TICKETS (ID);

alter table BOOKINGS add constraint FK_BOOKINGS_BOOKINGS2_GUIDES foreign key (GUI_ID)
      references GUIDES (ID);

alter table CONTACT_FORMS add constraint FK_CONTACT__RELATIONS_USER foreign key (USE_ID)
      references USER (ID);

alter table EVENTS add constraint FK_EVENTS_RELATIONS_EXHIBITI foreign key (EXH_ID)
      references EXHIBITIONS (ID);

alter table NEWSLETTERS add constraint FK_NEWSLETT_RELATIONS_USER foreign key (USE_ID)
      references USER (ID);

alter table REVIEWS add constraint FK_REVIEWS_RELATIONS_USER foreign key (USE_ID)
      references USER (ID);

alter table REVIEWS add constraint FK_REVIEWS_RELATIONS_EXHIBITI foreign key (EXH_ID)
      references EXHIBITIONS (ID);

alter table REVIEWS add constraint FK_REVIEWS_RELATIONS_EVENTS foreign key (EVE_ID)
      references EVENTS (ID);

alter table TICKETS add constraint FK_TICKETS_RELATIONS_USER foreign key (USE_ID)
      references USER (ID);

alter table USER add constraint FK_USER_RELATIONS_NEWSLETT foreign key (NEW_ID)
      references NEWSLETTERS (ID);

