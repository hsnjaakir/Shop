<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../classes/Product.php");
include_once($filepath . "/../helpers/Format.php");
?>
<?php
if (!isset($_GET['proId']) || $_GET['proId'] == NULL) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $id = $_GET['proId'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php'</script>";
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product Details</h2>
        <div class="block copyblock">
            <?php
            $pd = new Product();
            $getPro = $pd->getProById($id);
            if ($getPro) {
                while ($result = $getPro->fetch_assoc()) {
            ?>
                    <form action='' method='post'>
                        <table class="form">
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['productName']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['price']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['image']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="OK" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php }
            } ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>