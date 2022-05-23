<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Resources\Admin\AdminCollection;
use App\Http\Resources\Admin\AdminDetailResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:admin')->only(['login', 'loginPost']);
    }

    use AuthenticatesUsers;


    public function index()
    {
        return view('admin.index2');
    }

    public function login()
    {
        return view('admin.login');
    }


    public function loginPost(Request $request)
    {
        //đăng nhập
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            //nếu thành công thì chuyển hướng về view dashboard của admin
            $uri = Session::get('redirectAfterLoginAdmin');

            if ($uri != null) {
                Session::remove('redirectAfterLoginAdmin');
                return redirect($uri[0]);
            } else {
                return redirect()->route(ADMIN_INDEX, ['all' => 'dashboard']);
            }

            //return redirect()->intended(route('admin.index', ['all' => 'dashboard']))->with('thongbao', 'Đăng nhập thành công');

        } else {
            //thất bại

            return redirect()->back()->withInput($request->only('email', 'remember'));

        }
    }

    /*
    * đăng xuát
    * */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

    }


    public function getAdminLogin()
    {
        return response()->json(new AdminDetailResource(Auth::user()), 200);
    }


    public function getList(Request $request)
    {
        $size = $request->get('size', 10);
        if (Auth::user()->can(PERMISSION_ACCOUNT_VIEW)) {
            $data = new AdminCollection(AdminModel::where('name', 'like', '%' . $request->name . '%')->orWhere('email', 'like', '%' . $request->name . '%')->Paginate($size));
            return response()->json($data);
        } else {
            return response()->json('You are not authorized!', 419);
        }
    }


    public function getRoles()
    {
        return response()->json(Role::all());
    }

    public function getPermissions(Request $request)
    {
        $role_id = $request->role;
        $permissions = Role::where('id', $role_id)->orWhere('name', $role_id)->first()->permissions;
        return response()->json($permissions);
    }

    public function store(AdminRequest $request)
    {
        if (Auth::user()->can(PERMISSION_ACCOUNT_ADD)) {
            $input = $request->all();
            $input['password'] = bcrypt($input['repassword']);
            $input['folder'] = 'folder-' . $this->name_image($request->name) . '-avatar';
            //$input['avatar'] = $this->saveImgBase64($request->image, 'avatar/admins/' . $input['folder']);

            $admin = AdminModel::Create($input);
            $admin->givePermissionTo($input['permission_id']);
            return response()->json([], 200);
        } else {
            return response()->json(['message' =>'You are not authorized!'], 419);
        }

    }
    public function adminHasPermission(Request $request)
    {
        $this->validate($request, [
           'id' => 'required'
        ]);
        $id = $request->get('id', 0);
        $permission = AdminModel::find($id)->getPermissionsId();
        return response()->json($permission);
    }

    public function setPermission(Request $request)
    {
        if (Auth::user()->can(PERMISSION_ACCOUNT_EDIT)) {
            $request->validate([
                'id' => 'required',
                'permissions' => 'required'
            ]);
            $user = AdminModel::find($request->id);

            $user->setPermission($request->permissions);

            $isYour = Auth::id() == $user->id;
            $permission = array_map(function ($item) {
                return $item['name'];
            }, $user->getAllPermissions()->toArray());

            return response()->json([
                'isYour' => $isYour,
                'permission' =>$permission
            ], 200);
        } else {
            return response()->json('You are not authorized!', 419);
        }

    }
}
