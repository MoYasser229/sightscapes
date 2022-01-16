<?php
    /////////////CREATE DATABASE/////////////

    $conn=new mysqli("localhost","root","");
    if($conn->connect_error)
    die ("Connection failed: ".$conn->connect_error);

    $sql="CREATE DATABASE IF NOT EXISTS project;";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("Connection failed: ".$conn->connect_error);

    /////////////////SURVEY/////////////////
    $sql="CREATE TABLE IF NOT EXISTS Survey(
        surveyID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        surveyType VARCHAR(50) UNIQUE KEY,
        startDate DATE,
        endDate DATE,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        isOpen BOOLEAN
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);
    
    $sql="CREATE TABLE IF NOT EXISTS Question(
        questionID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        questionText VARCHAR(100) NOT NULL UNIQUE,
        questionType VARCHAR(50) NOT NULL
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS offeredAnswer(
        offeredAnswerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        offeredAnswerText VARCHAR(100) NOT NULL UNIQUE,
        offeredAnswerType VARCHAR(50) NOT NULL 
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    //////////////////////USERS//////////////////////

    $sql="CREATE TABLE IF NOT EXISTS Users(
        userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(170) NOT NULL,
        lname VARCHAR(170) NOT NULL,
        email VARCHAR(320) NOT NULL UNIQUE,
        pswrd CHAR(32) NOT NULL, 
        pic VARCHAR(400),
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        modifiedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        userRole VARCHAR(10) NOT NULL DEFAULT 'Hiker' 
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);
    
    /////////////////CHAT/////////////////

    $sql="CREATE TABLE IF NOT EXISTS Chat(
        chatID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        senderID INT NOT NULL,
        receiverID INT NOT NULL,
        chatType VARCHAR(50) NOT NULL,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (senderID) REFERENCES Users(userID) ON DELETE CASCADE,
        FOREIGN KEY (receiverID) REFERENCES Users(userID) ON DELETE CASCADE
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS Msg(
        msgID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        msgText VARCHAR(255) NOT NULL,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        seen BOOLEAN NOT NULL,
        chatID INT NOT NULL,
        recieverID INT NOT NULL,
        senderID INT NOT NULL,
        auditorComment VARCHAR(255),
        FOREIGN KEY (chatID) REFERENCES chat(chatID) ON DELETE CASCADE,
        FOREIGN KEY (recieverID) REFERENCES Users(userID),
        FOREIGN KEY (senderID) REFERENCES Users(userID)
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);
    //HR//
    $sql="CREATE TABLE IF NOT EXISTS Warnings(
        warningID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        chatID INT NOT NULL,
        userID INT NOT NULL,
        report BOOLEAN NOT NULL,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE,
        FOREIGN KEY (chatID) REFERENCES chat(chatID) ON DELETE CASCADE
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS groupRec(
        recID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        pic VARCHAR(400),
        link VARCHAR(400),
        loc VARCHAR(150) NOT NULL,
        descrip VARCHAR(600) NOT NULL,
        userID INT NOT NULL,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    /////////////////GROUPS/////////////////

    $sql="CREATE TABLE IF NOT EXISTS Groups(
        GID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        price VARCHAR(50) NOT NULL,
        avgrating INT NOT NULL DEFAULT 0,
        loc VARCHAR(150) NOT NULL, 
        departureTime DATE NOT NULL,
        arrivalTime DATE NOT NULL,
        descrip TEXT NOT NULL,
        diffLevel TINYINT(1),
        grpSize INT NOT NULL DEFAULT 0,
        distance VARCHAR(30) NOT NULL,
        tripLength VARCHAR(30) NOT NULL,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        modifiedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        pic TEXT NOT NULL
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql ="CREATE TABLE IF NOT EXISTS Orders(
        OrderID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        GID INT NOT NULL,
        userID INT,
        orderStatus BOOLEAN NOT NULL DEFAULT FALSE,
        totalPrice VARCHAR(50) NOT NULL,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        modifiedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE SET NULL
    );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    /////////////////REVIEWS/////////////////

    $sql="CREATE TABLE IF NOT EXISTS Reviews(
        reviewID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        GID INT NOT NULL,
        userID INT NOT NULL,
        reviewText VARCHAR(255),
        rating INT NOT NULL,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        modifiedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (GID) REFERENCES Groups(GID) ON DELETE CASCADE,
        FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS Answer(
        surveyID INT NOT NULL,
        questionID INT NOT NULL,
        offeredAnswerID INT NOT NULL,
        userID INT NOT NULL,
        otherText VARCHAR(255),
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        modifiedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (surveyID,questionID,offeredAnswerID,userID),
        FOREIGN KEY (surveyID) REFERENCES Survey(surveyID) ON DELETE CASCADE,
        FOREIGN KEY (questionID) REFERENCES Question(questionID) ON DELETE CASCADE,
        FOREIGN KEY (offeredAnswerID) REFERENCES offeredAnswer(offeredAnswerID) ON DELETE CASCADE,
        FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $sql="CREATE TABLE IF NOT EXISTS Errors(
        errorID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        errorMessage VARCHAR(255) NOT NULL,
        createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        );";
    if($conn->query($sql)===FALSE)
    die("Error: ".$conn->error);

    $conn->close();
?>