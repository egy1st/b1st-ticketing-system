 <?php
 function B1st_OPSWAT_scan_file($file)
 {
    $settings = (array)B1st_getSettingsValue('opswat');

    $api    = 'https://scan.metascan-online.com/v2/file';
    $apikey = $settings['api_key'];
   
    // Build headers array.
    $headers = array(
        'apikey: '.$apikey,
        'filename: '.basename($file)
    );

    // Build options array.
    $options = array(
        CURLOPT_URL     => $api,
        CURLOPT_HTTPHEADER  => $headers,
        CURLOPT_POST        => true,
        CURLOPT_POSTFIELDS  => file_get_contents($file),
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_SSL_VERIFYPEER  => false
    );

    // Init & execute API call.
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $h = curl_exec($ch);
    $response = json_decode($h, true);
	
	
    return $response;
 }


function B1st_OPSWAT_scan_report($rest_ip,$data_id)
{
     $settings = (array)B1st_getSettingsValue('opswat');
    //Config.
    $api        = 'https://'.$rest_ip.'/file/'.$data_id;
    $apikey = $settings['api_key'];

    //Build headers array.
    $headers = array(
        'apikey: '.$apikey
    );

    //Build options array.
    $options = array(
        CURLOPT_URL     => $api,
        CURLOPT_HTTPHEADER  => $headers,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_SSL_VERIFYPEER  => false
    );

    $response = "";
    //Init & execute API call.
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    do {
        $response = json_decode(curl_exec($ch), true);
    }
    while ($response["scan_results"]["progress_percentage"] != 100);

    if($response['scan_results']['scan_all_result_i'] == 0)
    {
       return true;
    } 

    return false;
}