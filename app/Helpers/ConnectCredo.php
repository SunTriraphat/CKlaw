<?php // Code within app\Helpers\Helper.php

class ConnectCredo
{
    //ดึง token จากหน้าเว็บหลัง login
    public static function postPage(){
        $headers = [
            "Content-Type: application/json",
            "Accept:application/json",
            "Cache-Control:no-cache"
        ];

        $url="https://scoring.credolab.com/v6.0/account/login";
        $pvars=array("userEmail"=>"admin@chookiat.com","password"=>"K4D4U6dgp");

        $curlx = curl_init($url);
        //$post = http_build_query($pvars);
        curl_setopt ($curlx, CURLOPT_USERAGENT, sprintf("Mozilla/%d.0",rand(4,5)));
        curl_setopt ($curlx, CURLOPT_HEADER, 0);
        curl_setopt ($curlx, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($curlx, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($curlx, CURLOPT_VERBOSE, true);
        curl_setopt ($curlx, CURLOPT_POST, 1);
        curl_setopt($curlx,CURLOPT_POSTFIELDS, json_encode($pvars));
        //curl_setopt($curlx,CURLOPT_POSTFIELDS, ($post));
        //curl_setopt($curl, CURLOPT_USERPWD,  $auth);
        curl_setopt($curlx,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlx, CURLOPT_AUTOREFERER, true);
        curl_setopt($curlx, CURLOPT_FOLLOWLOCATION,true); // follow redirects recursively
        curl_setopt($curlx, CURLOPT_FOLLOWLOCATION,false); // follow redirects recursively
        //curl_setopt($curlx, CURLOPT_FILE, $fp);

        if(curl_exec($curlx) === false){
            echo 'Curl error: ' . curl_error($curlx);
        }else{
            $contents=curl_exec($curlx);
        }
        curl_close($curlx);
        // dd($contents);

        return $contents;
    }

    //
    public static function postCreate($url,$pvars,$token){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        //curl_setopt ($ch, CURLOPT_USERAGENT, sprintf("Mozilla/%d.0",rand(4,5)));
        //curl_setopt ($ch, CURLOPT_HEADER, 0);

        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // Returns the data/output as a string instead of raw data

        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($pvars));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
           'Content-Type: application/json-patch+json',
           'Accept:application/json',
           'Authorization: Bearer ' . $token
           ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data=curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public static function postScore($value){
        $url="https://scoring.credolab.com/v6.0/datasets/$value/datasetinsight";
        $dataToken = ConnectCredo::postPage();
        $dataKeyToken= json_decode($dataToken,true);
        $token=$dataKeyToken["access_token"];
        $ch = curl_init($url);
        curl_setopt ($ch, CURLOPT_USERAGENT, sprintf("Mozilla/%d.0",rand(4,5)));
        //curl_setopt ($ch, CURLOPT_HEADER, 0);

        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // Returns the data/output as a string instead of raw data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_POST, 0);
        //Set your auth headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept:application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        $data=curl_exec($ch);

        // get info about the request
        $info = curl_getinfo($ch);
        // close curl resource to free up system resources
        curl_close($ch);
        $dataSet["data"]=$data;
        $dataSet["info"]=$info;
        $data1 = json_decode($dataSet["data"],true);

        if(isset($data1['scores'])) {
            $GetScore = $data1['scores'][0]['value'];
        }else {
            $GetScore = 0;
        }

        return array($GetScore,$data1);
    }
    public static function getTokenUser($user,$password){
        $msTeams = auth()->user()->UserToMSTeams;
        $clientSecret = $msTeams->ClientSecret_Id ;
        $tenantId = $msTeams->Tenant_Id;
        $clientId = $msTeams->Client_Id;
        $teams_chanel = $msTeams->Teams_Chanel;
        $group_id = $msTeams->Group_Id;

        try{
            $guzzle = new \GuzzleHttp\Client();
            $url = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/token';
            $token = json_decode($guzzle->post($url, [
                'form_params' => [
                    'grant_type'    => 'password', // password
                    'client_id'     => $clientId,
                    'client_secret' => $clientSecret,
                    'scope'         => "https://graph.microsoft.com/.default",
                    'username'      => $user,
                    'password'      => $password,
                ],
            ])->getBody()->getContents());

           return $token;

        }catch (\Exception $e) {
            return false;

        }
    }
}
