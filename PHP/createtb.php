<?php
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");
    /////////////////survey/////////////////
    $sql="CREATE TABLE IF NOT EXISTS Survey(
        surveyID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        surveyType TEXT UNIQUE KEY,
        startDate DATE,
        endDate DATE,
        isOpen BOOLEAN
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);
    
    $sql="CREATE TABLE IF NOT EXISTS Question(
        questionID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        questionText TEXT NOT NULL UNIQUE,
        questionType TEXT NOT NULL
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS offeredAnswer(
        offeredAnswerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        offeredAnswerText TEXT NOT NULL UNIQUE,
        offeredAnswerType TEXT NOT NULL 
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    
    

    //////////////////////USERS//////////////////////
    //personname instead of personid
    $sql="CREATE TABLE IF NOT EXISTS Hikers(
        hikerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fname TEXT NOT NULL,
        lname TEXT NOT NULL,
        email TEXT NOT NULL,
        pswrd TEXT NOT NULL,
        pic TEXT
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS Admins(
        adminID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fname TEXT NOT NULL,
        lname TEXT NOT NULL,
        email TEXT NOT NULL,
        pswrd TEXT NOT NULL,
        pic TEXT 
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS Auditors(
        auditorID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fname TEXT NOT NULL,
        lname TEXT NOT NULL,
        email TEXT NOT NULL,
        pswrd TEXT NOT NULL,
        pic TEXT
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS HRs(
        hrID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fname TEXT NOT NULL,
        lname TEXT NOT NULL,
        email TEXT NOT NULL,
        pswrd TEXT,
        pic TEXT
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);
    
    //
    ////////////////////////////////////////////////////////////

    /////////////////chat/////////////////

    // $sql="CREATE TABLE IF NOT EXISTS chat(
    //     chatID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     hikerID INT NOT NULL ,
    //     adminID INT NOT NULL ,
    //     auditorID INT ,
    //     chatText TEXT NOT NULL,
    //     chatTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    //     FOREIGN KEY (hikerID) REFERENCES Hikers(hikerID),
    //     FOREIGN KEY (adminID) REFERENCES Admins(adminID), 
    //     FOREIGN KEY (auditorID) REFERENCES Auditors(auditorID)
    //     );";
    // if($conn->query($sql)===FALSE)
    // die("Error: ".$conn->error);
// //HR//

        $sql="CREATE TABLE IF NOT EXISTS Warnings(
            warningID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            hikerID INT NOT NULL ,
            adminID INT NOT NULL,
            auditorID INT NOT NULL,
            hrID INT NOT NULL,
            report boolean NOT NULL,
            FOREIGN KEY (adminID) REFERENCES Admins(adminID)
            );";
        if($conn->query($sql)===FALSE)
        die("Error: ".$conn->error);

//     $sql="CREATE TABLE IF NOT EXISTS groupRec(
//         recID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
//         Picture TEXT,
//         Link TEXT ,
//         Loc TEXT NOT NULL,
//         FOREIGN KEY (ID) REFERENCES person(ID)
//         );";
//     if($conn->query($sql)===FALSE)
//     die("Error: ".$conn->error);

    

    /////////////////GROUPS/////////////////

    $sql="CREATE TABLE IF NOT EXISTS Groups(
        GID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        price INT NOT NULL,
        rating INT,
        Loc TEXT NOT NULL, 
        departureTime DATE NOT NULL,
        arrivalTime DATE NOT NULL,
        descrip TEXT NOT NULL,
        pic TEXT NOT NULL
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS Hikers_Group(
        GID INT NOT NULL,
        hikerID INT NOT NULL,
        PRIMARY KEY (GID,hikerID),
        FOREIGN KEY (GID) REFERENCES Groups(GID),
        FOREIGN KEY (hikerID) REFERENCES Hikers(hikerID)
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    /////////////////REVIEWS/////////////////

    $sql="CREATE TABLE IF NOT EXISTS Reviews(
        reviewID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        GID INT NOT NULL ,
        hikerID INT NOT NULL,
        reviewText VARCHAR(255),
        rating INT NOT NULL,
        FOREIGN KEY (GID) REFERENCES Groups(GID),
        FOREIGN KEY (hikerID) REFERENCES Hikers(hikerID)
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);
    $sql="CREATE TABLE IF NOT EXISTS Answer(
        surveyID INT NOT NULL ,
        questionID INT NOT NULL,
        offeredAnswerID INT NOT NULL ,
        hikerID INT NOT NULL ,
        otherText TEXT,
        PRIMARY KEY (surveyID,questionID,offeredAnswerID,hikerID),
        FOREIGN KEY (surveyID) REFERENCES Survey(surveyID),
        FOREIGN KEY (questionID) REFERENCES Question(questionID),
        FOREIGN KEY (offeredAnswerID) REFERENCES offeredAnswer(offeredAnswerID),
        FOREIGN KEY (hikerID) REFERENCES Hikers(hikerID)
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);
    /////////////////CART/////////////////
    
    $sql="CREATE TABLE IF NOT EXISTS cart(
        cartID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        GID INT NOT NULL,
        hikerID INT NOT NULL ,
        FOREIGN KEY (GID) REFERENCES Groups(GID),
        FOREIGN KEY (hikerID) REFERENCES Hikers(hikerID)
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);
    
?>