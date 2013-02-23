USE [ClimbItDB]
GO

CREATE TABLE StoneType (
StoneTypeID nchar(3) CONSTRAINT pk_StoneType_pid PRIMARY KEY,
StoneTypeName varchar(50),
StoneTypeDescr varchar(max),
)

CREATE TABLE Area (
AreaID nchar(6) not null CONSTRAINT pk_Area_pid PRIMARY KEY,
StoneTypeID nchar(3) not null CONSTRAINT fk1_Area_sid FOREIGN KEY REFERENCES StoneType(StoneTypeID),
AreaName varchar(50) not null,
AreaDescr varchar(max),
AreaState nchar(2) not null,
AreaCity varchar(50),
AreaLan float not null,
AreaLon float not null,
ApproachTime varchar(50)
)


CREATE TABLE Crag (
CragID nchar(6) not null CONSTRAINT pk_Crag_pid PRIMARY KEY,
AreaID nchar(6) not null CONSTRAINT fk1_Crag_sid FOREIGN KEY REFERENCES Area(AreaID),
StoneTypeID nchar(3) not null CONSTRAINT fk2_Crag_sid FOREIGN KEY REFERENCES StoneType(StoneTypeID),
CragName varchar(50) not null,
CragDescr varchar(max),
)


CREATE TABLE Route (
RouteID nchar(7) not null CONSTRAINT pk_Route_pid PRIMARY KEY,
CragID nchar(6) not null CONSTRAINT fk1_Route_sid FOREIGN KEY REFERENCES Crag(CragID),
RouteName varchar(100) not null,
RouteDescr varchar(max),
RouteType varchar(20),
Grade varchar(10),
Pitches int,
Height varchar(20)
)


CREATE TABLE [dbo].[User] (
UserID varchar(50) not null CONSTRAINT pk_User_pid PRIMARY KEY,
FirstName varchar(50),
LastName varchar(50),
Password varchar(50)
)



CREATE TABLE Climb (
ClimbID nchar(6) not null CONSTRAINT pk_Climb_pid PRIMARY KEY,
UserID varchar(50) not null CONSTRAINT fk1_Climb_fid FOREIGN KEY REFERENCES [dbo].[User](UserID),
ClimbStatus varchar(50) not null,
StartDateTime datetime,
CompleteDateTime datetime,
Rating nchar(10),
Notes varchar(max)
)

CREATE TABLE Attempt (
AttemptID nchar(8) not null CONSTRAINT pk_Attempt_pid PRIMARY KEY,
ClimbID nchar(6) not null CONSTRAINT fk1_Attempt_sid FOREIGN KEY REFERENCES [dbo].[Climb](ClimbID),
RouteID nchar(7) not null CONSTRAINT fk2_Attempt_sid FOREIGN KEY REFERENCES [dbo].[Route](RouteID),
StartDateTime datetime not null, 
EndDateTime datetime not null,
Duration varchar(10),
EffortRating nchar(5),
AttemptStatus varchar(20),
Note varchar(max)
)

GO



drop table climb