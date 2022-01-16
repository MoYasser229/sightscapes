<?php
 $conn=new mysqli("localhost","root","","project");
$query="INSERT IGNORE INTO Question (questionText,questionType,questionConnotation)
VALUES
('How old are you?', 'demographics','null' ),
('What is your gender?', 'demographics','null' ),
('Are you currently employed?', 'demographics','null' ),

('Which of the following words would you use to describe our services? *','services and staff','null' ),
('How well do our services meet your needs? *','services and staff','null' ),
('How responsive have we been to your questions or concerns? *','services and staff','null' ),

('How easy is it to navigate on our website? *','website feedback','null' ),
('Do you find the trips we offer relevant to your preference? *','website feedback','2'),
('Did you face any issues on our website? *','website feedback','0'),

('How would you rate the site quality? *','post-trip','null' ),
('How would you rate the food quality? *','post-trip','null' ),
('How would you rate the equipment quality? *','post-trip','null' ),
('How would you rate the overall cleanliness of the trip? *','post-trip','null' ),
('How would you rate the tour guide? *','post-trip','null' ),
('What is your overall trip rating? *','post-trip','null' ),

('Help us understand why you chose the answer above..','other','null'),
('Do you have any other comments, questions, or concerns?','other','null');";
$result=$conn->query($query);
if(!$result)
die("Error: ".$conn->error);
?>