<?php

namespace App\Repositories\UserMenu;

use App\Repositories\UserMenu\UserMenuRepositoryInterface;
use App\UserMenu;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\BinaryOp\BooleanAnd;

class UserMenuRepository implements UserMenuRepositoryInterface
{
    /**
     * @param $request
     * @return UserMenu
     */
    public function store($request)
    {
        $userMenu = UserMenu::create($request->except([
            'image',
        ]));
        if ($request->hasFile('image')) {
            $image              = $request->file('image');
            $fileName           = Storage::disk()->put('media/user-menu', $image);
            $userMenu->media()->create([
                'path' => $fileName,
            ]);
        }
        return $userMenu;
    }

    /**
     * @param int $id
     * @param $request
     * @return boolean
     */
    public function update($id, $request)
    {
        $attributes = $request->except([
            'image', '_token', '_method'
        ]);
        $userMenu = $this->findById($id);
        if ($request->hasFile('image')) {
            $oldMedia       = $userMenu->media->path;
            $image          = $request->file('image');
            $fileName       = Storage::disk()->put('media/user-menu', $image);
            $userMenu->media()->update(['path' => $fileName]);
            Storage::disk()->delete($oldMedia);
        }
        return $userMenu->update($attributes);
    }

    /**
     * @return UserMenu
     */
    public function findAll()
    {
        return UserMenu::all();
    }

    /**
     * @return UserMenu
     */
    public function findById($id)
    {
        return UserMenu::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id)
    {
        $userMenu = $this->findById($id);

        foreach ($userMenu->submenu as $sub) {
            if (count($sub->submenu) > 0) {
                UserMenu::whereIn('id', $sub->submenu->pluck('id'))->update([
                    'parent' => 0,
                    'order' => 0
                ]);
            }
            if ($sub->id) {
                UserMenu::where('id', $sub->id)->update([
                    'parent' => 0,
                    'order' => 0
                ]);
            }
        }
        @Storage::disk()->delete($userMenu->media->path);
        @$userMenu->media->delete();
        @$userMenu->deleteTranslations();
        @$userMenu->delete();
    }

    /**
     * @return UserMenu
     */
    public function findByOrderWithLevelOne($sortDirection = "ASC")
    {
        return UserMenu::orderBy('order', $sortDirection)
                    ->where('parent',0)->get();
    }

    public function manageOrder($request)
    {
        if ($request->has('menu')) {
            $userMenu = json_decode($request->menu);
            foreach ($userMenu as $mainKey => $mainMenu) {
                $this->findById($mainMenu->id)->update([
                    'order' => $mainKey + 1,
                    'parent' => 0
                ]);
                if (isset($mainMenu->children) && count($mainMenu->children)) {
                    foreach ($mainMenu->children as $subKey => $subMenu) {
                        $this->findById($subMenu->id)->update([
                            'order' => $subKey + 1,
                            'parent' => $mainMenu->id
                        ]);
                    }
                }
            }
            return true;
        }
    }
}
