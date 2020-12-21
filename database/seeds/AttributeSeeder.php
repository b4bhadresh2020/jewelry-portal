<?php

use App\Attribute;
use App\Option;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getLanguage = findLanguage();
        $attributes = [
            [
                'name' => 'Metal',
                'key' => 'metal',
                'options' => [
                    'Gold',
                    'Platinum',
                    'Silver',
                ],
            ],
            [
                'name' => 'Metal Quality',
                'key' => 'metal-quality',
                'options' => [
                    '18k',
                    '20k',
                    '25k',
                ],
            ],
            [
                'name' => 'Diamond Quality',
                'key' => 'diamond-quality',
                'options' => [
                    'VS',
                    'VVS',
                    'SI',
                    'IF',
                    'FL',
                ],
            ],
            [
                'name' => 'Size',
                'key' => 'size',
                'options' =>
                [
                    '18',
                    '20',
                    '25',
                ],
            ],
        ];

        foreach ($attributes as $order => $attribute) {
            $attributeArr = [
                'key'   => $attribute['key'],
                'order' => $order
            ];
            foreach ($getLanguage as  $item) {
                $attributeArr['name:' . $item->code] = $attribute['name'];
            }
            $attributeData  =  Attribute::create($attributeArr);

            foreach ($attribute['options']  as $option) {
                $optionArr = [];
                foreach ($getLanguage as  $item) {
                    $optionArr['attribute_id'] = $attributeData->id;
                    $optionArr['name:' . $item->code] = $option;
                }
                Option::create($optionArr);
            }
        }
    }
}
