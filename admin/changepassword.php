<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Adminlogin.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPass = $_POST['oldpass'];
    $newPass = $_POST['newpass'];
    $al = new Adminlogin();
    // $result = $al->changePassword($oldPass, $newPass);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <?php
        if (isset($result)) {
            echo $result;
        }
        ?>
        <div class="block">
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter Old Password..." name="oldpass" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>


<!-- Add it to Adminlogin.php class -->

<!-- public function changePassword($oldPass, $newPass)
{
$query = "SELECT * FROM tbl_admin";
$result = $this->db->select($query);
if (md5($result['adminPass']) == $oldPass) {
$query = "UPDATE tbl_admin SET adminPass = '$newPass'";
$updated_row = $this->db->update($query);
if ($updated_row) {
$msg = "Password updated";
return $msg;
}
} else {
$msg = "You cannot change password";
return $msg;
}
} -->