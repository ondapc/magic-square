# magic-square

Do numbers have shapes, and if these shapes exist – “How can we find all the possible permutations with PHP?”

This exercise started a few years back over an idea that numbers in a grid, a surface area – had shapes.

The rules are simple:

A 1x1 grid has only 1 number

1

A 2x2 grid has a maximum of 4, a minimum of 1 and is equally distributed into a grid on a surface

|  |  |
| --- | --- |
| 1 | 2 |
| 3 | 4 |

A 3x3 grid looks like the table below:

|  |  |  |
| --- | --- | --- |
| 1 | 2 | 3 |
| 4 | 5 | 6 |
| 7 | 8 | 9 |

I think you can see where I am goind with this. The grid is equally distributed on the horizontal and veritcal axis.

The grids continue to grow in this fashion 4x4, 5x5, 6x6, and so on.

By adding the diagonal vertices, you get the "sum numer" or magic number

so for the 2x2 grid you have two variations ( 1+4=5 & 3+2=5 )

As you might surmise, the 3x3 grid sum number is 15 ... how many permutations, without repeating numbers, can you find that add to that number.

Well, this can be done with some basic PHP...

You will need a webserver, that can run php :-)

