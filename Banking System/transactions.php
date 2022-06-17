<html>
    <head>
        <link rel="stylesheet" href="transactions.css">
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
        <div class="table">
                <?php
                    $con=new mysqli("localhost","root","","test");

                    if($con->connect_error){
                        die("Connection failed". con->connect_error);
                    }

                    $sql="Select * from transactions";
                    $result= $con->query($sql);
                    ?>
                    <h1 class="title">Transactions</h1>
                    <table>
                    <tr>
                        <th style="width:400px">Transaction Id</th>
                        <th style="width:400px">Sender Name</th>
                        <th style="width:400px">Sender Account Number</th>
                        <th style="width:400px">Reciever Name</th>
                        <th style="width:400px">Reciever Account Name</th>
                        <th style="width:400px">Amount</th>
                    </tr>
                    <?php
                    if($result-> num_rows>0){
                        while($row= $result->fetch_assoc()){
                            echo "<tr>"."<td>".$row["t_id"]."</td><td>".$row["s_name"]."</td><td>".$row["s_acc_no"]."</td><td>".$row["r_name"]."</td><td>".$row["r_acc_no"]."</td><td>".$row["amt"]."</td></tr>";
                        }
                    }

                    $con->close()
                ?>
                </table>
        </div>
    </body>
</html>