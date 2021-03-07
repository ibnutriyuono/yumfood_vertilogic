<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect([
            \App\Interfaces\TagInterface::CHINESE,
            \App\Interfaces\TagInterface::WESTERN,
            \App\Interfaces\TagInterface::KOREAN,
            \App\Interfaces\TagInterface::INDONESIAN,
            \App\Interfaces\TagInterface::BEVERAGES,
            \App\Interfaces\TagInterface::HALAL,
            \App\Interfaces\TagInterface::LUNCH,
            \App\Interfaces\TagInterface::DINNER,
            \App\Interfaces\TagInterface::BREAKFAST,
            \App\Interfaces\TagInterface::FISH,
            \App\Interfaces\TagInterface::MEAT,
            \App\Interfaces\TagInterface::BUDGET,
            \App\Interfaces\TagInterface::AFFORDABLE,
            \App\Interfaces\TagInterface::EXPENSIVE,
        ]);
        $tags->each(function ($tag) {
            factory(\App\Tag::class, 1)->create(['name' => $tag]);
        });
    }
}
