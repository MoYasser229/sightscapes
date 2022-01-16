<?php
$q="INSERT IGNORE INTO offeredAnswer(offeredAnswerText,offeredAnswerType,answerConnotation)
VALUES('Under 18 years old', 'demographics','null'),
('18 - 24 years old', 'demographics','null'),
('25 - 34 years old', 'demographics','null'),
('35 - 44 years old', 'demographics','null'),
('Above 45', 'demographics','null'),

('Male', 'demographics','null'),
('Female', 'demographics','null'),

('Yes','other','2'),
('No','other','0'),

('Ineffective','services and staff','0'),
('Reliable','services and staff','2'),
('Useful','services and staff','2'),
('Overpriced','services and staff','0'),
('Good value for money','services and staff','2'),

('1','other','0'),
('2','other','0'),
('3','other','1'),
('4','other','2'),
('5','other','2'),

('none','other', 'null');";
$resultt=$conn->query($q);
if(!$resultt)
die("Error: ".$conn->error);

// $query="SELECT loc FROM Groups WHERE ((departureTime+tripLength) < CURRENT_DATE())
//         OR ((departureTime+tripLength) = CURRENT_DATE() AND (TIME(departureTime)) <= CURRENT_TIME())";
//         $rs=$conn->query($query);
//         while($row=$rs->fetch_assoc()){
//             $loc=$row['loc'];
//             $query="INSERT IGNORE INTO offeredAnswer(offeredAnswerText,offeredAnswerType,answerConnotation)
//             VALUES('$loc','trip info','1');"; 

//         }


?>