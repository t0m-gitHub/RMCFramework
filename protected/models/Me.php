<?php
/**
* @property string firstName
* @property string secondName
* @property string lastName
* @property DateTime dateOfBirth
 */

class Me extends \RMC\ORMModelAbstract
{
    protected function tableName()
    {
        return 'me';
    }

    protected function tableFields()
    {
        return array(
            'id'         => array(
                'type' => 'int',
                'primaryKey' => true
            ),
            'firstName'  => array(
                'type'      => 'varchar',
                'maxLength' => 10,
            ),
            'secondName' => array(
                'type'      => 'varchar',
                'maxLength' => 100,
            ),
            'lastName'   => array(
                'type'      => 'varchar',
                'maxLength' => 100,
            ),
            'dateOfBirth'=> array(
                'type'      => 'dateTime'
            )
        );
    }

    /**
     * @return Me
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
}