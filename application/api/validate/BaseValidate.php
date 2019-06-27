<?php

namespace app\api\validate;
use think\Validate;
use app\lib\exception\BaseException;
/**
 * Class BaseValidate
 * 验证类的基类
 */
class BaseValidate extends Validate
{
    /**
     * 检测所有客户端发来的参数是否符合验证类规则
     * 基类定义了很多自定义验证方法
     * 这些自定义验证方法其实，也可以直接调用
     * @throws ParameterException
     * @return true
     */
    public function goCheck()
    {
        //必须设置contetn-type:application/json 批量->batch()
        $params = request()->param();
        // var_dump($this->getError());
        // $params['token'] = $request->header('token');
        if (!$this->check($params)) {
            $exception = new BaseException(
                [
                    // $this->error有一个问题，并不是一定返回数组，需要判断
                    'msg' => $this->getError(),
                    'errorCode' => 0,
                    'code' => 200
                ]);
            throw $exception;
        }
        return true;
    }

    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field . '必须是正整数';
    }
    protected function isStatus($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && ($value==1||$value==0)) {
            return true;
        }
        return $field . '必须是0或者1';
    }
    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        if (empty($value)) {
            return $field . '不允许为空';
        } else {
            return true;
        }
    }

    //没有使用TP的正则验证，集中在一处方便以后修改
    //不推荐使用正则，因为复用性太差
    //手机号的验证规则
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
}