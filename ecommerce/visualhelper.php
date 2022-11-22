<?php

function CreateTextLabel($text)
{
    echo '
    <label">' . $text . ' </label>
    ';

    return $text;
}


function BlankSpaces($howMany)
{
    for($i = 0; $i < $howMany; $i++)
    {
        echo '<br>';
    }
}

?>