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

    public function ajaxClientes(){
        $res = $this->db->getConnection()->query('SELECT * FROM clients') ;
        $this->response->html(json_encode($res),200);
    }

    public function ajaxProductos(){
        if ($this->request->isPost()) {
            $values = $this->request->getValues();
            $res = $this->db->getConnection()->query('SELECT * FROM products WHERE client_id='.$values['client_id']);
            $this->response->html(json_encode($res), 200);
        }
    }

    public function ajaxSubproductos(){
        if ($this->request->isPost()) {
            $values = $this->request->getValues();
            $res = $this->db->getConnection()->query('SELECT * FROM sub_products WHERE product_id='.$values['product_id']);
            $this->response->html(json_encode($res), 200);
        }
    }


    public function ajaxJsonHandler(){
        $clientes = $this->db->getConnection()->query('SELECT * FROM clients');
        foreach($clientes as $cliente) {
            $products = $this->db->getConnection()->query('SELECT * FROM products WHERE client_id='. $cliente['id']);
            foreach($products as $product) {
                $subproducts = $this->db->getConnection()->query('SELECT * FROM sub_products WHERE product_id='. $product['id']);
                foreach($subproducts as $subproduct) {
                    $subproducts[] = $subproduct;
                }
                $product['subproducts']=$subproducts;
            }
            $cliente['products']=$product;
        }

        $this->response->html(json_encode($clientes),200);
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
        $client_id = $this->request->getStringParam('client_id');
        if ($this->request->isPost()) {
            $values = $this->request->getValues();
            $client_id = $values['client_id'];
            $this->db->getConnection()->query('INSERT INTO products (id,client_id,title) VALUES(DEFAULT, '. $client_id.',\''. $values['product_name'].'\')') ;
            $this->flash->success('Producto creado');
        }
        $cliente = $this->db->table('clients')
            ->eq('id',$client_id)
            ->asc('id')
            ->limit(1)
            ->findOne();

        $productos =  $this->db->table('products')
            ->eq('client_id',$client_id)
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
        $client_id = $this->request->getStringParam('client_id');
        $product_id = $this->request->getStringParam('product_id');

        if ($this->request->isPost()) {
            $values = $this->request->getValues();
            $client_id=$values['client_id'];
            $product_id=$values['product_id'];
            $this->db->getConnection()->query('INSERT INTO sub_products (id,product_id,title) VALUES(DEFAULT, '. $product_id.',\''. $values['subproduct_name'].'\')') ;
            $this->flash->success('Subproducto creado');
        }
        $cliente = $this->db->table('clients')
            ->eq('id',$client_id)
            ->asc('id')
            ->limit(1)
            ->findOne();
        $producto =  $this->db->table('products')
            ->eq('id',$product_id)
            ->asc('id')
            ->findOne();
        $subproductos =  $this->db->table('sub_products')
            ->eq('product_id',$product_id)
            ->asc('id')
            ->findAll();
        $this->response->html($this->helper->layout->config('TitleCompose:config/subproductConfig', [
            //'values' => $values,
            //'errors' => $errors,
            'producto'  => $producto,
            'subproductos'  => $subproductos,
            'cliente' => $cliente,
            'title'  => t('Settings').' &gt; '.t('Configurar productos'),
        ]));
    }
}