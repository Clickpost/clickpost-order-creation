<?php
namespace ClickPost;
include 'OrderCreationService.php';
include_once 'Object/NewOrder.php';
include 'Exceptions/OrderCreationException.php';
include 'Object/OrderResponse.php';
require 'vendor/autoload.php'; 
use GuzzleHttp\Client;
use ClickPost\OrderCreationService;
use ClickPost\Object\NewOrder;
use ClickPost\Exceptions\OrderCreationException;
use ClickPost\Object\OrderResponse;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderCreationImpl implements OrderCreationService{
    
    public function createOrder(NewOrder $new_order) {
        $json_object = $new_order->jsonSerialize();
        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        $response = $client->post('https://www.clickpost.in/api/v1/create-order/?key=2e9b19ac-8e1f-41ac-a35b-4cd23f41ae17',
                ['body' => $recommend_data->jsonSerialize()]);
        if ($response->getStatusCode() != 200){
            throw new OrderCreationException("Internal Server Error In Clickpost Server ",
                    $response->getStatusCode());
        }
        $this->parseMeta($response);
        return $this->parserResult($response);
        
    }
    
    private function parserResult($response_object){
        $waybill = \GuzzleHttp\json_decode($response_body->getBody()->result->waybill);
        $shipping_url = \GuzzleHttp\json_decode($response_body->getBody()->result->label);
        return new OrderResponse($waybill, $shipping_url);
    }
    
    private function parseMeta($response_object){
        $meta_object = \GuzzleHttp\json_decode($response_body->getBody()->meta);
        if ($meta_object->status != 200){
            throw new OrderCreationException($meta_object->message, $meta_object->status);
        }
    }

}

?>

