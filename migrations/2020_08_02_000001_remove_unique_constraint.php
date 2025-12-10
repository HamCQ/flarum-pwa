<?php

/*
 * This file is part of askvortsov/flarum-pwa
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('push_subscriptions')) {
            // 检查唯一索引是否存在
            $connection = $schema->getConnection();
            $indexes = $connection->getDoctrineSchemaManager()
                ->listTableIndexes('push_subscriptions');
            
            $hasUniqueIndex = false;
            foreach ($indexes as $index) {
                if ($index->isUnique() && in_array('endpoint', $index->getColumns())) {
                    $hasUniqueIndex = true;
                    break;
                }
            }
            
            if ($hasUniqueIndex) {
                $schema->table('push_subscriptions', function (Blueprint $table) {
                    $table->dropUnique(['endpoint']);
                });
            }
        }
    },
    'down' => function (Builder $schema) {
        // 不执行删除操作
    },
];
