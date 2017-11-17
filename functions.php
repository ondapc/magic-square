<?php
/* Vertical Array Drill Down
so array(1,2,3), array(4,5,6), array(7,8,9),
are combined as follows:
	1 2 3
	4 5 6
	7 8 9
subset = array(1,4,7), array(2,5,8), array(3,6,9),
combined by key value
*/
function array_subset($array) {
	for ( $i=0; $i<count($array); $i++) {
		foreach ($array as $key => $value) {
			$subset[$i][] = $array[$key][$i];
		}
	}
	return $subset;
}

/*
* Diagonl Sum Number Eqution = [n(n2 + 1)] / 2 = M ( n is squared ) 
*/
function getDiagonalSum($grid) {
	$n = ( pow($grid, 2) + 1 ) / 2;
	$magic_sum = $n * $grid;
	return $magic_sum;
}
/*
* Middle Number Eqution = [(n2 + 1)] / 2 = M ( n is squared ) 
*/
function getMiddleNum($grid) {
	$middle_num = ( pow($grid, 2) + 1 ) / 2;
	return $middle_num;
}

/*
* Grid Magic Square
*/
function magicSquareGrid($grid) {

$dime = $grid;
$number_of_elements = $dime * $dime;
$values = 1;

for ($row = 0; $row < $dime ; $row++) {
    for ($column = 0; $column < $dime; $column++) {
        $array_a[$row][$column] = $values++;
     }  
	$middle = $dime/2;
	$middle = ceil($middle) - 1;
}
for ($column = 0; $column<$dime; $column++) {
    $array_b[$middle][$column] = $column+1;
	$temp_b = $middle-1;
}

while($temp_b >= 0) {
	for ($column = 0; $column < $dime; $column++) {
		if ((($array_b[$temp_b+1][$column])-1) != 0) {
			$array_b[$temp_b][$column] = $array_b[$temp_b+1][$column]-1;
		} else {
			$array_b[$temp_b][$column] = $dime;   
		}
	}
$temp_b--;
}
   
$temp_b = $middle+1;   
while($temp_b < $dime) {
    for ($column = 0; $column < $dime;$column++) {
		if ((($array_b[$temp_b-1][$column])+1) <= $dime) {
			$array_b[$temp_b][$column] = $array_b[$temp_b-1][$column]+1;
		} else {
			$array_b[$temp_b][$column] = $array_b[$temp_b-1][$column]+ 1 - $dime;
		}
	}
$temp_b++;
}

$swape = $dime-1;
for ($row = 0; $row < $dime ; $row++) {
    for ($column = 0; $column < $dime; $column++) {
        $array_c[$row][$column] = $array_b[$swape][$column];
	}
$swape--;
}

for ($row = 0; $row < $dime ; $row++) {
    for ($column = 0; $column < $dime; $column++) {   
		$row_element = $array_b[$row][$column]-1;
        $column_element = $array_c[$row][$column]-1;
        $magic_square[$row][$column] = $array_a[$row_element][$column_element];
    }
}

return $magic_square;
}

// DIAGONALS
function getSpiralDiagonal($spiralArr,$N){
    $diagonalValueCount = $N*2;
    $xIndexMainDiagonal = 0;
    $yIndexMainDiagonal = 0;
    $xIndexAntiDiagonal = 0;
    $yIndexAntiDiagonal = $N-1;
    while($diagonalValueCount > 0){
        // checking for same position
        if($yIndexMainDiagonal == $yIndexAntiDiagonal){
            $diagonals[] = $spiralArr[$xIndexMainDiagonal][$yIndexMainDiagonal];
        } else {
            $diagonals[] = $spiralArr[$xIndexMainDiagonal][$yIndexMainDiagonal];
            $diagonals[] = $spiralArr[$xIndexAntiDiagonal][$yIndexAntiDiagonal];
        }

        $xIndexMainDiagonal++;
        $yIndexMainDiagonal++;
        $xIndexAntiDiagonal++;
        $yIndexAntiDiagonal--;
        $diagonalValueCount -= 2;
    }
	return $diagonals;
}
function getDiagonals($number_array, $grid) {
	$spiralArr = array_chunk($number_array, $grid);
	$diagonals = getSpiralDiagonal($spiralArr,$grid);
	return $diagonals;	
}


/* GRID STYLE HIGHTLIGHT DIAGONALS, SEQUENCES 
 * grid = base of matrix so a 3x3 matrix = 3
 * grid_m = an array of numbers in the current grid
 * diagonals = the corresponding diagonals from the base matrix
*/
function style_numbers($grid_m, $diagonals) {
	$style = "";
	$array_style = array("td_magic","td_magic2");
	if (in_array($grid_m, $diagonals)) {
		$style =  " class='td_magic' ";
	} else {
		$style =  " class='td_normal' ";
	}
return $style;	
}


// MAGIC SQUARE ONLY ODD NUMBERS
function magic_odd($n) {
    $M = array();
    // Odd order
    if (($n % 2) == 1) {
      $a = ($n+1)/2;
      $b = ($n+1);
      for ($j = 0; $j < $n; ++$j)
        for ($i = 0; $i < $n; ++$i)
          $M[$i][$j] = $n*(($i+$j+$a) % $n) + (($i+2*$j+$b) % $n) + 1;

    // Doubly Even Order
    } else if (($n % 4) == 0) {
      for ($j = 0; $j < $n; ++$j) {
        for ($i = 0; $i < $n; ++$i) {
          if ((($i+1)/2)%2 == (($j+1)/2)%2)
            $M[$i][$j] = $n*$n-$n*$i-$j;
          else
            $M[$i][$j] = $n*$i+$j+1;
        }
      }

    // Singly Even Order
    } else {

      $p = $n/2;
      $k = ($n-2)/4;
      $A = magic_odd($p);

      for ($j = 0; $j < $p; ++$j) {
        for ($i = 0; $i < $p; ++$i) {
          $aij = $A->get($i,$j);       
          $M[$i][$j]       = $aij;
          $M[$i][$j+$p]    = $aij + 2*$p*$p;
          $M[$i+$p][$j]    = $aij + 3*$p*$p;
          $M[$i+$p][$j+$p] = $aij + $p*$p;
        }
      }

      for ($i = 0; $i < $p; ++$i) {
        for ($j = 0; $j < $k; ++$j) {
          $t = $M[$i][$j];
          $M[$i][$j] = $M[$i+$p][$j];
          $M[$i+$p][$j] = $t;
        }
        for ($j = $n-$k+1; $j < $n; ++$j) {
          $t = $M[$i][$j];
          $M[$i][$j] = $M[$i+$p][$j];
          $M[$i+$p][$j] = $t;
        }
      }

      $t = $M[$k][0];  $M[$k][0]  = $M[$k+$p][0];  $M[$k+$p][0]  = $t;
      $t = $M[$k][$k]; $M[$k][$k] = $M[$k+$p][$k]; $M[$k+$p][$k] = $t;

    }
    return $M;
}

/*
$grid = a number like 4 => 4x4 grid
$x = row 0,1,2,3,4
$grid_arrays = contain the arrays that the table cells represent
*/
function table_grid_print($grid, $x, $grid_arrays) {
	$columns = $grid;
	$rows = pow($columns, 2);
	$magic_number = array_sum($grid_arrays[0]);
	$html[] = '<div style="float:left; padding-right:10px; padding-top:10px;">';	
	$html[] = '<span class="td_sums"><i class="fa fa-arrow-down" aria-hidden="true"></i> ' . $magic_number . '</span>';
	$html[] = '<br/>';
	
	$html[] = '<table border="1" cellpadding="10" class="tables">';
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

	return join("\n", $html);
}

// HTML TABLE
function table_grid_print_sym($grid, $x, $grid_arrays) {
	$columns = $grid;
	$rows = $columns * $columns;
	$magic_number = array_sum($grid_arrays[0]);
	$html[] = '<div style="float:left; padding-right:10px; padding-top:10px;">';	
	$html[] = '<table border="1" cellpadding="10" class="tables">';
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

	return join("\n", $html);
}


function permutations(array $array, $inb=false)
{
    switch (count($array)) {
        case 1:
            // Return the array as-is; returning the first item
            // of the array was confusing and unnecessary
            return $array[0];
            break;
        case 0:
            throw new InvalidArgumentException('Requires at least one array');
            break;
    }
 
    // We 'll need these, as array_shift destroys them
    $keys = array_keys($array);
     
    $a = array_shift($array);
    $k = array_shift($keys); // Get the key that $a had
    $b = permutations($array, 'recursing');
     
    $return = array();
    foreach ($a as $v) {
        if($v)
        {
            foreach ($b as $v2) {
                // array($k => $v) re-associates $v (each item in $a)
                // with the key that $a originally had
                // array_combine re-associates each item in $v2 with
                // the corresponding key it had in the original array
                // Also, using operator+ instead of array_merge
                // allows us to not lose the keys once more
                /*
                if($inb == 'recursing') {
                    $return[] = array_merge(array($v), (array) $v2);                    
                } else {
                    $return[] = array($k => $v) + array_combine($keys, $v2);
                }
                */
                $return[] = array_merge(array($v), (array) $v2); 
            }
        }
    }
    return $return;
}
?>
