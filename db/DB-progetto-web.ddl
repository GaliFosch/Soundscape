-- *********************************************
-- * Standard SQL generation
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2
-- * Generator date: Sep 14 2021
-- * Generation date: Sat May  4 18:09:05 2024
-- * LUN file: C:\Users\gali2\Desktop\DB-progetto-web.lun
-- * Schema: schema-cleaned-DB/SQL
-- *********************************************


-- Database Section
-- ________________
drop database if exists SoundscapeDB;
create database SoundscapeDB;
use SoundscapeDB;

-- DBSpace Section
-- _______________


-- Tables Section
-- _____________

create table Belonging (
     GenreTag varchar(30) not null,
     TrackID int not null,
     constraint ID_Belonging_ID primary key (GenreTag, TrackID));

create table COMMENT (
     CommentID int not null auto_increment,
     CommentText varchar(500) not null,
     CommentTimestamp Timestamp not null default current_timestamp,
     Parent int,
     Username varchar(30) not null,
     PostID int not null,
     constraint ID_COMMENT_ID primary key (CommentID));

create table GENRE (
     GenreTag varchar(30) not null,
     constraint ID_GENRE_ID primary key (GenreTag));

create table NOTIFICATION (
     NotificationID int not null auto_increment,
     CommentID int,
     NotificationTimestamp timestamp not null default current_timestamp,
     Type enum("Follower", "Post", "Post_Interaction", "Reply") not null,
     Receiver varchar(30) not null,
     TriggeringUser varchar(30) not null,
     PostID int,
     constraint ID_NOTIFICATION_ID primary key (NotificationID),
     constraint SID_NOTIF_COMME_ID unique (CommentID));

create table PLAYLIST (
     NumTracks int not null default 0,
     PlaylistID int not null auto_increment,
     Name varchar(30) not null,
     CoverImage varchar(50),
     TimeLength time not null default 0,
     CreationDate datetime not null default current_timestamp,
     Creator varchar(30) not null,
     IsAlbum bool not null default false,
     constraint ID_PLAYLIST_ID primary key (PlaylistID));

create table POST (
     PostID int not null auto_increment,
     Caption varchar(500) not null,
     NumLike int not null default 0,
     NumComments int not null default 0,
     PostTimestamp Timestamp not null default current_timestamp,
     TrackID int,
     PlaylistID int,
     Username varchar(30) not null,
     constraint ID_POST_ID primary key (PostID));

create table Image (
     PostImage varchar(50) not null,
     PostID int not null,
     constraint ID_Image_ID primary key (PostImage));

create table SINGLE_TRACK (
     AudioFile varchar(50) not null,
     TrackID int not null auto_increment,
     Name varchar(30) not null,
     CoverImage varchar(50),
     TimeLength time not null,
     CreationDate datetime not null default current_timestamp,
     Creator varchar(30) not null,
     constraint ID_SINGLE_TRACK_ID primary key (TrackID));

create table USER (
     Username varchar(30) not null,
     Biography Text not null,
     ProfileImage varchar(50),
     Email varchar(30) not null,
     NumFollower int not null default '0',
     NumFollowing int not null default '0',
     Password char(128) not null,
     Salt char(128) not null,
     constraint ID_USER_ID primary key (Username));

create table LoginAttempt (
     Username varchar(30) not null,
     Time varchar(30) not null,
     constraint ID_LoginAttempt_ID primary key (Username, Time));

create table Follow (
     Following varchar(30) not null,
     Follower varchar(30) not null,
     constraint ID_Follow_ID primary key (Following, Follower));

create table PostLike (
     PostID int not null,
     Username varchar(30) not null,
     constraint ID_PostLike_ID primary key (PostID, Username));

create table Tracklist (
     TrackID int not null,
     PlaylistID int not null,
     Position int not null,
     constraint ID_Tracklist_ID primary key (TrackID, PlaylistID));

-- Constraints Section
-- ___________________

alter table Belonging add constraint EQU_Belon_SINGL_FK
     foreign key (TrackID)
     references SINGLE_TRACK(TrackID);

alter table Belonging add constraint REF_Belon_GENRE
     foreign key (GenreTag)
     references GENRE(GenreTag);

alter table COMMENT add constraint REF_COMME_COMME_FK
     foreign key (Parent)
     references COMMENT(CommentID);

alter table COMMENT add constraint REF_COMME_USER_FK
     foreign key (Username)
     references USER(Username);

alter table COMMENT add constraint REF_COMME_POST_FK
     foreign key (PostID)
     references POST(PostID);

alter table NOTIFICATION add constraint REF_NOTIF_USER_1_FK
     foreign key (Receiver)
     references USER(Username);

alter table NOTIFICATION add constraint REF_NOTIF_USER_FK
     foreign key (TriggeringUser)
     references USER(Username);

alter table NOTIFICATION add constraint SID_NOTIF_COMME_FK
     foreign key (CommentID)
     references COMMENT(CommentID);

alter table NOTIFICATION add constraint REF_NOTIF_POST_FK
     foreign key (PostID)
     references POST(PostID);

alter table PLAYLIST add constraint REF_PLAYL_USER_FK
     foreign key (Creator)
     references USER(Username);

alter table POST add constraint REF_POST_SINGL_FK
     foreign key (TrackID)
     references SINGLE_TRACK(TrackID);

alter table POST add constraint REF_POST_PLAYL_FK
     foreign key (PlaylistID)
     references PLAYLIST(PlaylistID);

alter table POST add constraint REF_POST_USER_FK
     foreign key (Username)
     references USER(Username);

alter table Image add constraint REF_Image_POST_FK
     foreign key (PostID)
     references POST(PostID);

alter table SINGLE_TRACK add constraint REF_SINGL_USER_FK
     foreign key (Creator)
     references USER(Username);

alter table LoginAttempt add constraint REF_LoginA_USER_FK
     foreign key (Username)
     references USER(Username);

alter table Follow add constraint REF_Follo_USER_1_FK
     foreign key (Follower)
     references USER(Username);

alter table Follow add constraint REF_Follo_USER
     foreign key (Following)
     references USER(Username);

alter table PostLike add constraint REF_PostLike_USER_FK
     foreign key (Username)
     references USER(Username);

alter table PostLike add constraint REF_PostLike_POST
     foreign key (PostID)
     references POST(PostID);

alter table Tracklist add constraint REF_Track_PLAYL_FK
     foreign key (PlaylistID)
     references PLAYLIST(PlaylistID);

alter table Tracklist add constraint REF_Track_SINGL
     foreign key (TrackID)
     references SINGLE_TRACK(TrackID);


-- Index Section
-- _____________

create unique index ID_Belonging_IND
     on Belonging (GenreTag, TrackID);

create index EQU_Belon_SINGL_IND
     on Belonging (TrackID);

create unique index ID_COMMENT_IND
     on COMMENT (CommentID);

create index REF_COMME_COMME_IND
     on COMMENT (Parent);

create index REF_COMME_USER_IND
     on COMMENT (Username);

create index REF_COMME_POST_IND
     on COMMENT (PostID);

create unique index ID_GENRE_IND
     on GENRE (GenreTag);

create unique index ID_NOTIFICATION_IND
     on NOTIFICATION (NotificationID);

create index REF_NOTIF_USER_1_IND
     on NOTIFICATION (Receiver);

create index REF_NOTIF_USER_IND
     on NOTIFICATION (TriggeringUser);

create unique index SID_NOTIF_COMME_IND
     on NOTIFICATION (CommentID);

create index REF_NOTIF_POST_IND
     on NOTIFICATION (PostID);

create unique index ID_PLAYLIST_IND
     on PLAYLIST (PlaylistID);

create index REF_PLAYL_USER_IND
     on PLAYLIST (Creator);

create unique index ID_POST_IND
     on POST (PostID);

create index REF_POST_SINGL_IND
     on POST (TrackID);

create index REF_POST_PLAYL_IND
     on POST (PlaylistID);

create index REF_POST_USER_IND
     on POST (Username);

create unique index ID_Image_IND
     on Image (PostImage);

create index REF_Image_POST_IND
     on Image (PostID);

create unique index ID_SINGLE_TRACK_IND
     on SINGLE_TRACK (TrackID);

create index REF_SINGL_USER_IND
     on SINGLE_TRACK (Creator);

create unique index ID_USER_IND
     on USER (Username);

create unique index ID_LOGINATTEMPT_IND
     on LoginAttempt(Username, Time);

create unique index ID_Follow_IND
     on Follow (Following, Follower);

create index REF_Follo_USER_1_IND
     on Follow (Follower);

create unique index ID_PostLike_IND
     on PostLike (PostID, Username);

create index REF_PostLike_USER_IND
     on PostLike (Username);

create unique index ID_Tracklist_IND
     on Tracklist (TrackID, PlaylistID);

create index REF_Track_PLAYL_IND
     on Tracklist (PlaylistID);