

CREATE DATABASE EITS COLLATE utf8_general_ci;
USE EITS;
CREATE TABLE Government(
    Gov_id int(10)  AUTO_INCREMENT,
    Gov_username VARCHAR(70)  not null UNIQUE,
    Fname VARCHAR(30)  not null,
    Lname VARCHAR(70)  not null,
    Email VARCHAR(50) not null,
    Password VARCHAR(30) not null,
    PRIMARY KEY(Gov_id)
    );

CREATE TABLE Rp_Specs(
    Mac VARCHAR(50) not null UNIQUE,
    Ram int(10) not null ,
    Storage int(20) not null ,
    HasCamera TINYINT(1) not null,
    Generation VARCHAR(10) not null,
    Location TEXT not null,

    PRIMARY KEY(Mac)
    );

CREATE TABLE IPs(
    Mac VARCHAR(50) not null UNIQUE,
    IpAddress VARCHAR(30) not null,
    Rpi_id int(10) not null,
    PRIMARY KEY(IpAddress,Mac)
    );


CREATE TABLE Current_Specs(
    Mac VARCHAR(50) not null UNIQUE,
    FreeStorage INT(20) not null,
    CpuUsage  DECIMAL(4,4) not null,
    Temperature INT(5) not null,
    State INT(5) not null,
    PRIMARY KEY(Mac)
    );
    
    

CREATE TABLE Rp_Log(
    Mac VARCHAR(50) not null UNIQUE,
    Jobs_Num  INT(20),
    Start_time datetime NOT NULL DEFAULT NOW(),
    PRIMARY KEY(Mac)
    );

CREATE TABLE Criminals(
    Crim_id int(10)  AUTO_INCREMENT,
    Mname VARCHAR(30)  not null,
    Fname VARCHAR(30)  not null,
    Lname VARCHAR(70)  not null,
    Dir_path TEXT,
    PRIMARY KEY(Crim_id)
    );

CREATE TABLE Gov_Log(
    Gov_id int(10),
    Gov_username VARCHAR(70)  not null,
    Action int(5) not null,
    Start_time datetime NOT NULL DEFAULT NOW(),
    Crim_id int(10)  not null,
  
    PRIMARY KEY(Gov_id , Start_time)
    );


CREATE TABLE Process(
    Img_id int(20) not null UNIQUE,
    Process_name VARCHAR(40) not null,
    Cont_id int(20) not null UNIQUE,
    Cont_IP VARCHAR(20) not null,
    Mac VARCHAR(50) not null ,
    User_id int(20) not null ,
    Size int(10) not null,
    Start_time datetime NOT NULL DEFAULT NOW(),
    Process_State int(5) not null,
    PRIMARY KEY(Process_name , Img_id)
    );

CREATE TABLE User(
    User_id int(10)  AUTO_INCREMENT,
    User_username VARCHAR(70)  not null UNIQUE,
    Fname VARCHAR(30)  not null,
    Lname VARCHAR(70)  not null,
    Email VARCHAR(50) not null,
    Password VARCHAR(30) not null,
    Premuim TINYINT(1),
    Join_Date datetime NOT NULL DEFAULT NOW(),
    PRIMARY KEY(User_id)
    );

CREATE TABLE User_Log(
    User_id int(10) ,
    Img_id int(20) not null ,
    Process_name VARCHAR(40) not null,
    PRIMARY KEY(User_id , Img_id)
    );


CREATE TABLE Admin(
    Admin_id int(10)  AUTO_INCREMENT,
    Admin_username VARCHAR(70)  not null UNIQUE,
    Fname VARCHAR(30)  not null,
    Lname VARCHAR(70)  not null,
    Email VARCHAR(50) not null,
    Password VARCHAR(30) not null,
    Join_Date datetime NOT NULL DEFAULT NOW(),
    PRIMARY KEY(Admin_id)
 );


CREATE TABLE Admin_Log(
    Admin_id int(10) ,
    Img_id int(20) not null ,
    The_Actions VARCHAR(40) ,
    Mac VARCHAR(50) not null ,
    Action_time datetime NOT NULL DEFAULT NOW(),
    PRIMARY KEY(Admin_id , Action_time),
    CONSTRAINT chk_Action CHECK (The_Actions IN ('Add Raspberry pi', 'Remove Raspberry pi', 'Add container', 'Remove container'))
    );




ALTER TABLE IPs ADD FOREIGN KEY (Mac) REFERENCES
Rp_Specs(Mac);


ALTER TABLE Current_Specs ADD FOREIGN KEY (Mac) REFERENCES
Rp_Specs(Mac);

ALTER TABLE Rp_Log ADD FOREIGN KEY (Mac) REFERENCES
Rp_Specs(Mac);


ALTER TABLE Gov_Log ADD FOREIGN KEY (Gov_id) REFERENCES
Government(Gov_id);

ALTER TABLE Gov_Log ADD FOREIGN KEY (Crim_id) REFERENCES
Criminals(Crim_id);

ALTER TABLE Process ADD FOREIGN KEY (Mac) REFERENCES
Rp_Specs(Mac);


ALTER TABLE Process ADD FOREIGN KEY (User_id) REFERENCES
User(User_id);

ALTER TABLE User_Log ADD FOREIGN KEY (User_id) REFERENCES
User(User_id);


ALTER TABLE User_Log ADD FOREIGN KEY (Img_id) REFERENCES
Process(Img_id);


ALTER TABLE User_Log ADD FOREIGN KEY (Process_name) REFERENCES
Process(Process_name);


ALTER TABLE Admin_Log ADD FOREIGN KEY (Admin_id) REFERENCES
Admin(Admin_id);


ALTER TABLE Admin_Log ADD FOREIGN KEY (Img_id) REFERENCES
Process(Img_id);


ALTER TABLE Admin_Log ADD FOREIGN KEY (Mac) REFERENCES
Rp_Specs(Mac);

