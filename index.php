<?php 
require_once('config.php');
// ERRORS
error_reporting(E_ALL);
ini_set('display_errors', 1);


// CHECK 
if (is_numeric($grid)) {
	$grid = $grid;
} else {
	$grid = 3;
}

// SQUARE $grid
$grid_squared = pow($grid,2);

$b = $grid_squared;	// numbers to count to
$i = 0;				// incrementor
$z = $grid;			// how many cols?

for ($x=1; $x<=$grid_squared; $x++) {
$number_array[] = $x;
}
$diagonals = getDiagonals($number_array, $grid);

$grid_cube_number = array_chunk($number_array, $grid);

$magic_square = magicSquareGrid($grid);

// MAGIC ARRAY & SUBSET V1
$magic_v1 = magicSquareGrid($grid);
$subset_v1 = array_subset($magic_v1);
$magic_square_v1 = array_merge_recursive($magic_v1, $subset_v1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="address=no,email=no,telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Magic Grid Squares using PHP</title>
<!-- CDN CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!-- BootStrap CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"><!-- fontawesome minified CSS -->
<!-- CDN JS -->
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js"></script><!-- jQuery JS -->
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
	
<!-- DROPDOWN-->
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Magic Squares <span class="caret"></span></button>
  <ul class="dropdown-menu">
	 <?php
	 for ($y=2; $y<=30; $y++ ) {
		echo '<li><a href="?grid='.$y.'">'.$y.'x'.$y.'</a></li>'; 
	 }
	 ?>
  </ul>
  
  <a href="reorder.php?grid=<?php echo $grid; ?>" class="btn btn-primary">Permutations</a>
</div> 	


<!-- GRID 1 -->
<div class="row">
  <div class="col-md-9">
	<div style="padding:10px;">
	<i class="fa fa-chevron-down" aria-hidden="true"></i> Grid Diagonal
	<br/>
	<br/>
	<table border="1" cellpadding="10" class="tables">
	<?php
	$a="";
	while($i < $b)
	{
		if($i == 0 || $i == $a) {
			echo "<tr>";
			$a = $a + $z; // the beginning ist always $a + cols per row or zero
			$e = $a - 1;  // the end ist always $a - 1;
			if ($e > $b)  // if the end is geater then our count 
			{
			$e = $b - 1; //we make $b - 1 and thats the end tag
			}
		 }
			
		$grid_numbers = ($i+1); 
		$style = style_numbers($grid_numbers, $diagonals);	
		echo "<td ".$style.">".$grid_numbers."</td>";

		if ($i == $e) {
			if ( ($a==$grid) || ($a==$grid_squared) ) {
				echo "<td class='td_sums'> <i class='fa fa-arrow-right' aria-hidden='true'></i> ". getDiagonalSum($grid)."</td>";	
			} else {
				echo "<td class='td_sums'></td>";
			}
			echo "</tr>";
		}
		$i++;
	}
	?>
	</table>
	<br/>
	<i class="fa fa-chevron-down" aria-hidden="true"></i> Magic Square V1
	<br/>
	<br/>
	
	
	<!-- GRID 2 -->
	<table border="1" cellpadding="10" class="tables">
	<?php
	for ($row = 0; $row < $grid; $row++) {
		echo "<tr>";
		for ($column = 0; $column < $grid; $column++) {
			$grid_m = $magic_square[$row][$column];
			$style = style_numbers($grid_m, $diagonals);		
			echo "<td ".$style.">".$grid_m."</td> ";

		}
		echo "<td class='td_sums'> <i class='fa fa-arrow-right' aria-hidden='true'></i> ". getDiagonalSum($grid)."</td>";	
		echo "</tr> ";
	}
	for ($row = 1; $row <= 1; $row++) {
		echo "<tr>";
		for ($column = 0; $column < $grid; $column++) {
			echo "<td class='td_sums'> <i class='fa fa-arrow-down' aria-hidden='true'></i><br/>". getDiagonalSum($grid)."</td>";
		}
		echo "";	
		echo "</tr> ";
	}
	?>
	</table>
	
	<!-- GRID 3 -->
	<?php
	if ($grid % 2 != 0) {
		$magic_square = magic_odd($grid);
		$magic_v2 = magic_odd($grid);
		$subset_v2 = array_subset($magic_v2);
		$magic_square_v2 = array_merge_recursive($magic_v2, $subset_v2);
		
		echo '<br/>';	
		echo '<i class="fa fa-chevron-down" aria-hidden="true"></i> Magic Square V2';
		echo '<br/>';
		echo '<br/>';
		echo '<table border="1" cellpadding="10" class="tables">';
		for ($row = 0; $row < $grid; $row++) {
			echo "<tr>";
			for ($column = 0; $column < $grid; $column++) {
				$grid_m = $magic_square_v2[$row][$column];
				$style = style_numbers($grid_m, $diagonals);
				echo "<td ".$style.">".$grid_m."</td> ";
			}
			echo "<td class='td_sums'> <i class='fa fa-arrow-right' aria-hidden='true'></i> ". getDiagonalSum($grid)."</td>";			
			echo "</tr> ";
		}
		for ($row = 1; $row <= 1; $row++) {
			echo "<tr>";
			for ($column = 0; $column < $grid; $column++) {
				echo "<td class='td_sums'> <i class='fa fa-arrow-down' aria-hidden='true'></i><br/>". getDiagonalSum($grid)."</td>";
			}
			echo "";	
			echo "</tr> ";
		}	
		echo '</table>';
	}
	?>

	</div>
  </div>
  
  
  <div class="col-sm-3">

	<h3>Order <?php echo $grid; ?></h3>
	<h3>Grid <?php echo $grid; ?><sup>2</sup></h3>
	<h3>Middle Number: <?php echo getMiddleNum($grid); ?></h3>
	<h3>Sum Number = <?php echo getDiagonalSum($grid); ?></h3>
	<h3>Grid From <b>1</b> to <b><?php echo $grid_squared; ?></b></h3>
	
	<button data-toggle="collapse" data-target="#magicDiag" class="btn btn-primary">Diagonals Array Values = <?php echo getDiagonalSum($grid); ?></button><br/><br/>
	<div id="magicDiag" class="collapse">	
		<pre>
		<?php
		for ($i=0; $i<count($grid_cube_number); $i++ ) {
			$x = ( count($grid_cube_number) - 1 ) - $i;
			$diagonalx[] = $grid_cube_number[$i][$i];
			$diagonaly[] = $grid_cube_number[$i][$x];	
		}
		$diagonal = array();
		$diagonal[] = $diagonalx;
		$diagonal[] = $diagonaly;
		print_r($diagonal);
		?>
		</pre>
	</div>	
	
	<button data-toggle="collapse" data-target="#magicv1" class="btn btn-primary">Magic Square V1 Array Values = <?php echo getDiagonalSum($grid); ?></button><br/><br/>
	<div id="magicv1" class="collapse">
		<pre>
		<?php print_r($magic_square_v1); ?>
		</pre>
	</div>
	
	<?php if ($grid % 2 != 0) { ?>
	<button data-toggle="collapse" data-target="#magicv2" class="btn btn-primary">Magic Square V2 Array Values = <?php echo getDiagonalSum($grid); ?></button><br/><br/>
	<div id="magicv2" class="collapse">	
		<pre>
		<?php print_r($magic_square_v2); ?>
		</pre>
	</div>
	<?php } ?>

  </div>
</div>

</div>

</body>
</html>
