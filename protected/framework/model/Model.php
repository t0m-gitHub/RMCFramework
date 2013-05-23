<?php
/**
 * User: t0m
 * Date: 17.05.13
 * Time: 10:55
 */
namespace RMC;

class Model
{
    protected $validator;

    public function __construct()
    {
        $validatorClassName = __CLASS__ . VALIDATORS_SUFFIX;
        if (class_exists($validatorClassName)){
            $this->validator = new $validatorClassName();
        } else {
            throw new RMCException('Validator not found for model ' . __CLASS__);
        }
    }

    public function __call($method, $data)
    {
        $inputData = isset($data[0]) ? $data[0] : null;
        $validatorClassName = __CLASS__ . VALIDATORS_SUFFIX;
        if (!($this->validator instanceof $validatorClassName)){
            throw new RMCException('Invalid validator for model' . __CLASS__);
        }
        $modelValidation = $this->validator->$method($this);
        $methodInputValidation = $this->validator->$method($inputData);
    }
}
