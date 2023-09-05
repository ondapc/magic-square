<?php
require_once( 'config.php' );

// DEFINE SOME STUFF
$grid  = (isset($_REQUEST['grid']) && $_REQUEST['grid']) ? $_REQUEST['grid'] : '5';
$grid = (int) $grid;

$magic_constant = ($grid / 2) * (pow($grid, 2) + 1);
$description = '<br/><h5 class="text-center">Magic square has a grid '.$grid.'<b>x</b>'.$grid.' and all diagonals / horizontals / vertical values sum up to '.$magic_constant.'</h5>';
$gridx = $grid.'<b>x</b>'.$grid;

// MAGIC SQUARE A
$matrix_v1 = magic_square_v1($grid);
$array_v1 = magic_square_array($grid, $matrix_v1);
$array_v1[] = magic_square_diagonal($array_v1);
$table_v1 = table_magic_square($grid, $matrix_v1);
$array_magic_sq_v1 = array_merge_recursive($array_v1["X"], $array_v1["Y"]);
$array_magic_diagonal_v1 = magic_square_diagonal($array_v1);
$array_magic_sq_v1[] = $array_magic_diagonal_v1["D1"];
$array_magic_sq_v1[] = $array_magic_diagonal_v1["D2"];	
for( $i=0; $i<count($array_magic_sq_v1); $i++ ) {
	$html_table_permutations_v1[] = table_grid_permutations($grid, $i, $array_magic_sq_v1);
}
// HEATMAP TABLE A
$numbers_used_v1 = array_flatten($array_magic_sq_v1);
$count_occurrences_v1 = array_count_values($numbers_used_v1);
ksort($count_occurrences_v1);

// MAGIC SQUARE B
$matrix_v2 = magic_square_v2($grid);
$array_v2 = magic_square_array($grid, $matrix_v2);
$array_v2[] = magic_square_diagonal($array_v2);
$table_v2 = table_magic_square($grid, $matrix_v2);
$array_magic_sq_v2 = array_merge_recursive($array_v2["X"], $array_v2["Y"]);
$array_magic_diagonal_v2 = magic_square_diagonal($array_v2);
$array_magic_sq_v2[] = $array_magic_diagonal_v2["D1"];
$array_magic_sq_v2[] = $array_magic_diagonal_v2["D2"];	
for( $i=0; $i<count($array_magic_sq_v2); $i++ ) {
	$html_table_permutations_v2[] = table_grid_permutations($grid, $i, $array_magic_sq_v2);
}
// HEATMAP TABLE B
$numbers_used_v2 = array_flatten($array_magic_sq_v2);
$count_occurrences_v2 = array_count_values($numbers_used_v2);
ksort($count_occurrences_v2);

// HEATMAP IMAGE OF BOTH RESULTS
$all_magic_sq_arrays = array_merge_recursive($array_v1, $array_v2);
$magic_sq_occurrences = array_flatten($all_magic_sq_arrays);
$magic_sq_occurrences = array_count_values($magic_sq_occurrences);
ksort($magic_sq_occurrences);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="address=no,email=no,telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title><?php echo strtoupper(trim(strip_tags($description))); ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/style.css?v=<?php echo VERSION; ?>"/>
</head>
<body>

<div class="p-2"></div>
<div class="container text-center form">
<form action="?" method="GET" class="form-inline" >	
<div class="row">
<div class="col-sm-10 col-md-11 text-center p-2"><input type="number" class="form-control form-control-lg" placeholder="magic square <?php echo strip_tags($gridx); ?> grid" value="<?php echo $grid; ?>" name="grid"></div>
<div class="col-sm-2 col-md-1 text-center p-2"><input type="submit" value="GO"  class="btn btn-primary btn-lg" /></div>
</div> 
</form>
</div>

<?php
if ( $grid <= 2 ) {
	echo '<h1 class="text-center">There is no solution for n = '.$grid.'</h1>';
	echo '</body></html>';
	exit();
	die();
}
echo $description;
?>

<div class="p-2"></div>
<div class="container-fluid text-center">
	<div class="row">
		<div class="col-sm-12 col-md-6 text-center p-2">
			<h6><b><?php echo $gridx; ?> MAGIC SQUARE A</b> <?php echo magic_square_valid($matrix_v1); ?></h6>
			<?php echo $table_v1; ?>
			<div class="p-1" style="clear:both;"></div>
			<button class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#permutations_v1">Permutations A</button>
			<div id="permutations_v1" class="collapse text-center">
				<?php echo join("\n", $html_table_permutations_v1);?>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 text-center p-2">
			<h6><b><?php echo $gridx; ?> MAGIC SQUARE B</b> <?php echo magic_square_valid($matrix_v2); ?></h6>
			<?php echo $table_v2; ?>
			<div class="p-1" style="clear:both;"></div>
			<button class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#permutations_v2">Permutations B</button>	
			<div id="permutations_v2" class="collapse text-center">
				<?php echo join("\n", $html_table_permutations_v2);?>
			</div>	
		</div>
	</div> 
</div>

<div class="p-2"></div>
<div class="container-fluid text-center">
	<div class="row">
		<div class="col-sm-12 col-md-6 text-center p-2">
			<h6><b>HEATMAP PERMUTATIONS A</b></h6>
			<?php echo table_grid_heatmap($count_occurrences_v1, $grid); ?>
		</div>
		<div class="col-sm-12 col-md-6 text-center p-2">
			<h6><b>HEATMAP PERMUTATIONS B</b></h6>			
			<?php echo table_grid_heatmap($count_occurrences_v2, $grid); ?>
		</div>
	</div> 
</div>

<div class="p-2"></div>
<div class="container-fluid text-center">
	<div class="row">
		<div class="col-sm-12 col-md-12 text-center p-2">
			<h6><b>HEATMAP BOTH PERMUTATIONS ( A &amp; B )</b></h6>
			<?php echo table_grid_heatmap($magic_sq_occurrences, $grid); ?>
		</div>
	</div> 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>
