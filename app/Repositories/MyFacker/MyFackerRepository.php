<?php

namespace App\Repositories\MyFacker;

use App\Repositories\MyFacker\MyFackerRepositoryInterface;
use Faker\Generator as Faker;

class MyFackerRepository implements MyFackerRepositoryInterface
{
    public $facker;
    public $times;

    public function __construct(Faker $facker)
    {
        $this->facker = $facker;
        $this->times  = 1;
    }

    public function items(int $times)
    {
        $this->times  = $times;
        return $this;
    }

    public function homeBlog()
    {
        $fackerList = [];
        foreach (range(1, $this->times) as $index) {
            $fackerList[] = (object) [
                'title'         => $this->facker->words(rand(5, 10), true),
                'description'   => call_user_func(function () {
                    $description = $this->facker->paragraph;
                    return (strlen($description) > 100) ? substr($description, 0, 100) . "..." : $description;
                }),
                'created_date'  => $this->facker->dateTimeThisCentury->format('Y/m/d'),
                'image'         => asset('assets/img/blog') . rand(1, 6) . ".jpg"
            ];
        }
        return $fackerList;
    }

    public function homeTestimonial()
    {
        $fackerList = [];
        foreach (range(1, $this->times) as $index) {
            $fackerList[] = (object) [
                'name'          => $this->facker->name,
                'role'          => $this->facker->words(rand(1, 2), true),
                'created_at'    => $this->facker->dateTimeThisCentury->format('Y/m/d'),
                'description'   => call_user_func(function () {
                    $description = $this->facker->paragraph;
                    return (strlen($description) > 100) ? substr($description, 0, 100) . "..." : $description;
                }),
                'image'         => "https://i.pravatar.cc/150?img=" . rand(1, 70)
            ];
        }
        return $fackerList;
    }

    public function homeCommonProduct()
    {
        $fackerList = [];
        foreach (range(1, $this->times) as $index) {
            $sell_price = rand(5000, 150000);
            $price      = $sell_price + rand(1000, 6000);
            $save_price = $price - $sell_price;
            $offer_per  = 100 - round(($sell_price * 100) / $price, 2);

            $fackerList[] = (object) [
                'title'         => $this->facker->words(rand(2, 3), true),
                'price'         => $price,
                'sell_price'    => $sell_price,
                'save_price'    => $save_price,
                'offer_per'     => $offer_per,
                'created_date'  => $this->facker->dateTimeThisCentury->format('Y/m/d'),
                'image'         => asset('assets/img/product') . rand(1, 6) . ".jpg",
                'hover_image'   => asset('assets/img/product') . rand(1, 6) . ".jpg"
            ];
        }
        return $fackerList;
    }
}
