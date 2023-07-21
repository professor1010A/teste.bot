<?php

 $input = file_get_contents('php://input');

 $update = json_decode($input);

 $message = $update->message;
 
 $chat_id = $message->chat->id;
 
 $message_id = $update->message->message_id;
 
 $tipo = $message->chat->type;
 
 $texto = $message->text;
 
 $id = $message->from->id;
 
 $isbot = $message->from->is_bot;
 
 if($message->from->is_premium){
   
     $ispremium = "sim";
     
 }else{
   
     $ispremium = "não";
     
 }
 $nome = $message->from->first_name;
 
 $usuario = $message->chat->username;
 
 $data = $update->callback_query->data;
 
 $query_message_id = $update->callback_query->message->message_id;
 
 $query_chat_id = $update->callback_query->message->chat->id;
 
 $query_usuario = $update->callback_query->message->chat->username;
 
 $query_nome = $update->callback_query->message->chat->first_name;
 
 $query_id = $update->callback_query->id;

function bot($method, $parameters) {
 $token = "6311616481:AAENHS7fYZia8wZoe-6r95Yph_Ma85DOIVE";
 $options = array(
			 'http' => array(
			 'method'  => 'POST',
			 'content' => json_encode($parameters),
			 'header'=>  "Content-Type: application/json\r\n" .
	            "Accept: application/json\r\n"
			 )
			);

$context  = stream_context_create( $options );
		return file_get_contents('https://api.telegram.org/bot'.$token.'/'.$method, false, $context );
  
}

function consultas($dados){
  
  $chat_id = $dados["chat_id"];
  $message_id = $dados["query_message_id"];
  
  $txt = "*☆ | COMANDOS BOT @fernandothedev_bot | ☆*

*🔄 Bases de dados atualizada, servidores otimizados!*

*● | PARÂMETROS | ●*

🟢 *STATUS 》* ONLINE
🟡* STATUS 》* MANUTENÇÃO
🔴 *STATUS 》 *OFFLINE

*• [CPF (1)] •*

🟢 *CPF1: *nada

⚡️ *Use os comandos em Grupos e no Privado do Robô*

👤 *Suporte: @FernandoTheDev*
━━━━━━━━━━━━━━━━━━━━━";

  $button[] = ['text'=>"Voltar", "callback_data" => "start"];

  $menu['inline_keyboard'] = array_chunk($button, 2);
  
  bot("editMessageText",
    array(
    "chat_id"=> $chat_id,
    "text" => $txt,
    "message_id" => $message_id,
    "reply_to_message_id"=> $message_id,
    "reply_markup" => $menu,
    "parse_mode" => 'Markdown'));
}

function tabela($dados){
  
  $chat_id = $dados["chat_id"];
  $message_id = $dados["query_message_id"];
  //von Fernando, dem Entwickler
  $txt = "*🕵️ PLANO INDIVIDUAL*
            
*💰 PREÇOS:*

*1 SEMANA = R$100,00*

*⚠ Atenção:*

*Este plano é PRIVADO, ou seja, apenas você terá acesso as puxadas!*
*Certifique-se que você está acessando pelo PRIVADO do bot! @fernandothedev*
*Se tiver acessando a partir de um grupo, o plano não será liberado!*

- Escolha o plano abaixo!";

  $button[] = ['text'=>"1 SEMANA", "callback_data" => "kkk"];
  $button[] = ['text'=>"", "callback_data" => "."];
  $button[] = ['text'=>"Voltar", "callback_data" => "start"];

  $menu['inline_keyboard'] = array_chunk($button, 2);
  
  bot("editMessageText",
    array(
    "chat_id"=> $chat_id,
    "text" => $txt,
    "message_id" => $message_id,
    "reply_to_message_id"=> $message_id,
    "reply_markup" => $menu,
    "parse_mode" => 'Markdown'));
}

function start($dados){
  
  $chat_id = $dados["chat_id"];
  $message_id = $dados["query_message_id"];
  $nome = $dados["nome"];
  
  $txt = "🔹 *Bem Vindo {$nome}*
  
• [Canal - Oficial](t.me/escoladedevs)

_Navegue pelo meu menu abaixo:_";

  $button[] = ['text'=>"Consultas",'callback_data'=>"consultas"];
  
  $button[] = ['text'=>"Tabela",'callback_data'=>"tabela"];
  
  $button[] = ['text'=>"Suporte / Dev",'url'=>"t.me/fernandothedev"];

  $menu['inline_keyboard'] = array_chunk($button, 2);
  
  bot("editMessageText",
    array(
    "chat_id"=> $chat_id,
    "text" => $txt,
    "message_id" => $message_id,
    "reply_to_message_id"=> $message_id,
    "reply_markup" => $menu,
    "parse_mode" => 'Markdown'));
}

if (strpos($texto, "/start") === 0){
  
  $txt = "🔹 *Bem Vindo {$nome}*
  
• [Canal - Oficial](t.me/escoladedevs)

_Navegue pelo meu menu abaixo:_";

  $button[] = ['text'=>"Consultas",'callback_data'=>"consultas"];
  
  $button[] = ['text'=>"Tabela",'callback_data'=>"tabela"];
  
  $button[] = ['text'=>"Suporte / Dev",'url'=>"t.me/fernandothedev"];
 
 $menu['inline_keyboard'] = array_chunk($button, 2);

  bot("sendChatAction", 
    array(
    "chat_id" => $chat_id,
    "action" => "typing"));

bot("sendMessage",
    array(
    "chat_id"=> $chat_id ,
    "text" => $txt,
    "reply_markup" => $menu,
    "reply_to_message_id"=> $message_id,
    "message_id" => $message_id,
    "parse_mode" => 'Markdown'));
}

if (strpos($texto, "/cpf") === 0){
  
  $txt = "NAUM ACABEI :)";

  bot("sendChatAction", 
    array(
    "chat_id" => $chat_id,
    "action" => "typing"));

bot("sendMessage",
    array(
    "chat_id"=> $chat_id ,
    "text" => $txt,
    "reply_markup" => $menu,
    "reply_to_message_id"=> $message_id,
    "message_id" => $message_id,
    "parse_mode" => 'Markdown'));
}


if(isset($data)){
  $callback = explode("|", $data)[0];
  $dados = array(
   "chat_id" => $query_chat_id,
   "id" => $query_chat_id,
   "nome" => $query_nome,
   "usuario" => $query_usuario,
   "message_id" => $query_message_id,
   "query_message_id" => $query_message_id,
   "query_nome" => $query_nome,
   "query_id" => $query_id,
   "optional" => explode("|", $data)[1],
   "query_usuario" => $query_usuario
   );
    
  if(function_exists($callback)){
  
  $callback($dados);
  
 } else {
    bot("answerCallbackQuery",
    array(
    "callback_query_id" => $query_id,
    "text" => "⚠️ | Função em desenvolvimento!",
    "show_alert"=> false,
    "cache_time" => 10));
 }
}