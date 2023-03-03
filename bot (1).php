<?php
error_reporting(E_ALL & ~E_WARNING);
define('BOT_TOKEN', '6224206512:AAHdTktrWTiHj6jE8momfG7wzjgqST4XCYc');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
$dev = "1062343521";
define('ADMIN_ID', '1062343521');
#//////////////////////////#
$update = json_decode(file_get_contents("php://input"));
if(isset($update->message)){
    $from_id    = $update->message->from->id;
    $chat_id    = $update->message->chat->id;
    $tc         = $update->message->chat->type;
    $text       = $update->message->text;
    $first_name = $update->message->from->first_name;
    $message_id = $update->message->message_id;
}elseif(isset($update->callback_query)){
    $chat_id    = $update->callback_query->message->chat->id;
    $data       = $update->callback_query->data;
    $query_id   = $update->callback_query->id;
    $message_id = $update->callback_query->message->message_id;
    $in_text    = $update->callback_query->message->text;
    $from_id    = $update->callback_query->from->id;
}
#-----------------------------#
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
#-----------------------------#
function sendmessage($chat_id,$text,$keyboard = null) {
    bot('sendMessage',[
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => "HTML",
        'disable_web_page_preview' => true,
        'reply_markup' => $keyboard
    ]);
}
#-----------------------------#
#-----------------------------#
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}
#-----------------------------#
// ساخت فایل ها
if(!is_dir("data")){
mkdir("data");
}
if(!is_dir("data/user")){
mkdir("data/user");
}
if(!is_dir("data/vpn")) {
mkdir("data/vpn");
}
if(!is_dir("data/vpn/pol")) {
    mkdir("data/vpn/pol");
}
if(!is_dir("data/vpn/hajm")) {
    mkdir("data/vpn/hajm");
}
if(!is_dir("data/vpn/pol/irancell")) {
    mkdir("data/vpn/pol/irancell");
}
if(!is_dir("data/vpn/pol/hamrah")) {
    mkdir("data/vpn/pol/hamrah");
}
//////////ایرانسل 
if(!is_dir("data/vpn/irancell")) {
mkdir("data/vpn/irancell");
}
if(!is_dir("data/vpn/irancell/small")){
mkdir("data/vpn/irancell/small");
}
if(!is_dir("data/vpn/irancell/medium")){
mkdir("data/vpn/irancell/medium");
}
if(!is_dir("data/vpn/irancell/big")){
mkdir("data/vpn/irancell/big");
}
//////همراه اول
if(!is_dir("data/vpn/hamrah")){
mkdir("data/vpn/hamrah");
}
if(!is_dir("data/vpn/hamrah/small")){
mkdir("data/vpn/hamrah/small");
}
if(!is_dir("data/vpn/hamrah/medium")){
mkdir("data/vpn/hamrah/medium");
}
if(!is_dir("data/vpn/hamrah/big")){
mkdir("data/vpn/hamrah/big");
}
///////
if(!is_dir("data/change_message")){
mkdir("data/change_message");
}
if(!is_dir("data/user/$from_id")){
mkdir("data/user/$from_id");
}
if(!is_dir("data/user/$from_id/vpn")){
mkdir("data/user/$from_id/vpn");
}
if(!file_exists("data/change_message/start")) {
    file_put_contents("data/change_message/start", "سلام\nبه ربات من خوش اومدید\nقصد انجام چه کاری رو دارید🤔");
}
if(!file_exists("data/vpn/pol/irancell/small")) {
    file_put_contents("data/vpn/pol/irancell/small","0");
}
if(!file_exists("data/vpn/pol/irancell/medium")) {
    file_put_contents("data/vpn/pol/irancell/medium","0");
}
if(!file_exists("data/vpn/pol/irancell/big")) {
    file_put_contents("data/vpn/pol/irancell/big","0");
}
if(!file_exists("data/vpn/pol/hamrah/small")) {
    file_put_contents("data/vpn/pol/hamrah/small","0");
}
if(!file_exists("data/vpn/pol/hamrah/medium")) {
    file_put_contents("data/vpn/pol/hamrah/medium","0");
}
if(!file_exists("data/vpn/pol/hamrah/big")) {
    file_put_contents("data/vpn/pol/hamrah/big","0");
}
if(!file_exists("data/vpn/hajm/small")) {
    file_put_contents("data/vpn/hajm/small","0");
}
if(!file_exists("data/vpn/hajm/medium")) {
    file_put_contents("data/vpn/hajm/medium","0");
}
if(!file_exists("data/vpn/hajm/big")) {
    file_put_contents("data/vpn/hajm/big","0");
}
if(!file_exists("data/helpcon")) {
    file_put_contents("data/helpcon","متن راهنما تنظیم نشده است");
}
if(!file_exists("data/cart")) {
    file_put_contents("data/cart","شماره کارت ثبت نشده است نشده است");
}
////////#FF0019
$step = file_get_contents ("data/user/$from_id/step.txt");
$cart = file_get_contents("data/cart");
///////
function MessageRequestJson($method, $parameters) {
    $handle = curl_init(API_URL . $method);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
    curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($handle);
    curl_close($handle); // بستن پرانتز برای تابع curl_init
    return $result;
}

$meno1 = '🛒خرید سرویس🛒';
$meno2 = '➕شارژ حساب➕';
$meno3 = '🧾حساب کاربری🧾';
$meno4 = '💡راهنما اتصال💡';
$meno5 = '💲تعرفه ها💲';
$meno6 = '📞پشتیبانی📞';



      //////////دکمه خرید سرویس
    if ($data == "meno1") {
        $matn = "لطفا اپراتور مورد نظر خود را انتخاب کنید📞";
        $buy1 = "ایرانسل";
        $buy2 = "همراه اول";
        $buy3 = "برگشت 🔙";
        
        $buy = [
                   [
                       ['text' => "$buy1", 'callback_data' => "buy1"],
                       ['text' => "$buy2", 'callback_data' => "buy2"]
                   ],
                   [
                       ['text' => "$buy3",'callback_data' => "buy3"]
                   ]
               ];
        $key = [
               'inline_keyboard' => $buy
            ];
        MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $key));
    }
    ///////دکمه راهنما اتصال
    else if ($data == "meno4") {
        $matn = file_get_contents("data/helpcon");
        $ren2 = "برگشت🔙";
        $key = [
                    [
                        ['text'=>$ren2,'callback_data'=>"buy3"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
                   MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    }
    ///////////دکمه تعرفه ها
    else if ($data == "meno5") {
        $hajm1 = file_get_contents("data/vpn/hajm/small");
        $hajm2 = file_get_contents("data/vpn/hajm/medium");
        $hajm3 = file_get_contents("data/vpn/hajm/big");
        $ir1 = file_get_contents("data/vpn/pol/irancell/small");
        $ir2 = file_get_contents("data/vpn/pol/irancell/medium");
        $ir3 = file_get_contents("data/vpn/pol/irancell/big");
        $hm1 = file_get_contents("data/vpn/pol/hamrah/small");
        $hm2 = file_get_contents("data/vpn/pol/hamrah/medium");
        $hm3 = file_get_contents("data/vpn/pol/hamrah/big");
        $gh1 = "بسته ها";
        $gh2 = "حجم";
        $gh3 = "قیمت";
        $gh4 = "قیمت همراه اول";
        $gh5 = "قیمت ایرانسل";
        $gh6 = "کوچک";
        $gh7 = "متوسط";
        $gh8 = "بزرگ";
        $matn = "اینجا قسمت تعرفها هستش حجم بسته ها برای همراه اول و ایرانسل مشترکه ولی قیمت ها ممکنه متفاوت باشن";
        $key = [
                    [
                        ['text'=>$gh1,'callback_data'=>"1"],
                        ['text'=>$gh2,'callback_data'=>"1"],
                        ['text'=>$gh4,'callback_data'=>"1"],
                        ['text'=>$gh5,'callback_data'=>"1"]
                    ],
                    [
                        ['text'=>$gh8,'callback_data'=>"1"],
                        ['text'=>"$hajm3 GB",'callback_data'=>"1"],
                        ['text'=>"$hm3 T",'callback_data'=>"1"],
                        ['text'=>"$ir3 T",'callback_data'=>"1"]
                    ],
                    [
                        ['text'=>$gh7,'callback_data'=>"1"],
                        ['text'=>"$hajm2 GB",'callback_data'=>"1"],
                        ['text'=>"$hm2 T",'callback_data'=>"1"],
                        ['text'=>"$ir2 T",'callback_data'=>"1"]
                    ],
                    [
                        ['text'=>$gh6,'callback_data'=>"1"],
                        ['text'=>"$hajm1 GB",'callback_data'=>"1"],
                        ['text'=>"$hm1 T",'callback_data'=>"1"],
                        ['text'=>"$ir1 T",'callback_data'=>"1"]
                    ],
                    [
                        ['text'=>"برگشت",'callback_data'=>"buy3"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));

    }
    ///////////دکمه شارژ حساب
    else if ($data == "meno2") {
    $matn = "💳 برای شارژ حساب خود ابتدا مبلغ مورد نظر خود را به کارت زیر واریز کنید سپس از طریق دکمه ارسال رسید ، رسید بانکی را ارسال کنید .

شماره کارت :
`$cart`

با کلیک روی شماره کارت به صورت خودکار برای شما کپی می شود .
";
        $ars = "ارسال رسید";
        $key = [
                    [
                        ['text'=>"برگشت",'callback_data'=>"buy3"],
                        ['text'=>"$ars",'callback_data'=>"send"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
                   MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    }
     ////////////ارسال رسید
     else if ($data == "send"){
     bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ لطفا عکس رسید را برای من ارسال کنید :",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
    ]);
    file_put_contents ("data/user/$from_id/step.txt","zitactm");
}
    else if ($step == "zitactm" and $text != "/start"){
        $photo = $update->message->photo;
        $file_id = $update->message->photo[count($update->message->photo) - 1]->file_id;
        bot ('sendphoto',[
'chat_id'=>$dev,
'photo'=>"$file_id",
'caption'=>"
✅ فرستاده شده توسط کاربر `$chat_id`
",
'parse_mode'=>"Markdown",

    ]);
    sendmessage ($chat_id,"رسید یا موفقیت ارسال شد ."  , $key1);
    file_put_contents ("data/user/$from_id/step.txt","none");
}
    //////دکمه برگشت از خرید سرویس
    else if($data == "buy3") {
    $matn = file_get_contents("data/change_message/start");
    $meno1 = '🛒خرید سرویس🛒';
    $meno2 = '➕شارژ حساب➕';
    $meno3 = '🧾حساب کاربری🧾';
    $meno4 = '💡راهنما اتصال💡';
    $meno5 = '💲تعرفه ها💲';
    $meno6 = '📞پشتیبانی📞';
    $keybuy3 = [
        [
            ['text' => "$meno1" , 'callback_data' => "meno1"]
        ],
        [
            ['text' => "$meno2" , 'callback_data' => "meno2"],
            ['text' => "$meno3" , 'callback_data' => "meno3"]
        ],
        [
            ['text' => "$meno4" , 'callback_data' => "meno4"],
            ['text' => "$meno5" , 'callback_data' => "meno5"]
        ],
        [
            ['text' => "$meno6" , 'callback_data' => "meno6"]
        ]
    ];
    $key = [
        'inline_keyboard' => $keybuy3
    ];
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $key));
 
}



  ////////دستور استارت
if($text == "/start") {
    $matn = file_get_contents("data/change_message/start");
    $meno1 = '🛒خرید سرویس🛒';
    $meno2 = '➕شارژ حساب➕';
    $meno3 = '🧾حساب کاربری🧾';
    $meno4 = '💡راهنما اتصال💡';
    $meno5 = '💲تعرفه ها💲';
    $meno6 = '📞پشتیبانی📞';

    $key = [
        [
            ['text' => "$meno1" , 'callback_data' => "meno1"]
        ],
        [
            ['text' => "$meno2" , 'callback_data' => "meno2"],
            ['text' => "$meno3" , 'callback_data' => "meno3"]
        ],
        [
            ['text' => "$meno4" , 'callback_data' => "meno4"],
            ['text' => "$meno5" , 'callback_data' => "meno5"]
        ],
        [
            ['text' => "$meno6" , 'callback_data' => "meno6"]
        ]
    ];
    $inline_keyboard = [
        'inline_keyboard' => $key
    ];
    MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>$matn, 'reply_markup' => $inline_keyboard));
}
//////////دستور پنل
else if ($text == "/panel" || $text == "پنل") {
    if ($chat_id == ADMIN_ID) {
        $p1 = "تغییر متن دکمه ها";
        $p2 = "افزودن سرویس";
        $p3 = "تعیین تعرفه ها";
        $p4 = " تعیین حجم کانفیگ ها";
        $pkey = [
                    [
                        ['text'=>"$p1",'callback_data'=>"p1"],
                        ['text'=>"$p2",'callback_data'=>"p2"]
                    ],
                    [
                        ['text'=>"$p3",'callback_data'=>"p3"],
                        ['text'=>"$p4",'callback_data'=>"p4"]
                    ]
                ];
                
                $keyboard = [
                    'inline_keyboard'=>$pkey
                    ];
    $matn = "سلام مدیر عزیز✋\nبه پنل مدیریت خوش اومدید\n\nقصد انجام چه عملیاتی رو دارید؟🤔";
    MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>$matn,'reply_markup'=>$keyboard));
    }
    else {
        $matn = "پوزش میتلبم شما ادمین این ربات نیستید🙏";
        MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>$matn));

    }

}
////////////////// دکمه تغییر متن
    else if ($data == "p1") {
        $matn = "قصد تغییر متن کدوم دکمه رو دارید؟\n \n \n \n توجه داشته باشید که این قابلیت در اصل پیام ارسالی دکمه مورد نظر رو تغییر میده⚠️";
        $ren1 = "دکمه استارت";
        $ren3 = "دکمه آموزش اتصال";
        $ren2 = "برگشت🔙";
        $ren4 = "ثبت شماره کارت";
        $rekey = [
                    [
                        ['text'=>$ren1,'callback_data'=>"ren1"],
                        ['text'=>$ren3,'callback_data'=>"ren3"]
                    ],
                    [
                        ['text'=>$ren4,'callback_data'=>"ren4"]
                    ],
                    [
                        ['text'=>$ren2,'callback_data'=>"panelback"]
                    ]
                 ];
                 $keyboard = [
                     'inline_keyboard'=>$rekey
                     ];
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    //file_put_contents("data/user/$from_id/step.txt","none")
    }
    ////////دکمه برگشت به پنل
    else if ($data == "panelback") {
        if ($chat_id == ADMIN_ID) {
        file_put_contents("data/user/$from_id/step.txt","none");
        $p1 = "تغییر متن دکمه ها";
        $p2 = "افزودن سرویس";
        $p3 = "تعیین تعرفه ها";
        $p4 = " تعیین حجم کانفیگ ها";
        $pkey = [
                    [
                        ['text'=>"$p1",'callback_data'=>"p1"],
                        ['text'=>"$p2",'callback_data'=>"p2"]
                    ],
                    [
                        ['text'=>"$p3",'callback_data'=>"p3"],
                        ['text'=>"$p4",'callback_data'=>"p4"]
                    ]
                ];
                
                $keyboard = [
                    'inline_keyboard'=>$pkey
                    ];
    $matn = "سلام مدیر عزیز✋\nبه پنل مدیریت خوش اومدید\n\nقصد انجام چه عملیاتی رو دارید؟🤔";
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    }
    else {
        $matn = "پوزش میتلبم شما ادمین این ربات نیستید🙏";
        MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>$matn));
    }
    }
    ///////////دکمه ثبت شماره کارت
    else if ($data == "ren4") {
    $matn = "شما در حال تغییر شماره کارت هستید
شماره کارت فعلی $cart 
برای تغییر شماره کارت جدید رو بفرستید";
    $back = "برگشت🔙";
    $key = [
        [
            ['text'=>"$back",'callback_data'=>"panelback"]
        ]
           ];
    $keyboard = [
        'parse_mode'=>"Markdown",
        'inline_keyboard'=>$key
    ];
    file_put_contents("data/user/$from_id/step.txt","cart");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
}
else if ($step == "cart" and $text !== "/start" || $text !== "/panel") {
            $startm_path = "data/cart";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن متن جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'متن جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
    //////دکمه تغییر متن استارت
    else if ($data == "ren1") {
        $start = file_get_contents("data/change_message/start");
        $matn = "شما در بخش تغییر پیام دکمه استارت هستید⚠️\nمتن فعلی 👇\n\n$start \nبرای تغییر متن دلخواه خودتونو ارسال کنید🙏";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"panelback"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","start");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "start" and $text !== "/start" || $text !== "/panel") {
            $startm_path = "data/change_message/start";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن متن جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'متن جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
////////////////دکمه تغییر متن آموزش اتصال
    else if ($data == "ren3") {
        $start = file_get_contents("data/helpcon");
        $matn = "شما در بخش تغییر پیام دکمه آموزش اتصال هستید⚠️\nمتن فعلی 👇\n\n$start \nبرای تغییر متن دلخواه خودتونو ارسال کنید🙏";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"panelback"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","help");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "help" and $text !== "/start" || $text !== "/panel") {
            $startm_path = "data/helpcon";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن متن جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'متن جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
///////////////دکمه افزودن سرویس
    else if ($data == "p2") {
        $matn = "شما در بخش افزودن سرور ها قرار دارید، لطفا انتخاب کنید که قصد اضافه کردن کدوم سرویس رو دارید";
        $ser1 = "سرویس های همراه اول";
        $ser2 = "سرویس کوچک";
        $ser3 = "سرویس متوسط";
        $ser4 = "سرویس بزرگ";
        $ser5 = "سرویس های ایرانسل";
        $ser6 = "سرویس کوچک";
        $ser7 = "سرویس متوسط";
        $ser8 = "سرویس بزرگ";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$ser1",'callback_data'=>"ser1"]
                    ],
                    [
                        ['text'=>"$ser2",'callback_data'=>"ser2"],
                        ['text'=>"$ser3",'callback_data'=>"ser3"],
                        ['text'=>"$ser4",'callback_data'=>"ser4"]
                    ],
                    [
                        ['text'=>"$ser5",'callback_data'=>"ser5"]
                    ],
                    [
                        ['text'=>"$ser6",'callback_data'=>"ser6"],
                        ['text'=>"$ser7",'callback_data'=>"ser7"],
                        ['text'=>"$ser8",'callback_data'=>"ser8"]
                    ],
                    [
                        ['text'=>"$back",'callback_data'=>"panelback"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard' => $key
                   ];
                   MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    }
    /////////دکمه افزودن سرویس کوچک همراه اول 
    else if ($data == "ser2") {
        $matn = "شما در حال اضافه کردن سرویس کوچک برای اپراتور همراه اول هستید⚠️\n\n\n\nلطفا کانفیگ رو بفرستید تا برای فروش ذخیره کنم";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"panelback"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=> $key
                   ];
               MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
                file_put_contents("data/user/$from_id/step.txt","ser2");
    }
    else if ($step == "ser2" && trim($text) != "/start" && trim($text) != "/panel") {
    $rand = rand(1000,100000);
    file_put_contents("data/vpn/hamrah/small/$rand","$text");
    $matn = "کانفیگ برای فروش آماده شد✅";
    $back = "برگشت🔙";
    $key = [
        [
            ['text'=>"$back",'callback_data'=>"panelback"]
        ]
    ];
    $keyboard = [
        'inline_keyboard'=> $key
    ];
    MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn,'reply_markup' => $keyboard));
    file_put_contents("data/user/$from_id/step.txt","none");
}
////// افزودن سرویس متوسط همراه اول 
    else if ($data == "ser3") {
        $matn = "شما در حال اضافه کردن سرویس متوسط برای اپراتور همراه اول هستید⚠️\n\n\n\nلطفا کانفیگ رو بفرستید تا برای فروش ذخیره کنم";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"panelback"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=> $key
                   ];
               MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
                file_put_contents("data/user/$from_id/step.txt","ser3");
    }
    else if ($step == "ser3" && trim($text) != "/start" && trim($text) != "/panel") {
    $rand = rand(1000,100000);
    file_put_contents("data/vpn/hamrah/medium/$rand","$text");
    $matn = "کانفیگ برای فروش آماده شد✅";
    $back = "برگشت🔙";
    $key = [
        [
            ['text'=>"$back",'callback_data'=>"p2"]
        ]
    ];
    $keyboard = [
        'inline_keyboard'=> $key
    ];
    MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn,'reply_markup' => $keyboard));
    file_put_contents("data/user/$from_id/step.txt","none");
}
/////////////افرودن سرویس بزرگ همراه اول 
    else if ($data == "ser4") {
        $matn = "شما در حال اضافه کردن سرویس بزرگ برای اپراتور همراه اول هستید⚠️\n\n\n\nلطفا کانفیگ رو بفرستید تا برای فروش ذخیره کنم";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p2"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=> $key
                   ];
               MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
                file_put_contents("data/user/$from_id/step.txt","ser4");
    }
    else if ($step == "ser4" && trim($text) != "/start" && trim($text) != "/panel") {
    $rand = rand(1000,100000);
    file_put_contents("data/vpn/hamrah/big/$rand","$text");
    $matn = "کانفیگ برای فروش آماده شد✅";
    $back = "برگشت🔙";
    $key = [
        [
            ['text'=>"$back",'callback_data'=>"p2"]
        ]
    ];
    $keyboard = [
        'inline_keyboard'=> $key
    ];
    MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn,'reply_markup' => $keyboard));
    file_put_contents("data/user/$from_id/step.txt","none");
}
////////////// افزودن سرویس کوچک ایرانسل
    else if ($data == "p2") {
        $matn = "شما در بخش افزودن سرور ها قرار دارید، لطفا انتخاب کنید که قصد اضافه کردن کدوم سرویس رو دارید";
        $ser1 = "سرویس های همراه اول";
        $ser2 = "سرویس کوچک";
        $ser3 = "سرویس متوسط";
        $ser4 = "سرویس بزرگ";
        $ser5 = "سرویس های ایرانسل";
        $ser6 = "سرویس کوچک";
        $ser7 = "سرویس متوسط";
        $ser8 = "سرویس بزرگ";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$ser1",'callback_data'=>"ser1"]
                    ],
                    [
                        ['text'=>"$ser2",'callback_data'=>"ser2"],
                        ['text'=>"$ser3",'callback_data'=>"ser3"],
                        ['text'=>"$ser4",'callback_data'=>"ser4"]
                    ],
                    [
                        ['text'=>"$ser5",'callback_data'=>"ser5"]
                    ],
                    [
                        ['text'=>"$ser6",'callback_data'=>"ser6"],
                        ['text'=>"$ser7",'callback_data'=>"ser7"],
                        ['text'=>"$ser8",'callback_data'=>"ser8"]
                    ],
                    [
                        ['text'=>"$back",'callback_data'=>"panelback"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard' => $key
                   ];
                   MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    }
    /////////دکمه افزودن سرویس کوچک ایرانسل 
    else if ($data == "ser6") {
        $matn = "شما در حال اضافه کردن سرویس کوچک برای اپراتور ایرانسل هستید⚠️\n\n\n\nلطفا کانفیگ رو بفرستید تا برای فروش ذخیره کنم";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p2"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=> $key
                   ];
               MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
                file_put_contents("data/user/$from_id/step.txt","ser6");
    }
    else if ($step == "ser6" && trim($text) != "/start" && trim($text) != "/panel") {
    $rand = rand(1000,100000);
    file_put_contents("data/vpn/irancell/small/$rand","$text");
    $matn = "کانفیگ برای فروش آماده شد✅";
    $back = "برگشت🔙";
    $key = [
        [
            ['text'=>"$back",'callback_data'=>"p2"]
        ]
    ];
    $keyboard = [
        'inline_keyboard'=> $key
    ];
    MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn,'reply_markup' => $keyboard));
    file_put_contents("data/user/$from_id/step.txt","none");
}
/////////دکمه افزودن سرویس متوسط ایرانسل 
    else if ($data == "ser7") {
        $matn =  "شما در حال اضافه کردن سرویس متوسط برای اپراتور ایرانسل هستید⚠️\n\n\n\nلطفا کانفیگ رو بفرستید تا برای فروش ذخیره کنم";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p2"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=> $key
                   ];
               MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
                file_put_contents("data/user/$from_id/step.txt","ser7");
    }
    else if ($step == "ser7" && trim($text) != "/start" && trim($text) != "/panel") {
    $rand = rand(1000,100000);
    file_put_contents("data/vpn/irancell/medium/$rand","$text");
    $matn = "کانفیگ برای فروش آماده شد✅";
    $back = "برگشت🔙";
    $key = [
        [
            ['text'=>"$back",'callback_data'=>"p2"]
        ]
    ];
    $keyboard = [
        'inline_keyboard'=> $key
    ];
    MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn,'reply_markup' => $keyboard));
    file_put_contents("data/user/$from_id/step.txt","none");
}
/////////دکمه افزودن سرویس بزرگ ایرانسل 
    else if ($data == "ser8") {
        $matn = "شما در حال اضافه کردن سرویس بزرگ برای اپراتور ایرانسل هستید⚠️\n\n\n\nلطفا کانفیگ رو بفرستید تا برای فروش ذخیره کنم";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p2"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=> $key
                   ];
               MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
                file_put_contents("data/user/$from_id/step.txt","ser8");
    }
    else if ($step == "ser8" && trim($text) != "/start" && trim($text) != "/panel") {
    $rand = rand(1000,100000);
    file_put_contents("data/vpn/irancell/big/$rand","$text");
    $matn = "کانفیگ برای فروش آماده شد✅";
    $back = "برگشت🔙";
    $key = [
        [
            ['text'=>"$back",'callback_data'=>"p2"]
        ]
    ];
    $keyboard = [
        'inline_keyboard'=> $key
    ];
    MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn,'reply_markup' => $keyboard));
    file_put_contents("data/user/$from_id/step.txt","none");
}
    else if ($data == "p3") {
        $matn = "شما در بخش تعیین قیمت ها قرار دارید، لطفاً انتخاب کنید که قیمت کدوم بسته رو میخواید تغییر بدهید";
        $pol1 = "سرویس های همراه اول";
        $pol2 = "سرویس کوچک";
        $pol3 = "سرویس متوسط";
        $pol4 = "سرویس بزرگ";
        $pol5 = "سرویس های ایرانسل";
        $pol6 = "سرویس کوچک";
        $pol7 = "سرویس متوسط";
        $pol8 = "سرویس بزرگ";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$pol1",'callback_data'=>"pol1"]
                    ],
                    [
                        ['text'=>"$pol2",'callback_data'=>"pol2"],
                        ['text'=>"$pol3",'callback_data'=>"pol3"],
                        ['text'=>"$pol4",'callback_data'=>"pol4"]
                    ],
                    [
                        ['text'=>"$pol5",'callback_data'=>"pol5"]
                    ],
                    [
                        ['text'=>"$pol6",'callback_data'=>"pol6"],
                        ['text'=>"$pol7",'callback_data'=>"pol7"],
                        ['text'=>"$pol8",'callback_data'=>"pol8"]
                    ],
                    [
                        ['text'=>"$back",'callback_data'=>"panelback"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard' => $key
                   ];
                   MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    }
    else if ($data == "pol2") {
        $pol = file_get_contents("data/vpn/pol/hamrah/small");
        $matn = "شما در قسمت تعیین قیمت بسته کوچک همرا اول هستید \n\n\n\n قیمت فعلی ($pol) است\nقیمت جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p3"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","pol2");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "pol2" and is_numeric($text)) {            $startm_path = "data/vpn/pol/hamrah/small";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن قیمت جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'قیمت جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
    else if ($data == "pol3") {
        $pol = file_get_contents("data/vpn/pol/hamrah/medium");
        $matn = "شما در قسمت تعیین قیمت بسته متوسط همرا اول هستید \n\n\n\n قیمت فعلی ($pol) است\nقیمت جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p3"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","pol3");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "pol3" and is_numeric($text)) {            $startm_path = "data/vpn/pol/hamrah/medium";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن قیمت جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'قیمت جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
    else if ($data == "pol4") {
        $pol = file_get_contents("data/vpn/pol/hamrah/big");
        $matn = "شما در قسمت تعیین بزرگ بسته متوسط h اول هستید \n\n\n\n قیمت فعلی ($pol) است\nقیمت جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p3"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","pol4");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "pol4" and is_numeric($text)) {            $startm_path = "data/vpn/pol/hamrah/big";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن قیمت جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'قیمت جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
    else if ($data == "pol6") {
        $pol = file_get_contents("data/vpn/pol/irancell/small");
        $matn = "شما در قسمت تعیین قیمت بسته کوچک ایرانسل هستید \n\n\n\n قیمت فعلی ($pol) است\nقیمت جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p3"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","pol6");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "pol6" and is_numeric($text)) {            $startm_path = "data/vpn/pol/irancell/small";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن قیمت جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'قیمت جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
    else if ($data == "pol7") {
        $pol = file_get_contents("data/vpn/pol/irancell/medium");
        $matn = "شما در قسمت تعیین قیمت بسته متوسط ایرانسل هستید \n\n\n\n قیمت فعلی ($pol) است\nقیمت جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p3"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","pol7");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "pol7" and is_numeric($text)) {            $startm_path = "data/vpn/pol/irancell/medium";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن قیمت جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'قیمت جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
    else if ($data == "pol8") {
        $pol = file_get_contents("data/vpn/pol/irancell/big");
        $matn = "شما در قسمت تعیین قیمت بسته بزرگ ایرانسل هستید \n\n\n\n قیمت فعلی ($pol) است\nقیمت جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p3"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","pol8");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "pol8" and is_numeric($text)) {            $startm_path = "data/vpn/pol/irancell/big";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن قیمت جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'قیمت جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
//////////////////تعیین حجم
    else if ($data == "p4") {
        $matn = "شما در بخش تعیین حجم ها قرار دارید، لطفاً انتخاب کنید که قیمت کدوم بسته رو میخواید تغییر بدهید";
        $gig2 = "سرویس کوچک";
        $gig3 = "سرویس متوسط";
        $gig4 = "سرویس بزرگ";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$gig2",'callback_data'=>"gig2"],
                        ['text'=>"$gig3",'callback_data'=>"gig3"],
                        ['text'=>"$gig4",'callback_data'=>"gig4"]
                    ],
                    [
                        ['text'=>"$back",'callback_data'=>"panelback"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard' => $key
                   ];
                   MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    }
    else if ($data == "gig2") {
        $hajm = file_get_contents("data/vpn/hajm/small");
        $matn = "شما در قسمت تعیین حجم بسته کوچک هستید \n\n\n\n قیمت فعلی ($hajm) است حجم جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p4"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","gig2");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "gig2" and is_numeric($text)) {
        $startm_path = "data/vpn/hajm/small";
        $result = file_put_contents($startm_path, $text);
        if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن حجم جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'حجم جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
    else if ($data == "gig3") {
        $hajm = file_get_contents("data/vpn/hajm/medium");
        $matn = "شما در قسمت تعیین حجم بسته متوسط هستید \n\n\n\n قیمت فعلی ($hajm) است حجم جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p4"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","gig3");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "gig3" and is_numeric($text)) {            $startm_path = "data/vpn/hajm/medium";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن حجم جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'حجم جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
}
    else if ($data == "gig4") {
        $hajm = file_get_contents("data/vpn/hajm/big");
        $matn = "شما در قسمت تعیین حجم بسته بزرگ هستید \n\n\n\n قیمت فعلی ($hajm) است حجم جدید رو ارسال کنید";
        $back = "برگشت🔙";
        $key = [
                    [
                        ['text'=>"$back",'callback_data'=>"p4"]
                    ]
               ];
               $keyboard = [
                   'inline_keyboard'=>$key
                   ];
        file_put_contents("data/user/$from_id/step.txt","gig4");
    MessageRequestJson("editmessagetext", array('chat_id' => $chat_id, 'message_id'=> $message_id,'text' => $matn,'reply_markup' => $keyboard));
    
    }
    else if ($step == "gig4" and is_numeric($text)) {            $startm_path = "data/vpn/hajm/big";
    $result = file_put_contents($startm_path, $text);
    if ($result === false) {
        $matn = 'مشکلی در ذخیره کردن حجم جدید به وجود آمده است. لطفا دوباره تلاش کنید.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
    } else {
        $matn = 'حجم جدید با موفقیت ذخیره شد.';
        MessageRequestJson("sendmessage", array('chat_id' => $chat_id, 'text' => $matn));
        file_put_contents("data/user/$from_id/step.txt","none");
    }
    }










?>