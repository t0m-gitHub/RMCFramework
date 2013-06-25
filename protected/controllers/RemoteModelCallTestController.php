<?php
/**
 * Created by JetBrains PhpStorm.
 * User: t0m
 * Date: 06.06.13
 * Time: 20:01
 * To change this template use File | Settings | File Templates.
 */

class RemoteModelCallTestController extends RMC\Controller
{
    public function indexAction()
    {

        if (!empty($_POST['request'])){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'http://webclient.my/index.php?r=data/get');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST['request']);
            $out = curl_exec($curl);
            echo $out;
            curl_close($curl);
        }
        echo $this->render('index');
    }
}