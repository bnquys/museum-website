/*==============================================================*/
/* DBMS name:      MySQL5.0Custom                               */
/* Created on:     4/14/2025 8:41:08 PM                         */
/*==============================================================*/


/*==============================================================*/
/* Table: Academy                                               */
/*==============================================================*/
create table Academy
(
   Id                   varchar(20) not null,
   Price                float default 0,
   Speaker              varchar(100),
   primary key (Id)
);

/*==============================================================*/
/* Table: Account                                               */
/*==============================================================*/
create table Account
(
   Username             varchar(50) not null,
   Email                varchar(50) not null,
   Password             varchar(100),
   IsActive             boolean,
   CodeActivate         varchar(10),
   primary key (Username)
);

/*==============================================================*/
/* Table: Artifact                                              */
/*==============================================================*/
create table Artifact
(
   Id                   varchar(20) not null,
   Title                varchar(100),
   Description          varchar(256),
   History              text,
   ImageUrl             varchar(256),
   IsShow               boolean default 1,
   primary key (Id)
);

/*==============================================================*/
/* Table: Blog                                                  */
/*==============================================================*/
create table Blog
(
   Id                   varchar(20) not null,
   Username             varchar(50) not null,
   Title                varchar(256),
   Date                 datetime,
   Summary              text,
   Content              text,
   ImageUrl             varchar(256),
   IsShow               boolean,
   primary key (Id)
);

/*==============================================================*/
/* Table: BlogTag                                               */
/*==============================================================*/
create table BlogTag
(
   Id                   varchar(20) not null,
   BloId                varchar(20) not null,
   primary key (Id, BloId)
);

/*==============================================================*/
/* Table: Client                                                */
/*==============================================================*/
create table Client
(
   Email                varchar(50) not null,
   Username             varchar(50),
   Name                 varchar(50),
   PhoneNumber          varchar(20),
   primary key (Email)
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
   Id                   varchar(20) not null,
   Status               varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: EventType                                             */
/*==============================================================*/
create table EventType
(
   Id                   varchar(20) not null,
   Name                 varchar(50),
   IsShow               boolean,
   primary key (Id)
);

/*==============================================================*/
/* Table: Events                                                */
/*==============================================================*/
create table Events
(
   Id                   varchar(20) not null,
   EveId                varchar(20),
   EveId2               varchar(20),
   Title                varchar(256),
   Description          text,
   TimeStart            datetime,
   TimeEnd              datetime,
   Location             varchar(256),
   primary key (Id)
);

/*==============================================================*/
/* Table: ExhibitionArtifact                                    */
/*==============================================================*/
create table ExhibitionArtifact
(
   Id                   varchar(20) not null,
   ExhId                varchar(20) not null,
   primary key (Id, ExhId)
);

/*==============================================================*/
/* Table: Exhibitions                                           */
/*==============================================================*/
create table Exhibitions
(
   Id                   varchar(20) not null,
   primary key (Id)
);

/*==============================================================*/
/* Table: Guides                                                */
/*==============================================================*/
create table Guides
(
   Email                varchar(50) not null,
   Id                   varchar(20) not null,
   Expertise            text,
   Introduction         text,
   primary key (Email)
);

/*==============================================================*/
/* Table: Language                                              */
/*==============================================================*/
create table Language
(
   Id                   varchar(20) not null,
   Name                 varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: Navbar                                                */
/*==============================================================*/
create table Navbar
(
   Name                 varchar(100) not null,
   Href                 varchar(256),
   IsShow               boolean,
   primary key (Name)
);

/*==============================================================*/
/* Table: "Order"                                               */
/*==============================================================*/
create table "Order"
(
   Id                   varchar(20) not null,
   VouId                varchar(20),
   PayId                varchar(20),
   Username             varchar(50),
   CreatedDate          datetime,
   primary key (Id)
);

/*==============================================================*/
/* Table: OrderTicket                                           */
/*==============================================================*/
create table OrderTicket
(
   Id                   varchar(20) not null,
   TicId                varchar(20) not null,
   primary key (Id, TicId)
);

/*==============================================================*/
/* Table: Payment                                               */
/*==============================================================*/
create table Payment
(
   Id                   varchar(20) not null,
   OrdId                varchar(20) not null,
   PayId                varchar(20),
   TotalCost            float,
   primary key (Id)
);

/*==============================================================*/
/* Table: PaymentMethod                                         */
/*==============================================================*/
create table PaymentMethod
(
   Id                   varchar(20) not null,
   Method               varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: Reviews                                               */
/*==============================================================*/
create table Reviews
(
   Id                   varchar(20) not null,
   EveId                varchar(20) not null,
   Username             varchar(50) not null,
   Rating               float,
   Comment              text,
   CreatedAt            datetime,
   IsShow               boolean,
   primary key (Id)
);

/*==============================================================*/
/* Table: Role                                                  */
/*==============================================================*/
create table Role
(
   Id                   varchar(20) not null,
   Email                varchar(50) not null,
   Name                 varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: Speak                                                 */
/*==============================================================*/
create table Speak
(
   Email                varchar(50) not null,
   Id                   varchar(20) not null,
   primary key (Email, Id)
);

/*==============================================================*/
/* Table: Tag                                                   */
/*==============================================================*/
create table Tag
(
   Id                   varchar(20) not null,
   Name                 varchar(50),
   IsShow               boolean,
   primary key (Id)
);

/*==============================================================*/
/* Table: Ticket                                                */
/*==============================================================*/
create table Ticket
(
   Id                   varchar(20) not null,
   TicId                varchar(20),
   Email                varchar(50),
   VisitDate            datetime,
   primary key (Id)
);

/*==============================================================*/
/* Table: TicketType                                            */
/*==============================================================*/
create table TicketType
(
   Id                   varchar(20) not null,
   Name                 varchar(50),
   primary key (Id)
);

/*==============================================================*/
/* Table: Voucher                                               */
/*==============================================================*/
create table Voucher
(
   Id                   varchar(20) not null,
   Price                float,
   Percent              real,
   Description          text,
   primary key (Id)
);

alter table Academy add constraint FK_ACADEMY_TYPE_EVENTS foreign key (Id)
      references Events (Id) on delete restrict on update restrict;

alter table Account add constraint FK_ACCOUNT_HAS_CLIENT foreign key (Email)
      references Client (Email) on delete restrict on update restrict;

alter table Blog add constraint FK_BLOG_POST_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table BlogTag add constraint FK_BLOGTAG_BLOGTAG_BLOG foreign key (BloId)
      references Blog (Id) on delete restrict on update restrict;

alter table BlogTag add constraint FK_BLOGTAG_BLOGTAG_TAG foreign key (Id)
      references Tag (Id) on delete restrict on update restrict;

alter table Client add constraint FK_CLIENT_HAS_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

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

alter table Guides add constraint FK_GUIDES_INHERITAN_CLIENT foreign key (Email)
      references Client (Email) on delete restrict on update restrict;

alter table "Order" add constraint FK_ORDER_APPLY_VOUCHER foreign key (VouId)
      references Voucher (Id) on delete restrict on update restrict;

alter table "Order" add constraint FK_ORDER_MAKE_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table "Order" add constraint FK_ORDER_PAY_PAYMENT foreign key (PayId)
      references Payment (Id) on delete restrict on update restrict;

alter table OrderTicket add constraint FK_ORDERTIC_ORDERTICK_ORDER foreign key (Id)
      references "Order" (Id) on delete restrict on update restrict;

alter table OrderTicket add constraint FK_ORDERTIC_ORDERTICK_TICKET foreign key (TicId)
      references Ticket (Id) on delete restrict on update restrict;

alter table Payment add constraint FK_PAYMENT_METHOD_PAYMENTM foreign key (PayId)
      references PaymentMethod (Id) on delete restrict on update restrict;

alter table Payment add constraint FK_PAYMENT_PAY_ORDER foreign key (OrdId)
      references "Order" (Id) on delete restrict on update restrict;

alter table Reviews add constraint FK_REVIEWS_REVIEW_EVENTS foreign key (EveId)
      references Events (Id) on delete restrict on update restrict;

alter table Reviews add constraint FK_REVIEWS_WRITE_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Role add constraint FK_ROLE_ROLE_CLIENT foreign key (Email)
      references Client (Email) on delete restrict on update restrict;

alter table Speak add constraint FK_SPEAK_SPEAK_GUIDES foreign key (Email)
      references Guides (Email) on delete restrict on update restrict;

alter table Speak add constraint FK_SPEAK_SPEAK_LANGUAGE foreign key (Id)
      references Language (Id) on delete restrict on update restrict;

alter table Ticket add constraint FK_TICKET_HIRE_GUIDES foreign key (Email)
      references Guides (Email) on delete restrict on update restrict;

alter table Ticket add constraint FK_TICKET_TYPE_TICKETTY foreign key (TicId)
      references TicketType (Id) on delete restrict on update restrict;

