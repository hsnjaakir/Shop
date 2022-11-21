<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../classes/Cart.php");
include_once($filepath . "/../helpers/Format.php");
$ct = new Cart();
$fm = new Format();
?>
<?php
if (isset($_GET['shiftid'])) {
	$id = $_GET['shiftid'];
	$price = $_GET['price'];
	$time = $_GET['time'];
	$shift = $ct->productShifted($id, $time, $price);
}

if (isset($_GET['delproid'])) {
	$id = $_GET['delproid'];
	$price = $_GET['price'];
	$time = $_GET['time'];
	$delOrder = $ct->delShiftedProduct($id, $time, $price);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<?php
		if(isset($shift)){
			echo $shift;
		}
		if(isset($delOrder)){
			echo $delOrder;
		}
		?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Order Time</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Cust. ID</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$getOrder = $ct->getAllOrderProduct();
					if ($getOrder) {
						while ($result = $getOrder->fetch_assoc()) {
					?>
							<tr class="odd gradeX">
								<td><a href="product.php?proId=<?php echo $result['id']; ?>"><?php echo $result['id']; ?></a></td>
								<td><?php echo $fm->formatDate($result['date']); ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><?php echo $result['quantity']; ?></td>
								<td>$<?php echo $result['price']; ?></td>
								<td><?php echo $result['cmrId']; ?></td>
								<td><a href="customer.php?custId=<?php echo $result['cmrId']; ?>">Details</a></td>
								<?php
								if($result['status'] == '0'){
									?><td><a href="?shiftid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Shift</a></td><?php
								}else if($result['status'] == '1'){
									?><td>Pending</td><?php
								}else{
									?><td><a href="?delproid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Removed</a></td><?php
								}
								?>
							</tr>
					<?php
						}
					}
					?>

				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>