<?php
namespace ClickPost\Service;
include 'CourierRecommendImpl.php';
include 'Object/CourierRecommendData.php';

use \ClickPost\Service\Object\CourierRecommendData;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Test{
    public function test(){
        $cp_recommedn_data = new CourierRecommendData('110017','110019','PREPAID',1245,'bottle',
                10,10,10,'FORWARD','1',10);
        $test_cp_recommend = new CourierRecommendImpl();
        $test_cp_recommend->getCourierCompany($cp_recommedn_data);
    }
}
$test = new Test();
$test->test();
?>


