<?php
// FLATTENS AN ARRAY
function array_flatten($a) { 
    $ab = array(); 
    
    if(!is_array($a)) return $ab;
    foreach($a as $value){
        if(is_array($value)){
            $ab = array_merge($ab,array_flatten($value));
        } else {
            array_push($ab,$value);
        }
    }
    return $ab;
}

// INTEGER VALID SET
function string_integer($int) {
	if(preg_match('/^\d+$/',$int)) {
		$int = $int;
	} else {
		$int = 5;
	}
	return $int;
}

// VALIDATES A MAGIC SQUARE ARRAY COMPUTES > HORIZONTAL, VERTICAL, AND DIAGONAL SUMS
function magic_square_valid($matrix) {
	$error = '( <span class="text-danger strong">INVALID</span> )';
	$msg = '( <span class="text-success strong">VALID</span> )';
    // sumd1 and sumd2 are the sum of the two diagonals
    $sumd1 = 0; $sumd2 = 0;
    $n= count($matrix);
    for($i = 0; $i < $n; $i++) {
        // (i, i) is the diagonal from top-left -> bottom-right
        $sumd1 = $sumd1 + $matrix[$i][$i];
        // (i, N - i - 1) is the diagonal from top-right -> bottom-left
        $sumd2 = $sumd2 + $matrix[$i][$n-$i-1];
    }
    // if the two diagonal sums are unequal then it is not a magic square
    if( $sumd1 != $sumd2) {
        $msg = $error;
	}
	// checks the horizontal and vertical sums
    for($i = 0; $i < $n; $i++) {
        $rowSum = 0;    $colSum = 0;
        for ($j = 0; $j < $n; $j++) {
			$rowSum += $matrix[$i][$j];
			$colSum += $matrix[$j][$i];
        }
        if ($rowSum != $colSum || $colSum != $sumd1) {
            $msg = $error;
        }
    }
    return $msg;
}

// GENERATE A MULTI-DIMENSIONAL ARRAY OF THE MAGIC SQUARE
function magic_square_array($grid, $matrix) {
	$i = 0;
	$j = 0;
	$sum = 0;
	$arr = array();
	for ( $i=0 ; $i < $grid ; $i++ ) {
		$sum = $sum + $matrix[$i][$grid-$i-1];
	}
	for ( $i=0 ; $i < $grid ; $i++ ) {
		for ( $j=0 ; $j<$grid ; $j++ ) {
			$arr["X"][$j][] = $matrix[$i][$j];
			$arr["Y"][$j][] = $matrix[$j][$i];
		}
	}
	return $arr;
}

// GENERATE DIAGONAL COUNTERPARTS OF THE MAGIC SQUARE
function magic_square_diagonal($matrix) {
	$m = count($matrix["X"]);
	$arr = array();	
	for ($i = 0; $i < $m; $i++) {
		$arr["D1"][] = $matrix["X"][$i][$i];
	}	
	for ($i = 0; $i < $m; $i++) {
		$arr["D2"][] = $matrix["Y"][$i][$m-$i-1];
	}	
	return $arr;
}

// A SWISS KNIFE MAGIC SQUARE SOLUTION (A) >> FOR ALL NUMBERS >= 3
function magic_square_v1($n) {
	// Odd order
	if (($n % 2) == 1) {
	$a = ($n+1)/2;
	$b = ($n+1);
	for ($j = 0; $j < $n; ++$j)
		for ($i = 0; $i < $n; ++$i)
		$arr[$i][$j] = $n*(($i+$j+$a) % $n) + (($i+2*$j+$b) % $n) + 1;
	
	// Doubly Even Order
	} else if (($n % 4) == 0) {
	for ($j = 0; $j < $n; ++$j) {
		for ($i = 0; $i < $n; ++$i) {
		if ((($i+1)/2)%2 == (($j+1)/2)%2)
			$arr[$i][$j] = $n*$n-$n*$i-$j;
		else
			$arr[$i][$j] = $n*$i+$j+1;
		}
	}
	
	// Singly Even Order
	} else {
	$p = $n/2;
	$k = ($n-2)/4;
	$A = magic_square_v1($p);
	$M = array();
	for ($j = 0; $j < $p; ++$j) {
		for ($i = 0; $i < $p; ++$i) {
		$aij = $A[$i][$j];
		$arr[$i][$j]       = $aij;
		$arr[$i][$j+$p]    = $aij + 2*$p*$p;
		$arr[$i+$p][$j]    = $aij + 3*$p*$p;
		$arr[$i+$p][$j+$p] = $aij + $p*$p;
		}
	}
	for ($i = 0; $i < $p; ++$i) {
		for ($j = 0; $j < $k; ++$j) {
		$t = $arr[$i][$j];
		$arr[$i][$j] = $arr[$i+$p][$j];
		$arr[$i+$p][$j] = $t;
		}
		for ($j = $n-$k+1; $j < $n; ++$j) {
		$t = $arr[$i][$j];
		$arr[$i][$j] = $arr[$i+$p][$j];
		$arr[$i+$p][$j] = $t;
		}
	}
	
	$t = $arr[$k][0]; $arr[$k][0] = $arr[$k+$p][0]; $arr[$k+$p][0] = $t;
	$t = $arr[$k][$k]; $arr[$k][$k] = $arr[$k+$p][$k]; $arr[$k+$p][$k] = $t;
	}
	return $arr;
}

// A SWISS KNIFE MAGIC SQUARE SOLUTION (B) >> FOR ALL NUMBERS >= 3
function magic_square_v2($n) {
	if ( $n%2 == 1 ) {
		// odd
		$i = ($n-1)/2 + 1 ;
		$j = ($n-1)/2 ;
		for( ($k = 1) ; ($k <= ($n*$n)) ; $k++ ) {
			$arr[$i][$j] = $k ;
			if ( $k % $n == 0 ) {
				$i = $i + 2 ;
			} else {
				$i++ ;
				$j++ ;
			}
			if ( $i >= $n ) {
				$i = $i - $n ;
			} elseif ( $j >= $n ) {
				$j = $j - $n;
			}
		}
	} elseif ( $n%4 == 0 ) {
		// doubly even
		$k = 1 ;
		for ( $i=0 ; $i < $n ; $i++ ) {
			for ( $j=($n-1) ; $j >= 0 ; $j-- ) {
				if ((($i%4 == 1) or ($i%4 == 2)) xor (($j%4 == 1) or ($j%4 == 2))) {
					$arr[$i][$j] = $n*$n-$k+1 ;
				} else {
					$arr[$i][$j] = $k ;
				}
				$k++ ;
			}
		}
	} else {
		// singly even
		$k = 1 ;
		for ( $i=0 ; $i < $n ;$i++ ) {
			for ( $j=($n-1) ; $j >= 0 ; $j-- ) {
				if (($i == $j ) or ($i+$j+1 == $n)) {
					$arr[$i][$j] = $k ;
				} elseif (((($i+$j)%2 == 0) and ((($i+$j >= $n) and ($j < $n/2)) or (($i-$j > 0) and ($i < $n/2) and ($i > 2)) or (($j-$i > 0) and ($i >= $n/2)) or (($i+$j < $n) and ($j >= $n/2) and ($i > 1)))) or ((($i+$j)%2 == 1) and ((($i+$j < $n) and ($i >= $n/2)) or (($j-$i > 0) and ($j < $n/2) and ($i > 1)) or (($i-$j > 0) and ($j >= $n/2)) or (($i+$j > $n) and ($i < $n/2) and ($i > 2))))) {
					$arr[$i][$j] = $n*$n-$k+$n-$j*2;
				} elseif (((($i+$j)%2 == 0) and ((($j-$i > 0) and ($j < $n/2)) or (($i+$j >= $n) and ($i < $n/2) and ($j < $n-2)) or (($i+$j < $n) and ($i >= $n/2)) or (($i-$j > 0) and ($j >= $n/2) and ($j < $n-3)))) or ((($i+$j)%2 == 1) and ((($i-$j > 0) and ($i < $n/2)) or (($i+$j < $n) and ($j >= $n/2) and ($j < $n-3)) or (($i+$j >= $n) and ($j < $n/2)) or (($j-$i > 0) and ($i >= $n/2) and ($j < $n-2))))) {
					$arr[$i][$j] = ($i*2+1)*$n-$k+1 ;
				} else {
					$arr[$i][$j] = $n*$n-$k+1 ;
				}
				$k++ ;
			}
		}
	}
	return $arr;	
}

// MAP COLORS PASSED
function color_gradient($HexFrom, $HexTo, $ColorSteps) {

    $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
    $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
    $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));

    $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
    $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
    $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));

    $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
    $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
    $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);

    $GradientColors = array();
    for($i = 0; $i <= $ColorSteps; $i++) {
        $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
        $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
        $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));

        $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
        $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
        $HexRGB['b'] = sprintf('%02x', ($RGB['b']));

        $GradientColors[] = implode("", $HexRGB);
    }
    $GradientColors = array_filter($GradientColors, function($val){
        return (strlen($val) == 6 ? true : false );
    });
    return $GradientColors;
}

// GENERATE GRADIENT COLOR FROM FUNCTION
function color_from_gradient($n, $min, $max, $colors) {
    $tablecolors = [];
    $prevcolor = array_shift($colors);
    foreach ($colors as $color) {
        $tablecolors = array_merge($tablecolors, color_gradient($prevcolor, $color, 10));
        $prevcolor = $color;
    }
    $max = $max-$min;
    if ( $max == 0 ) {
		$max = 1;
	} else {
		$max = $max;
	}
    $n-= $min;
    if ($n > $max) $n = $max;
    
    $ncolor = (int)round(count($tablecolors)/$max * $n)-1;
    if ( $ncolor > 0 ) {
		$ncolor = $ncolor;
	} else {
		$ncolor = 1;
	}
    $tablecolors[$ncolor] = $tablecolors[$ncolor];
    
    return '#' . $tablecolors[$ncolor];
}

// GET THE NEATMAP MIN / MAX FROM ARRAY VALUES
function table_grid_heatmap($array, $grid) {
	$array_flip = $array;
	$min = min($array_flip);
	$max = max($array_flip);
	$columns = $grid;
	$rows = $columns * $columns;	
	$html[] = '<div class="div_table">';
	$html[] = '<table class="tables">';
	$html[] = '<tr>';
	foreach ($array as $key => $value) {
		$html[] = '<td class="td_gradient" style="background-color: '.color_from_gradient($value, $min, $max, ['FFFFFF', 'FFFF00', 'FF0000']).';"><b>' . $key . '</b> <sup>'.$value.'</sup></td>';
		// check if we need a new row
		if($key % $columns === 0) {
			$html[] = "</tr><tr>";
		}
	}
	$html[] = '</tr>';
	$html[] = '</table>';
	$html[] = '<h6 class="small">N<sup>X</sup> WHERE N = NUMBER AND X = OCCURRENCE RATE</h6>';
	
	$html[] = '</div>';	
	return join("\n", $html);
}

// HTML TABLE OF WITH MAGIC SQ. SUM PERMUTATIONS
function table_grid_permutations($grid, $x, $grid_arrays) {
	$columns = $grid;
	$rows = $grid * $grid;
	$html[] = '<div class="table_permutation">';	
	$html[] = '<table class="tables">';
	$html[] = '<tr>';
	for($i=1; $i<=$rows; $i++) {
		$d = $grid_arrays;
		$style = style_numbers($i, $d[$x]);
		$html[] = "<td ".$style.">" . $i . "</td>";
		// check if we need a new row
		if($i % $columns === 0) {
			$html[] = "</tr><tr>";
		}
	}
	$html[] = '</tr>';
	$html[] = '</table>';
	$html[] = '</div>';	

	return join("", $html);
}

// STYLE CELLS ( HIGHLIGHT SUMS PERMUTATIONS )
function style_numbers($i, $diagonals) {
	$style = "";
	if (in_array($i, $diagonals)) {
		$style = 'class="td_magic" ';
	} else {
		$style = 'class="td_norm" ';
	}
return $style;	
}

// PRINTS THE TABLE WITH THE NUMBERS OF THE MAGIC GRID
function table_magic_square($grid, $matrix) {
	$i = 0;
	$j = 0;
	$html[] = '<div class="div_table">';	
	$html[] = '<table class="table_magic_square table-sm">';
	$diagonals = array();
	$diagonals["X"] = array();
	$diagonals["Y"] = array();
	for ( $i=0; $i < $grid; $i++ ) {
		$diagonals["X"][] += $matrix[$i][$i]; // TOP TO BOTTOM RIGHT
        $diagonals["Y"][] += $matrix[$i][$grid - $i - 1]; // RIGHT TO BOTTOM LEFT
		$html[] = '<tr>';
		for ( $j=0 ; $j < $grid ; $j++ ) {
			$number = $matrix[$i][$j];
			if (in_array($number, $diagonals["X"])) {
				$style_class = 'td_diagonal_x';
			} elseif ( in_array($number, $diagonals["Y"])) {
				$style_class = 'td_diagonal_y';			
			} else {
				$style_class = "";
			}
			$html[] = '<td align="center" class="'.$style_class.'">'.$number.'</td>';
		}
		$html[] = '</tr>';
	}
	$html[] = '</table>';
	$html[] = '</div>';	
	return join("\n", $html);
}

