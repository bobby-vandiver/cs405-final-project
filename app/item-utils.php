<?php
    const TOY = 0;
    const GAME = 1;

    function type_to_string($type) {
        if($type == TOY) {
            return "Toy";
        }
        else {
            return "Game";
        }
    }
 ?>
