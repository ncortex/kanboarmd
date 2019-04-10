<?php

namespace Kanboard\Plugin\TitleCompose\Schema;

use PDO;

const VERSION = 3;

function version_3(PDO $pdo)
{
    $pdo->query("INSERT INTO clients VALUES(1,'cliente1')");
    $pdo->query("INSERT INTO clients VALUES(2,'cliente2')");
    $pdo->query("INSERT INTO clients VALUES(3,'cliente3')");

    $pdo->query("INSERT INTO products VALUES(1,1,'producto1')");
    $pdo->query("INSERT INTO products VALUES(2,1,'producto2')");
    $pdo->query("INSERT INTO products VALUES(3,2,'producto3')");

    $pdo->query("INSERT INTO sub_products VALUES(1,1,'sub_producto1')");
    $pdo->query("INSERT INTO sub_products VALUES(2,2,'sub_producto2')");
    $pdo->query("INSERT INTO sub_products VALUES(3,2,'sub_producto3')");
}

function version_1(PDO $pdo)
{
    $pdo->exec('ALTER TABLE tasks ADD COLUMN client_id INTEGER');
    $pdo->exec('ALTER TABLE tasks ADD COLUMN product_id INTEGER');
    $pdo->exec('ALTER TABLE tasks ADD COLUMN subproduct_id INTEGER');

    $pdo->exec('ALTER TABLE tasks ADD COLUMN project_number VARCHAR(255)');
    $pdo->exec('ALTER TABLE tasks ADD COLUMN package_number VARCHAR(255)');
    $pdo->exec('ALTER TABLE tasks ADD COLUMN extra_number VARCHAR(255)');

    $pdo->exec('
        CREATE TABLE IF NOT EXISTS clients (
          id SERIAL PRIMARY KEY,
          title VARCHAR(255) NOT NULL
        )
    ');

    $pdo->exec('
        CREATE TABLE IF NOT EXISTS products (
          id SERIAL PRIMARY KEY,
          client_id INTEGER NOT NULL,
          title VARCHAR(255) NOT NULL,
          FOREIGN KEY(client_id) REFERENCES clients(id) ON DELETE CASCADE
        )
    ');

    $pdo->exec('
        CREATE TABLE IF NOT EXISTS sub_products (
          id SERIAL PRIMARY KEY,
          product_id INTEGER NOT NULL,
          title VARCHAR(255) NOT NULL,
          FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE
        )
    ');
}
