<?php

use App\Helpers\Helper;
use App\Product;
use App\ProductAttribute;
use App\ProductStatus;
use App\Repositories\Language\LanguageRepository;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

if (!function_exists('findLanguage')) {
    function findLanguage()
    {
        $language = new LanguageRepository;
        if (session()->exists('findLanguage')) {
            return session('findLanguage');
        } else {
            $languages = $language->findAll();
            session(['findLanguage' => $languages]);
            return $languages;
        }
    }
}

if (!function_exists('findActiveLanguage')) {
    function findActiveLanguage()
    {
        $language = new LanguageRepository;
        if (session()->exists('findActiveLanguage')) {
            return session('findActiveLanguage');
        } else {
            $languages = $language->findActive();
            session(['findActiveLanguage' => $languages]);
            return $languages;
        }
    }
}

if (!function_exists('findFrontLanguage')) {
    function findFrontLanguage()
    {
        $language = new LanguageRepository;
        if (session()->exists('findFrontLanguage')) {
            return session('findFrontLanguage');
        } else {
            $languages = $language->findFront();
            session(['findFrontLanguage' => $languages]);
            return $languages;
        }
    }
}

if (!function_exists('userProfile')) {
    function userProfile($user)
    {
        if ($user->media) {
            if (Storage::has($user->media->path)) {
                return url('storage/' . $user->media->path);
            } else {
                return url('default/not-found.png');
            }
        } else {
            return 'https://ui-avatars.com/api/?name=' . $user->first_name . '+' . $user->last_name;
        }
    }
}

if (!function_exists('getMediaUrlToMedia')) {
    function getMediaUrlToMedia($media)
    {
        if ($media) {
            if (Storage::has($media->path)) {
                return url('storage/' . $media->path);
            } else {
                return url('default/not-found.png');
            }
        } else {
            return url('default/not-found.png');
        }
    }
}

if (!function_exists('getMediaUrlToUrl')) {
    function getMediaUrlToUrl($url)
    {
        if (Storage::exists($url)) {
            return url('storage/' . $url);
        } else {
            return url('default/not-found.png');
        }
    }
}


if (!function_exists('__url')) {
    function __url($url)
    {
        return (config('custom.custom.secure_url', true)) ? secure_url($url) : url($url);
    }
}

if (!function_exists('paginateMerge')) {
    function paginateMerge(LengthAwarePaginator $collection1, LengthAwarePaginator $collection2)
    {
        $total      = $collection1->total() + $collection2->total();
        $perPage    = $collection1->perPage() + $collection2->perPage();
        $items      = array_merge($collection1->items(), $collection2->items());
        $paginator  = new LengthAwarePaginator($items, $total, $perPage);
        return $paginator;
    }
}

if (!function_exists('findNameByStatusId')) {
    function findNameByStatusId($stepId)
    {
        switch ($stepId) {
            case '1':
            case '2':
                return 'Draft';
                break;

            case '3':
                return 'Publish';
                break;

            default:
                # code...
                break;
        }
    }
}

if (!function_exists('isSubcategory')) {
    function isSubcategory($id)
    {
        $isSubCategory = Product::find($id)->subCategory;
        if ($isSubCategory) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('checkCollection')) {
    function checkCollection($key, $collection)
    {
        $classEntity = null;
        switch ($key) {
            case 'product_attribute':
                $classEntity = ProductAttribute::class;
                break;
        }

        if (get_class($collection) === $classEntity) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('convertObjectToArray')) {
    function convertObjectToArray($object)
    {
        return json_decode(json_encode($object), true);
    }
}

/**
 *  Create New Directory Of given file or path
 *  @param string $directoryOrFileName
 *  @param boolean $isFile
 */
if (!function_exists('fileMakeDirectory')) {
    function fileMakeDirectory($directoryOrFileName, $isFile = false)
    {
        $finalPath = $directoryOrFileName;
        if ($isFile) {
            $newDirectoryArr        = explode("/", $directoryOrFileName);
            $newDirectoryPathArr    = array_slice($newDirectoryArr, 0, (count($newDirectoryArr) - 1));
            $finalPath              = implode("/", $newDirectoryPathArr);
        }
        if (!File::exists($finalPath)) {
            File::makeDirectory($finalPath, 0777, true, true);
        }
    }
}

/**
 *  Copy Any File From public folder to storage folder
 *  @param string $fromPath
 *  @param string $toPath
 */
if (!function_exists('fileCopyPublicToStorage')) {
    function copyFilePublicToStorage($fromPath, $toPath)
    {
        $publicPath         = public_path($fromPath);
        $fullStoragePath    = storage_path('app/public/' . $toPath);
        fileMakeDirectory($fullStoragePath, true);
        File::copy($publicPath, $fullStoragePath);
    }
}


if (!function_exists('getLocale')) {
    function getLocale()
    {
        $configData = Helper::applClasses();
        $locale = $configData['defaultLanguage'];
        if (session()->has('locale')) {
            $locale = session()->get('locale');
        }
        return $locale;
    }
}

if (!function_exists('__sortArray')) {
    function __sortArray($array, $sortField, $sortDirection = SORT_ASC)
    {
        $order = array_column($array, $sortField);
        array_multisort($order, $sortDirection, $array);
        return $array;
    }
}

/**
 *  Used For Pretty Print
 *  @param array|object $arr
 *  @param boolean $withDie = true
 */
if (!function_exists('prettyPrint')) {
    function prettyPrint($data)
    {
        echo "<pre>";
        print_r(...$data);
        echo "</pre>";
    }
}

if (!function_exists('bladeDirectiveSeparator')) {
    function bladeDirectiveSeparator($expression)
    {
        $expression = substr(substr($expression, 0, -1), 1);
        $expression = str_replace(['","', "','", "\",'", "',\""], ",", $expression);
        $permissions = explode(',', $expression);
        return $permissions;
    }
}

if (!function_exists('permissionsException')) {
    function permissionsException(array $config = [])
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "javascript:void(0)", 'name' => $config['title'] ?? "Access Denied!"],
        ];

        return view('admin.access.403', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'config'        => $config
        ]);
    }
}

if (!function_exists('isDeveloper')) {
    function isDeveloper()
    {
        return auth()->user()->email == DEV_EMAIL;
    }
}

if (!function_exists('isBackendUser')) {
    function isBackendUser()
    {
        return auth()->user()->type == User::BACKEND_USER;
    }
}

if (!function_exists('isFrontendUser')) {
    function isFrontendUser()
    {
        return auth()->user()->type == User::CUSTOMER;
    }
}

if (!function_exists('userHasPermission')) {
    function userHasPermission($permissionName)
    {
        return (auth()->user()->hasPermission($permissionName)) ? true : false;
    }
}

if (!function_exists('userHasAnyPermission')) {
    function userHasAnyPermission(...$permissions)
    {
        $returnFlag = false;
        foreach ($permissions as $permission) {
            if (userHasPermission($permission)) {
                $returnFlag = true;
                break;
            }
        }
        return $returnFlag;
    }
}

if (!function_exists('userHasAllPermission')) {
    function userHasAllPermission(...$permissions)
    {
        $returnFlag = true;
        foreach ($permissions as $permission) {
            if (!userHasPermission($permission)) {
                $returnFlag = false;
                break;
            }
        }
        return $returnFlag;
    }
}

if (!function_exists('__in_array')) {
    function __in_array($myValuesueArray, $myArray, $option = "OR")
    {
        $incurrectCount = 0;
        foreach ($myValuesueArray as $item) {
            if (!in_array($item, $myArray)) {
                $incurrectCount++;
            }
        }
        $totalCount = count($myValuesueArray);
        $currectCount = $totalCount - $incurrectCount;

        $returnValue = false;
        if ($option == "OR" && $currectCount >= 1 && $totalCount != $incurrectCount) {
            $returnValue = true;
        } else if ($option == "AND" && $currectCount == $totalCount) {
            $returnValue = true;
        }
        return $returnValue;
        // echo "Total = {$totalCount} | currect = {$currectCount} | incurrect = {$incurrectCount}";
    }
}
