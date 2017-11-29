
<?php
    //header("Refresh:30");
    date_default_timezone_set('America/Cleveland');
    ?>

<html id='page'>
    <title>Smart Mirror</title>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Architects+Daughter|Arima+Madurai|Dancing+Script|Fjalla+One|Orbitron|PT+Sans+Narrow|Shadows+Into+Light|Sriracha" rel="stylesheet"> 
    </head>
    <body onload="startTime()"></body>
    <table class='site' border=1; style="width:100%;">
        <tr class='site'>
            <td class='site first'>
                <div id='txt'>
                </div>
            </td>

            <td class='weather'>
                <?php
                    getWeather("Westlake");
                    function getWeather($city){
                        $url="http://api.openweathermap.org/data/2.5/weather?q=Westlake,US&APPID=e5c67df4931d937680fddaf01ce40b92";
                        $json=file_get_contents($url);
                        $data=json_decode($json,true);
                        $weather = $data['weather'][0]['main'];
                        echo "<div class='city'>".$data['name']." ,OH</div><br>";
                        echo "Temp: ".round(((9/5)*(($data['main']['temp'])-273)+32),2)."&deg;F<br>";
                        if ($weather == "Clouds"){
                            echo "Status: ";
                             if ($data['clouds']['all'] <= 50){
                                 echo "Scattered Clouds<br>";
                             } else if ($data['clouds']['all']<=90){
                                 echo "Broken Clouds <br>";
                             } else {
                                 echo "Overcast<br>";
                             }
                        } else {
                            echo "Status:   ".$weather;
                        }
                    }
                ?>
            </td>
            <td style='width:1%; padding-top:135px; vertical-align:top;color:black;'>
                <?php
                    $url="http://api.openweathermap.org/data/2.5/weather?q=Westlake,US&APPID=e5c67df4931d937680fddaf01ce40b92";
                    $json=file_get_contents($url);
                    try {$data=json_decode($json,true);
                    $weather = $data['weather'][0]['main'];
                    if ($data['weather'][0]['main'] == "Clouds"){
                            echo "<img style='margin-top:-27;height:300px;margin-left:30;' src='http://www.clker.com/cliparts/s/E/z/g/z/V/cloud-md.png'></img>";
                    } else if ($weather == "Clear"){
                        echo "<img style='margin-top:-27;height:300px;margin-left:30;' src='http://www.clipartkid.com/images/16/sun-yellow-clip-art-at-clker-com-vector-clip-art-online-royalty-yH7tiB-clipart.png'></img>";
                    } else if ($weather == "Rain"){
                        echo "<img style='margin-top:-27;height:300px;margin-left:30;'src='http://icon-park.com/imagefiles/simple_weather_icons_rain.png'></img>";
                    } else if ($weather == "Snow"){
                        echo "<img style='margin-top:-27;height:300px;margin-left:30;'src='https://cdn4.iconfinder.com/data/icons/outline-2/64/weather-cloud-more-snow-512.png'></img>";
                    }
                    } catch (exception $e) {
                        header('Location:https://smartmirror-sneharams.c9users.io/mirrorUI.php');

                    }

                ?>
            </td>
            
        </tr>
        <tr class='site' style="width:50%;">
            <td class='site'>
                
            </td>
            <td class='site' colspan='2'><br><br><br><br><br><br>
                          
                            <?php
                            
                                $date =time() ;
                                $day = date('d', $date) ;
                                $month = date('m', $date) ;
                                $year = date('Y', $date) ;
                                $first_day = mktime(0,0,0,$month, 1, $year) ;
                                $title = date('F', $first_day) ;
                                $day_of_week = date('D', $first_day);
                                switch($day_of_week){
                                    case"Sun": $blank = 0; break;
                                    case"Mon": $blank = 1; break;
                                    case"Tue": $blank = 2; break;
                                    case"Wed": $blank = 3; break;
                                    case"Thu": $blank = 4; break;
                                    case"Fri": $blank = 5; break;
                                    case"Sat": $blank = 6; break;
                                }
                                $days_in_month = cal_days_in_month(0, $month, $year);
                                echo "<table class='calendarTitle calendar'; border=1";
                                echo "<tr><th class='calendarTitle'; colspan=7; class='title'> $title $year </th></tr>";
                                echo "<tr><td><b>S<b></td><td><b>M<b></td><td><b>T<b></td><td><b>W<b></td><td><b>T<b></td><td><b>F<b></td><td><b>S<b></td></tr>";
                                $day_count = 1; echo "<tr>";
                                while ( $blank > 0 ) {
                                    echo "<td></td>";
                                    $blank = $blank-1;
                                    $day_count++;
                                }
                                $day_num=1;
                                while($day_num <= $days_in_month){
                                    $todayDate = getTodayDate();
                                    if($day_num == $todayDate){
                                        echo "<td class='bold' onclick='openList(".$day_num.")'>".$day_num."</td>";
                                    } else {
                                        echo "<td onclick='openList(".$day_num.")'>".$day_num."</td>";
                                    }
                                    $day_num++;
                                    $day_count++;
                                    if ($day_count > 7) {
                                        echo "</tr><tr>";
                                        $day_count = 1;
                                    }
                                }
                                while ( $day_count >1 && $day_count <=7 ) {
                                    echo "<td> </td>";
                                    $day_count++; 
                                }
                                function getTodayDate(){
                                    $today = getdate();
                                    return ($today['mday']);
                                }
                    ?>
            </td>
        </tr>
        <tr></tr>
    </table>
    <div class="mydiv" id="content" onload="openList(3);"></div>
    <div class="mydiv2" id="reminder" onload="openReminder()"></div>
</html>
<style>

    .weather{
        font-size:70px;
        padding-top:100px;
        vertical-align:top;
        float:right;
        line-height:100px;
    }

    html{
        zoom: 30%;
    } 
    
    .city{
        height:10px;
        font-size:80px;
    }
    html {
        font-family: <?php
                     //Connect to the database
                        $host = "127.0.0.1";
                        $user = "sneharams";            //Your Cloud 9 username
                        $pass = "";                     //Remember, there is NO password by default!
                        $db = "smartMirror";            //Your database name you want to connect to
                        $port = 3306;                   //The port #. It is always 3306
                            
                        $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
                        
                        //And now to perform a simple query to make sure it's working
                        $query = "SELECT * FROM fonts";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                             if ($row['selected'] == 'Yes'){
                                 echo $row['css'];
                             }
                         }
                         $connection->close();
                    ?>;
        color:white;
        text-align:left;
        font-size:70;
        background-color:black;
        
    }
    .first{
        color:white;
        vertical-align:top;
        text-align:left;
        font-size:100;
        background-color:black;
    }
    .bold{
        color:black;
        background-color:white;
    }
    
    .time{
        height:230px;
        font-size:250px;
    }
    
    .title{
        height:50px;
        font-size:100px;
    }
    
    .calendar{
        margin-right:15px;
        color:white;
        vertical-align:bottom;
        text-align:center;
        margin-bottom: -1000px;
    }
    
    table.site{
        border-color:black;
        border-spacing:0;
        height:100%;
        width:100%;
    }
    
    td.site{
        width:17%;
        height:50%;
    }

    table.calendarTitle {
        width:60%;
        margin-left:35%;
        font-size:40;
        border-color:white;
        border-spacing:0;
        margin-top:20%;
    }
    
    tr.calendarTitle{
        height:30px;
    }
    
    th.calendarTitle {
        text-align:center;
        font-size:50;
    }
    
    .mydiv{        
        width:50%;
        height:40%;
        background-color:transparent;
        position:fixed;
        top:30%;
        bottom:30%;
        left:25%;
        font-size:140px;
    }
     .mydiv2{        
        width:60%;
        height:40%;
        background-color:transparent;
        position:fixed;
        top:30%;
        bottom:30%;
        left:15%;
        font-size:140px;
    }

    td{
        height:50px;
    }
    
    div{
        font-size:70px;
    }

</style>

<script >


    function keyPress(evt){
        var evt  = (evt) ? evt : ((event) ? event : null);
	    if ((evt.keyCode == 38)) {
	        openList(4);
	    }
	    if ((evt.keyCode == 40)) {
	       // closeList();
	       // closeReminder();
	        refreshPage();
	    }
	    if ((evt.keyCode==39)) {
	        goodMorning();
	    }
	    if ((evt.keyCode==37)) {
	        meObviously();
	    }

    }

    function startTime() {
        document.onkeyup = keyPress;
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var months = ['January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'December'];
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        var date = today.getDate();
        var n = today.getDay();
        var t = today.getMonth();
        var time = "a.m.";
        var day = "Morning";
        m = checkTime(m);
        if (h >= 21){
            day = "Night";
        } else if (h >= 17){
            day = "Evening";   
        } else if (h >= 12){
            day = "Afternoon";
        } else {
            day = "Morning";
        }
        var today = days[n];
        var month = months[t];
        
        if (h > 12){
            h -= 12;
            time = "p.m.";
        } else {
            time = "a.m.";
        }
        
        if (h == 0){
            h = 12;
        }

        document.getElementById('txt').innerHTML = "<div class='time'>" +h + ":" + m + " " + time + "</div><br><div class='title'>Good " + day+ " Sneha</div><br>" + today+ ", " +month+ " " + date +"<br>";
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

    function openList(date){
        //postFunction(var date);
        document.getElementById("content").innerHTML="<?php
            //Connect to the database
                 $host2 = "127.0.0.1";
                 $user2 = "sneharams";            //Your Cloud 9 username
                 $pass2 = "";                     //Remember, there is NO password by default!
                 $db2 = "smartMirror";            //Your database name you want to connect to
                 $port2 = 3306;                   //The port #. It is always 3306
                            
                 $connection2 = mysqli_connect($host2, $user2, $pass2, $db2, $port2)or die(mysql_error());
                        
            //And now to perform a simple query to make sure it's working
                $query2 = "SELECT * FROM todoList";
                $result2 = mysqli_query($connection2, $query2);
                $changed1 = "false";
                $changed2 = "false";
                if(substr($month,0,1) == "0"){
                    $month2 = substr($month,1,1);
                    $changed1 = "true";
                }
                if(substr($day,0,1) == "0"){
                    $day2 = substr($day,1,1);
                    $changed2 = "true";
                }
                if($changed1 == "true" && $changed2 == "true"){
                    $today = $month2.$day2.$year;
                    //echo "<article><u>$month2-$day2-$year</u></article>";

                } else if ($changed1 == "true"){
                    $today = $month2.$day.$year;
                    //echo "<article><u>$month2-$day-$year<br></u></article>";
                } else if ($changed2 == "true"){
                    $today = $month.$day2.$year;
                    //echo "<article><u>$month-$day2-$year<br></u></article>";
                } else {
                    $today = $month.$day.$year;
                    //echo "<article><u>$month-$day-$year<br></u></article>";
                }
                echo "<article style='text-align:center;'><u>Today's Tasks</u></article>";
                $display = 'no';
                $num = 0;
                while ($row2 = mysqli_fetch_assoc($result2)) {
                      if ($row2['date'] == $today){
                         $num ++;
                         echo $num.") ".$row2['todo']."<br>";
                         $display='yes';
                      } 
                }
                if ($display != 'yes'){
                     echo "<article style='text-align:center;'>none</article>";
                }
                $connection2->close();
        ?>";
    }
    
    function closeList(){
        document.getElementById("content").innerHTML=" ";
    }
    
    function changeUser(){
        
    }
    openReminder();
    
    function closeReminder(){
        document.getElementById("reminder").innerHTML="";
    }
    
    function refreshPage(){
        window.location.reload();
    }
    

    
    function goodMorning(){
        new Audio('hellomirror.mp3').play()
    }
    
    function meObviously(){
        new Audio('meobviously.mp3').play();
    }
    
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.5.0/annyang.min.js">

</script>
<script>
    if (annyang) {
      var commands = {
        '(Maria) (yo) show (me my) tasks': function() {
          openList(5);
        }
      };
      
      var commands3 = {
        '(Maria) (yo) what am I doing (today)': function() {
          openList(5);
        }
      };
      
      var commands2 = {
          '(Maria) clear the screen': function(){
              closeList();
              closeReminder();
          }
      };
      
      var commands4 = {
          '(Maria) update (the mirror)': function(){
              refreshPage();
          }
      }
      
      var commands7 = {
          '(Maria) set an alarm for seven': function(){
              sayOk();
          }
      }
      
      var commands6 = {
          '(Maria) who is the coolest (Maria)': function(){
              meObviously();
          }
      }
      
      var commands5 = {
          'Hello Maria': function(){
              goodMorning();
          }
      }
      
      var commands8 = {
          '(Maria) what is the weather': function(){
              theWeatherIs();
          }
      }
    
      annyang.addCommands(commands);
      annyang.addCommands(commands2);
      annyang.addCommands(commands3);
      annyang.addCommands(commands4);
      annyang.addCommands(commands5);
      annyang.addCommands(commands6);
      annyang.addCommands(commands7);
      annyang.addCommands(commands8);
      annyang.start();
    }
</script>
