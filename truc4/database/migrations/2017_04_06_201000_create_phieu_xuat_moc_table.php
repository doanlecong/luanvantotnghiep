<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieuXuatMocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_xuat_moc', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('loai_vai_id')->unsigned();
            $table->foreign('loai_vai_id')->references('id')->on('loai_vai');
            $table->integer('tong_so_cay_moc')->unsigned();
            $table->integer('tong_so_met')->unsigned();
            $table->integer('kho_id')->unsigned();
            $table->foreign('kho_id')->references('id')->on('kho');
            $table->integer('nhan_vien_xuat_id')->unsigned();
            $table->foreign('nhan_vien_xuat_id')->references('id')->on('nhan_vien');
            $table->dateTime('ngay_gio_xuat_kho');


            $table->text('ghi_chu')->nullable();
            $table->timestamps();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('nhan_vien');
            $table->foreign('updated_by')->references('id')->on('nhan_vien');
            $table->foreign('deleted_by')->references('id')->on('nhan_vien');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieu_xuat_moc');
    }
}
