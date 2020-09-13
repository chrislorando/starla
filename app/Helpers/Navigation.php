<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PermissionRole;
use App\Permission;
use App\Navigation as NavModel;

class Navigation
{
    public static function getAccessControl($user)
    {
        // $roleUser = User::where('id', $user->id)->first();

        $roles = PermissionRole::where('role_id', $user->role_id)->get();
        $permission_ids = [];
        foreach ($roles as $r) {
            $permission_ids[] = $r->permission->name;
        }

        // print_r($permission_ids);exit;

        return $permission_ids;
    }

    /**
     * @param int $user_id User-id
     *
     * @return string
     */
    public static function getMenu($user, $parnId=0)
    {
        $permission = self::getAccessControl($user);

        $menu = NavModel::where('parent', NULL)->where('deleted_at', null)->whereIn('route', $permission)->where('type',1)->orderBy('sort', 'ASC')->get();
        
        $m = '';

        foreach ($menu as $rs) {
            $route = explode('/',$rs->route)[1];
            $current =  \Request::segment(1);
            if (self::getSubMenu($permission,$rs->id)[0] > 0) {
                $m.= '<li class="nav-item dropdown">';
                $m.= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="'.$rs->icon.'"></i> '.$rs->name.'</a>';
                $m.= '<div class="dropdown-menu dropright" aria-labelledby="navbarDropdown">';
                $m.= self::getSubMenu($permission,$rs->id)[1];
                $m.= '</div>';
                $m.= '</li>';
            } else {
                $url = url($rs->route);
                if (strpos($rs->route, 'parent') !== false) {
                    $url = 'javascript::';
                }
                $m.= $route==$current ? '<li class="nav-item active">' : '<li class="nav-item">';
                $m.= '<a href="'.$url.'" class="nav-link"><i class="'.$rs->icon.'" aria-hidden="true"></i> '.$rs->name.'</a>';
                $m.= '</li>';
            }
        }
    
        return $m;
    }

    public static function getSubMenu($permission,$parnId)
    {
        $menu = NavModel::where('deleted_at', null)->where('parent', $parnId)->whereIn('route', $permission)->where('type',1)->orderBy('sort', 'ASC')->get();

        $m='';

        foreach ($menu as $rs) {
            $route = explode('/',$rs->route)[1];
            $current =  \Request::segment(1);
            if (self::getSubMenu($permission,$rs->id)[0] > 0) {
                // $m.= '<li class="nav-item dropdown">';
                $m.= '<a class="dropdown-toggle dropdown-item" href="javascript::" id="navbarDropdowns" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="'.$rs->icon.'"></i> '.$rs->name.'</a>';
                $m.= '<div class="dropdown-menu" aria-labelledby="navbarDropdowns">';
                $m.= self::getSubMenu($permission,$rs->id)[1];
                $m.= '</div>';
                // $m.= '</li>';
            } else {
                $url = url($rs->route);
                if (strpos($rs->route, 'parent') !== false) {
                    $url = 'javascript::';
                }
                // $m.= $route==$current ? '<li class="nav-item active">' : '<li class="nav-item">';
                $m.= '<a href="'.$url.'" class="dropdown-item"><i class="'.$rs->icon.'" aria-hidden="true"></i> '.$rs->name.'</a>';
                // $m.= '</li>';
            }
        }

        return [count($menu),$m];
    }

    public static function getSideMenu($user,$ctrl)
    {
        $permission = Permission::where('controller',$ctrl)->get();
      
        $permission_ids = [];
        foreach ($permission as $r) {
            $permission_ids[] = $r->name;
        }
        $model = NavModel::whereIn('route', $permission_ids)
        ->where('deleted_at', null)
        ->where('type',2)
        ->orderBy('sort', 'ASC')
        ->get();

        foreach($model as $row){
            echo '<a href="'.url($row->route).'" class="list-group-item">
            <i class="'.$row->icon.'"></i>&nbsp;      
            '.$row->name.'     
            </a>';
        }
    }

}
