


<?php
    if(isset($_GET['selectFont'])){
        changeFont($_GET['selectFont']);
    }
    
    function changeFont($font){
        $host = "127.0.0.1";
        $user = "sneharams";                     //Your Cloud 9 username
        $pass = "";                                  //Remember, there is NO password by default!
        $db = "smartMirror";                                  //Your database name you want to connect to
        $port = 3306;                                //The port #. It is always 3306
        
        $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
    
    
    
        //And now to perform a simple query to make sure it's working
        $query = "SELECT * FROM fonts";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['name'] == $font){
                $sql = "UPDATE fonts SET selected = 'Yes' WHERE name = '". $row['name']. "'";
                if($connection->query($sql) === TRUE){
                } else {
                    badFont();
                }
            } else {
                $sql = "UPDATE fonts SET selected = 'No' WHERE name = '". $row['name']. "'";
                $connection->query($sql);

            }
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
    
    button{
        width:40%;
        font-size:50px;
    }
    .selected{
        color: white;
    }
    .notSelected{
        color:black;
    }
    
    a{
        color: white;
        font-weight: bold;
        height: 50px;
    }
</style>
<html>
    <img src="http://www.willieboats.com/wp-content/uploads/2013/03/brushed-metal-texture.jpg" >

    <title>
        Smart Mirror
    </title>
    
    <body>
        
        <form method="get">
            <h2>Select Font</h2>
            <select name='selectFont' onchange="this.form.submit()">
                <option selected disabled>SelectFont</option>
                <?php
                    //Connect to the database
                    $host = "127.0.0.1";
                    $user = "sneharams";                    //Your Cloud 9 username
                    $pass = "";                             //Remember, there is NO password by default!
                    $db = "smartMirror";                    //Your database name you want to connect to
                    $port = 3306;                           //The port #. It is always 3306
                    
                    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
                
                    //And now to perform a simple query to make sure it's working
                    $query = "SELECT * FROM fonts";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option ";
                        if ($row['selected'] == 'Yes'){
                            echo " class='selected' value='". $row['name']."'>". $row['name']. "</option>";
                        } 
                    }
                    $query = "SELECT * FROM fonts";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option ";
                        if ($row['selected'] == 'Yes'){
                        } else {
                            echo " class='notSelected' value='". $row['name']. "'>". $row['name']. "</option>";
                        }
                    }
                    
                    $connection -> close();
                ?>
            </select> 
            <br>
            <input style="visibility:hidden;" type="text"></input><br>
            <a href="https://smartmirror-sneharams.c9users.io/phoneUI.php">Back</a>
        </form>
        <?php
            function badFont(){
                echo "Error";
            }
        ?>

    </body>

</html>