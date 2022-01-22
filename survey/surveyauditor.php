<?php session_start(); $conn = new mysqli("localhost","root","","project"); 
include_once '../errorHandler/errorHandlers.php'; set_error_handler("customError",E_ALL); 
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="../styles/surveyauditor.css" rel="stylesheet" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscapes</title>
    </head>
<body style='background-color: #071a20; overflow-x:hidden; width: 100%; height: 100%;'>
    <div class="lastsur" style="cursor:default">Last Survey Analysis</div>
    <button id="sendsurvey" > <div class="sendsurveytext" style="cursor:pointer"> Send Survey </div></button>
    <div class="analysisbox"> 

    <?php $ssb=0; $psb=0;$ssalreadythere=false; ?>

    <?php
        $query="SELECT DISTINCT surveyType FROM survey";
        $rs=$conn->query($query);
        $numofgroups=mysqli_num_rows($rs);
        if($numofgroups==0){
        ?>
            <div class="lastsur" style="cursor:default;top: 45%;left: 25%;">No surveys were added..</div></div>
    <?php } else if($numofgroups>=1){
             ?>
            <?php /////button to view surv info n comp view surv resp
            $sql="SELECT surveyID FROM survey ORDER BY createdAt DESC LIMIT 1";
            $result=$conn->query($sql);
            if($result)
            $row=implode($result->fetch_assoc());
            if($row){
                $sql1="SELECT COUNT(DISTINCT userID) FROM answer WHERE surveyID='$row'";
                $result1=$conn->query($sql1);
                $all=implode($result1->fetch_assoc());
                if($all){
                    $sql2="SELECT COUNT(DISTINCT userID) FROM answer WHERE surveyID='$row' and completionStatus='1'";
                    $result2=$conn->query($sql2);
                    $comp=implode($result2->fetch_assoc());
                    // $incomp=$all-$comp;

                    $sql3="SELECT COUNT(a.offeredAnswerID) FROM answer as a,question as q,offeredanswer as oa WHERE a.surveyID='$row' and a.offeredAnswerID=oa.offeredAnswerID and a.questionID=q.questionID and q.questionConnotation='0' and oa.answerConnotation='3' and q.questionType!='demographics'";
                    $result3=$conn->query($sql3);
                    $pos=implode($result3->fetch_assoc());

                    $sql4="SELECT COUNT(a.offeredAnswerID) FROM answer as a,question as q,offeredanswer as oa WHERE a.surveyID='$row' and a.offeredAnswerID=oa.offeredAnswerID and a.questionID=q.questionID and q.questionConnotation='0' and oa.answerConnotation='2' and q.questionType!='demographics'";
                    $result4=$conn->query($sql4);
                    $neutral=implode($result4->fetch_assoc());

                    $sql5="SELECT COUNT(a.offeredAnswerID) FROM answer as a,question as q,offeredanswer as oa WHERE a.surveyID='$row' and a.offeredAnswerID=oa.offeredAnswerID and a.questionID=q.questionID and q.questionConnotation=oa.answerConnotation and q.questionConnotation!='0' and q.questionType!='demographics'";
                    $result5=$conn->query($sql5);
                    $pos1=implode($result5->fetch_assoc());

                    $sql6="SELECT COUNT(a.offeredAnswerID) FROM answer as a,question as q,offeredanswer as oa WHERE a.surveyID='$row' and a.offeredAnswerID=oa.offeredAnswerID and a.questionID=q.questionID and q.questionConnotation!=oa.answerConnotation and q.questionConnotation!='0' and q.questionType!='demographics'";
                    $result6=$conn->query($sql6);
                    $neg1=implode($result6->fetch_assoc());

                    $sql7="SELECT COUNT(a.offeredAnswerID) FROM answer as a,question as q,offeredanswer as oa WHERE a.surveyID='$row' and a.offeredAnswerID=oa.offeredAnswerID and a.questionID=q.questionID and q.questionConnotation='0' and oa.answerConnotation='1' and q.questionType!='demographics'";
                    $result7=$conn->query($sql7);
                    $neg=implode($result7->fetch_assoc());

                    $pos+=$pos1;
                    $neg+=$neg1; 
                    $total=$pos+$neg+$neutral;
                    // echo "<script>alert($total,$pos,$neg,$neutral)</script>";
                    $comprate=(($comp/$all)*100);
                    $posperc=round(($pos/$total)*100);
                    $negperc=round(($neg/$total)*100);
                    $neutperc=round(($neutral/$total)*100);
                    $arr=array((0)=>array(('color')=>"#cb8f20",('perc')=>$posperc),  (1)=>array(('color')=>"#08171e",('perc')=>$negperc), (2) => array(('color')=>"#143649b6",('perc')=>$neutperc));
                    array_multisort((array_column($arr, 'perc')), SORT_ASC, $arr);
                    $mid=$arr[1]['perc']+$arr[0]['perc'];
                    $fcolor=$arr[0]['color'];
                    $scolor=$arr[1]['color'];
                    $tcolor=$arr[2]['color'];
                    
                    echo "<div class='piechart' style='background-image: conic-gradient( $fcolor 0deg {$arr[0]['perc']}"."%, $scolor  {$arr[0]['perc']}% $mid"."%, $tcolor 0 {$arr[2]['perc']}%);'></div>
                    <div class='pos'></div> <div class='perctext'>Positive Responses. ({$posperc}%) </div><div class='neut'></div> <div class='perctext'>Neutral Responses. ({$neutperc}%) </div> <div class='neg'></div> <div class='perctext'>Negative Responses. ({$negperc}%) </div> </div>
                    <div class='lastsur' style='cursor:default;top: 87%;left: 54%;font-size: 50px; color:#3d60718e;'>  {$comprate}% </div> <div class='lastsur' style='cursor:default;top: 90%;left: 63%;font-size: 30px; color:#3d60718e;'> completion rate. </div> </div>";
                
                }
                else { ?> <div class="lastsur" style="cursor:default;top: 45%;left: 25%;">No responses yet..</div> </div> <?php }
            }
        ?>
        <div class="lilboxes"> 
            <?php
            $row=mysqli_fetch_all($rs,MYSQLI_NUM) or die("Error: ".$conn->error);
            $row1=implode($row[0]);
            echo "<div class='lastsur' style='cursor:default;left: 57;top: 37%;font-size: 33;'>$row1</div>";
            echo "<button class='picksurvey' id='$row1 info' style='position:absolute;top:40%; left:55%; width:18%; text-align:center;'> <div class='picksurveytext1' style='cursor:pointer'>View Survey Info</div></button>";
            echo "<button class='picksurvey' id='$row1' style='position:absolute;top:40%; left:75%; width:22%;'> <div class='picksurveytext1' style='cursor:pointer'>View Survey Responses</div></button>";
            $sqlopen= "SELECT isOpen FROM survey WHERE surveyType='Satisfaction Survey'";
            $resultopen=$conn->query($sqlopen);
            if(mysqli_num_rows($resultopen) !== 0)
                $rowopen=implode($resultopen->fetch_assoc());
            if($row1=='Satisfaction Survey'&&$rowopen=='1'){
                $ssalreadythere=true;
            }
            ?>
        </div>
    <?php 
        if($numofgroups>1){?>
    <div class="lilboxes2">
        <?php
            if($row){
                $row2=implode($row[1]);
                echo "<div class='lastsur' style='cursor:default;left: 57;top: 37%;font-size: 33;'>$row2</div>";
                echo "<button class='picksurvey' id='$row2 info' style='position:absolute;top:40%; left:55%; width:18%; text-align:center;'> <div class='picksurveytext1' style='cursor:pointer'>View Survey Info</div></button>";
                echo "<button class='picksurvey' id='$row2' style='position:absolute;top:40%; left:75%; width:22%;'> <div class='picksurveytext1' style='cursor:pointer'>View Survey Responses</div></button>";
                
                if($row2=='Satisfaction Survey'&&$rowopen=='1'){
                    $ssalreadythere=true;
                }
            }
        }
        } ?>
    </div>

    <div id="popup1" class="overlay">
    	<div class="popup" id="popup">
    		<h2 style="cursor:default;">Pick a survey</h2>
            <button class="picksurvey"id="SS" > <div class="picksurveytext1" style="cursor:pointer" id="picksurveytext1"> Satisfaction Survey</div></button>
            <button class="picksurvey" id="PTS"> <div class="picksurveytext2" style="cursor:pointer" id="picksurveytext2"> Post-Trip Survey</div></button>
            <div class="picksurveytext3" name='dateslabel' style="cursor:default; left:5%;"> Start Date </div>
            <form method="POST" action="">
            <input type="date" id='date1' name='date1' style="left:5%;">
            <div class="picksurveytext3" name='dateslabel' style="cursor:default; left:53%;"> End Date </div>
            <input type="date" id='date2' name='date2' style="left:53%;">
            <?php
            $query="SELECT GID, loc FROM Groups WHERE ((arrivalTime) < CURRENT_DATE())OR ((arrivalTime) = CURRENT_DATE() AND (TIME(arrivalTime)) <= CURRENT_TIME())";
            $rs=$conn->query($query);
            $numofgroups=mysqli_num_rows($rs);
            $nogroups=true;
            if($numofgroups==0){
                $nogroups=false;
            }
            else
            {echo "<select id='searchlist' name='searchlist' id='searchlist' style='position: absolute;top: 65%;left: 27%;visibility: hidden; width:45%'>";
            while($row=$rs->fetch_assoc()){
                $loc=$row['loc'];
                $gid=$row['GID'];
                echo "<option value='$gid'> $gid $loc </option>";
            }
            echo "</select>";}
            ?>
            <input type='hidden' id='ssb' name='ssb' value='0'>
            <input type='hidden' id='psb' name='psb' value='0'>

            <button type='submit' name='send' class="picksurvey" style="position:absolute;top:75%; left:38%; width:20%;" id="send"> <div class="picksurveytext2" style="cursor:pointer; left:28%;" id="sendtext"> Send </div></button>
            </form>
            <a class="close" href="" onClick="close()">×</a>
    	</div>
    </div>

    <script>
        if(document.getElementById('Post-Trip Survey info')){
        document.getElementById('Post-Trip Survey info').addEventListener("click", viewpts);
        function viewpts(){
            window.location.replace('surveyresponses.php?viewinfo=Post-Trip Survey');
        }}
        if(document.getElementById('Satisfaction Survey info')){
        document.getElementById('Satisfaction Survey info').addEventListener("click", viewss);
        function viewss(){
            window.location.replace('surveyresponses.php?viewinfo=Satisfaction Survey');
        }}
        if(document.getElementById('Post-Trip Survey')){
        document.getElementById('Post-Trip Survey').addEventListener("click", viewpts);
        function viewpts(){
            window.location.replace('surveyresponses.php?view=Post-Trip Survey');
        }}
        if(document.getElementById('Satisfaction Survey')){
        document.getElementById('Satisfaction Survey').addEventListener("click", viewss);
        function viewss(){
            window.location.replace('surveyresponses.php?view=Satisfaction Survey');
        }}
        var popup1=document.getElementById('popup1');
        function close(){
            popup1.style.opacity='0';
            popup1.style.display='none';
        }
        document.getElementById('sendsurvey').addEventListener("click", send);
        function send(){
            popup1.style.visibility='visible';
            document.body.style.overflow='hidden';
            document.body.scrollTop =0;
        }
        var ssur=document.getElementById('SS');
        var sstext=document.getElementById('picksurveytext1');
        var ssalreadythere=false;
        <?php if($ssalreadythere==true) {?> ssalreadythere = true; <?php } ?>
        if(ssalreadythere==true) {
            ssur.style.backgroundColor = '#1d1d1d4e';
            ssur.style.borderColor = '#1d1d1d4e';
            ssur.style.cursor = 'default';
            sstext.style.color = '#747678';   
            sstext.style.cursor= 'default';
        }
        document.getElementById('SS').addEventListener("click", ss);
        var groups=true;
        <?php if($nogroups==false) {?> groups = false; <?php } ?>
        if(groups==false) {
            document.getElementById('PTS').style.backgroundColor = '#1d1d1d4e';
            document.getElementById('PTS').style.borderColor = '#1d1d1d4e';
            document.getElementById('PTS').style.cursor = 'default';
            document.getElementById('picksurveytext2').style.color = '#747678';   
            document.getElementById('picksurveytext2').style.cursor= 'default';
        }
        document.getElementById('PTS').addEventListener("click", pts);
        var b=1;
        var c=false;
        var c1=true;
        
        function ss(){
            if (b==0) {
                b=1;
                c=false;
                if(ssalreadythere==false) {
                ssur.style.backgroundColor = '#efefef';   
                sstext.style.color = '#141f27';
                }
                document.getElementById('ssb').value=0;
            }
            else if (b==1&&c1==true) {
                b=0;
                c=true;
                if(ssalreadythere==false) {
                ssur.style.backgroundColor = '#141f27'; 
                sstext.style.color = '#efefef';
                }
                document.getElementById('ssb').value=1;
                document.getElementById('psb').value=0;
            }
        }
        var b1=1;
        var popup=document.getElementById('popup');
        var date1=document.getElementById('date1');
        var date2=document.getElementById('date2');
        var dateslabel=document.getElementsByName('dateslabel');
        var searchlist=document.getElementById('searchlist');
        function pts(){
            var pts=document.getElementById('PTS');
            var ptstext=document.getElementById('picksurveytext2')
            if (b1==0) {
                b1=1;
                c1=true;
                
                if(groups==true){
                    pts.style.backgroundColor = '#efefef';   
                    document.getElementById('picksurveytext2').style.color = '#141f27';   
                    popup.style.top = '20%'; 
                    popup.style.height = '45%'; 
                    send.style.top='75%';
                    date1.style.top='57%'; 
                    date2.style.top='57%'; 
                    dateslabel[0].style.top='45%'; 
                    dateslabel[1].style.top='45%'; 
                    searchlist.style.visibility = 'hidden';
                }
                document.getElementById('psb').value=0;
            }
            else if (b1==1&&c==false) {
                b1=0;
                c1=false;
                
                if(groups==true){
                    pts.style.backgroundColor = '#141f27'; 
                    document.getElementById('picksurveytext2').style.color = '#efefef';   
                    popup.style.top = '15%'; 
                    popup.style.height = '50%'; 
                    send.style.top='80%';
                    date1.style.top='50%'; 
                    date2.style.top='50%'; 
                    dateslabel[0].style.top='40%'; 
                    dateslabel[1].style.top='40%'; 
                    searchlist.style.visibility = 'visible';
                }
                document.getElementById('ssb').value=0;
                document.getElementById('psb').value=1;
            }
        }
        var send=document.getElementById('send');
        var sendtext=document.getElementById('sendtext');
        
        <?php
        if(isset($_POST['send'])){ ?>
        
            <?php $error=false;  ?>
            var errorInSurveyType = false;
            var errorInStartDate = false;
            var errorInEndDate = false;
            var errorInGroup = false;

            send.style.backgroundColor = '#141f27';
            sendtext.style.color = '#efefef';
            
            <?php
            $groupSelected='';
            if($_POST['ssb']==0&&$_POST['psb']==0){
                echo "errorInSurveyType = true;";
                $error = true; 
            }
                $startdate=$_POST['date1'];
                $enddate=$_POST['date2'];
                if($_POST['psb']==1) $groupSelected=$_POST['searchlist'];

                if(empty($_POST['date1'])){
                    $error = true; ?>
                    errorInStartDate = true;
                <?php }
                if(empty($_POST['date2'])){
                    $error = true; ?>
                    errorInEndDate = true;
                <?php }

                if($startdate < date("Y-m-d")&&$startdate != date("Y-m-d")){ ?>
                if(errorInStartDate==false)
                alert('*Note that: Start Date has already passed.');
                <?php }

                if($enddate < date("Y-m-d") || $enddate < $startdate && $enddate!= date("Y-m-d")){
                    $error = true; ?>
                    if(errorInEndDate==false)
                    alert('End Date is invalid.');
                <?php }

                $sqlselect="SELECT * FROM survey WHERE GroupSpecified='$groupSelected'";
                $resultselect=$conn->query($sqlselect);
                if($rowselect=$resultselect->fetch_assoc()){ 
                    $error = true;
                    echo "alert('Group selected already has an active survey.');";
                }

                if($error===false){
                    if($startdate <= date("Y-m-d"))
                        $isOpen=1;
                    else
                        $isOpen=0;
                    
                    if($_POST['ssb']==1){
                        $surveytype='Satisfaction Survey';
                        $questionNo="11";
                        $pages="4";
                        $query="INSERT IGNORE INTO Survey(surveyType,startDate,endDate,isOpen,questionNo,pages) 
                        VALUES('$surveytype','$startdate','$enddate','$isOpen','$questionNo','$pages')";
                        $result=$conn->query($query);
                        echo "window.location.replace('surveyauditor.php');";
                    }
                    else if($_POST['psb']==1) {
                        if(isset($_POST['searchlist'])){
                            $surveytype='Post-Trip Survey';
                            $questionNo="6";
                            $pages="2";
                            
                            $query="INSERT IGNORE INTO Survey(surveyType,startDate,endDate,isOpen,questionNo,pages,GroupSpecified) 
                            VALUES('$surveytype','$startdate','$enddate','$isOpen','$questionNo','$pages','$groupSelected')";
                            $result=$conn->query($query);
                            if(!$result) die("Error: ".$conn->error);
                            echo "window.location.replace('surveyauditor.php');";
                        }
                        
                    }
            }
            ?>
            error="Error: "
            if(errorInSurveyType === true)
            error += "Survey type is not given. "
            if(errorInStartDate === true)
            error += "Start date is not given. "
            if(errorInEndDate === true)
            error += "End date is not given. "
            if(error != "Error: ")
            alert(error);
        <?php }  ?>
        
        send.style.backgroundColor = '#efefef'; 
        sendtext.style.color = '#141f27';
     </script>
<?php include_once "../users/checkLogin.php"; checkLogin(); ?>
</html>
