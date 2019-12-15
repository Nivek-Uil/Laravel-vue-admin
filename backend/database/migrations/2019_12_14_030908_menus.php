<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->comment('菜单名称');
            $table->string('code')->unique()->comment('菜单唯一标识符');
            $table->integer('parent_id')->comment('父级菜单id');
            $table->string('icon')->comment('菜单图标');
            $table->string('url')->comment('页面地址');
            $table->integer('sort')->default(0)->comment('菜单排序');
            $table->integer('type')->default(0)->comment('菜单类型 0-普通多级菜单 1-外链菜单');
            $table->softDeletes();
            $table->index(['code','name','deleted_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
