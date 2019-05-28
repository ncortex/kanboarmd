<?php

namespace Kanboard\Plugin\TitleCompose\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Core\Base;
use PDO;

class TitleComposeController extends BaseController
{
    private $pdo;
    public function __construct($container)
    {
        parent::__construct($container);
        //$this->pdo=new PDO($this->db->getConnection()->);
    }

    public function ajaxProductHandler(){
        //$task = $this->getTask();
        //$json= $this->pdo->query('SELECT * FROM products WHERE client_id= '. $this->request->getStringParam('client_id'));
        $res = [];
        foreach($this->db->getConnection()->query('SELECT title FROM products WHERE client_id='. $this->request->getStringParam('client_id')) as $row) {
            $res[] = $row[0];
        }

        $this->response->html(json_encode($res),200);

    }

    public function ajaxJsonHandler(){
        $res = [];
        foreach($this->db->getConnection()->query('SELECT title FROM clients') as $row_c) {
            foreach($this->db->getConnection()->query('SELECT title FROM products WHERE client_id='. $row_c) as $row_p) {
                $subproducts = [];
                foreach($this->db->getConnection()->query('SELECT title FROM subproducts WHERE product_id='. $row_p) as $row_s) {
                    $subproducts[] = $row_s[0];
                }
                $res[$row_c[0]][$row_p[0]] = $subproducts;
            }

        }

        $this->response->html(json_encode($res),200);
    }

}