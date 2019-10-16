<?php

function init($prompt, $argv)
{
    $total_prompt = 0;
    $turn = 0;

    while (true) {
        $render = "";
        $turn += 1;

        if ($prompt >= 0 && $prompt <= 3) {
            $total_prompt += intval($prompt);
            $total_matches = str_repeat("|", 11 - $total_prompt);
        }
        echo $total_matches . "\n";


        if (strlen($total_matches) <= 1) {
            if ($turn % 2 == 1) {
                echo "\nYou lose !\n";
                die();
            } else {
                echo "\nYou win !\nI lost... snif... but I'll get you next time !!\n";
                die();
            }
        }

        echo strlen($total_matches) . " matches.\n";

        if ($turn % 2 == 1) {
            echo "Your turn :\n";
            $prompt = readline("Matches : ");
            intval($prompt);
        } else {
            echo "AI's turn :\n";
            if ($argv[1] === "easy") {
                $prompt = random_int(1, 3);
            } elseif ($argv[1] === "normal") {
                if (strlen($total_matches) === 4) {
                    $prompt = 3;
                } else if (strlen($total_matches) === 3) {
                    $prompt = 2;
                } else if (strlen($total_matches) === 2) {
                    $prompt = 1;
                } else {
                    $prompt = random_int(1, 3);
                }
            } elseif ($argv[1] === "hard") {
                if (strlen($total_matches) === 10) {
                    $prompt = 1;
                } else if (strlen($total_matches) === 9) {
                    $prompt = random_int(1, 3);
                } else if (strlen($total_matches) === 8) {
                    $prompt = 3;
                } else if (strlen($total_matches) === 7) {
                    $prompt = 2;
                } else if (strlen($total_matches) === 6) {
                    $prompt = 1;
                } else if (strlen($total_matches) === 5) {
                    $prompt = random_int(1, 3);
                } else if (strlen($total_matches) === 4) {
                    $prompt = 3;
                } else if (strlen($total_matches) === 3) {
                    $prompt = 2;
                } else if (strlen($total_matches) === 2) {
                    $prompt = 1;
                }
            }
            echo "Matches : " . $prompt . "\n";
        }

        if ($prompt == 1) {
            $render .= "Player removed $prompt match.\n\n";
        } else if ($prompt >= 2 && $prompt <= 5) {
            $render .= "Player removed $prompt matches.\n\n";
        } else if ($prompt == 0) {
            $render .= "Error : you have to remove at least one match.\n\n";
            $turn += 1;
        } else if ($prompt < 0 || $prompt > 3) {
            $render .= "Error : invalid input (positive number expected).\n\n";
            $turn += 1;
        }
        usleep(500000);
        echo $render;
    }
}

init(0, $argv);