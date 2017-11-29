<?php
    if(isset($_GET['selectMonth']) && isset($_GET['selectDay']) && isset($_GET['selectYear']) && isset($_GET['Task'])){
        submitTask($_GET['selectMonth'], $_GET['selectDay'], $_GET['selectYear'], $_GET['Task']);
    }
    
    function submitTask($month, $day, $year, $task){
        $host = "127.0.0.1";
        $user = "sneharams";                     //Your Cloud 9 username
        $pass = "";                                  //Remember, there is NO password by default!
        $db = "smartMirror";                                  //Your database name you want to connect to
        $port = 3306;                                //The port #. It is always 3306
        
        $connection = mysqli_connect($host, $user, $pass, $db, $port);
        $date = $month.$day.$year;
        echo  $date;
        if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
        }
        $query = "SELECT * FROM todoList";
        $result = mysqli_query($connection, $query);
        $sql = "INSERT INTO todoList(date, todo)
                VALUES ('" . strval($date) . "','" . strval($task) . "')";

        if ($connection->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }   
        $connection -> close();
        

    }
?>

<style>

    img {
      position: fixed; 
      top: 0; 
      left: 0; 
    
      /* Preserve aspet ratio */
      min-width: 100%;
      min-height: 100%;
    }
    html{
        color: white;
        font-family: "calibri";
        font-size:60;
        text-align:center;
    }
    form{
        position: fixed; 
        top: 0; 
        left: 0; 
    
      /* Preserve aspet ratio */
      min-width: 100%;
      min-height: 100%;
    }
    select{
        background-color: grey;
        color:white;
        font-size:50;
        width:70%;

    }
    a{
        color: white;
        font-weight: bold;
        height: 50px;
    }

    .selected{
        color: white;
    }
    .notSelected{
        color:black;

</style>
<html>
    <img src="http://pre06.deviantart.net/0c8f/th/pre/i/2009/340/5/5/brushed_metal_silver_texture_by_sweetsoulsister.jpg" >

    <title>
        Smart Mirror
    </title>
    
    <body>
        
        <form method="get">
            <h2>Input Task</h2>
            <select name='selectMonth'>
                <option class="selected" value="00">Select Month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select> 
            <br><br>
             <select name='selectDay'>
                <option class="selected" value="00">Select Day</option>
                <?php 
                    for($i = 1; $i < 32; $i++){
                        $i2="";
                        if (strlen($i+"")<2){
                            $i2 = "0";
                        } 
                        $i2 += $i;
                        echo "<option value='".$i2."'>".$i2."</option>";
                    }
                ?>
                
            </select> 
            <br><br>
            <select name='selectYear'>
                <option class="selected" value="00">Select Year</option>
                <?php 
                for($i = date("Y"); $i < date("Y")+50; $i++){

                    echo "<option value='".$i."'>".$i."</option>";
                }
                ?>
            </select> 
            <br><br>
            <div>Input Task:</div>
            <textarea 
                    style="width:70%; height:500px;font-size:50px;" 
                    name="Task" 
                    value="">
                
            </textarea><br>
            <input style="visibility:hidden;" type="text" value></input><br>
            <input style="color: white;font-weight:bold;font-size:50px;height:100px;width:30%;" type="submit" value="Submit"></input><br><br>
            <a href="https://smartmirror-sneharams.c9users.io/phoneUI.php">Back</a>
        </form>
        <?php
            function badFont(){
                echo "Error";
            }
        ?>

    </body>

</html>