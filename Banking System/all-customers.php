<html>
    <head>
        <link rel="stylesheet" href="all-customers.css">
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

                    $sql="Select * from customers";
                    $result= $con->query($sql);
                    ?>
                    <h1 class="title">Our all Customers</h1>
                    <table>
                    <tr>
                        <th style="width:400px; font-size:22px">Name</th>
                        <th style="width:400px; font-size:22px">Customer Id</th>
                        <th style="width:400px; font-size:22px">Account Number</th>
                        <th style="width:400px; font-size:22px">Balance</th>
                    </tr>
                    <?php
                    if($result-> num_rows>0){
                        while($row= $result->fetch_assoc()){
                            echo "<tr>"."<td>".$row["c_name"]."</td><td>".$row["c_id"]."</td><td>".$row["acc_no"]."</td><td>" .$row["bal"]."</td></tr>";
                        }
                    }

                    $con->close()
                ?>
                </table>
        </div>
    </body>
</html>