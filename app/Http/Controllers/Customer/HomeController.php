<?php

namespace App\Http\Controllers\Customer;

use App\AppSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SubscribeRequest;
use App\Http\Requests\Customer\ContactRequest;
use App\Repositories\MyFacker\MyFackerRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Banner\BannerRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Inquiry\InquiryContactRepositoryInterface;
use App\Repositories\FaqCategory\FaqCategoryRepositoryInterface;
use App\Repositories\Offer\OfferRepositoryInterface;
use App\Repositories\Seller\SellerRepositoryInterface;
use App\Testimonial;
use App\Blog;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Session;
use App\InquiryImage;

class HomeController extends Controller
{
    public $myFacker;
    private $service;
    private $banner;
    private $category;
    private $blog;
    private $contactInquiry;
    private $faqCategory;
    private $offer;
    private $seller;

    public function __construct(
        MyFackerRepositoryInterface $myFacker,
        ServiceRepositoryInterface $service,
        BannerRepositoryInterface $banner,
        CategoryRepositoryInterface $category,
        BlogRepositoryInterface $blog,
        InquiryContactRepositoryInterface $contactInquiry,
        FaqCategoryRepositoryInterface $faqCategory,
        offerRepositoryInterface $offer,
        SellerRepositoryInterface $seller

    ) {
        $this->myFacker = $myFacker;
        $this->service = $service;
        $this->banner = $banner;
        $this->category = $category;
        $this->blog = $blog;
        $this->contactInquiry = $contactInquiry;
        $this->faqCategory = $faqCategory;
        $this->offer = $offer;
        $this->seller = $seller;
    }

    public function index(Request $request)
    {
        $visibleBlockList = AppSetting::findActiveHomeBlockList();

        $data['visibleBlockList'] = $visibleBlockList;
        $data['banners'] = $this->banner->findAll();
        $data['categories'] = $this->category->findAll();
        $data['sellers'] = $this->seller->findByPublishSeller();

        if (in_array(AppSetting::HOME_PAGE_SERVICES, $visibleBlockList)) {
            $data['services'] = $this->service->findAll();
        }
        if (in_array(AppSetting::HOME_PAGE_OFFERS, $visibleBlockList)) {
            $data['offerFirst'] = $this->offer->findById(1);
            $data['offerSecond'] = $this->offer->findById(2);
            $data['offerThird']  = $this->offer->findById(3);
        }
        if (in_array(AppSetting::HOME_PAGE_BACKGROUND_OFFER, $visibleBlockList)) {
            $data['offerFour']  = $this->offer->findById(4);
        }
        if (in_array(AppSetting::HOME_OFFER_SLIDER_ONE, $visibleBlockList)) {
            $data['offerfive']  = $this->offer->findById(5);
        }
        if (in_array(AppSetting::HOME_OFFER_SLIDER_TWO, $visibleBlockList)) {
            $data['offersix']  = $this->offer->findById(6);
        }
        return view('customer.home', $data);
    }

    public function homeBanners(Request $request, $type)
    {
        $returnResponse = [];
        $page = $request->page ?? 1;

        // Let check type and fetch data from DB
        switch ($type) {

            case 'lettest-blogs':
                $items  = $page == 1 ? 3 : 1;
                $page   = ($page == 1 ? $page : $page + 2) - 1;
                $blogs =  Blog::take($items)->skip($page)->get();
                // $blogs = $this->myFacker->items($items)->homeBlog();
                if (!$blogs->isEmpty()) {
                    foreach ($blogs as $blog) {

                        $returnResponse[] = "" . view('customer.items.home.blog', [
                            'blog' => $blog
                        ]);
                    }
                }
                break;

            case 'testimonials':
                $items  = $page == 1 ? 3 : 1;
                $page   = ($page == 1 ? $page : $page + 2) - 1;
                $testimonials =  Testimonial::take($items)->skip($page)->get();
                // $testimonials = $this->myFacker->items($items)->homeTestimonial();
                foreach ($testimonials as $testimonial) {
                    $returnResponse[] = "" . view('customer.items.home.testimonial', [
                        'testimonial' => $testimonial
                    ]);
                }
                break;

            case 'new-collection':
                $items  = $page == 1 ? 3 : 1;
                $newCollections = $this->myFacker->items($items)->homeCommonProduct();
                foreach ($newCollections as $product) {
                    $returnResponse[] = "" . view('customer.items.home.new-collection', [
                        'product' => $product
                    ]);
                }
                break;

            case 'special-product':
                $items  = $page == 1 ? 3 : 1;
                $specialProducts = $this->myFacker->items($items)->homeCommonProduct();
                foreach ($specialProducts as $product) {
                    $returnResponse[] = "" . view('customer.items.home.special-product', [
                        'product' => $product
                    ]);
                }
                break;
        }

        return response()->json($returnResponse);
    }

    public function blog()
    {
        return view('customer.blog.blog', [
            'blogs' => $this->blog->filterWithPaginate()
        ]);
    }

    public function singleBlogView($id)
    {
        return view('customer.blog.single-blog', [
            'blog' => $this->blog->findById($id)
        ]);
    }

    public function Subscriber(Request $request)
    {
        Subscriber::updateOrCreate(['email_subscribe' => $request->email_subscribe]);
        return response()->json(['status' => true]);
    }


    public function contact()
    {
        return view('customer.contact.index');
    }

    public function contactStore(ContactRequest $request)
    {
        $contactInquiry = $this->contactInquiry->store($request->all());
        if ($request->hasFile('file')) {
            foreach ($request->file as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . "/storage/media/inquiry/", $name);
                $path = "media/inquiry/" . $name;
                $inquiryImagesArr = [
                    'file' => $path
                ];
                $inquiryImage = InquiryImage::create($inquiryImagesArr);
            }
        }
        if ($contactInquiry) {
            Session::flash('inquiry_success', 'Inquiry Successfully!');
        }
        return redirect('contact');
    }

    public function faq()
    {
        $faqCategories = $this->faqCategory->findAll();
        return view('customer.faq.index', compact('faqCategories'));
    }
}
