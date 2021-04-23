<?php
    /*  Treasure Hunt Simulation Program
        Create by : Titan Hadiyan (titanhadiyan@yahoo.com) */

    /*----- Initialization ----*/
    //Board grid
    $grid = array(
        array("#","#","#","#","#","#","#","#"),
        array("#",".",".",".",".",".",".","#"),
        array("#",".","#","#","#",".",".","#"),
        array("#",".",".",".",".","#",".","#"),
        array("#","X","#",".",".",".",".","#"),
        array("#","#","#","#","#","#","#","#")
    );

    //Player Position Start
    $playX = 4; $playY = 1;
    
    //Obstacle Position
    $obsX = array(); $obsY = array();
    $obsX[0] = 2; $obsY[0] = 2;
    $obsX[1] = 2; $obsY[1] = 3;
    $obsX[2] = 2; $obsY[2] = 4;
    $obsX[3] = 3; $obsY[3] = 5;
    $obsX[4] = 4; $obsY[4] = 2;

    //Display Board Grid
    echo "Board Grid\n";
    for ($x = 0; $x <= 5; $x++) {
        for ($y = 0; $y <= 7; $y++) {
            echo $grid[$x][$y];
        }
        echo "\n";
    }
    echo "\n";

    //Create Random Treasure Position
    $posX = rand(1,4);
    $posY = rand(1,6);

    //Make sure Treasure Not In Obstacle
    for ($x = 0; $x <= 4; $x++) {
        if (($posX == $obsX[$x]) && ($posY == $obsY[$x])) {
            echo "Treasure In Obstacle, Regenerate Treasure Position.\n";
            $posX = rand(1,4);
            $posY = rand(1,6);
        }
    }
    
    //Display Treasure Location
    echo "Random Treasure Location $posX, $posY\n";
    for ($x = 0; $x <= 5; $x++) {
        for ($y = 0; $y <= 7; $y++) {
            if (($x == $posX) && ($y == $posY) && ($grid[$x][$y] != "#") ) {
                echo "$";
            } else {
                echo $grid[$x][$y];
            }
        }
        echo "\n";
    }
    echo "\n";

    //Get Move Input
    echo "Input Your Move\n";
    echo "Up/North (0-3) step:";
    $up = trim(fgets(STDIN));
    echo "Right/East (0-5) step:";
    $right = trim(fgets(STDIN));
    echo "Down/South (0-5) step:";
    $down = trim(fgets(STDIN));

    //Find Treasure Location by player move
    $newplayX = $playX - $up;
    $newplayY = $playY + $right;
    $newplayX = $newplayX + $down;

    if (($posX == $newplayX) && ($posY == $newplayY)) {
        echo "Wohooo!!! Congratulations, You found the treasure...\n";
    } else {
        echo "Sorry, You have not made it, please try again...\n";
    }

    //echo "Your Input move is $up step, $right step and $down step\n";
    //echo "New Player Position $newplayX, $newplayY\n";
?>