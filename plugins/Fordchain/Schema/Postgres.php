<?php

namespace Kanboard\Plugin\Fordchain\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec('ALTER TABLE ONLY "tasks" ADD COLUMN "translator_id" integer default 0,
        ADD COLUMN "gestor_id" integer default 0,
        ADD COLUMN "fordchainStep" integer default 0,
        ADD COLUMN "reviewer_id" integer default 0;
    ');
}
