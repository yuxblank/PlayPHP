<?php
/**
 * Created by PhpStorm.
 * User: TheCoreStylerz
 * Date: 08/10/2015
 * Time: 22:05
 */



class Request {

    private $post=array();
    private $get=array();
    private $put=array();
    private $delete=array();

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param array $post
     */
    public function setPost($name,$value)
    {
        $this->post[$name] = $value;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @param array $get
     */
    public function setGet($name,$value)
    {
        $this->get[$name] = $value;
    }
    













}