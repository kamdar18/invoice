<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	/*var_dump($_POST["product_name"]);
	exit;*/
	$product_name = implode(",", $_POST["product_name"]);
	$tot_price = implode(",", $_POST["tot_price"]);
	$tot_discount = implode(",", $_POST["tot_discount"]);
	$cname = $_POST["cname"];
	$cemail = $_POST["cemail"];
	$total_item = $_POST["total_item"];
	$total_amount = $_POST["total_amount"];
	$total_discount_amount = $_POST["total_discount_amount"];
	$total_bill = $_POST["total_bill"];

	$data = array(
		':cust_name'						=>	$_POST["cname"],
		':cust_email'						=>	$_POST["cemail"],
		':product_name'						=>	$product_name,
		':product_price'					=>	$tot_price,
		':product_dis'						=>	$tot_discount,
		':total_item'						=>	$_POST["total_item"],
		':total_amount'						=>	$_POST["total_amount"],
		':total_discount'					=>	$_POST["total_discount_amount"],
		':total_bill'						=>	$_POST["total_bill"]
		
	);

	$query = '';
	if($_POST["action"] == "insert")
	{
		 $query = "INSERT INTO product_data (cust_name, cust_email,product_name,product_price,product_dis,total_item,total_amount,total_discount,total_bill) VALUES (:cust_name, :cust_email,:product_name,:product_price,:product_dis,:total_item,:total_amount,:total_discount,:total_bill)";
		
	}
	if($_POST["action"] == "edit")
	{
		 $query = "
		UPDATE product_data 
		SET cust_name = :cust_name, 
		cust_email = :cust_email,
		product_name = :product_name,
		product_price = :product_price,
		product_dis = :product_dis,
		total_item = :total_item,
		total_amount = :total_amount,
		total_discount = :total_discount,
		total_bill = :total_bill
		
		WHERE id = '".$_POST['hidden_id']."'
		";

		/*$query1 = "UPDATE product_data 
		SET cust_name = '".$_POST["cname"]."', 
		cust_email = '".$_POST["cname"]."',
		product_name = '".$product_name."',
		product_price = '".$tot_price."',
		product_dis = '".$tot_discount."',
		total_item = '".$_POST["total_item"]."',
		total_amount = '".$_POST["total_amount"]."',
		total_discount = '".$_POST["total_discount_amount"]."',
		total_bill = '".$_POST["total_bill"]."', 
		WHERE id = '".$_POST['hidden_id']."'
		";*/

		/*$t = $conn->query($query1);
		var_dump($t);*/
	}



	$statement = $connect->prepare($query);
	//echo "\PDO::errorInfo():\n";
    //print_r($connect->errorInfo());
	$statement->execute($data);
}


?>