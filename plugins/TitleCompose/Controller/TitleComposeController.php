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

    public function ajaxClientAdd(){
        $this->db->getConnection()->query('INSERT INTO clients (id,title) VALUES(DEFAULT, \''. $this->request->getStringParam('client_name').'\')') ;
        $this->response->html(json_encode('OK'),200);
    }

    public function ajaxClientDel(){
        $this->db->getConnection()->query('DELETE FROM clients WHERE id='. $this->request->getStringParam('client_id')) ;
        $this->response->html(json_encode('OK'),200);
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

    public function config(){
        if ($this->request->isPost()) {
            $values = $this->request->getValues();
            if($values['client_name' != ""]) {
                $this->db->getConnection()->query('INSERT INTO clients (id,title) VALUES(DEFAULT, \'' . $values['client_name'] . '\')');
                $this->flash->success('Cliente creado');
            }
        }
        //$clientes = $this->db->getConnection()->query('SELECT * FROM clients');
        $clientes = $this->db->table('clients')
            ->asc('id')
            ->findAll();
        $this->response->html($this->helper->layout->config('TitleCompose:config/clientConfig', [
            //'values' => $values,
            //'errors' => $errors,
            'clientes'  => $clientes,
            'title'  => t('Settings').' &gt; '.t('Configurar clientes'),
        ]));
    }

    public function configProducts(){
        if ($this->request->isPost()) {
            $values = $this->request->getValues();
            $this->db->getConnection()->query('INSERT INTO products (id,client_id,title) VALUES(DEFAULT, '. $values['client_id'].',\''. $values['product_name'].'\')') ;
            $this->flash->success('Producto creado');
        }
        //$cliente = $this->db->getConnection()->query('SELECT * FROM clients WHERE id='.$this->request->getStringParam('client_id')." LIMIT 1");
        $cliente = $this->db->table('clients')
            ->eq('id',$this->request->getStringParam('client_id'))
            ->asc('id')
            ->limit(1)
            ->findOne();
        //$productos = $this->db->getConnection()->query('SELECT * FROM products WHERE client_id='.$this->request->getStringParam('client_id'));
        $productos =  $this->db->table('products')
            ->eq('client_id',$this->request->getStringParam('client_id'))
            ->asc('id')
            ->findAll();
        $this->response->html($this->helper->layout->config('TitleCompose:config/productConfig', [
            //'values' => $values,
            //'errors' => $errors,
            'productos'  => $productos,
            'cliente' => $cliente,
            'title'  => t('Settings').' &gt; '.t('Configurar productos'),
        ]));
    }

    public function configSubproducts(){
        if ($this->request->isPost()) {
            $values = $this->request->getValues();
            $this->db->getConnection()->query('INSERT INTO sub_products (id,product_id,title) VALUES(DEFAULT, '. $values['product_id'].',\''. $values['subproduct_name'].'\')') ;
            $this->flash->success('Subproducto creado');
        }
        $cliente = $this->db->table('clients')
            ->eq('id',$this->request->getStringParam('client_id'))
            ->asc('id')
            ->limit(1)
            ->findOne();
        //$productos = $this->db->getConnection()->query('SELECT * FROM products WHERE client_id='.$this->request->getStringParam('client_id'));
        $productos =  $this->db->table('products')
            ->eq('client_id',$this->request->getStringParam('client_id'))
            ->asc('id')
            ->findAll();
        $this->response->html($this->helper->layout->config('TitleCompose:config/productConfig', [
            //'values' => $values,
            //'errors' => $errors,
            'productos'  => $productos,
            'cliente' => $cliente,
            'title'  => t('Settings').' &gt; '.t('Configurar productos'),
        ]));
    }
}