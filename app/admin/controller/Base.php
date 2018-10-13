<?phpnamespace app\admin\controller;use app\common\controller\Common;use app\admin\model\AuthRule;use think\Db;/** * Class Base * @package app\admin\controller * 基础控制器 */class Base extends Common{    /**     *初始化     */    public function _initialize()    {        parent::_initialize();        if (!$this->check_admin_login()) $this->redirect('admin/Login/login');//未登录        $auth = new AuthRule;        $id_curr = $auth->get_url_id();        if (!$auth->check_auth($id_curr)) $this->error('没有权限', url('admin/Index/index'));        if (\config('login_region_protect')) {            $this->check_login_region();        }        //获取有权限的菜单tree        $menus = $auth->get_admin_menus();        $this->assign('menus', $menus);        //当前方法倒推到顶级菜单ids数组        $menus_curr = $auth->get_admin_parents($id_curr);        $this->assign('menus_curr', $menus_curr);        //取当前操作菜单父节点下菜单 当前菜单id(仅显示状态)        $menus_child = $auth->get_admin_parent_menus($id_curr);        $this->assign('menus_child', $menus_child);        $this->assign('id_curr', $id_curr);        //当前的位置名称        $module = \request()->module();        $controller = \request()->controller();        $action = \request()->action();        $name = $module . '/' . $controller . '/' . $action;        $a_name = Db::name('AuthRule')->where('name', 'eq', $name)->value('title');        $this->assign('a_name', $a_name);        //管理员头像        $admin_avatar = Db::name('Admin')->where('admin_id', 'eq', \session('hid'))->value('admin_avatar');        $this->assign('admin_avatar', $admin_avatar);    }    /**     *只允许淮安的ip登录     */    protected function check_login_region()    {        $ip = \request()->ip();        $content = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip);        $ip_info = json_decode(trim($content), true);        if ((empty($ip_info['data']['region_id']) || $ip_info['data']['region_id'] != '320000')) {            header("HTTP/1.0 404 Not Found");            echo 'HTTP / 1.0 404 Not Found';            exit;        }    }}