<?php
namespace wechat\controllers;

use Yii;
use yii\web\Controller;
use common\components\WechatLogin;

/**
 * 微信基类
 *
 * Class BaseController
 * @package wechat\controllers
 * @author jianyan74 <751393839@qq.com>
 */
class BaseController extends Controller
{
    use WechatLogin;

    /**
     * 默认分页
     *
     * @var int
     */
    protected $pageSize = 10;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if (!Yii::$app->wechat->isWechat)
        {
            // die('请用微信打开');
        }

        // 修改微信授权方式为静默授权
        // Yii::$app->params['wechatConfig']['oauth']['scopes'] = ['snsapi_base'];

        // 开启微信模拟数据
        Yii::$app->params['simulateUser']['switch'] = true;

        // 微信登录
        $this->login();
    }

    /**
     * 解析错误
     *
     * @param $fistErrors
     * @return string
     */
    protected function analyErr($firstErrors)
    {
        return Yii::$app->debris->analyErr($firstErrors);
    }
}