<form class="log" action='/' method='GET'>
    <div class="text">Войдите, чтобы отправить сообщение:  </div>
		<input  name='login' type='text'>
		<input name='password' type='password'>
		<input class="button" type='submit' value='Авторизироваться'>
	</form>

<?php

date_default_timezone_set('Asia/Vladivostok');
$login_successful = false;

    function add_message_to_file($login, $message){
        $content = json_decode(file_get_contents("message.json"));
        $message_object = (object) ['date' => date('d.m.Y H:i'), 'user' => $login, 'message' => $message];
        $content->messages[] = $message_object;
        file_put_contents("message.json", json_encode($content));
    }

    function show_messages(){
        $content = json_decode(file_get_contents("message.json"));
        foreach($content->messages as $message){
            echo "<p>";
            echo "$message->date $message->user";
            echo "</p>";
            echo "<p>";
            echo "$message->message";
            echo "</p>";
        }
    }
    

if (isset($_GET['login'])&&isset($_GET['password'])) {
    setcookie('login', $_GET['login']);
    $user = $_GET['login'];
    $pwd = $_GET['password'];
    
    

     if ($user == 'admin' && $pwd == '000' || 
         $user == 'drainkid' && $pwd == '228' ||
         $user =='chelik'  && $pwd == '777'
         )
         {
             
        $login_successful = true; 
        echo ("Авторизирован как   ");
        echo($_GET['login']);
    }
    
    else {
        echo ("  ");
         echo ("  ");
        echo ("Неверный логин или пароль...  ");
       
    }
}

if ($login_successful){
 ?>    
    <form class="smski" action="/" method="GET">
    <input class="in" placeholder="Сообщение" name="message">
    <input class="button" type="submit" name="send" value="Отправить">
    </form>
<?php
}

 if (isset($_GET['message'])){
    add_message_to_file ($_COOKIE['login'], $_GET['message']) ; 
   } 
    show_messages();
?>

