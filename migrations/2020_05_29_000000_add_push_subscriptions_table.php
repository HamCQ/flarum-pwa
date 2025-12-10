<?php

/*
 * This file is part of askvortsov/flarum-pwa
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

use Flarum\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasTable('push_subscriptions')) {
            $schema->create('push_subscriptions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('endpoint')->unique();
                $table->string('vapid_public_key');
                $table->string('keys')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->unsignedInteger('user_id');

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    },
    'down' => function (Builder $schema) {
        // 不执行删除操作
    }
];
