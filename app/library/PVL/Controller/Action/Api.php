<?php
namespace PVL\Controller\Action;

class Api extends \DF\Controller\Action
{
    public function permissions()
    {
        return true;
    }

    protected $_time_start;

    public function preDispatch()
    {
        parent::preDispatch();

        // Disable rendering.
        $this->doNotRender();

        // Allow AJAX retrieval.
        header('Access-Control-Allow-Origin: *');

        // Fix the base URL prefixed with '//'.
        $current_base_url = \DF\Url::baseUrl();
        $base_url = $current_base_url;

        if (substr($current_base_url, 0, 2) == '//')
            $base_url = 'http'.((DF_IS_SECURE) ? 's:' : ':').$base_url;

        \DF\Url::setBaseUrl($base_url);

        $this->_time_start = microtime(true);
    }

    public function postDispatch()
    {
        parent::postDispatch();

        $end_time = microtime(true);
        $request_time = $end_time - $this->_time_start;

        // Log request using a raw SQL query for higher performance.
        $table_name = $this->em->getClassMetadata('\Entity\ApiCall')->getTableName();
        $conn = $this->em->getConnection();

        $conn->insert($table_name, array(
            'timestamp'     => time(),
            'ip'            => $_SERVER['REMOTE_ADDR'],
            'client'        => $this->_getParam('client', 'general'),
            'useragent'     => $_SERVER['HTTP_USER_AGENT'],
            'controller'    => $this->_getControllerName(),
            'action'        => $this->_getActionName(),
            'parameters'    => json_encode($_REQUEST),
            'requesttime'   => $request_time,
        ));
    }

    /**
     * Authentication
     */

    public function requireKey()
    {
        $this->returnError('API keys are not yet implemented.');
        return;
    }

    /**
     * Result Printout
     */

    public function returnSuccess($data)
    {
        $this->returnToScreen(array(
            'status'    => 'success',
            'result'    => $data,
        ));
        return true;
    }

    public function returnError($message)
    {
        $this->returnToScreen(array(
            'status'    => 'error',
            'error'     => $message,
        ));
        return false;
    }

    public function returnToScreen($obj)
    {
        $format = strtolower($this->getParam('format', 'json'));

        if ($format == 'xml')
            $this->returnRaw(\DF\Export::ArrayToXml($obj), 'xml');
        else
            $this->returnRaw(json_encode($obj, JSON_UNESCAPED_SLASHES), 'json');
    }

    public function returnRaw($message, $format = 'json')
    {
        if ($format == 'xml')
            header('Content-Type: text/xml; charset=utf-8');
        else
            header('Content-Type: application/json; charset=utf-8');

        echo $message;
    }




}