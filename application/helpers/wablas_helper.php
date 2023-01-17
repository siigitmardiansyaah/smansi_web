<?php
if (!function_exists('sendWA')) {
    function sendWA($no_wa,$pesan)
    {
//         // $link  =  "https://pati.wablas.com/api/v2/send-message";
//         // $data = [
//         //     'phone' => $no_wa,
//         //     'message' => $pesan,
//         // ];


//         // $curl = curl_init();
//         // $token =  "sHcxmCZ1YfZFcsPLdylJlsuTuWcMMIdWG50qTODgiuj271lT8lTSlJhBpLzuHGmi";

//         // curl_setopt(
//         //     $curl,
//         //     CURLOPT_HTTPHEADER,
//         //     array(
//         //         "Authorization: $token",
//         //     )
//         // );
//         // curl_setopt($curl, CURLOPT_URL, $link);
//         // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
//         // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//         // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
//         // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//         // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//         // $result = curl_exec($curl);
//         // curl_close($curl);
//         // return $result;
// $curl = curl_init();
// $token = "NJHRjn4mjaZBUYvIONV7MFz9ljig3BWvziM0NM5jmAsJMwF9oTjXUdOEjZqt2qae";
// $random = true;
// $payload = [
//     "data" => [
//         [
//             'phone' => $no_wa,
//             'message' => $pesan,
//             'secret' => false, // or true
//             'retry' => false, // or true
//             'isGroup' => false, // or true
//         ]
//     ]
// ];
// curl_setopt($curl, CURLOPT_HTTPHEADER,
//     array(
//         "Authorization: $token",
//         "Content-Type: application/json"
//     )
// );
// curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
// curl_setopt($curl, CURLOPT_URL,  "https://pati.wablas.com/api/v2/send-message?random=$random");
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

// $result = curl_exec($curl);
// curl_close($curl);
// return $result;

$curl = curl_init();
$token = "NJHRjn4mjaZBUYvIONV7MFz9ljig3BWvziM0NM5jmAsJMwF9oTjXUdOEjZqt2qae";
$data = [
'phone' => $no_wa,
'message' => $pesan,
];
curl_setopt($curl, CURLOPT_HTTPHEADER,
    array(
        "Authorization: $token",
    )
);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_URL,  "https://jogja.wablas.com/api/send-message");
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($curl);
curl_close($curl);
return $result;



    }
}
