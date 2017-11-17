<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="address=no,email=no,telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Magic Squares using PHP</title>
<!-- CDN CSS -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"><!-- DataTables CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!-- BootStrap CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"><!-- fontawesome minified CSS -->
<!-- CDN JS -->
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js"></script><!-- jQuery JS -->
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script><!-- DataTables JS-->
<script type="text/javascript" language="javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><!-- Bootstrap JS -->
<style>
.container {width:98%; padding:10px; }
.tables    { text-align:center; padding:10px; }
.td_magic  { padding: 5px; background-color: #C0C0C0; }
.td_magic2  { padding: 5px; background-color: red; }
.td_center { padding: 5px; background-color: #000; color: #FFF; }
.td_normal { padding: 5px;}
.td_sums   { padding: 5px; color: red; border:0px;  }
</style>
</head>
<body>
	
<div class="container">

<div class="dropdown">  	
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Symmetry Magic Square 
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
	 <?php
	 for ($i=2; $i<=6; $i++ ) {
		echo '<li><a href="?grid='.$i.'">'.$i.'x'.$i.'</a></li>'; 
	 }
	 ?>
  </ul>
  
  <a href="index.php?grid=<?php echo $grid; ?>" class="btn btn-default">Magic Squares</a>
</div> 	



<?php


if ( $grid < "7" ) {

	// MAGIC CONSTANT
	$magic = getDiagonalSum($grid);

	// SQUARE $grid
	$grid_squared = pow($grid,2);
	for ($x=1; $x<=$grid_squared; $x++) {
	$number_array[] = $x;
	}
	$numbers_chunk = array_chunk($number_array, $grid);

	echo "<b>" . $magic . "</b> Sum Number<br/>";


	$x = permutations($numbers_chunk);

	for ( $i=0; $i<count($x); $i++ ) {
		if ( array_sum($x[$i]) == $magic ) {
			$permutations[] = $x[$i];
		}
	}
	asort($permutations);



	echo "<b>" . ( count($permutations) * 2 ) . "</b> Unique Permutations<br/>";


	echo "<b>" . count($permutations) . "</b> Symmetrical Permutations<br/>";

	for ( $i=0; $i<count($permutations); $i++) {
		 $html_tables[] = table_grid_print_sym($grid, $i, $permutations); // Y AXIS	
	}


	echo "If you add the numbers in gray you will get the magic constant = <b>" . $magic . "</b><br/>";


	$total = count($html_tables);
	for ( $i=0; $i<$total; $i++ ) {

		$x = $i;
		
		if ( $i == 0 ) {
			$y = ($total - 1);
		} else {
			$y = ($total - ( $i + 1) );
		}

		echo "<div>";
		echo $html_tables[$x] . " " . $html_tables[$y];
		echo "</div>";
		echo "<br style='clear:both;'>";	
	}


} else {

echo "<br/><br/><h3>IF THE GRID IS GREATER THAN 6 YOU WILL HAVE MILLIONS OF POSSIBLE COMBINATIONS</h3>";
	
}
?>
</div>	
</body>
</html>
