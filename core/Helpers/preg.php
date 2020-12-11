<?php
 
function preg_foreach(&$htmlRaw){
    preg_match_all('/<\s*foreach\s*data\s*=\s*"([$\w =>]+)"\s*>/', $htmlRaw, $allForeach);
    foreach ($allForeach[0]??[] as $key => $search) {
        $arguments = $allForeach[1][$key] ?? "";
        $htmlRaw =  str_replace ($search, "<?php foreach($arguments): ?>", $htmlRaw );
    }
    $htmlRaw =  preg_replace('/<\/\s*foreach\s*>/' , "<?php endforeach; ?>", $htmlRaw );
}

function preg_echo(&$htmlRaw){
    preg_match_all('/{{([$\w ]+)}}/', $htmlRaw, $allEchoHt);
    foreach ($allEchoHt[0]??[] as $key => $search) {
        $arguments = $allEchoHt[1][$key] ?? "";
        $htmlRaw =  str_replace ($search, "<?php echo htmlspecialchars($arguments); ?>", $htmlRaw );
    }
    preg_match_all('/{!([$\w ]+)!}/', $htmlRaw, $allEcho);
    foreach ($allEcho[0]??[] as $key => $search) {
        $arguments = $allEcho[1][$key] ?? "";
        $htmlRaw =  str_replace ($search, "<?php echo $arguments; ?>", $htmlRaw );
    }
}