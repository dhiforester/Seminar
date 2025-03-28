<?php
    $ApiKey=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
    echo '<span class="text-success" id="NotifikasiGenerateApiKey">Generate Success!</span><br>';
    echo 'API Key: <span id="ApiKeyIs">'.$ApiKey.'</span>';
?>