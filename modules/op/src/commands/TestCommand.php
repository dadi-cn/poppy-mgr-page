<?php

namespace Op\Commands;

use Illuminate\Console\Command;
use Storage;

/**
 * 使用命令行生成 api 文档
 */
class TestCommand extends Command
{

    protected $signature = 'op:test';

    protected $description = 'Move file to aim files';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $images = [
            'http://cdn1.zhizhucms.com/materials/32184/origin/a781ef53179b1557beb07193d4ec3fc6_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/a781ef53179b1557beb07193d4ec3fc6_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/a781ef53179b1557beb07193d4ec3fc6_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e1a39f5651a67448cef9905fe22d3d8e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e1a39f5651a67448cef9905fe22d3d8e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/8fd3aa314411b71c4d77a690e6b4a74f_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/8fd3aa314411b71c4d77a690e6b4a74f_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/63bbaf286ad33578e0ccaa633456737e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/63bbaf286ad33578e0ccaa633456737e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/bea4d4310e4ce6304cfc968cea4d6ab3_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/bea4d4310e4ce6304cfc968cea4d6ab3_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/bea4d4310e4ce6304cfc968cea4d6ab3_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/6a71a249ca64ff9e93ea9002db8545c7_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/6a71a249ca64ff9e93ea9002db8545c7_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/6a71a249ca64ff9e93ea9002db8545c7_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e5cc7a783d95aa699fc23fb0c3c22989_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e5cc7a783d95aa699fc23fb0c3c22989_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/c9a76adf59c4bfbd80dbfb21f41e3690_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/becc5b76393ae0f954493e1093a29377_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/a247183005e4c6485f0a14c69691f0bb_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/657cc91599a8985fa12258d8f624e20e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/657cc91599a8985fa12258d8f624e20e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/657cc91599a8985fa12258d8f624e20e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/5a42d8865ad2e90ff772a83453cb406b_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/5a42d8865ad2e90ff772a83453cb406b_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/5a42d8865ad2e90ff772a83453cb406b_origin.png',
            'http://cdn1.zhizhucms.com/materials/origin/944cf527b38385aa09272af5f75d8623_origin.png',
            'http://cdn1.zhizhucms.com/materials/origin/944cf527b38385aa09272af5f75d8623_origin.png',
            'http://cdn1.zhizhucms.com/materials/thumb/67a31b21274a99ba43dc16805011e6e3_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/060d52575930c90cd40228b298702dfa_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/060d52575930c90cd40228b298702dfa_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/54f9c464aede1e3ad783234873c09a06_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/6b9bdcbc747a62380b30979f4284ba00_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/171e7471fcccd07184f339efef388ccf_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/63bbaf286ad33578e0ccaa633456737e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/63bbaf286ad33578e0ccaa633456737e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c92eb2e6899d8b7b7080579f9c0e7f29_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c92eb2e6899d8b7b7080579f9c0e7f29_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/8fd3aa314411b71c4d77a690e6b4a74f_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/8fd3aa314411b71c4d77a690e6b4a74f_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/8867f49665c4550e5af39d6660f0143d_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/8867f49665c4550e5af39d6660f0143d_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e1a39f5651a67448cef9905fe22d3d8e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e1a39f5651a67448cef9905fe22d3d8e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/dc5e029a609968085c1873d247bec931_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/dc5e029a609968085c1873d247bec931_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e1a39f5651a67448cef9905fe22d3d8e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e1a39f5651a67448cef9905fe22d3d8e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/dc5e029a609968085c1873d247bec931_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/dc5e029a609968085c1873d247bec931_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/63bbaf286ad33578e0ccaa633456737e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/63bbaf286ad33578e0ccaa633456737e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c92eb2e6899d8b7b7080579f9c0e7f29_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c92eb2e6899d8b7b7080579f9c0e7f29_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/57098ef7ad98ade0a84138894385adeb_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/57098ef7ad98ade0a84138894385adeb_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/8819e725e754e1317ad7616b8419251f_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/32c2908a8b631f7b5a6cbf7b7a72c3f0_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/32c2908a8b631f7b5a6cbf7b7a72c3f0_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/07a234bd9689598c7c6b087299cf4a57_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/0086f3758ca2929ff77bb64e8f6f47ac_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/0086f3758ca2929ff77bb64e8f6f47ac_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/28a7d5f579db9cc4d6b2d9cc2fba7223_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/cb725768ddeea59fd5d77d11f830eaf7_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/cb725768ddeea59fd5d77d11f830eaf7_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/bafdd53d2f8c4756194bee7eab2c4723_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/657cc91599a8985fa12258d8f624e20e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/657cc91599a8985fa12258d8f624e20e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/657cc91599a8985fa12258d8f624e20e_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/5a42d8865ad2e90ff772a83453cb406b_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/5a42d8865ad2e90ff772a83453cb406b_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/5a42d8865ad2e90ff772a83453cb406b_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/2cd023ee7c572228b715ed19a3f61dcf_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/2cd023ee7c572228b715ed19a3f61dcf_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/e06f172dcb1d250abc2bb4b2d6371eb9_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c983e867604b813b289fd71f32f1608a_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c983e867604b813b289fd71f32f1608a_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c983e867604b813b289fd71f32f1608a_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e47891516f0dc75e8bd851944cf003c0_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e47891516f0dc75e8bd851944cf003c0_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e47891516f0dc75e8bd851944cf003c0_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/178a79ab2a013896aa2cdf94b2369d90_origin_uYqOcmM.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/178a79ab2a013896aa2cdf94b2369d90_origin_uYqOcmM.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/bddac94da40495e0358afc2a2a2c5f09_256_ljBYwvk.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/70ae1413f2c8a372a4cd72d4c58f48e8_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/70ae1413f2c8a372a4cd72d4c58f48e8_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/70ae1413f2c8a372a4cd72d4c58f48e8_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e47891516f0dc75e8bd851944cf003c0_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e47891516f0dc75e8bd851944cf003c0_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/e47891516f0dc75e8bd851944cf003c0_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c983e867604b813b289fd71f32f1608a_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c983e867604b813b289fd71f32f1608a_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/c983e867604b813b289fd71f32f1608a_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/f023a503afe436acc95bfee28ef35e99_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/f023a503afe436acc95bfee28ef35e99_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/f1e0980bfc4020056370d25d620cecb2_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/71eecf1796674c43287474dbe0006635_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/71eecf1796674c43287474dbe0006635_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/70cb1e9aa77e88b278195c3b0e1e41d5_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/46d18e5d2fdcf29ce4dba914f5b48032_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/46d18e5d2fdcf29ce4dba914f5b48032_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/b3646fc08fa23a283c5a28addbb96a59_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/db3bcb71fcd8b5110fb48a2411e93023_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/db3bcb71fcd8b5110fb48a2411e93023_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/6b88bed40b132a229b2707f704bc7cde_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/1a768895deb25acc7cd2a50aece3fba6_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/1a768895deb25acc7cd2a50aece3fba6_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/thumb/a64ef07c40f03fa6a5b38b5ebff4e871_256.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/bea4d4310e4ce6304cfc968cea4d6ab3_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/bea4d4310e4ce6304cfc968cea4d6ab3_origin.png',
            'http://cdn1.zhizhucms.com/materials/32184/origin/bea4d4310e4ce6304cfc968cea4d6ab3_origin.png',
        ];

        foreach ($images as $img) {
            $filename = 'images/' . substr($img, strpos($img, '32184/') + 6);
            $storage  = Storage::disk('storage');
            $storage->put($filename, file_get_contents($img));
        }
    }
}