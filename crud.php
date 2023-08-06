<?php
function connection()
{
	$host="localhost";
	$user = "root";
	$password= "";
	$db_name="menu_sys_db";
	$conn=mysqli_connect($host,$user,$password,$db_name);
	return $conn;
}

	function fetch($table_name)
	{
		$conn=connection();

		$query= "select * from $table_name";
		$result= mysqli_query($conn,$query);
		return $result;
	}

	function query_exec($query)
	{
		$conn=connection();
		
		$result= mysqli_query($conn,$query);
		return $result;
	}

	function generate_invoice_no($table_name)
	{
		$conn=connection();
		
		$query="Select CONCAT(DATE_FORMAT(CURDATE(), '%y%m'), '-', COUNT(id) + 1) as `invoice_no` from $table_name";
		$result= mysqli_query($conn,$query);
		return mysqli_fetch_assoc($result)["invoice_no"];
	}

	function fetch_row($table_name,$condition)//array("username"=>"ahmed","password"=>"1234")
	{
		$conn=connection();
		$col= "";
		foreach ($condition as $key => $value) {
			$col.="$key='$value' and ";
		}
		$col=rtrim($col,"and ");
		$query="select * from $table_name where $col";
		$result= mysqli_query($conn,$query);
		return $result;
	}

	function insert_row($table_name,$data)
	{
		$conn=connection();

		$col= "";
		$rows="";

		foreach ($data as $key => $value) {
			$col.="$key,";
			$rows.="'$value',";
		}
		$col=rtrim($col,",");
		$rows=rtrim($rows,",");
		 $query="insert into $table_name($col) values($rows)";

		$result=mysqli_query($conn,$query);

		echo mysqli_error($conn);

		if($result){
			return mysqli_insert_id($conn);
		}else{
			return false;
		}

	}

	function create_insert_query($table_name,$data)
	{
		$conn=connection();

		$col= "";
		$rows="";

		foreach ($data as $key => $value) {
			$col.="$key,";
			$rows.="'$value',";
		}
		$col=rtrim($col,",");
		$rows=rtrim($rows,",");
		$query="insert into $table_name($col) values($rows)";

		return $query;
	}
	function insert_mul_row($query)
	{
		$conn=connection();


		$result=mysqli_multi_query($conn,$query);

		echo mysqli_error($conn);

		return $result;
	}
function delete_row($table_name,$condition)
	{
		$conn=connection();
		$col= "";
		foreach ($condition as $key => $value) {
			$col.="$key='$value' and ";
		}
		$col=rtrim($col,"and ");
		 $query="delete from $table_name where $col";
		$result= mysqli_query($conn,$query);
		return $result;
	}
								
	function update_row($table_name,$data,$condition)
	{
		$conn=connection();
		$col_row= "";
		$cond="";
		foreach ($data as $key => $value) {
			$col_row.="$key='$value',";			
		}

		foreach ($condition as $key => $value) {
			$cond.="$key='$value' and ";			
		}

		$col_row=rtrim($col_row,",");
		$cond=rtrim($cond,"and ");
		 $query="update $table_name set $col_row where $cond";
		$result= mysqli_query($conn,$query);
		return $result;
	}

?>