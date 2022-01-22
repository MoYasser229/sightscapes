<?php
$q="INSERT IGNORE INTO offeredAnswer(offeredAnswerText,offeredAnswerType,answerConnotation)
VALUES('Under 18 years old', 'demographics','null'),
('18 - 24 years old', 'demographics','null'),
('25 - 34 years old', 'demographics','null'),
('35 - 44 years old', 'demographics','null'),
('Above 45', 'demographics','null'),

('Male', 'demographics','null'),
('Female', 'demographics','null'),

('Yes','other','3'),
('No','other','1'),

('Ineffective','services and staff','1'),
('Reliable','services and staff','3'),
('Useful','services and staff','3'),
('Overpriced','services and staff','1'),
('Good value for money','services and staff','3'),

('1','other','1'),
('2','other','1'),
('3','other','2'),
('4','other','3'),
('5','other','3'),

('none','other', 'null');";
$resultt=$conn->query($q);
if(!$resultt)
die("Error: ".$conn->error);

?>