<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use YaroslavMolchan\Rbac\Models\Role;
use App\RoleUser;
use App\PermissionRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Anchor
{
    public static function can($act, $id='',$class='',$text='')
    {
        $href = str_replace('.','/',$act);
        $user = User::find(Auth::user()->id);
        if ($user->canDo($act)) {
            return '<a href="'.url($href).'" id="'.$id.'" class="'.$class.'">'.$text.'</a>';
        }

        return '';
        
    }
}
