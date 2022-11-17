<?php

// Недостающие элементы устанавливаются в контейнере через composer
require_once '/var/www/vendor/autoload.php';
require_once 'fakeCatData.php';

function generate_cats(int $cats_amount): array
{
    $faker = Faker\Factory::create();

    $cats = array();

    for ($i = 0; $i < $cats_amount; $i++) {
        $cats[] = new fakeCatData(
            $faker->name(),
            $faker->colorName(),
            $faker->latitude(),
            $faker->longitude(),
            $faker->jobTitle(),
            $faker->email(),
            implode(' ', $faker->shuffle(['meow', 'mew', 'mewl', 'nya', 'nyan']))
        );
    }

    return $cats;
}