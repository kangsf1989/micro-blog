<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SessionsController extends Controller
{
    //
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        /**
         *   if (Auth::attempt(['email' => $email, 'password' => $password])) {
         *   }
         *   使用 email 字段的值在数据库中查找；
         *   如果用户被找到：
         *   1). 先将传参的 password 值进行哈希加密，然后与数据库中 password 字段中已加密的密码进行匹配；
         *   2). 如果匹配后两个值完全一致，会创建一个『会话』给通过认证的用户。会话在创建的同时，也会种下一个名为 laravel_session 的 HTTP Cookie，以此 Cookie 来记录用户登录状态，最终返回 true；
         *   3). 如果匹配后两个值不一致，则返回 false；
         *   如果用户未找到，则返回 false
         */
        if (Auth::attempt($credentials,$request->has('remember'))) {
            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }

        return;
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
