<?php

function raw_data(): array
{
    return json_decode(file_get_contents('fakeCats.json'));
}