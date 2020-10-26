<?php

//fetch.php

include('database_connection.php');

$query = "SELECT * FROM product_data ORDER BY id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_rows = $statement->rowCount();

$output = '
<div class="table-responsive">
	<table class="table table-bordered table-striped" border="2">
		<tr>
			<th>Customer Name</th>
			<th>Customer Email</th>
			<th>Number of items</th>
			<th>Total Amount</th>
			<th>Total Discount</th>
			<th>Final Amount</th>
			<th>Action</th>
			
		</tr>';

if($total_rows > 0)
{
	foreach($result as $row)
	{
		$id = $row['id'];
		$output .= '
		<tr>
			<td align="center">'.$row["cust_name"].'</td>
			<td align="center">'.$row["cust_email"].'</td>
			<td align="center">'.$row["total_item"].'</td>
			<td align="center">'.$row["total_amount"].'</td>
			<td align="center">'.$row["total_discount"].'</td>
			<td align="center">'.$row["total_bill"].'</td>
			<td><button type="button" name="edit" id="'.$row["id"].'" class="btn btn-warning btn-xs edit">Edit</button>
			

			&nbsp;&nbsp;<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>

			&nbsp;&nbsp;<button type="button" name="view" id="'.$row["id"].'" class="btn btn-warning btn-xs view">View</button>

			</td>
			
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr align="center">
		<td colspan="7">No Data Found</td>
	</tr>
	';
}
$output .= '</table></div>';

echo $output;

?>