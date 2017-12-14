<?php
/**
 * Time: 0:19
 */

namespace Home\Controller\Admin;
use Think\Controller;

/**
 * Class LoginController
 */
class LoginController extends Controller {
    /**
     * 用户登录
     */
    public function login()
    {
        // 判断提交方式
        if (IS_POST) {
            // 实例化Login对象
            $login = D('login');
            // 自动验证 创建数据集
            if (!$data = $login->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                
                $res = array(
                    'status' => false,
                    'info' => $login->getError(),
                    'callback' => U('Home/Admin/Login/login')
                );
                $this->ajaxReturn($res,'JSON');
//                 exit($login->getError());
            }

            // 组合查询条件
            $where = array();
            $where['username'] = $data['username'];
            $result = $login->where($where)->field('id,username,password')->find();

            // 验证用户名 对比 密码
            if ($result && $result['password'] == $data['password']) {
                // 存储session
                session('uid', $result['id']);          // 当前用户id
                session('username', $result['username']);   // 当前用户名
                 session('logintime', time());   // 当前登陆时间

                // 更新用户登录信息
                //$this->success('登录成功,正跳转至系统首页...', U('Home/Admin/Admin/index'));
                $res = array(
                    'status' => true,
                    'info' => 'ok',
                    'callback' => U('Home/Admin/Admin/index')
                );
                $this->ajaxReturn($res,'JSON');
                
            } else {
                //$this->error('登录失败,用户名或密码不正确!');
                $res = array(
                    'status' => false,
                    'info' => '登录失败,用户名或密码不正确!',
                    'callback' => U('Home/Admin/Admin/login')
                );
                $this->ajaxReturn($res,'JSON');
            }
            
        } else {
            $this->display("Admin/Login/login");
        }
    }

    /**
     * 用户注册
     */
   /*  public function register()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {
            // 实例化User对象
            $user = D('users');

            // 自动验证 创建数据集
            if (!$data = $user->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($user->getError());
            }

            //插入数据库
            if ($id = $user->add($data)) {
                /* 直接注册用户为超级管理员,子用户采用邀请注册的模式,
                   遂设置公司id等于注册用户id,便于管理公司用户*/
               /* $user->where("userid = $id")->setField('companyid', $id);
                $this->success('注册成功', U('Index/index'), 2);
            } else {
                $this->error('注册失败');
            }
        } else {
            $this->display();
        }
    } */

    /**
     * 用户注销
     */
    public function logout()
    {
        header("Content-type: text/html; charset=utf-8");
        // 清楚所有session
        session(null);
        redirect(U('Home/Admin/Login/login'), 0, '正在退出登录...');
    }

    /**
     * 验证码
     */
    public function verify()
    {
        ob_clean();
        // 实例化Verify对象
        $verify = new \Think\Verify();

        // 配置验证码参数
        $verify->fontSize = 14;     // 验证码字体大小
        $verify->length = 4;        // 验证码位数
        $verify->imageH = 34;       // 验证码高度
        $verify->useImgBg = true;   // 开启验证码背景
        $verify->useNoise = false;  // 关闭验证码干扰杂点
        $verify->entry();
    }
}