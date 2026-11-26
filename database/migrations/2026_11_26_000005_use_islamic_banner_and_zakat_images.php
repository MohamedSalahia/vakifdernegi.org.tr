<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Replaces the stock photos of people (page banner and zakat page image) with
 * designed images without people: an Islamic 8-pointed star pattern banner and a
 * crescent + coins illustration. Settings live in storage/app/settings.json.
 */
return new class extends Migration
{
    private const NEW = ['banner' => 'page-banner-islamic.jpg', 'zakat' => 'zakat-illustration.jpg'];
    private const OLD = ['banner' => 'yUUizdYkFUmB9mY40nTchvDU8luKc16XVEReFJuB.jpg', 'zakat' => 'qiuWjViBEMPSViicjDB23jzTty5hWVFCumvCanlm.jpg'];

    public function up()
    {
        foreach (self::NEW as $key => $file) {
            setting()->set($key, $file);
        }
        setting()->save();
    }

    public function down()
    {
        foreach (self::OLD as $key => $file) {
            setting()->set($key, $file);
        }
        setting()->save();
    }
};
