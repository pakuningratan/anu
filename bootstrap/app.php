<?php

declare(strict_types=1);

use App\Controllers\DiskusiController;
use Leaf\App;

$app = new App();

$app->get('/', function () {
    redirect('/diskusi');
});

$app->get('/diskusi', [DiskusiController::class, 'index']);
$app->get('/diskusi/create', [DiskusiController::class, 'create']);
$app->post('/diskusi', [DiskusiController::class, 'store']);
$app->get('/diskusi/{id}', [DiskusiController::class, 'show']);
$app->get('/diskusi/{id}/edit', [DiskusiController::class, 'edit']);
$app->put('/diskusi/{id}', [DiskusiController::class, 'update']);
$app->delete('/diskusi/{id}', [DiskusiController::class, 'destroy']);

$app->run();
