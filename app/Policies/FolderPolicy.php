<?php

namespace App\Policies;

use App\Folder;
use App\User;

class FolderPolicy
{
    /**
     * フォルダの閲覧権限
     * @param User $user
     * @param Folder $folder
     * @return bool
     */
    // ユーザーとフォルダが紐付いているときのみtrueを返す
    public function view(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }
}