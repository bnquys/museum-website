/*==============================================================*/
/* DBMS name:      MySQL5.0Custom                               */
/* Created on:     4/23/2025 10:18:02 PM                        */
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
   UploadDate           datetime default 'CURRENT_TIMESTAMP()',
   Summary              text,
   Content              text,
   ImageUrl             text default '',
   IsShow               boolean default TRUE,
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
   PhoneNumber          varchar(20),
   BirthDay             date,
   primary key (Email)
);

/*==============================================================*/
/* Table: ContactForms                                          */
/*==============================================================*/
create table ContactForms
(
   Username             varchar(50) not null,
   Message              text,
   CreatedAt            datetime default 'CURRENT_TIMESTAMP()',
   primary key (Username)
);

/*==============================================================*/
/* Table: Contain                                               */
/*==============================================================*/
create table Contain
(
   TicId                varchar(20) not null,
   Id                   varchar(20) not null,
   Quantity             int default 0,
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
   TimeStart            datetime default 'CURRENT_TIMESTAMP()',
   TimeEnd              datetime default 'CURRENT_TIMESTAMP()',
   Location             text,
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
   Name                 text,
   primary key (Id)
);

/*==============================================================*/
/* Table: Navbar                                                */
/*==============================================================*/
create table Navbar
(
   Name                 varchar(100) not null,
   Href                 text,
   IsShow               boolean default TRUE,
   primary key (Name)
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
   CreatedDate          datetime default 'CURRENT_TIMESTAMP()',
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
   Rating               float default 0,
   Comment              text,
   CreatedAt            datetime default 'CURRENT_TIMESTAMP()',
   IsShow               boolean default TRUE,
   primary key (Id)
);

/*==============================================================*/
/* Table: Role                                                  */
/*==============================================================*/
create table Role
(
   Id                   varchar(20) not null,
   Email                varchar(50) not null,
   Name                 text,
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
   Email                varchar(50),
   Name                 text,
   VisitDate            datetime default 'CURRENT_TIMESTAMP()',
   Price                float default 0,
   IsShow               boolean default TRUE,
   primary key (Id)
);

/*==============================================================*/
/* Table: ToTag                                                 */
/*==============================================================*/
create table ToTag
(
   TagId                varchar(20) not null,
   Id                   varchar(20) not null,
   primary key (TagId, Id)
);

/*==============================================================*/
/* Table: Voucher                                               */
/*==============================================================*/
create table Voucher
(
   Id                   varchar(20) not null,
   Price                float default 0,
   Percent              real default 0,
   Description          text,
   primary key (Id)
);

alter table Academy add constraint FK_ACADEMY_TYPE_EVENTS foreign key (Id)
      references Events (Id) on delete restrict on update restrict;

alter table Account add constraint FK_ACCOUNT_HAS_CLIENT foreign key (Email)
      references Client (Email) on delete restrict on update restrict;

alter table Blog add constraint FK_BLOG_POST_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table Client add constraint FK_CLIENT_HAS_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

alter table ContactForms add constraint FK_CONTACTF_CONTACT_ACCOUNT foreign key (Username)
      references Account (Username) on delete restrict on update restrict;

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

alter table Guides add constraint FK_GUIDES_HIRE_TICKET foreign key (Id)
      references Ticket (Id) on delete restrict on update restrict;

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

alter table ToTag add constraint FK_TOTAG_TOTAG_BLOG foreign key (Id)
      references Blog (Id) on delete restrict on update restrict;

alter table ToTag add constraint FK_TOTAG_TOTAG_TAG foreign key (TagId)
      references Tag (Id) on delete restrict on update restrict;

