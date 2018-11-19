<?php 
$key = 'D3NET'; #ใส่ตามที่ต้องการ 
$proto = 'http'; #โปรโตคอลของเว็บตัวเอง http หรือ https(ssl) 
$url = 'https://files.catbox.moe/86m9j3.mp4'; #url ของลิงค์ที่ต้องการเข้ารหัส 
$accesskey = 'letsprotect'; #คีย์ API ถ้าไม่มีคีย์ส่วนตัวให้ใช้อันนี้ 
$cached = false; #ระบบแคชเพื่อเพิ่มความเร็วตอนเรียก ไม่แนะนำให้เปิดถ้าใช้ url ไม่คงที่ 
$locked = false; #ระบบล็อคโดเมนแนะนำให้เปิดแค่ตอนใช้ระบบแคช 
$domain = 'localhost'; #โดเมนของเว็บ ไม่ต้องใส่ http:// หรือ / ปิดท้าย 
$server = 'default'; #เซิร์ฟเวอร์การใช้งาน แนะนำให้ใช้งานตามประเทศที่ใช้ไกล้ๆ 
# ดูเซิร์ฟเวอร์ทั้งหมดได้ที่นี่ https://server.letsprotect.me # 

function protect_api($d3url, $proto, $domain, $server, $key, $accesskey, $cached, $locked) { 
$config['data'] = array( 
"key" => $key,"proto" => $proto,"url" => $d3url,"accesskey" => $accesskey,"cached" => $cached,"locked" => $locked,"domain" => $domain,"server" => $server 
); 
$config['useragent'] = 'Wyvern/1.0 (compatible; MSIE 8.0; Windows ME; EV1)'; 
$handler = curl_init(); 
curl_setopt($handler, CURLOPT_URL, $proto."://api.letsprotect.me"); 
curl_setopt($handler, CURLOPT_POSTFIELDS, http_build_query($config['data'])); 
curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE); 
curl_setopt($handler, CURLOPT_USERAGENT, $config['useragent']); 
curl_setopt($handler, CURLOPT_REFERER, $config['data']['domain']); 
curl_setopt($handler, CURLOPT_POST, true); 
curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false); 
$response = curl_exec($handler); 
$response_data = json_decode($response, true); 
if(!$response_data['error']) { 
return $response_data['url']; 
} else { 
return $config['data']['url']; 
} 
} 

echo $url = protect_api($url,$proto,$domain,$server,$key,$accesskey,$cached,$locked); 
?>
