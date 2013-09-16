<?php
/**
 * AccessLogFilter.php in blog.
 * User: Ramin Farmani ramin.farmani@gmail.com
 * Date: 9/16/13
 * Time: 1:59 PM
 */

class AccessLogFilter extends CFilter
{
    public $logFile;
    protected function preFilter($filterChain)
    {
        $string  = date("Y.m.d H:i:s") . ' - ';
        $string .= Yii::app()->request->userHostAddress . ' - ';
        $string .= Yii::app()->request->requestType . ' - ';
        $string .= Yii::app()->request->requestUri . ' - ';
        $string .= (Yii::app()->request->isAjaxRequest == true)?'AJAX -':'';
        $string .= Yii::app()->request->userAgent;

        file_put_contents($this->logFile, $string . PHP_EOL, FILE_APPEND);

        return true; // false if the action should not be executed
    }
}