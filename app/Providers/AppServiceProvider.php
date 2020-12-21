<?php

namespace App\Providers;

use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Collection\CollectionRepository;
use App\Repositories\Collection\CollectionRepositoryInterface;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Option\OptionRepository;
use App\Repositories\Option\OptionRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepository;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\FaqCategory\FaqCategoryRepository;
use App\Repositories\FaqCategory\FaqCategoryRepositoryInterface;
use App\Repositories\Faq\FaqRepository;
use App\Repositories\Faq\FaqRepositoryInterface;
use App\Repositories\Email\EmailTemplateRepository;
use App\Repositories\Email\EmailTemplateRepositoryInterface;
use App\Repositories\UserMenu\UserMenuRepository;
use App\Repositories\UserMenu\UserMenuRepositoryInterface;
use App\Repositories\Discount\DiscountRepository;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Repositories\Inquiry\InquiryContactRepository;
use App\Repositories\Inquiry\InquiryContactRepositoryInterface;
use App\Repositories\Inquiry\InquiryProductRepository;
use App\Repositories\Inquiry\InquiryProductRepositoryInterface;
use App\Repositories\MyFacker\MyFackerRepository;
use App\Repositories\MyFacker\MyFackerRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Testimonial\TestimonialRepository;
use App\Repositories\Testimonial\TestimonialRepositoryInterface;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\BannerRepositoryInterface;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Subscriber\SubScriberRepository;
use App\Repositories\Subscriber\SubScriberRepositoryInterface;
use App\Repositories\Offer\OfferRepository;
use App\Repositories\Offer\OfferRepositoryInterface;
use App\Repositories\CustomCategory\CustomCategoryRepository;
use App\Repositories\CustomCategory\CustomCategoryRepositoryInterface;
use App\Repositories\CustomSubCategory\CustomSubCategoryRepository;
use App\Repositories\CustomSubCategory\CustomSubCategoryRepositoryInterface;
use App\Repositories\PaymentGateway\PaymentGatewayRepository;
use App\Repositories\PaymentGateway\PaymentGatewayRepositoryInterface;
use App\Repositories\Seller\SellerRepository;
use App\Repositories\Seller\SellerRepositoryInterface;
use App\View\Composers\LanguageComposer;
use App\View\Composers\UserMenuComposer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind All Repository With Interface
        $this->bindRepository();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer(['*'], LanguageComposer::class);
        view()->composer(['customer.*'], UserMenuComposer::class);
        view()->composer('customer.layouts.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
        view()->composer(['*'], function ($view) {
            $view->with('fonts', [
                "Times New Roman",
                "Lucida Calligraphy"
            ]);
        });
    }

    public function bindRepository()
    {
        $this->app->bind(MyFackerRepositoryInterface::class, MyFackerRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepository::class);
        $this->app->bind(OptionRepositoryInterface::class, OptionRepository::class);
        $this->app->bind(EmailTemplateRepositoryInterface::class, EmailTemplateRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(FaqCategoryRepositoryInterface::class, FaqCategoryRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(UserMenuRepositoryInterface::class, UserMenuRepository::class);
        $this->app->bind(DiscountRepositoryInterface::class, DiscountRepository::class);
        $this->app->bind(InquiryContactRepositoryInterface::class, InquiryContactRepository::class);
        $this->app->bind(InquiryProductRepositoryInterface::class, InquiryProductRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(TestimonialRepositoryInterface::class, TestimonialRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(CollectionRepositoryInterface::class, CollectionRepository::class);
        $this->app->bind(ProductAttributeRepositoryInterface::class, ProductAttributeRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(SubScriberRepositoryInterface::class, SubScriberRepository::class);
        $this->app->bind(OfferRepositoryInterface::class, OfferRepository::class);
        $this->app->bind(CustomCategoryRepositoryInterface::class, CustomCategoryRepository::class);
        $this->app->bind(CustomSubCategoryRepositoryInterface::class, CustomSubCategoryRepository::class);
        $this->app->bind(PaymentGatewayRepositoryInterface::class, PaymentGatewayRepository::class);
        $this->app->bind(SellerRepositoryInterface::class, SellerRepository::class);
    }
}