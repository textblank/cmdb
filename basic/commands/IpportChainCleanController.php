<?php
/**
 * www.qunee.com
 */

namespace app\commands;

use yii\console\Controller;
use app\models\IpportChain;

class IpportChainCleanController extends Controller
{
    public function actionIndex()
    {
        $uptime = date('Y-m-d H:i:s', (time()-3600));
        IpportChain::deleteAll('uptime < :uptime', [':uptime'=>$uptime]);
    }
}
