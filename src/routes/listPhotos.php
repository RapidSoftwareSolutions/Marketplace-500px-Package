<?php

$app->post('/api/500px/listPhotos', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','token','tokenSecret','feature']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['apiKey'=>'apiKey','apiSecret'=>'apiSecret','token'=>'token','tokenSecret'=>'tokenSecret','feature'=>'feature'];
    $optionalParams = ['userIds'=>'user_id','includeCategories'=>'only','excludeCategories'=>'exclude','sort'=>'sort','sortDirection'=>'sort_direction','page'=>'page','perPage'=>'rpp','imageSize'=>'image_size','includeStore'=>'include_store','includeStates'=>'include_states','personalizedCategories'=>'personalized_categories','tags'=>'tags'];
    $bodyParams = [
       'query' => ['user_id','only','exclude','sort','sort_direction','page','rpp','image_size','include_store','include_states','personalized_categories','feature','tags']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    
    $data['user_id'] = \Models\Params::toString($data['user_id'], ','); 
    $data['only'] = \Models\Params::toString($data['only'], ','); 
    $data['exclude'] = \Models\Params::toString($data['exclude'], ','); 

    $stack = GuzzleHttp\HandlerStack::create();     $middleware = new GuzzleHttp\Subscriber\Oauth\Oauth1([         'consumer_key'    => $data['apiKey'],         'consumer_secret' => $data['apiSecret'],         'token' => $post_data['args']['token'],         'token_secret' => $post_data['args']['tokenSecret']     ]);     $stack->push($middleware);     $client = new GuzzleHttp\Client([         'handler' => $stack,         'auth' => 'oauth'     ]);
    $query_str = "https://api.500px.com/v1/photos";

    

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = [];
     

    try {
        $resp = $client->get($query_str, $requestParams);
        $responseBody = $resp->getBody()->getContents();

        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});