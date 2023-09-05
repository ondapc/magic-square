# magic-square
Using PHP to generate a couple magic squares and see their corresponding permutations while ultimately generating a heatmap of number occurrences. 

Tested using:
> Apache
> PHP 8.1.2

A magic square has a grid that is defined by "N" where n has to be greater than 2. 

The sum of all horizontal 
- horizontal
- vertical
- diagonal

Values will equal to:  (($n*$n+1)*$n/2);

Added a validation script to verify that the "Magic Squares" are valid using the algorithms below:

- Siamese method
- Albrecht Dürer's method
- Conway's LUX method
