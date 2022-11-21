<?php include 'inc/header.php' ?>
<?php
$login = Session::get("cuslogin");
if ($login == false) {
    header("Location: login.php");
}
?>
<style>
    .psuccess {
        width: 500px;
        min-height: 250px;
        text-align: center;
        border: 2px solid #ddd;
        margin: 0 auto;
        padding: 50px;
    }

    .psuccess h2 {
        border-bottom: 2px solid #ddd;
        margin-bottom: 80px;
        padding-bottom: 10px;
    }
    .psuccess p {
        line-height: 25px;
        font-size: 18px;
        text-align: left;
    }

</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="psuccess">
                <h2 class="success">Success</h2>
                <?php
                $cmrId = Session::get("cmrId");
                $amount = $ct->payableAmount($cmrId);
                $price = 0;
                if($amount){
                    while($result = $amount->fetch_assoc()){
                        $price = $price + $result['price'];
                    }
                }
                ?>
                <p style="color: red">Total payable amount(inclucing vat) is $<?php
                    $total = $price + $price*0.1;
                    echo $total;
                ?></p>
                <p>Thanks for parchasing. We will contact with you as soon as possible with delevary details. Here is your order details... <a href="orderdetails.php">Visit here</a></p>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php' ?>