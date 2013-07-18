<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 15:26
 */
class IndexController extends \RMC\Controller
{
    public function indexAction()
    {
        if(isset($_POST['json'])){
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, 'http://127.0.0.1/RMCFramework/index.php?action=RemoteModelCall');
            curl_setopt($ch,CURLOPT_POST, sizeof($_POST['json']));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $_POST['json']);
            $result = curl_exec($ch);
            echo $result;
            curl_close($ch);
        }
        echo $this->view->render('index');
    }
}
