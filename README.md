# magic-squares
Using PHP to generate a couple magic squares and see their corresponding permutations while ultimately generating a heatmap of number occurrences. 

Tested using:
- Apache
- PHP 8.1.2
- Bootstrap 5
- CSS

A magic square has a grid that is defined by "N" where n has to be greater than 2. The NxN magic square will use the numbers from 1 to N<sup>2</sup> without repeating and can only use N numbers to sum to the magic constant

![image](https://github.com/ondapc/magic-square/assets/26459137/9e202c58-d92c-4d15-9d49-e5615e85d20e)

The sum of all 
- horizontal
- vertical
- diagonal

values should equal to: (int) ($n / 2) * (pow($n, 2) + 1);

Added a validation script to verify that the "Magic Squares" are valid ( horizontal, vertical, and diagonal sums )

The following algorithms were used to determine the Magic Squares:

- Albrecht Dürer's method
- Conway's LUX method
- Siamese method
- Strachey method 
