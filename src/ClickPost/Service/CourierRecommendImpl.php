<?php
namespace ClickPost\Service;
include 'CourierRecommendService.php';
require 'vendor/autoload.php'; 
include 'Object/CourierRecommendResponse.php';
use GuzzleHttp\Client;
use \ClickPost\Service\Object\CourierRecommendData;
use \ClickPost\Service\Object\CourierRecommendResponse;
use \ClickPost\Exceptions\CourierRecommendationException;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CourierRecommendImpl implements CourierRecommendService{

    public function getCourierCompany(CourierRecommendData $recommend_data) {
        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        $response = $client->post('https://www.clickpost.in/api/v1/recommendation_api/?key=2e9b19ac-8e1f-41ac-a35b-4cd23f41ae17',
                ['body' => json_encode(
                    [[
                        "pickup_pincode"=> $recommend_data->getPickup_pincode(),
                        "drop_pincode"=> $recommend_data->getDrop_pincode(),
                        "order_type"=> $recommend_data->getOrder_type(),
                        "reference_number"=> $recommend_data->getReference_number(),
                        "item"=> $recommend_data->getItem_name(),
                        "invoice_value"=> $recommend_data->getInvoice_value(),
                        "delivery_type"=> $recommend_data->getDelivery_type(),
                        "weight"=> $recommend_data->getWeight(),
                        "height"=> $recommend_data->getHeight(),
                        "length"=> $recommend_data->getLength(),
                        "breadth"=> $recommend_data->getBreadth()
                    ]]
    )]);
        if ($response->getStatusCode() != 200){
            throw new CourierRecommendationException("Exception In Clickpost Courier Recommendation",
                    $response->getStatusCode());
        }
        return $this->parseClickPostResponse($response);
    }
    
    private function parseClickPostResponse($response_body){
        $courier_recommend_array = new \ArrayObject();
        $preference_array = \GuzzleHttp\json_decode($response_body->getBody())->result[0]->preference_array;
        foreach ($preference_array as $preference){
            $courier_recommend_response = new CourierRecommendResponse($preference->cp_name,
                    $preference->cp_id,$preference->priority);
            $courier_recommend_array->append($courier_recommend_response);
        }
        return $courier_recommend_array;
    }
  
}

?>
