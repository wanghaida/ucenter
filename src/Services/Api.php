<?php

namespace Haaid\UCenter\Services;

use Haaid\UCenter\Services\Help;

class Api implements \Haaid\UCenter\Contracts\Api
{
    use Help;

    public $get = [];

    public $post = [];

    public function test()
    {
        return API_RETURN_SUCCEED;
    }

    public function deleteuser()
    {
        $uids = str_replace("'", '', stripslashes($this->get['ids']));

        /**
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function renameuser()
    {
        $uid = $this->get['uid'];
        $oldusername = $this->get['oldusername'];
        $newusername = $this->get['newusername'];

        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function gettag()
    {
        $id = $this->get['id'];

        /*
         * 业务代码编写
         */
        $return = [];

        return $this->serialize([$id, $return], 1);
    }

    public function synlogin()
    {
        $uid = $this->get['uid'];
        $username = $this->get['username'];
        $password = $this->get['password'];
        $time = $this->get['time'];

        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function synlogout()
    {
        $time = $this->get['time'];

        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function updatepw()
    {
        $username = $this->get['username'];
        $password = $this->get['password'];

        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function updatebadwords()
    {
        $data = array();
        if (is_array($this->post)) {
            foreach ($this->post as $k => $v) {
				if(substr($v['findpattern'], 0, 1) != '/' || substr($v['findpattern'], -3) != '/is') {
					$v['findpattern'] = '/' . preg_quote($v['findpattern'], '/') . '/is';
				}
                $data['findpattern'][$k] = $v['findpattern'];
                $data['replace'][$k] = $v['replacement'];
            }
        }

        $cachefile = API_ROOT . 'uc_client/data/cache/badwords.php';
        $fp = fopen($cachefile, 'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'badwords\'] = '.var_export($data, true).";\r\n";
        fwrite($fp, $s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    public function updatehosts()
    {
        $cachefile = API_ROOT . 'uc_client/data/cache/hosts.php';
        $fp = fopen($cachefile, 'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'hosts\'] = '.var_export($this->post, true).";\r\n";
        fwrite($fp, $s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    public function updateapps()
    {
        $cachefile = API_ROOT . 'uc_client/data/cache/apps.php';
        $fp = fopen($cachefile, 'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'apps\'] = '.var_export($this->post, true).";\r\n";
        fwrite($fp, $s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    public function updateclient()
    {
        $cachefile = API_ROOT . 'uc_client/data/cache/settings.php';
        $fp = fopen($cachefile, 'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'settings\'] = '.var_export($this->post, true).";\r\n";
        fwrite($fp, $s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    public function updatecredit()
    {
        $uid = $this->get['uid'];
        $credit = $this->get['credit'];
        $amount = $this->get['amount'];

        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function getcredit()
    {
        $uid = $this->get['uid'];
        $credit = $this->get['credit'];

        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function getcreditsettings()
    {
        /*
         * 业务代码编写
         */
        $credits = [];

        return $this->serialize($credits);
    }

    public function updatecreditsettings()
    {
        $credit = $this->get['credit'];

        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function addfeed()
    {
        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }

    public function __call($function, $arguments)
    {
        if (method_exists($this, $function)) {
            return call_user_func_array([$this, $function], $arguments);
        } else {
            throw new \Exception('Method does not exists');
        }
    }
}
