<?php
$query="INSERT IGNORE INTO Question (questionText,questionType)
VALUES
('How old are you?','demographics'),
('What is your gender?','demographics'),
('Are you currently employed?','demographics'),

('Which of the following words would you use to describe our services? *','services and staff'),
('How well do our services meet your needs? *','services and staff'),
('How responsive have we been to your questions or concerns? *','services and staff'),

('How easy is it to navigate on our website? *','website feedback'),
('Do you find the trips we offer relevant to your preference? *','website feedback'),
('Did you face any issues on our website? *','website feedback'),

('Help us understand why you chose the answer above..','other'),
('Do you have any other comments, questions, or concerns?','other');";
$result=$conn->query($query);
if(!$result)
die("Error: ".$conn->error);
?>