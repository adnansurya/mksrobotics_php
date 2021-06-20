<?php 

 



    function sendMessage($chatId, $msg, $token){
        $request_params = [
            'chat_id' => $chatId,
            'text' => $msg,
            'parse_mode' => 'html'
        ];    
        
        $request_url = 'https://api.telegram.org/bot'. $token . '/sendMessage?' . http_build_query($request_params);

        file_get_contents($request_url);
    }

    function deleteMessage($chatId, $messageId, $token){
        $request_params = [
            'chat_id' => $chatId,
            'message_id' => $messageId
        ];    
        
        $request_url = 'https://api.telegram.org/bot'. $token . '/deleteMessage?' . http_build_query($request_params);

        file_get_contents($request_url);
    }

    
?>