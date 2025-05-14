/*==============================================================*/
/* DBMS name:      MySQL5.0Custom                               */
/* Created on:     5/14/2025 5:29:47 PM                         */
/*==============================================================*/


/*==============================================================*/
/* Table: Academy                                               */
/*==============================================================*/
create table Academy
(
   Id                   varchar(20) not null,
   Price                float default 0,
   Speaker              text,
   primary key (Id)
);

/*==============================================================*/
/* Table: Account                                               */
/*==============================================================*/
create table Account
(
   Username             varchar(50) not null,
   Email                varchar(50) not null,
   Id                   varchar(20),
   Password             text,
   ActivateCode         varchar(20),
   IsActive             boolean default TRUE,
   primary key (Username)
);

/*==============================================================*/
/* Table: Artifact                                              */
/*==============================================================*/
create table Artifact
(
   Id                   varchar(20) not null,
   Title                text,
   Description          text,
   History              text,
   ImageUrl             text,
   IsShow               boolean default TRUE,
   DisplayOrder         bigint default 0,
   primary key (Id)
);

/*==============================================================*/
/* Table: Blog                                                  */
/*==============================================================*/
create table Blog
(
   Id                   varchar(20) not null,
   Username             varchar(50) not null,
   Title                text,
   UploadDate           datetime default CURRENT_TIMESTAMP,
   Summary              text,
   Content              text,
   ImageUrl             text default '',
   IsShow               boolean default TRUE,
   DisplayOrder         bigint default 0,
   primary key (Id)
);

/*==============================================================*/
/* Table: Client                                                */
/*==============================================================*/
create table Client
(
   Email                varchar(50) not null,
   Username             varchar(50),
   Name                 text,
   PhoneNumber          national varchar(255),
   BirthDate            date,
   Avatar               national varchar(255),
   primary key (Email)
);

/*==============================================================*/
/* Table: Comment                                               */
/*==============================================================*/
create table Comment
(
   Username             varchar(50) not null,
   Id                   varchar(20) not null,
   Content              text not null,
   CreatedAt            datetime default CURRENT_TIMESTAMP,
   IsShow               boolean default TRUE,
   primary key (Username, Id)
);

/*==============================================================*/
/* Table: ContactForms                                          */
/*==============================================================*/
create table ContactForms
(
   Id                   varchar(20) not null,
   Email                text,
   Name                 text,
   Message              text,
   CreatedAt            datetime default CURRENT_TIMESTAMP,
   IsSeen               boolean default FALSE,
   primary key (Id)
);

/*==============================================================*/
/* Table: Contain                                               */
/*==============================================================*/
create table Contain
(
   TicId                varchar(20) not null,
   Id                   varchar(20) not null,
   Email                varchar(50),
   Quantity             int default 0,
   VisitDate            datetime default CURRENT_TIMESTAMP,
   primary key (TicId, Id)
);

/*==============================================================*/
/* Table: Display                                               */
/*==============================================================*/
create table Display
(
   Id                   varchar(20) not null,
   ExhId                varchar(20) not null,
   primary key (Id, ExhId)
);

/*==============================================================*/
/* Table: EventStatus                                           */
/*==============================================================*/
create table EventStatus
(
   Id                   varchar(20) not null,
   Status               text,
   IsShow               boolean default TRUE,
   primary key (Id)
);

/*==============================================================*/
/* Table: EventType                                             */
/*==============================================================*/
create table EventType
(
   Id                   varchar(20) not null,
   Name                 text,
   IsShow               boolean default TRUE,
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
   Title                text,
   Description          text,
   TimeStart            datetime default CURRENT_TIMESTAMP,
   TimeEnd              datetime default CURRENT_TIMESTAMP,
   Location             text,
   DisplayOrder         bigint default 0,
   IsShow               boolean default TRUE,
   primary key (Id)
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
   Name                 text,
   IsShow               boolean default TRUE,
   primary key (Id)
);

/*==============================================================*/
/* Table: Orders                                                */
/*==============================================================*/
create table Orders
(
   Id                   varchar(20) not null,
   VouId                varchar(20),
   PayId                varchar(20),
   Username             varchar(50),
   CreatedDate          datetime default CURRENT_TIMESTAMP,
   primary key (Id)
);

/*==============================================================*/
/* Table: Payment                                               */
/*==============================================================*/
create table Payment
(
   Id                   varchar(20) not null,
   OrdId                varchar(20) not null,
   PayId                varchar(20),
   PayDate              datetime default CURRENT_TIMESTAMP,
   TotalCost            float default 0,
   primary key (Id)
);

/*==============================================================*/
/* Table: PaymentMethod                                         */
/*==============================================================*/
create table PaymentMethod
(
   Id                   varchar(20) not null,
   Method               text,
   IsShow               boolean default TRUE,
   primary key (Id)
);

/*==============================================================*/
/* Table: Review                                                */
/*==============================================================*/
create table Review
(
   Username             varchar(50) not null,
   Id                   varchar(20) not null,
   Comment              text,
   CreatedAt            datetime default CURRENT_TIMESTAMP,
   IsShow               boolean default TRUE,
   primary key (Username, Id)
);

/*==============================================================*/
/* Table: Role                                                  */
/*==============================================================*/
create table Role
(
   Id                   varchar(20) not null,
   Name                 text,
   IsShow               boolean default TRUE,
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
   Name                 text,
   IsShow               boolean default TRUE,
   primary key (Id)
);

/*==============================================================*/
/* Table: Ticket                                                */
/*==============================================================*/
create table Ticket
(
   Id                   varchar(20) not null,
   Name                 text,
   Price                float default 0,
   Description          text,
   IsShow               boolean default TRUE,
   DisplayOrder         bigint default 0,
   primary key (Id)
);

/*==============================================================*/
/* Table: ToTag                                                 */
/*==============================================================*/
create table ToTag
(
   Id                   varchar(20) not null,
   BloId                varchar(20) not null,
   primary key (Id, BloId)
);

/*==============================================================*/
/* Table: Voucher                                               */
/*==============================================================*/
create table Voucher
(
   Id                   varchar(20) not null,
   Price                float default 0,
   Percent              real default 0,
   DateStart            datetime default CURRENT_TIMESTAMP,
   DateEnd              datetime default CURRENT_TIMESTAMP,
   Description          text,
   primary key (Id)
);

alter table Academy add constraint FK_ACADEMY_TYPE_EVENTS foreign key (Id)
      references Events (Id) on delete restrict on update restrict;

alter table Account add constraint FK_ACCOUNT_DECENTRAL_ROLE foreign key (Id)
      references Role (Id) on delete restrict on update restrict;

alter table Account add constraint FK_ACCOUNT_HAS_CLIENT foreign key (Email)
      references Client (Email) on delete restrict on update restrict;

alter table Blog add constraint FK_BLOG_POST_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Client add constraint FK_CLIENT_HAS_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Comment add constraint FK_COMMENT_COMMENT_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Comment add constraint FK_COMMENT_COMMENT_BLOG foreign key (Id)
      references Blog (Id) on delete restrict on update restrict;

alter table Contain add constraint FK_CONTAIN_CONTAIN_GUIDES foreign key (Email)
      references Guides (Email) on delete restrict on update restrict;

alter table Contain add constraint FK_CONTAIN_CONTAIN_ORDERS foreign key (Id)
      references Orders (Id) on delete restrict on update restrict;

alter table Contain add constraint FK_CONTAIN_CONTAIN_TICKET foreign key (TicId)
      references Ticket (Id) on delete restrict on update restrict;

alter table Display add constraint FK_DISPLAY_DISPLAY_ARTIFACT foreign key (Id)
      references Artifact (Id) on delete restrict on update restrict;

alter table Display add constraint FK_DISPLAY_DISPLAY_EXHIBITI foreign key (ExhId)
      references Exhibitions (Id) on delete restrict on update restrict;

alter table Events add constraint FK_EVENTS_STATUS_EVENTSTA foreign key (EveId2)
      references EventStatus (Id) on delete restrict on update restrict;

alter table Events add constraint FK_EVENTS_TYPE_EVENTTYP foreign key (EveId)
      references EventType (Id) on delete restrict on update restrict;

alter table Exhibitions add constraint FK_EXHIBITI_TYPE_EVENTS foreign key (Id)
      references Events (Id) on delete restrict on update restrict;

alter table Guides add constraint FK_GUIDES_INHERITAN_CLIENT foreign key (Email)
      references Client (Email) on delete restrict on update restrict;

alter table Orders add constraint FK_ORDERS_APPLY_VOUCHER foreign key (VouId)
      references Voucher (Id) on delete restrict on update restrict;

alter table Orders add constraint FK_ORDERS_MAKE_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Orders add constraint FK_ORDERS_PAY_PAYMENT foreign key (PayId)
      references Payment (Id) on delete restrict on update restrict;

alter table Payment add constraint FK_PAYMENT_METHOD_PAYMENTM foreign key (PayId)
      references PaymentMethod (Id) on delete restrict on update restrict;

alter table Payment add constraint FK_PAYMENT_PAY_ORDERS foreign key (OrdId)
      references Orders (Id) on delete restrict on update restrict;

alter table Review add constraint FK_REVIEW_REVIEW_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Review add constraint FK_REVIEW_REVIEW_EVENTS foreign key (Id)
      references Events (Id) on delete restrict on update restrict;

alter table Speak add constraint FK_SPEAK_SPEAK_GUIDES foreign key (Email)
      references Guides (Email) on delete restrict on update restrict;

alter table Speak add constraint FK_SPEAK_SPEAK_LANGUAGE foreign key (Id)
      references Language (Id) on delete restrict on update restrict;

alter table ToTag add constraint FK_TOTAG_TOTAG_BLOG foreign key (BloId)
      references Blog (Id) on delete restrict on update restrict;

alter table ToTag add constraint FK_TOTAG_TOTAG_TAG foreign key (Id)
      references Tag (Id) on delete restrict on update restrict;

