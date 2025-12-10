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
        if ($schema->hasTable('push_subscriptions') && !$schema->hasColumn('push_subscriptions', 'last_used')) {
            $schema->table('push_subscriptions', function (Blueprint $table) {
                $table->dateTime('last_used')->nullable();
            });
        }
    },
    'down' => function (Builder $schema) {
        // 不执行删除操作
    },
];

