<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DiscountRequest;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiscountController extends Controller
{

    private $discount, $subCategory, $category, $user, $language;

    public function __construct(
        DiscountRepositoryInterface $discount,
        SubCategoryRepositoryInterface $subCategory,
        CategoryRepositoryInterface $category,
        UserRepositoryInterface $user,
        LanguageRepositoryInterface $language
    ) {
        $this->discount = $discount;
        $this->subCategory = $subCategory;
        $this->category = $category;
        $this->user = $user;
        $this->language = $language;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DiscountRequest $request)
    {
        if (!userHasPermission('view-discount')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/discount", 'name' => "Discount"],
            ['link' => "javascript:void(0)", 'name' => "All"],
        ];

        return view('admin.discount.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userHasPermission('add-discount')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/discount", 'name' => "Discount"],
            ['name' => "Create"],
        ];
        $categories = $this->category->findByStatus(Category::PUBLISH);
        $users = $this->user->findByStatus(true);

        return view('admin.discount.create', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'categories'    => $categories,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        if (!userHasPermission('add-discount')) return permissionsException();

        $languages = $this->language->findAll();
        if ($request->discount_type == 1) {
            foreach ($languages as $language) {
                $request->request->remove('title:' . $language->code);
                $request->request->remove('description:' . $language->code);
            }
        }
        $this->discount->store($request);
        Session::flash('toast_success', 'Discount Add Successfully!');
        return redirect('admin/discount/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!userHasPermission('edit-discount')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/discount", 'name' => "Discount"],
            ['name' => "Create"],
        ];
        $categories = $this->category->findByStatus(Category::PUBLISH);
        $users = $this->user->findByStatus(true);
        $discount = $this->discount->findById($id);
        $categoryId = null;
        $subCategories = null;

        if ($discount->discountAssign->first()->discount_assigns_type == "App\SubCategory") {
            $categoryId =  $this->subCategory->findById($discount->discountAssign->first()->discount_assigns_id)->category_id;
            $subCategories = $this->subCategory->findSubCategoryByCategoryId($categoryId);
        }

        return view('admin.discount.edit', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'categories'    => $categories,
            'subCategories'    => $subCategories,
            'users' => $users,
            'discount' => $discount,
            'categoryId' => $categoryId
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountRequest $request, $id)
    {
        if (!userHasPermission('edit-discount')) return permissionsException();

        $languages = $this->language->findAll();
        if ($request->discount_type == 1) {
            foreach ($languages as $language) {
                $request->request->remove('title:' . $language->code);
                $request->request->remove('description:' . $language->code);
            }
        }
        $discount = $this->discount->update($request, $id);
        if ($discount) {
            Session::flash('toast_success', 'Discount Update Successfully!');
        }
        return redirect('admin/discount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->discount->delete($id);
        Session::flash('toast_success', 'Discount Delete Successfully!');
        return redirect('admin/discount');
    }

    public function findSubCategoryByCategoryId($categoryId)
    {
        $subCategories = $this->subCategory->findSubCategoryByCategoryId($categoryId);
        return response()->json($subCategories);
    }

    public function changeStatus($id, $status)
    {
        $attributes = [
            'status' => $status
        ];
        if ($this->discount->changeStatus($id, $attributes)) {
            if ($status == 1) {
                Session::flash('toast_success', "Discount Active Successfully");
            } else {
                Session::flash('toast_success', "Discount Block Successfully");
            }
        }
        return redirect()->back();
    }
}
