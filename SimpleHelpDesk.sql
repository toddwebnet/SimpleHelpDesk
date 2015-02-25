
drop table IF EXISTS AllowedEmailRules;
drop table IF EXISTS TicketEntryFiles;
drop table IF EXISTS TicketEntries;
drop table IF EXISTS Tickets;
drop table IF EXISTS TicketGroups;
drop table IF EXISTS TicketStatus;
drop table IF EXISTS CustomerContacts;
drop table IF EXISTS CustomerEmailRules;
drop table IF EXISTS Users;
drop table IF EXISTS Customers;
drop table IF EXISTS UserRoles;
drop table IF EXISTS ci_sessions ;


CREATE TABLE  ci_sessions (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY last_activity_idx (last_activity)
);


create table UserRoles
(
	UserRoleID int auto_increment not null, 
	RoleName varchar(32) not null, 
	PermissionLevel tinyint not null, 
	primary key (UserRoleID)
);

	
create table Customers
(
	CustomerID int auto_increment not null, 
	CustomerName varchar(64)  not null, 
	Address1 varchar(255) not null, 
	Address2 varchar(255) not null, 
	City varchar(255) not null, 
	State varchar(32) not null, 
	Zip varchar(16) not null,
	IsActive bit default 1 not null,
	primary key (CustomerID)
);
create table CustomerEmailRules
(
	CustomerEmailRuleID int auto_increment, 
	CustomerID int not null,
	EmailText varchar(32), 	
	primary key (CustomerEmailRuleID) 
);
	

create table CustomerContacts
(
	CustomerContactID int auto_increment, 
	CustomerID int,
	FirstName varchar(32) not null, 
	LastName varchar(32) not null, 
	Phone varchar(64), 
	Email varchar(255), 
	IsActive bit, 
	primary key (CustomerContactID) 
);


create table Users
(
	UserID int auto_increment not null, 	
	CustomerID int, 
	Email varchar(255) not null, 
	Password varchar(32) not null, 	
	FirstName varchar(32), 
	LastName varchar(32), 
	UserRoleID int not null, 
	IsActive bit default 1 not null, 
	primary key (UserID)
);

create table TicketStatus
(
	TicketStatusID int auto_increment not null , 	
	StatusName varchar(32) not null , 
	IsActive bit default 1 not null , 
	primary key (TicketStatusID)
);

create table TicketGroups
(
	TicketGroupID int auto_increment not null , 	
	GroupName varchar(32) not null , 
	IsActive bit default 1 not null , 
	primary key (TicketGroupID)
);

create table Tickets
(
	TicketID int auto_increment not null , 
	UserID int, 
	TicketGroupID int, 
	TicketStatusID int, 
	CustomerID int, 
	Title varchar(255) not null , 	
	CreateDate datetime not null, 
	CreatorEmail varchar(255), 
	IsActive bit default 1 not null, 
	primary key (TicketID)
);
	


create table TicketEntries
(
	TicketEntryID int auto_increment, 
	TicketID int, 
	Descr Text, 
	Email varchar(255), 
	CreateDate datetime, 
	IsActive bit default 1 not null, 
	primary key (TicketEntryID)
);
	

create table TicketEntryFiles
(
	TicketEntryFileID int auto_increment,
	TicketEntryID int, 
	FileName varchar(255), 
	FilePath varchar(255), 
	FileExt varchar(8), 
	CreateDate datetime, 
	primary key (TicketEntryFileID)
);

create table AllowedEmailRules
(
	AllowedEmailRuleID int auto_increment, 
	RuleText varchar(255), 
	IncludeExclude char(1),
	IsActive bit default 1, 
	primary key (AllowedEmailRuleID)
);




ALTER TABLE TicketEntryFiles
	ADD CONSTRAINT FK_TicketEntryFiles_TicketEntries
	FOREIGN KEY (TicketEntryID) REFERENCES TicketEntries(TicketEntryID);

ALTER TABLE TicketEntries 
	ADD CONSTRAINT FK_TicketEntries_Ticket
	FOREIGN KEY (TicketID) REFERENCES Tickets(TicketID);
	
	
ALTER TABLE Tickets
	ADD CONSTRAINT FK_Tickets_Users
	FOREIGN KEY (UserID) REFERENCES Users(UserID);
	
ALTER TABLE Tickets
	ADD CONSTRAINT FK_Tickets_TicketGroups
	FOREIGN KEY (TicketGroupID) REFERENCES TicketGroups(TicketGroupID);
		
ALTER TABLE Tickets
	ADD CONSTRAINT FK_Tickets_TicketStatus
	FOREIGN KEY (TicketStatusID) REFERENCES TicketStatus(TicketStatusID);
	
ALTER TABLE Tickets 
	ADD CONSTRAINT FK_Tickets_Customers
	FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID);
	
ALTER TABLE CustomerContacts 
	ADD CONSTRAINT FK_CustomerContacts_Customer
	FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID);
		
ALTER TABLE CustomerEmailRules 
	ADD CONSTRAINT FK_CustomerEmailRule_Customer
	FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID);

ALTER TABLE Users 
	ADD CONSTRAINT FK_User_UserRoles
	FOREIGN KEY (UserRoleID) REFERENCES UserRoles(UserRoleID);

ALTER TABLE Users 
	ADD CONSTRAINT FK_User_Customers
	FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID);



insert into UserRoles (UserRoleID, RoleName, PermissionLevel) values (1, 'Admin', 1);
insert into UserRoles (UserRoleID, RoleName, PermissionLevel) values (2, 'Ticketeer', 2);
insert into UserRoles (UserRoleID, RoleName, PermissionLevel) values (3, 'User', 10);

/*
5f202e7ab75f00af194c61cc07ae6b0c = groovy
*/
insert into Customers (CustomerID, CustomerName, Address1, Address2, City, State, Zip, IsActive) values (1, 'Simple Help Desk', '', '', '', '', '', 1);

insert into CustomerContacts (CustomerContactID, CustomerID, FirstName, LastName, Phone, Email, IsActive) values (1, 1, 'James', 'Todd', '', 'toddwebnet@gmail.com', 1);

insert Users (UserID, CustomerID, Email, Password, FirstName, LastName, UserRoleID, IsActive) values (1, 1, 'toddwebnet@gmail.com', '5f202e7ab75f00af194c61cc07ae6b0c', 'James', 'Todd', 1, 1);

insert into TicketStatus (TicketStatusID, StatusName, IsActive) values (1, 'New', 1);
insert into TicketStatus (TicketStatusID, StatusName, IsActive) values (2, 'Working', 1);
insert into TicketStatus (TicketStatusID, StatusName, IsActive) values (3, 'Waiting', 1);
insert into TicketStatus (TicketStatusID, StatusName, IsActive) values (4, 'Closed', 1);


insert into TicketGroups (TicketGroupID, GroupName, IsActive) values (1, 'Email', 1);
insert into TicketGroups (TicketGroupID, GroupName, IsActive) values (2, 'Computer Hardware', 1);
insert into TicketGroups (TicketGroupID, GroupName, IsActive) values (3, 'Environmental Controls', 1);
insert into TicketGroups (TicketGroupID, GroupName, IsActive) values (4, 'Psychological Malfunction', 1);

