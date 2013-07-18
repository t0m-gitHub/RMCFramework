<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 7/18/13
 * Time: 5:38 PM
 * To change this template use File | Settings | File Templates.
 */

class ClientModel extends \RMC\Model
{
    /**
     * @return ClientModel
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    public function getBaseInfo($params = null)
    {
        $clientId = SessionData::getInstance()->getCurrentRequestParam('clientId');
        $result = ClientQuery::create()->findPk($clientId);
        if(!($result instanceof Client)){
            throw new \RMC\UserException('Client not found');
        }
        return $result->toArray();
    }
}