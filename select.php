<?php

//select.php

include('database_connection.php');

if(isset($_POST["id"]))
{
	
	$query = "SELECT * FROM product_data WHERE id='".$_POST["id"]."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$programming_languages = '';
	$programming_languages1 = '';
	$name = '';
	foreach($result as $row)
	{
		$cname = $row["cust_name"];
		$cemail = $row['cust_email'];
		$total_item = $row['total_item'];
		$total_amount = $row['total_amount'];
		$total_discount = $row['total_discount'];
		$total_bill = $row['total_bill'];
		$language_array = explode(",", $row["product_name"]);
		$language_array1 = explode(",", $row["product_price"]);
		$language_array2 = explode(",", $row["product_dis"]);

		//$language_array1 = explode(",", $row["product_price"]);
		$count = 1;
		$programming_languages .= '<tr>';
        $programming_languages .= '<th>Product Name</th>';
        $programming_languages .='<th>Price</th><th>Discount(%)</th>';
        $programming_languages	.= '</tr>';

        /*$query1 = "SELECT * FROM product_detail WHERE product_id='".$_POST["id"]."'";
		$statement1 = $connect->prepare($query1);
		$statement1->execute();
		$result1 = $statement1->fetchAll();*/
		//print_r($language_array1[0]);
		foreach($language_array as $key => $language)
		{
			
			$prod_count =  count($language_array);
			
			$button = '';
			if($prod_count = 1)
			{
				//$button = '<button type="button" name="remove" id="'.$count.'" class="btn btn-danger btn-xs remove">x</button>';
					
			}
			else
			{
				//$button = '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
			}
			$programming_languages .= '
				<tr id="row'.$count.'" class="all_data">
					<td><input type="text" name="product_name[]" id="product_name" placeholder="Product Name" class="form-control product_name" value="'.$language.'" /></td>

					<td><input type="text" name="tot_price[]" id="product_name" placeholder="Product Name" class="form-control tot_price" value="'.$language_array1[$key].'" /></td>

					<td><input type="text" name="tot_discount[]" id="product_name" placeholder="Product Name" class="form-control tot_discount" value="'.$language_array2[$key].'" /></td>

					
					
				</tr>
			';
			$count++;
		}
		/*foreach($language_array1 as $language1)
		{
			$prod_count =  count($language_array);
			
			$button = '';
			if($prod_count = 1)
			{
				//$button = '<button type="button" name="remove" id="'.$count.'" class="btn btn-danger btn-xs remove">x</button>';
					
			}
			else
			{
				//$button = '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
			}
			$programming_languages1 .= '
				<tr id="row'.$count.'">
					<td><input type="text" name="tot_price[]" placeholder="Price" class="form-control tot_price" value="'.$language1.'" /></td>

					
				</tr>
			';
			$count++;
		}*/
	}
	$output = array(
		'cust_name'					=>	$cname,
		'cust_email'				=>  $cemail,
		'total_item'				=>  $total_item,
		'total_amount'				=>  $total_amount,
		'total_discount'			=>	$total_discount,
		'total_bill'				=>	$total_bill,
		'product_name'	=>	$programming_languages
		//'tot_price' => $programming_languages1
	);
	echo json_encode($output);
}


?>
