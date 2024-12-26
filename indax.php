<?php
/*
- ملف بوت كشف ايدي قناتك وايديك وايدي مجموعة 🆔
- يتميز بثلاث لغات (عربي,انكليزي, فارسي) ⚙
-Channel : @Bots_Syria
Developer : @OO1OOO
-bot :          @id_ChannelBot
*/
define('API_KEY','7441744296:AAFbfBEffgxuXFbCGdu4nMSjOXZg3o7uumc');

function bot($method,$datas=[]){$BOT_Damascus = http_build_query($datas);
$url = "https://api.telegram.org/bot".API_KEY."/".$method."?$BOT_Damascus";
$BOTS_SYR1A = file_get_contents($url); return json_decode($BOTS_SYR1A);}


$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)){
    $message = $update->message; 
    $chat_id = $message->chat->id;
    $text = $message->text;
    $idchannel = $update->message->forward_from_chat->id;

}
$data = json_decode(file_get_contents("Data/$chat_id/data.json"),true);
$step = $data['step'];

mkdir("Data/$chat_id");
$language = json_encode(['keyboard'=>[
[['text'=>"العربية 🇸🇾"],['text'=>"English 🇱🇷"],['text'=>"🇮🇷 فارسى"]],
],'resize_keyboard'=>true]);


if($update->message->forward_from_chat){
bot('sendmessage', [
'chat_id'=>$chat_id, 
'parse_mode'=>html,
'text'=>"id channel <code>$idchannel</code>",
]);
}
if($text == "/id" ){
bot('sendmessage', [
'chat_id'=>$chat_id, 
'parse_mode'=>html,
'text'=>"<code>$chat_id</code>",
]);
}
if($update->message->new_chat_members){
bot('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode'=>html,
'text'=>"<code>$chat_id</code>",
]);
bot('leaveChat',[
'chat_id'=>$chat_id,
]);
}
if($step !== "ar" and $step !== "en" and $step !== "fa"){
if( $text == "/start"){
$data['step'] = "create";
bot('sendmessage', [
'chat_id'=>$chat_id, 
'parse_mode'=>html,
'text'=>"👋🏻مرحبا بك في بوت كشف معلومات\n\n👋🏻 استقبال به افشای اطلاعات ربات\n\n👋🏻 Welcome to bot information disclosure",
'reply_markup'=>$language
]);
}
}
if($step == "ar" and $text == "/start" or $text == "العربية 🇸🇾" ){
$data['step'] = "ar";
file_put_contents("Data/$chat_id/data.json",json_encode($data));
bot('sendmessage', [
'chat_id'=>$chat_id, 
'parse_mode'=>html,
'text'=>"1⃣ أرسل /id لإظهار إيديك\n\n2⃣ قم بعمل توجيه منشور في قناتك لأظهار إيدي القناة\n\n3⃣ أضفني إلى مجموعتك لإظهار إيدي المجموعة\n\nChannel : @Bots_Syria",
'reply_markup'=>$language
]);
}
if($step == "en" and $text == "/start" or $text == "English 🇱🇷" ){
$data['step'] = "en";
file_put_contents("Data/$chat_id/data.json",json_encode($data));
bot('sendmessage', [
'chat_id'=>$chat_id, 
'parse_mode'=>html,
'text'=>"1⃣ send /id show your id\n\n2⃣ Make a directive prism in your channel Show id \n\n3⃣ Add me to your Group Show id Group",
'reply_markup'=>$language
]);
}
if($step == "fa" and $text == "/start" or $text == "🇮🇷 فارسى" ){
$data['step'] = "fa";
file_put_contents("Data/$chat_id/data.json",json_encode($data));
bot('sendmessage', [
'chat_id'=>$chat_id, 
'parse_mode'=>html,
'text'=>"1⃣ ارسال /id اطلاعات ايديک\n\n2⃣ یک جزوه در کانال خود را برای نشان دادن ادی کانال\n\n3⃣ من را به مجموعه خود اضافه کنید تا دست گروه را نشان دهید.",
'reply_markup'=>$language
]);
}

