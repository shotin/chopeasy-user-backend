<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ErrorLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('error_logs')->delete();
        
        \DB::table('error_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'causer' => 'Guest',
                'model' => 'Illuminate\\Http\\Client\\ConnectionException',
            'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
                'error_line' => '939',
            'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
            'request_url' => 'http://localhost:8000/api/v1/auth/login',
            'request_method' => 'POST',
            'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
            'request_ip' => '127.0.0.1',
        'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 CrKey/1.54.250320',
            'context' => NULL,
            'created_at' => '2025-07-30 13:23:58',
            'updated_at' => '2025-07-30 13:23:58',
        ),
        1 => 
        array (
            'id' => 2,
            'causer' => 'Guest',
            'model' => 'Illuminate\\Http\\Client\\ConnectionException',
        'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
            'error_line' => '939',
        'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
        'request_url' => 'http://localhost:8000/api/v1/auth/login',
        'request_method' => 'POST',
        'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
        'request_ip' => '127.0.0.1',
    'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 CrKey/1.54.250320',
        'context' => NULL,
        'created_at' => '2025-07-30 13:24:50',
        'updated_at' => '2025-07-30 13:24:50',
    ),
    2 => 
    array (
        'id' => 3,
        'causer' => 'Guest',
        'model' => 'Illuminate\\Http\\Client\\ConnectionException',
    'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
        'error_line' => '939',
    'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
    'request_url' => 'http://localhost:8000/api/v1/auth/login',
    'request_method' => 'POST',
    'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
    'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 CrKey/1.54.250320',
    'context' => NULL,
    'created_at' => '2025-07-30 13:25:48',
    'updated_at' => '2025-07-30 13:25:48',
),
3 => 
array (
    'id' => 4,
    'causer' => 'Guest',
    'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
    'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 CrKey/1.54.250320',
'context' => NULL,
'created_at' => '2025-07-30 13:27:30',
'updated_at' => '2025-07-30 13:27:30',
),
4 => 
array (
'id' => 5,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 CrKey/1.54.250320',
'context' => NULL,
'created_at' => '2025-07-30 13:32:38',
'updated_at' => '2025-07-30 13:32:38',
),
5 => 
array (
'id' => 6,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 CrKey/1.54.250320',
'context' => NULL,
'created_at' => '2025-07-30 13:33:01',
'updated_at' => '2025-07-30 13:33:01',
),
6 => 
array (
'id' => 7,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 CrKey/1.54.250320',
'context' => NULL,
'created_at' => '2025-07-30 13:35:54',
'updated_at' => '2025-07-30 13:35:54',
),
7 => 
array (
'id' => 8,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-07-30 13:38:59',
'updated_at' => '2025-07-30 13:38:59',
),
8 => 
array (
'id' => 9,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=7008d32ecd1e471fbbe73941f196cdba&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\GeoLocationService.php(57): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Services\\User\\UserService.php(86): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(64): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"customer@chopwell.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 CrKey/1.54.250320',
'context' => NULL,
'created_at' => '2025-07-30 13:45:17',
'updated_at' => '2025-07-30 13:45:17',
),
9 => 
array (
'id' => 10,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"ilesanmiolushola9@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:02:45',
'updated_at' => '2025-10-11 13:02:45',
),
10 => 
array (
'id' => 11,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"chopeasy@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:09:02',
'updated_at' => '2025-10-11 13:09:02',
),
11 => 
array (
'id' => 12,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"olumide@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:11:33',
'updated_at' => '2025-10-11 13:11:33',
),
12 => 
array (
'id' => 13,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"olushola@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:12:43',
'updated_at' => '2025-10-11 13:12:43',
),
13 => 
array (
'id' => 14,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"ilesanmiolushola9@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:13:17',
'updated_at' => '2025-10-11 13:13:17',
),
14 => 
array (
'id' => 15,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"olushola@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 CrKey/1.54.250320',
'context' => NULL,
'created_at' => '2025-10-11 13:16:01',
'updated_at' => '2025-10-11 13:16:01',
),
15 => 
array (
'id' => 16,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"ilesanmiolushola9@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:16:52',
'updated_at' => '2025-10-11 13:16:52',
),
16 => 
array (
'id' => 17,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"ilesanmiolushola9@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:17:31',
'updated_at' => '2025-10-11 13:17:31',
),
17 => 
array (
'id' => 18,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"uzorarnon@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:18:45',
'updated_at' => '2025-10-11 13:18:45',
),
18 => 
array (
'id' => 19,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"chopeasy@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:19:29',
'updated_at' => '2025-10-11 13:19:29',
),
19 => 
array (
'id' => 20,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"ilesanmiolushola9@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:19:57',
'updated_at' => '2025-10-11 13:19:57',
),
20 => 
array (
'id' => 21,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"chopeasy@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:20:38',
'updated_at' => '2025-10-11 13:20:38',
),
21 => 
array (
'id' => 22,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"uzorarnon@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:21:15',
'updated_at' => '2025-10-11 13:21:15',
),
22 => 
array (
'id' => 23,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"olumide@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:23:34',
'updated_at' => '2025-10-11 13:23:34',
),
23 => 
array (
'id' => 24,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"ilesanmiolushola9@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:25:12',
'updated_at' => '2025-10-11 13:25:12',
),
24 => 
array (
'id' => 25,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"olumide@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:26:22',
'updated_at' => '2025-10-11 13:26:22',
),
25 => 
array (
'id' => 26,
'causer' => 'Guest',
'model' => 'Illuminate\\Http\\Client\\ConnectionException',
'error_message' => 'cURL error 6: Could not resolve host: api.ipgeolocation.io (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.ipgeolocation.io/ipgeo?apiKey=&ip=127.0.0.1',
'error_line' => '939',
'error_trace' => '#0 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(338): Illuminate\\Http\\Client\\PendingRequest->{closure:Illuminate\\Http\\Client\\PendingRequest::send():903}()
#1 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(903): retry()
#2 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\PendingRequest.php(770): Illuminate\\Http\\Client\\PendingRequest->send()
#3 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Client\\Factory.php(535): Illuminate\\Http\\Client\\PendingRequest->get()
#4 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php(361): Illuminate\\Http\\Client\\Factory->__call()
#5 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\GeoLocationService.php(58): Illuminate\\Support\\Facades\\Facade::__callStatic()
#6 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Services\\User\\UserService.php(140): App\\Services\\GeoLocationService->getGeoInfo()
#7 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\app\\Http\\Controllers\\v1\\Auth\\AuthController.php(67): App\\Services\\User\\UserService->login()
#8 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php(46): App\\Http\\Controllers\\v1\\Auth\\AuthController->login()
#9 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(265): Illuminate\\Routing\\ControllerDispatcher->dispatch()
#10 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php(211): Illuminate\\Routing\\Route->runController()
#11 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(808): Illuminate\\Routing\\Route->run()
#12 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Routing\\Router->{closure:Illuminate\\Routing\\Router::runRouteWithinStack():807}()
#13 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#14 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#15 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#16 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(807): Illuminate\\Pipeline\\Pipeline->then()
#17 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(786): Illuminate\\Routing\\Router->runRouteWithinStack()
#18 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(750): Illuminate\\Routing\\Router->runRoute()
#19 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php(739): Illuminate\\Routing\\Router->dispatchToRoute()
#20 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#21 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Foundation\\Http\\Kernel->{closure:Illuminate\\Foundation\\Http\\Kernel::dispatchToRouter():197}()
#22 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():167}()
#23 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#24 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#25 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#26 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#27 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#28 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#29 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#30 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#31 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#32 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php(61): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#33 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\HandleCors->handle()
#34 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#35 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#36 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#37 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#38 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#39 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(208): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#40 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():183}:184}()
#41 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#42 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#43 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#44 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\public\\index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#45 C:\\Users\\HP\\Documents\\ChopWell\\ADMIN\\user_backend\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php(23): require_once(\'...\')
#46 {main}',
'request_url' => 'http://localhost:8000/api/v1/auth/login',
'request_method' => 'POST',
'request_data' => '"{\\"email\\":\\"ilesanmiolushola9@gmail.com\\"}"',
'request_ip' => '127.0.0.1',
'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
'context' => NULL,
'created_at' => '2025-10-11 13:30:22',
'updated_at' => '2025-10-11 13:30:22',
),
));
        
        
    }
}