<html>
    <head>
        <link rel="stylesheet" href="transfer.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <nav>
        <div class="nav-options">
                <img class="nav-img" alt="" src="new.png">
                <a class="nav-items" href="index.html">Home</a>
                <a class="nav-items" href="all-customers.php">View all Customers</a>
                <a class="nav-items" href="transfer.php">Transfer Money</a>
                <a class="nav-items" href="transactions.php">Transactions</a>
            </div>
        </nav>
        <h1 class="title">Transfer Money</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            Account No. <input type="number" name="id" required>
            Recievers Account No. <input type="number" name="rec_acc" required>
            Amount <input type="number" name="amt" required>
            <input type="submit" value="Transfer" class="submit" name="Transfer">
        </form>
        <p id="result"></p>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $id=$_POST["id"];
                $amt=$_POST["amt"];
                $rec_acc=$_POST["rec_acc"];
                $con=new mysqli("localhost","root","","test");
                if($con->connect_error){
                    die("Connection failed". $con->connect_error);
                }
                $sql=$con->prepare("Select * from customers where acc_no=?");
                $update=$con->prepare("update customers set bal=? where acc_no=?");
                $sql->bind_param("i",$id);
                $sql->execute();
                $result= $sql->get_result();
                if($result-> num_rows==0){
                    echo '<script type="text/javascript">
                        $("#result").text("Invalid Details!");
                        </script>';
                }
                else{
                    $bal=$result->fetch_assoc()["bal"];
                    $sql->execute();
                    $result= $sql->get_result();
                    $s_name=$result->fetch_assoc()["c_name"];
                    if($amt<=$bal && $bal!=NULL){
                        $bal=$bal-$amt;
                        $acc=$bal;
                        $update->bind_param("ii",$bal,$id);
                        $update->execute();
                        $sql->bind_param("i",$rec_acc);
                        $sql->execute();
                        $result= $sql->get_result();
                        $bal=$result->fetch_assoc()["bal"];
                        $sql->execute();
                        $result= $sql->get_result();
                        $r_name=$result->fetch_assoc()["c_name"];
                        $bal=$bal+$amt;
                        $update->bind_param("ii",$bal,$rec_acc);
                        $update->execute();
    
                        $sql="Select * from transactions";
                        $result= $con->query($sql);
                        $t_id=0;
                        if($result-> num_rows>0){
                            while($row= $result->fetch_assoc()){
                               $t_id=$row["t_id"];
                            }
                        }
                        $t_id=$t_id+1;
                        $insert=$con->prepare("insert into transactions value(?,?,?,?,?,?)");
                        $insert->bind_param("isisii",$t_id,$s_name,$id,$r_name,$rec_acc,$amt);
                        $insert->execute();
                        echo '<script type="text/javascript">
                                $("#result").text("Transfer Successfull!! Your Current Balance is '. $acc .' Rs.");
                            </script>';
    
                    }
                    else{
                        echo '<script type="text/javascript">
                        $("#result").text("Insufficeint Balance!");
                        </script>';
                }
            }
        }
        ?>
    </body>
</html>