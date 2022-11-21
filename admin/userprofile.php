<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../classes/Customer.php");
$cmr = new Customer();
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>User Profile</h2>
		<div class="block">
			<div class="block">
				<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Address</th>
							<th>Country</th>
							<th>Zipcode</th>
							<!-- <th>Details</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						$getCustomer = $cmr->getAllCustomer();
						if ($getCustomer) {
							while ($result = $getCustomer->fetch_assoc()) {
						?>
								<tr class="odd gradeX">
									<td><?php echo $result['id']; ?></td>
									<td><?php echo $result['name']; ?></td>
									<td><?php echo $result['phone']; ?></td>
									<td><?php echo $result['email']; ?></td>
									<td><?php echo $result['address']; ?></td>
									<td><?php echo $result['country']; ?></td>
									<td><?php echo $result['zip']; ?></td>
									<!-- <td><a href="customer.php?custId=<?php echo $result['id']; ?>">Click</a></td> -->
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
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>