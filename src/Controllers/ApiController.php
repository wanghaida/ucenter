<?php

namespace Haaid\UCenter\Controllers;

use App\Http\Controllers\Controller;
use Haaid\UCenter\Contracts\Api;
use Haaid\UCenter\Services\Help;
use Config;
use Request;

class ApiController extends Controller
{
    use Help;

    public function __construct()
    {
        if (!defined('API_RETURN_SUCCEED')) {
            define('API_RETURN_SUCCEED', '1');
            define('API_RETURN_FAILED', '-1');
            define('API_RETURN_FORBIDDEN', '1');
        }

        if (!defined('API_ROOT')) {
            define('API_ROOT', __DIR__.'/../');
        }
    }

    public function run(Api $api)
    {
        $code = Request::input('code');
        parse_str(self::authcode($code, 'DECODE', Config::get('ucenter.key')), $get);

        if(empty($get)) {
            exit('Invalid Request');
        }
        if(time() - $get['time'] > 3600) {
            exit('Authracation has expiried');
        }

        $action = $get['action'];
        $actionList = [
            'test',
            'deleteuser',
            'renameuser',
            'gettag',
            'synlogin',
            'synlogout',
            'updatepw',
            'updatebadwords',
            'updatehosts',
            'updateapps',
            'updateclient',
            'updatecredit',
            'getcredit',
            'getcreditsettings',
            'updatecreditsettings',
            'addfeed',
        ];

        if (in_array($action, $actionList) && method_exists($api, $action)) {
            $post = self::unserialize(file_get_contents('php://input'));

            $api->get = $get;
            $api->post = $post;

            return $api->$action();
        } else {
            return API_RETURN_FAILED;
        }
    }
}
