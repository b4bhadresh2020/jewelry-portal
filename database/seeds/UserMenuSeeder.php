<?php

use App\Category;
use App\SubCategory;
use Illuminate\Database\Seeder;
use App\UserMenu;

class UserMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->menusList() as $key => $getLevelOneMenu) {
            //1
            $levelOneMenu = UserMenu::create(array_merge($this->getLangData($getLevelOneMenu), [
                'link'  =>  $getLevelOneMenu['link'],
                'order' =>  $getLevelOneMenu['order']
            ]));
            $this->addMedia($levelOneMenu, $key);

            //2
            if (array_key_exists('sub', $getLevelOneMenu)) {
                foreach ($getLevelOneMenu['sub'] as $key => $getLevelTwoMenu) {
                    $levelTwoMenu = UserMenu::create(array_merge($this->getLangData($getLevelTwoMenu), [
                        'link'  =>  $getLevelTwoMenu['link'],
                        'order' =>  $getLevelTwoMenu['order'],
                        'parent' =>  $levelOneMenu->id
                    ]));
                    $this->addMedia($levelTwoMenu, $key);
                    //3
                    if (array_key_exists('sub', $getLevelTwoMenu)) {
                        foreach ($getLevelTwoMenu['sub'] as $key => $getLevelThreeMenu) {
                            $levelThreeMenu = UserMenu::create(array_merge($this->getLangData($getLevelThreeMenu), [
                                'link'  =>  $getLevelThreeMenu['link'],
                                'order' =>  $getLevelThreeMenu['order'],
                                'parent' =>  $levelTwoMenu->id
                            ]));
                            $this->addMedia($levelThreeMenu, $key);
                        }
                    }
                }
            }
        }
    }


    public function menusList()
    {
        return [
            [
                'title' => 'Home',
                'link'  =>  url('/'),
                'order'  =>  1
            ],
            [
                'title' => 'Products',
                'link'  =>  url('/products'),
                'order'  =>  2
            ],
            [
                'title' => 'engagement rings',
                'link'  =>  url('/'),
                'order'  =>  3,
                'sub'   => [
                    [
                        'title' => 'Gifts For Mom',
                        'link'  =>  $this->getUrl(),
                        'order'  =>  1,
                    ],
                    [
                        'title' => 'Gifts For Wife',
                        'link'  =>  $this->getUrl(),
                        'order'  =>  2,

                    ],
                    [
                        'title' => 'Gifts For Offer',
                        'link'  =>  $this->getUrl(),
                        'order'  =>  3,

                    ],
                    [
                        'title' => 'Gifts For 10K',
                        'link'  =>  $this->getUrl(),
                        'order'  =>  4,

                    ],
                    [
                        'title' => 'Gifts For Mom',
                        'link'  =>  $this->getUrl(),
                        'order'  =>  5,

                    ],
                    [
                        'title' => 'Gifts For Wife',
                        'link'  =>  $this->getUrl(),
                        'order'  =>  6,

                    ],
                    [
                        'title' => 'Gifts For Offer',
                        'link'  =>  $this->getUrl(),
                        'order'  =>  7,

                    ]
                ]
            ],
            [
                'title' => 'Wedding rings',
                'link'  =>  url('/'),
                'order'  =>  4,
                'sub'   => [
                    [
                        'title' => 'Casual',
                        'link'  =>  $this->getUrl(true),
                        'order'  =>  1,

                    ],
                    [
                        'title' => 'Wedding',
                        'link'  =>  $this->getUrl(true),
                        'order'  =>  2,
                    ],
                    [
                        'title' => 'Megan Platinum Band for Her',
                        'link'  =>  $this->getUrl(true),
                        'order'  =>  3,
                    ],
                    [
                        'title' => 'Cinda Platinum Band for Her',
                        'link'  =>  $this->getUrl(true),
                        'order'  =>  4,
                    ],
                    [
                        'title' => 'Man',
                        'link'  =>  $this->getUrl(true),
                        'order'  =>  5,
                    ],
                    [
                        'title' => 'Women',
                        'link'  =>  $this->getUrl(true),
                        'order'  =>  6,
                    ],
                    [
                        'title' => 'Megan Platinum Band for Her',
                        'link'  =>  $this->getUrl(true),
                        'order'  =>  7,
                    ],
                    [
                        'title' => 'Cinda Platinum Band for Her',
                        'link'  =>  $this->getUrl(true),
                        'order'  =>  8,
                    ]
                ],
            ],
            [
                'title' => 'Blog',
                'link'  =>  url('blog'),
                'order'  =>  5,
            ],
            [
                'title' => 'Faq',
                'link'  =>  url('faq'),
                'order'  =>  6,
            ],
        ];
    }

    public function getLangData($menu)
    {
        $LanguageList   = findLanguage();
        $temp = [];
        foreach ($LanguageList as  $item) {
            $temp['title:' . $item->code] = $menu['title'] . ($item->code == "en" ? '' : " " . $item->code);
        }
        return $temp;
    }

    public function addMedia($menu, $key)
    {
        $imgArr = [
            "m-icon1.jpg",
            "m-icon2.jpg",
            "m-icon3.jpg",
            "m-icon4.jpg",
            "megamenu-imges-block1.jpg",
            "megamenu-imges-block2.jpg",
            "megamenu-imges-block3.jpg",
            "megamenu-imges-block4.jpg",
        ];
        $fileName = $imgArr[$key];
        $fromPath = 'assets/img/' . $fileName;
        $destPath = 'media/user-menu/' . $fileName;
        copyFilePublicToStorage($fromPath, $destPath);
        $menu->media()->create([
            'path' => $destPath,
        ]);
    }

    public function getUrl(bool $isSubCategory = false)
    {
        if ($isSubCategory) {
            $subCategory = SubCategory::inRandomOrder()->first();
            return url("products/{$subCategory->category->slug}/{$subCategory->slug}");
        } else {
            return url('products/' . Category::inRandomOrder()->first()->slug);
        }
    }
}
