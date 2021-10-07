<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SessionsController extends Controller
{
    public function __construct()
    {
        // 未登录用户仅可访问登录页面
        $this->middleware('guest', [
            'only'  => ['create']
        ]);
        // 限流 5分钟3次
        $this->middleware('throttle:3,5', [
            'only'  => ['store']
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password'  => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Log::info('------------------------当前用户id:'.Auth::user()->id);
            // 激活验证
            if (Auth::user()->activated) {
                // 登录成功
                session()->flash('success', '欢迎回来！');
                $fallback = route('users.show', Auth::user());
                return redirect()->intended($fallback);
            } else {
                Auth::logout();
                session()->flash('warning', '您的账号未激活，请检查邮箱种的注册邮件进行激活。');
                return redirect('/');
            }
        } else {
            // 登录失败
            session()->flash('danger', '很抱歉，您的邮箱和账号不匹配');
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出!');
        return redirect('login');
    }
}
