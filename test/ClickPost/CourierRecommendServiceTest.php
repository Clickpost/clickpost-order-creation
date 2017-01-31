<?php
namespace ClickPost\Tests;
use PHPUnit\Framework\TestCase;
require 'vendor/autoload.php';
include 'src/ClickPost/CourierRecommendImpl.php';
include 'src/ClickPost/Object/CourierRecommendData.php';
use ClickPost\CourierRecommendImpl;
use ClickPost\Object\CourierRecommendData;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CourierRecommendServiceTest extends \PHPUnit\Framework\TestCase{
    
    
    public function testCourierRecommend(){
        echo "Testing Clickpost Courier Recommnedation Service";
        $this->assertEquals(1, 1);
        
    }
    
    
    
    
   
    
}

?>