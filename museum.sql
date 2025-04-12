/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     4/12/2025 9:22:42 PM                         */
/*==============================================================*/


/*==============================================================*/
/* Table: Academy                                               */
/*==============================================================*/
create table Academy
(
   Id                   char(10) not null,
   Price                float default 0,
   Speaker              national varchar(100),
   primary key (Id)
);

/*==============================================================*/
/* Table: Account                                               */
/*==============================================================*/
create table Account
(
   Username             varchar(50) not null,
   Id                   char(256) not null,
   Password             char(64),
   IsActive             bool,
   CodeActivate         varchar(10),
   primary key (Username)
);

/*==============================================================*/
/* Table: Artifact                                              */
/*==============================================================*/
create table Artifact
(
   Id                   char(10) not null,
   Title                national varchar(100),
   Description          national varchar(256),
   History              text,
   ImageUrl             varchar(256),
   IsShow               bool default 1,
   primary key (Id)
);

/*==============================================================*/
/* Table: Blog                                                  */
/*==============================================================*/
create table Blog
(
   Id                   char(10) not null,
   Username             varchar(50) not null,
   Title                national varchar(256),
   Date                 datetime,
   Summary              text,
   Content              text,
   ImageUrl             varchar(256),
   IsShow               bool,
   primary key (Id)
);

/*==============================================================*/
/* Table: BlogTag                                               */
/*==============================================================*/
create table BlogTag
(
   Id                   char(10) not null,
   BloId                char(10) not null,
   primary key (Id, BloId)
);

/*==============================================================*/
/* Table: ContactForms                                          */
/*==============================================================*/
create table ContactForms
(
   Username             varchar(50) not null,
   Message              text,
   CreatedAt            datetime,
   primary key (Username)
);

/*==============================================================*/
/* Table: EventStatus                                           */
/*==============================================================*/
create table EventStatus
(
   Id                   char(10) not null,
   Status               varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: EventType                                             */
/*==============================================================*/
create table EventType
(
   Id                   char(10) not null,
   Name                 varchar(50),
   IsShow               bool,
   primary key (Id)
);

/*==============================================================*/
/* Table: Events                                                */
/*==============================================================*/
create table Events
(
   Id                   char(10) not null,
   EveId                char(10),
   EveId2               char(10),
   Title                national varchar(100),
   Description          text,
   TimeStart            datetime,
   TimeEnd              datetime,
   Location             national varchar(256),
   primary key (Id)
);

/*==============================================================*/
/* Table: ExhibitionArtifact                                    */
/*==============================================================*/
create table ExhibitionArtifact
(
   Id                   char(10) not null,
   ExhId                char(10) not null,
   primary key (Id, ExhId)
);

/*==============================================================*/
/* Table: Exhibitions                                           */
/*==============================================================*/
create table Exhibitions
(
   Id                   char(10) not null,
   primary key (Id)
);

/*==============================================================*/
/* Table: Guides                                                */
/*==============================================================*/
create table Guides
(
   UseId                char(256) not null,
   Id                   char(10) not null,
   Expertise            char(256),
   Introduction         text,
   primary key (UseId)
);

/*==============================================================*/
/* Table: Language                                              */
/*==============================================================*/
create table Language
(
   Id                   varchar(20) not null,
   Name                 national varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: Navbar                                                */
/*==============================================================*/
create table Navbar
(
   Name                 national varchar(100) not null,
   Href                 varchar(256),
   IsShow               bool,
   primary key (Name)
);

/*==============================================================*/
/* Table: "Order"                                               */
/*==============================================================*/
create table "Order"
(
   Id                   char(10) not null,
   VouId                char(10),
   PayId                char(10),
   Username             varchar(50),
   CreatedDate          char(256),
   primary key (Id)
);

/*==============================================================*/
/* Table: OrderTicket                                           */
/*==============================================================*/
create table OrderTicket
(
   OrdId                char(10) not null,
   Id                   char(10) not null,
   primary key (OrdId, Id)
);

/*==============================================================*/
/* Table: Payment                                               */
/*==============================================================*/
create table Payment
(
   Id                   char(10) not null,
   OrdId                char(10) not null,
   PayId                char(10),
   TotalCost            float,
   primary key (Id)
);

/*==============================================================*/
/* Table: PaymentMethod                                         */
/*==============================================================*/
create table PaymentMethod
(
   Id                   char(10) not null,
   Method               national varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: Reviews                                               */
/*==============================================================*/
create table Reviews
(
   Id                   char(10) not null,
   EveId                char(10) not null,
   Username             varchar(50) not null,
   Rating               real,
   Comment              text,
   CreatedAt            datetime,
   IsShow               bool,
   primary key (Id)
);

/*==============================================================*/
/* Table: Role                                                  */
/*==============================================================*/
create table Role
(
   Id                   char(10) not null,
   UseId                char(256) not null,
   Name                 national varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: Speak                                                 */
/*==============================================================*/
create table Speak
(
   UseId                char(256) not null,
   Id                   varchar(20) not null,
   primary key (UseId, Id)
);

/*==============================================================*/
/* Table: Tag                                                   */
/*==============================================================*/
create table Tag
(
   Id                   char(10) not null,
   Name                 national varchar(50),
   IsShow               bool,
   primary key (Id)
);

/*==============================================================*/
/* Table: Ticket                                                */
/*==============================================================*/
create table Ticket
(
   Id                   char(10) not null,
   TicId                char(10),
   UseId                char(256),
   VisitDate            datetime,
   primary key (Id)
);

/*==============================================================*/
/* Table: TicketType                                            */
/*==============================================================*/
create table TicketType
(
   Id                   char(10) not null,
   Name                 national varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: User                                                  */
/*==============================================================*/
create table User
(
   Id                   char(256) not null,
   Username             varchar(50),
   Name                 char(256),
   Email                varchar(50),
   PhoneNumber          varchar(20),
   primary key (Id)
);

/*==============================================================*/
/* Table: Voucher                                               */
/*==============================================================*/
create table Voucher
(
   Id                   char(10) not null,
   Price                float,
   Percent              real,
   Description          text,
   primary key (Id)
);

alter table Academy add constraint FK_ACADEMY_TYPE_EVENTS foreign key (Id)
      references Events (Id) on delete restrict on update restrict;

alter table Account add constraint FK_ACCOUNT_HAS_USER foreign key (Id)
      references User (Id) on delete restrict on update restrict;

alter table Blog add constraint FK_BLOG_POST_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table BlogTag add constraint FK_BLOGTAG_BLOGTAG_BLOG foreign key (BloId)
      references Blog (Id) on delete restrict on update restrict;

alter table BlogTag add constraint FK_BLOGTAG_BLOGTAG_TAG foreign key (Id)
      references Tag (Id) on delete restrict on update restrict;

alter table ContactForms add constraint FK_CONTACTF_CONTACT_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Events add constraint FK_EVENTS_STATUS_EVENTSTA foreign key (EveId2)
      references EventStatus (Id) on delete restrict on update restrict;

alter table Events add constraint FK_EVENTS_TYPE_EVENTTYP foreign key (EveId)
      references EventType (Id) on delete restrict on update restrict;

alter table ExhibitionArtifact add constraint FK_EXHIBITI_EXHIBITIO_ARTIFACT foreign key (Id)
      references Artifact (Id) on delete restrict on update restrict;

alter table ExhibitionArtifact add constraint FK_EXHIBITI_EXHIBITIO_EXHIBITI foreign key (ExhId)
      references Exhibitions (Id) on delete restrict on update restrict;

alter table Exhibitions add constraint FK_EXHIBITI_TYPE_EVENTS foreign key (Id)
      references Events (Id) on delete restrict on update restrict;

alter table Guides add constraint FK_GUIDES_HIRE_TICKET foreign key (Id)
      references Ticket (Id) on delete restrict on update restrict;

alter table Guides add constraint FK_GUIDES_INHERITAN_USER foreign key (UseId)
      references User (Id) on delete restrict on update restrict;

alter table "Order" add constraint FK_ORDER_APPLY_VOUCHER foreign key (VouId)
      references Voucher (Id) on delete restrict on update restrict;

alter table "Order" add constraint FK_ORDER_MAKE_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table "Order" add constraint FK_ORDER_PAY_PAYMENT foreign key (PayId)
      references Payment (Id) on delete restrict on update restrict;

alter table OrderTicket add constraint FK_ORDERTIC_ORDERTICK_ORDER foreign key (OrdId)
      references "Order" (Id) on delete restrict on update restrict;

alter table OrderTicket add constraint FK_ORDERTIC_ORDERTICK_TICKET foreign key (Id)
      references Ticket (Id) on delete restrict on update restrict;

alter table Payment add constraint FK_PAYMENT_METHOD_PAYMENTM foreign key (PayId)
      references PaymentMethod (Id) on delete restrict on update restrict;

alter table Payment add constraint FK_PAYMENT_PAY_ORDER foreign key (OrdId)
      references "Order" (Id) on delete restrict on update restrict;

alter table Reviews add constraint FK_REVIEWS_REVIEW_EVENTS foreign key (EveId)
      references Events (Id) on delete restrict on update restrict;

alter table Reviews add constraint FK_REVIEWS_WRITE_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Role add constraint FK_ROLE_ROLE_USER foreign key (UseId)
      references User (Id) on delete restrict on update restrict;

alter table Speak add constraint FK_SPEAK_SPEAK_GUIDES foreign key (UseId)
      references Guides (UseId) on delete restrict on update restrict;

alter table Speak add constraint FK_SPEAK_SPEAK_LANGUAGE foreign key (Id)
      references Language (Id) on delete restrict on update restrict;

alter table Ticket add constraint FK_TICKET_HIRE_GUIDES foreign key (UseId)
      references Guides (UseId) on delete restrict on update restrict;

alter table Ticket add constraint FK_TICKET_TYPE_TICKETTY foreign key (TicId)
      references TicketType (Id) on delete restrict on update restrict;

alter table User add constraint FK_USER_HAS_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

