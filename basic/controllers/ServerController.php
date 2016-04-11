<?php

namespace app\controllers;

use Yii;
use app\models\Server;
use app\models\ServerSearch;
use app\models\Biz;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\HostnameTag;
use app\models\Portonhost;
use yii\data\ActiveDataProvider;

/**
 * ServerController implements the CRUD actions for Server model.
 */
class ServerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    

    //根据tag列出host
    public function actionTag($tag)
    {
        $tagHosts = HostnameTag::find()->where(['tag'=>$tag])->select('hostname')->asArray()->all();
        $hosts = [];
        foreach($tagHosts as $tagHost){
            $hosts[] = $tagHost['hostname'];
        }

        $searchModel = new ServerSearch();
        $searchModel->hosts = $hosts;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_tag', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tag' => $tag
        ]);
    }

    //根据输入的hostname，从数据库里删除此表中没有的hostname
   public function actionBatchDelete()
   {
       if(Yii::$app->user->isGuest){
           return Yii::$app->user->loginRequired();
       }


        $model = new Server();

            $using = [];
            $deletes = [];


        if(isset($_POST['Server']['list'])){
            $list =  isset($_POST['Server']['list']) ? trim($_POST['Server']['list']) : '';
            $fp = fopen('data://text/plain,'. $list, 'r');
            while(!feof($fp)){
                $line = fgetcsv($fp);
                  if(count($line) > 0) {

                  $prefix = strtolower(substr($line[0], 0, 4));
                  if(!(($prefix == 'vlnx') || ($prefix == 'vwsr') || ($prefix == 'pwsr'))){
                        continue;
                    }

                    $hostname = $this->fillHostname(strtolower($line[1]));
                    $using[] = $hostname;
                }
                $line = null;
            }

            $olds = Server::find()->all();
            $i = 0;
            foreach($olds as $old){
                if(!in_array($old->hostname, $using)){
                    if(!strpos($old->hostname, 'x018')){
                        $deletes[] = $old->hostname;
                        $old->currentStatus = Server::CURRENT_STATUS_OFFLINE;
                        $old->save();
                        $i++;
                    }
                }
            }
        }

       return $this->render('batch_delete', [
           'model' => $model,
           'deletes' => $deletes
       ]);
   }

    public function actionExchange()
    {
      $wins = [3,
              4,
              5,
              8,
              9,
              11,
              12,
              13,
              15,
              24,
              27,
              28,
              36,
              37,
              42,
              47,
              48
            ];

      $before = [];
      $after = [];

      if(isset($_POST['Server']['before'])){
        $before = explode("\n", $_POST['Server']['before']);

        foreach($before as $b){
          $b = strtolower(trim($b));
            if(strlen($b)>5){
                if(substr($b, 0, 1) == 'v'){
                    $after[] = $this->hostname2ip($b);
                } else {
                    $after[] = $this->ip2hostname($b, $wins);
                }
            }
        }
      }

      return $this->render('exchange', ['before'=>$before, 'after'=>$after]);
    }

    //批量查询机器信息
    public function actionBatchQuery()
    {

        $before = [];
        $after = [];
        $model = new Server();

        if(isset($_POST['Server']['before'])){
            $before = explode("\n", $_POST['Server']['before']);

            foreach($before as $b){
                $bb = $this->fillHostname($b);
                $r = [];
                
                $query = Server::find()->where(['hostname' => $bb])->one();
                if($query){
                    if(!isset($_POST['selection'])){
                        $r[] = $query->hostname;
                        $r[] = $query->ip1;
                        $r[] = $query->devAdmin;
                        $r[] = $query->entityHostname;
                    } else {
                        foreach ($_POST['selection'] as $s) {
                            $r[] = $query[$s];
                        }
                    }

                }

                $after[] = implode(',', $r);
            }
        }

        return $this->render('batch_query', ['before'=>$before, 'after'=>$after, 'model'=>$model]);
    }

    public function actionIndex()
    {
        $searchModel = new ServerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //列出机器所有信息
    public function actionListall()
    {
        $searchModel = new ServerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list_all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIpView($ip)
    {
        $model = Server::find()->where(['ip1'=>$ip])->one();
        if($model){
            $tags = HostnameTag::find()->select('tag')->where(['hostname'=>$model->hostname])->asArray()->all();
            $ports = Portonhost::find()->where(['hostname'=>$model->hostname]);
            $dataProvider = new ActiveDataProvider([
                'query' => $ports,
                'sort' => [
                    'defaultOrder' => ['id' => SORT_DESC],
                ],
                'pagination' => ['pageSize'=>10000],
            ]);
            return $this->render('view', [
                'model' => $model,
                'tags' => $tags,
                'dataProvider' => $dataProvider
            ]);
        } else {
            echo "wrong ip";
        }
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $tags = HostnameTag::find()->select('tag')->where(['hostname'=>$model->hostname])->asArray()->all();
        $ports = Portonhost::find()->where(['hostname'=>$model->hostname]);
        $dataProvider = new ActiveDataProvider([
            'query' => $ports,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
            'pagination' => ['pageSize'=>10000],
        ]);
        return $this->render('view', [
            'model' => $model,
            'tags' => $tags,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new Server();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = $this->findModel($id);
        $model->currentStatus = Server::CURRENT_STATUS_OFFLINE;
        $model->save();
        $this->sendDeleteToFalcon($model->hostname);

        return $this->redirect(['index']);
    }

    //批量输入机器，从雷龙那里得到机器列表 http://172.17.0.29:9090/Trans.ashx?t=E，从源文件里拷贝
    public function actionBatchinput()
    {
       if(Yii::$app->user->isGuest){
           return Yii::$app->user->loginRequired();
       }

       $model = new Server();
       if(isset($_POST['Server'])) {
            $ook = [];
            $ono = [];
            $nok = [];
            $nno = [];
            $list =  isset($_POST['Server']['list']) ? trim($_POST['Server']['list']) : '';
            $fp = fopen('data://text/plain,'. $list, 'r');
            while(!feof($fp)){
            	$line = fgetcsv($fp);
                if(count($line) > 0) {

                  $prefix = strtolower(substr($line[0], 0, 4));
                  if(!(($prefix == 'vlnx') || ($prefix == 'vwsr') || ($prefix == 'pwsr'))){
                    $no[] = '"'.implode('","', $line).'"';
                    continue;
                  }

                    $entityHostname = strtolower($line[0]);
                    $hostname = $this->fillHostname(strtolower($line[1]));
                    $ip = $this->hostname2ip($hostname);
                    $cpuNum = $line[2];
                    $cpuInfo = $line[3];
                    $memorySize = $line[4];
                    $osName = $line[5];
                    $currentStatusText = $line[6];
                    switch ($currentStatusText) {
                      case 'PowerOff':
                        $currentStatus = Server::CURRENT_STATUS_OFFLINE;
                        $this->sendDeleteToFalcon($hostname); //通知open-falcon删除此hostname
                        break;
                      
                      default:
                        $currentStatus = Server::CURRENT_STATUS_ONLINE;
                        break;
                    }
                    $ck = Server::find()->where(['hostname' => $hostname])->one();
                    if($ck) {
                        $ck->ip1 = $ip;
                        $ck->entityHostname = $entityHostname;
                        $ck->cpuNum = $cpuNum;
                        $ck->cpuInfo = $cpuInfo;
                        $ck->memorySize = $memorySize;
                        $ck->osName = $osName;
                        $ck->currentStatus = $currentStatus;
                      if($ck->update()) {
                          $ook[] = '"'.implode('","', $line).'"';
                        } else {
                          var_dump($ck->getErrors());
                          $ono[] = '"'.implode('","', $line).'"';
                        }
                    } else {
                        $in = new Server;
                        $in->hostname = $hostname;
                        $in->ip1 = $ip;
                        $in->entityHostname = $entityHostname;
                        $in->cpuNum = $cpuNum;
                        $in->cpuInfo = $cpuInfo;
                        $in->memorySize = $memorySize;
                        $in->osName = $osName;
                        $in->currentStatus = $currentStatus;
                        if($in->save()) {
                          $nok[] = '"'.implode('","', $line).'"';
                        } else {
                          $nno[] = '"'.implode('","', $line).'"';
                        }
                    }
                }
                $line = null;
            }

            return $this->render('result2',[
                'ook' => $ook,
                'ono' => $ono,
                'nok' => $nok,
                'nno' => $nno
            ]);
        } else {

           return $this->render('batch_input', [
               'model' => $model,
           ]);
       }

       /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['view', 'id' => $model->id]);
       } else {
           return $this->render('batch_input', [
               'model' => $model,
           ]);
       }*/
    }

   //批量修改机器负责人，因为负责人的中文名无法一一对应，暂停此操作
   public function actionBatchinputOwner()
   {
       if(Yii::$app->user->isGuest){
           return Yii::$app->user->loginRequired();
       }

       $model = new Server();
       if(isset($_POST['Server'])) {
            $ook = [];
            $ono = [];
            $nok = [];
            $nno = [];
           $list =  isset($_POST['Server']['list']) ? trim($_POST['Server']['list']) : '';
           $fp = fopen('data://text/plain,'. $list, 'r');
           while(!feof($fp)){
              $line = fgetcsv($fp);
                if(count($line) > 0) {

                  $prefix = strtolower(substr($line[0], 0, 4));
                  if(!(($prefix == 'vlnx') || ($prefix == 'vwsr') || ($prefix == 'pwsr'))){
                        $no[] = '"'.implode('","', $line).'"';
                        continue;
                    }

                    $hostname = $this->fillHostname(strtolower($line[0]));
                    $ip = $this->hostname2ip($hostname);
                    $devAdmin = $line[1];
                    $ck = Server::find()->where(['hostname' => $hostname])->one();
                    if($ck) {
                        $ck->devAdmin = $devAdmin;
                        if($ck->update()) {
                          $ook[] = '"'.implode('","', $line).'"';
                        } else {
                          $ono[] = '"'.implode('","', $line).'"';
                        }
                    } else {
                        $in = new Server;
                        $in->hostname = $hostname;
                        $in->ip1 = $ip;
                        $in->devAdmin = $devAdmin;
                        if($in->save()) {
                          $nok[] = '"'.implode('","', $line).'"';
                        } else {
                          $nno[] = '"'.implode('","', $line).'"';
                        }
                    }
                }
                $line = null;
            }

            return $this->render('result2',[
                'ook' => $ook,
                'ono' => $ono,
                'nok' => $nok,
                'nno' => $nno
            ]);
        }

       return $this->render('batch_input_owner', [
           'model' => $model
       ]);

       /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['view', 'id' => $model->id]);
       } else {
           return $this->render('batch_input', [
               'model' => $model,
           ]);
       }*/
   }

   //批量修改机器基本信息，没有提交的不会修改
   public function actionBatchmodify()
   {
       if(Yii::$app->user->isGuest){
           return Yii::$app->user->loginRequired();
       }
       
       $model = new Server();

       if(isset($_POST['selection'])){
          $model->hostnames = implode("\n", $_POST['selection']);
       }

       if(isset($_POST['Server'])) {
            $ok = [];
            $no = [];

           $hostnames =  isset($_POST['Server']['hostnames']) ? trim($_POST['Server']['hostnames']) : '';
           $hostnames = array_map('trim', preg_split("#[\r\n]+#", $hostnames));
           foreach($hostnames as $hostname) {
               if(($hostname == '') or ($hostname == ' ')) {
                    $no[] = $hostname;
                    continue;
               }

               $hostname = preg_replace("/\s/", "", $hostname);

               $ck = Server::find()->where(['hostname' => $hostname])->all();
               if(count($ck) == 0) {
                   $insert = new Server();
               } else {
                   $insert = Server::findOne(['hostname' => $hostname]);
               }

               foreach($_POST['Server'] as $k => $v) {
                   if($k != 'hostname') {
                       $v = trim($v);
                       $k = trim($k);
                       if($v != '') {
                           $insert->$k = $v;
                       }
                   }
               }
               $insert->hostname = $hostname;
               if($insert->save()){
                    $ok[] = $hostname;
               } else {
                    $no[] = $hostname;
               }
           }
           return $this->render('result', ['ok'=>$ok, 'no'=>$no]);
       }

       return $this->render('batch_modify', [
           'model' => $model,
       ]);
    }

    //批量修改机器所属业务
    public function actionBatchmodifyBiz()
    {
       if(Yii::$app->user->isGuest){
           return Yii::$app->user->loginRequired();
       }

       if(isset($_POST['selection'])){
          $model = Server::find()->where(['hostname' => $_POST['selection'][0]])->one();
          $model->hostnames = implode("\n", $_POST['selection']);
       } else {
          $model = new Server();
       }

       if(isset($_POST['Server'])) {
            $ok = [];
            $no = [];

           $hostnames =  isset($_POST['Server']['hostnames']) ? trim($_POST['Server']['hostnames']) : '';
           $hostnames = array_map('trim', preg_split("#[\r\n]+#", $hostnames));
           foreach($hostnames as $hostname) {
               if(($hostname == '') or ($hostname == ' ')) {
                    $no[] = $hostname;
                    continue;
               }

               $hostname = preg_replace("/\s/", "", $hostname);

               $ck = Server::find()->where(['hostname' => $hostname])->all();
               if(count($ck) == 0) {
                   $insert = new Server();
               } else {
                   $insert = Server::findOne(['hostname' => $hostname]);
               }

               foreach($_POST['Server'] as $k => $v) {
                   if($k != 'hostname') {
                       $v = trim($v);
                       $k = trim($k);
                       if($v != $insert[$k]) {
                           $insert->$k = $v;
                       }
                   }
               }
               $insert->hostname = $hostname;
               if($insert->save()){
                    $ok[] = $hostname;
               } else {
                    $no[] = $hostname;
               }
           }
           return $this->render('result', ['ok'=>$ok, 'no'=>$no]);
       }

       return $this->render('batch_modify_biz', [
           'model' => $model,
       ]);
    }

    //把机器负责人的id填入表内，用于补数据的，现在没用了
    public function actionInsertUid()
    {
        $users = User::find()->all();
        $nameToId = [];
        foreach($users as $user){
            $nameToId[$user->name] = $user->employee_id;
        }

        $err = [];
        $servers = Server::find()->where(['<', 'currentStatus', Server::CURRENT_STATUS_OFFLINE])->all();
        foreach($servers as $server){
            $ids = [];
            $id = '';
            if($server->devAdmin != ''){
                $devs = explode(';', $server->devAdmin);
                if(count($devs>0)){
                    foreach($devs as $dev){
                        isset($nameToId[$dev]) ? $ids[] = $nameToId[$dev] : $err[] = $dev;
                    }
                }
                $id = implode(';', $ids);
            }
            $server->devAdminId = $id;
            $server->save();
        }
        var_dump($err);
    }

    //通过ip查主机名
    public function actionIpToHostname($ip)
    {
        $query = Server::find()->select('hostname')->where(['ip1' => $ip])->one();
        return $query->hostname;
    }

    public function hostname2ip($b)
    {
        if(strlen($b)<=23){
            $bb3 = intval(substr($b, 4, 3));
            $bb4 = intval(substr($b, 7, 3));
            $ip = '172.17.'.$bb3.'.'.$bb4;
        } else {
            $bb2 = intval(substr($b, 4, 3));
            $bb3 = intval(substr($b, 7, 3));
            $bb4 = intval(substr($b, 10, 3));
            $ip = '10.'.$bb2.'.'.$bb3.'.'.$bb4;
        }

        return $ip;
    }

    public function ip2hostname($b, $wins)
    {
        if(substr($b, 0, 3) == '172'){
            $bb = explode('.', $b);
            in_array($bb[2], $wins) ? $prefix = 'vwsr' : $prefix = 'vlnx';
            $hostname = $prefix.str_pad($bb[2], 3, 0, STR_PAD_LEFT).str_pad($bb[3], 3, 0, STR_PAD_LEFT).'.foneshare.cn';
        } else {
            $bb = explode('.', $b);
            in_array($bb[2], $wins) ? $prefix = 'vwsr' : $prefix = 'vlnx';
            $hostname = $prefix.str_pad($bb[1], 3, 0, STR_PAD_LEFT).str_pad($bb[2], 3, 0, STR_PAD_LEFT).str_pad($bb[3], 3, 0, STR_PAD_LEFT).'.foneshare.cn';
        }

        return $hostname;
    }

    public function fillHostname($k)
    {
        $k = trim(strtolower($k));
        $kk = str_replace('.foneshare.cn', '', $k);
        return $kk.'.foneshare.cn';
    }

    /**
     * Finds the Server model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Server the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Server::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 通过hostname获取devAdmin
     * @param varchar $hostname
     * @return varchar $devAdmin
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionGetAdminByHostname($hostname)
    {
        $data = '';
        $query = Server::find()->where(['hostname' => $hostname])->one();
        if($query){
            $data = $query->devAdmin;
        }

        return $data;
    }

    //通过业务获取机器
    public function actionGetHostnameByBiz($biz_id)
    {
        $data = [];
        $data['msg'] = '';
        $data['data'] = [];
        $data['ok'] = true;
        $biz = Biz::find()->where(['id' => $biz_id])->one();
        if($biz){
            $query = Server::find()->where(['<','currentStatus', 3]);
            switch ($biz->level) {
                case 1:
                    $query->andWhere(['busi1Id' => $biz_id]);
                    break;

                case 2:
                    $query->andWhere(['busi2Id' => $biz_id]);
                    break;

                case 3:
                    $query->andWhere(['busi3Id' => $biz_id]);
                    break;
                
                default:
                    # code...
                    break;
            }

            $rows = $query->all();
            if($rows){
                foreach($rows as $row){
                    $data['data'][] = $row->hostname;
                }
            } else {
                $data['ok'] = false;
                $data['msg'] = 'can not find the server';
            }
        } else {
            $data['ok'] = false;
            $data['msg'] = 'can not find the biz';
        }

        return json_encode($data);
    }

    //通过机器名获取机器信息
    public function actionGetInfoByHostname($hostname)
    {
        $data = [];
        $data['msg'] = '';
        $data['data'] = [];
        $data['status'] = 'ok';
        if(!$hostname){
            $data['msg'] = 'lost hostname';
            $data['status'] = 'no';
            return json_encode($data);
        }

        $row = Server::find()->where(['hostname' => $hostname])->one();
        if(!$row){
            $data['msg'] = 'wrong hostname';
            $data['status'] = 'no';
            return json_encode($data);
        }

        $data = [
            'status' => 'ok',
            'hostname' => $row->hostname,
            'ip1' => $row->ip1,
            'devAdmin' => $row->devAdmin,
            'biz1cname' => isset($row->biz1) ? $row->biz1->cname : '-',
            'biz2cname' => isset($row->biz2) ? $row->biz2->cname : '-',
            'biz3cname' => isset($row->biz3) ? $row->biz3->cname : '-',
            'memorySize' => $row->memorySize.'MB',
            'cpuNum' => $row->cpuNum,
        ];
        return json_encode($data);
    }

    //给open-falcon的接口
    public function actionGetAllInfo()
    {

        $data = [];
        $data['msg'] = '';
        $data['endpointinfos'] = [];
        $rows = Server::find()->where(['<','currentStatus', 3])->all();
        if($rows){
            foreach($rows as $row){
                $owners = [];
                $endpoint = ['endpoint' => $row->hostname];
                $biz = [];
                $row->biz1 ? $biz[] = $row->biz1->cname : $biz[] = '';
                $row->biz2 ? $biz[] = $row->biz2->cname : $biz[] = '';
                $row->biz3 ? $biz[] = $row->biz3->cname : $biz[] = '';
                $devs = explode(';', $row->devAdmin);
                $ids = explode(';', $row->devAdminId);
                foreach($ids as $i=>$id){
                    if(isset($devs[$i])){
                        $owners[] = [
                            'id' => $id,
                            'name' => $devs[$i]
                        ];
                    }
                }
                $data['endpointinfos'][] = [
                    'endpoint' => $row->hostname,
                    'owners' => $owners,
                    'bizs' => $biz,
                ];
            }
        } else {
            $data['msg'] = 'no info';
        }
        //var_dump($data);
        return json_encode($data);
    }

    //通知open-falcon删除hostname
    public function sendDeleteToFalcon($hostname)
    {
      $url = "http://conf.mon.foneshare.cn/api/host/".$hostname;
      return $this->callInterfaceCommon($url, "DELETE", "", "");
    }

    //发起http请求
    public function callInterfaceCommon($URL,$type,$params,$headers){
        $ch = curl_init();
        $timeout = 5;
        curl_setopt ($ch, CURLOPT_URL, $URL); //发贴地址
        if($headers!=""){
            curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
        }else {
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type: text/json'));
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        switch ($type){
            case "GET" : curl_setopt($ch, CURLOPT_HTTPGET, true);break;
            case "POST": curl_setopt($ch, CURLOPT_POST,true); 
                         curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
            case "PUT" : curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
                         curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
            case "DELETE":curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
                          curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
        }
        $file_contents = curl_exec($ch);//获得返回值
        return $file_contents;
        curl_close($ch);
    }
}
