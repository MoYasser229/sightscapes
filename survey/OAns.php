<?php
$q="INSERT IGNORE INTO offeredAnswer(offeredAnswerText,offeredAnswerType)
VALUES('Under 18 years old','demographics'),
('18 - 24 years old','demographics'),
('25 - 34 years old','demographics'),
('35 - 44 years old','demographics'),
('Above 45','demographics'),

('Male','demographics'),
('Female','demographics'),

('Yes','other'),
('No','other'),

('Ineffective','services and staff'),
('Reliable','services and staff'),
('Useful','services and staff'),
('Overpriced','services and staff'),
('Good value for money','services and staff'),

('1','other'),
('2','other'),
('3','other'),
('4','other'),
('5','other'),

('none','other');";
$resultt=$conn->query($q);
if(!$resultt)
die("Error: ".$conn->error);


?>