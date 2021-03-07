<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {
    $faker_data = [
        'name' => $faker->company,
    ];

    $logo = $faker->optional($weight = 0.8)->imageUrl($width = 640, $height = 480, 'food');
    if (filled($logo)) {
        \Illuminate\Support\Arr::set($faker_data, 'logo', $logo);
    }
    return $faker_data;
});

$factory->afterCreatingState(Vendor::class, 'random-meat-fish', function (Vendor $vendor, Faker $faker) {
    $random_tags = \App\Tag::whereIn('name', [
        \App\Interfaces\TagInterface::MEAT,
        \App\Interfaces\TagInterface::FISH,
    ])->get();

    $randomTag = $faker->randomElement($random_tags);
    $randomTag->vendors()->attach($vendor->id);
});

$factory->afterCreatingState(Vendor::class, 'randoms-meal-of-the-day', function (Vendor $vendor, Faker $faker) {
    $meal_of_the_day_tags = \App\Tag::whereIn('name', [
        \App\Interfaces\TagInterface::BREAKFAST,
        \App\Interfaces\TagInterface::LUNCH,
        \App\Interfaces\TagInterface::DINNER,
    ])->get();

    $tags_count = $meal_of_the_day_tags->count();
    $random_elements_count = $faker->randomElement(\Illuminate\Support\Collection::times($tags_count)->toArray());
    $random_meal_of_the_day_tags = $faker->randomElements($meal_of_the_day_tags, $random_elements_count);
    collect($random_meal_of_the_day_tags)->each(function ($random_meal_of_the_day_tag) use ($vendor) {
        $random_meal_of_the_day_tag->vendors()->attach($vendor->id);
    });
});

$factory->afterCreatingState(Vendor::class, 'is-halal', function (Vendor $vendor, Faker $faker) {
    $halal_tag = \App\Tag::whereIn('name', [\App\Interfaces\TagInterface::HALAL])->get()->first();
    $halal_tag->vendors()->attach($vendor->id);
});

$factory->afterCreatingState(Vendor::class, 'randoms-cuisine', function (Vendor $vendor, Faker $faker) {
    $cuisine_tags = \App\Tag::whereIn('name', [
        \App\Interfaces\TagInterface::CHINESE,
        \App\Interfaces\TagInterface::WESTERN,
        \App\Interfaces\TagInterface::KOREAN,
        \App\Interfaces\TagInterface::INDONESIAN,
    ])->get();

    $tags_count = $cuisine_tags->count();
    $random_elements_count = $faker->randomElement(\Illuminate\Support\Collection::times($tags_count)->toArray());
    $random_cuisine_tags = $faker->randomElements($cuisine_tags, $random_elements_count);
    collect($random_cuisine_tags)->each(function ($random_cuisine_tag) use ($vendor) {
        $random_cuisine_tag->vendors()->attach($vendor->id);
    });
});

$factory->afterCreatingState(Vendor::class, 'random-cost', function (Vendor $vendor, Faker $faker) {
    $cost_tags = \App\Tag::whereIn('name', [
        \App\Interfaces\TagInterface::BUDGET,
        \App\Interfaces\TagInterface::AFFORDABLE,
        \App\Interfaces\TagInterface::EXPENSIVE,
    ])->get();

    $random_cost_tag = $faker->randomElement($cost_tags);
    $random_cost_tag->vendors()->attach($vendor->id);
});
