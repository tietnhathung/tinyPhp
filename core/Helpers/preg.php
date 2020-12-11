<?php
 
function preg_foreach(&$htmlRaw){
    preg_match_all('/<\s*foreach\s*parameters\s*=\s*"([$\w =>]+)"\s*>/', $htmlRaw, $allForeach);
    foreach ($allForeach[0]??[] as $key => $search) {
        $parameters = $allForeach[1][$key] ?? "";
        $htmlRaw =  str_replace ($search, "<?php foreach($parameters): ?>", $htmlRaw );
    }
    $htmlRaw =  preg_replace('/<\/\s*foreach\s*>/' , "<?php endforeach; ?>", $htmlRaw );
}

function preg_echo(&$htmlRaw){
    preg_match_all('/{{([$\w ]+)}}/', $htmlRaw, $allEchoHt);
    foreach ($allEchoHt[0]??[] as $key => $search) {
        $parameters = $allEchoHt[1][$key] ?? "";
        $htmlRaw =  str_replace ($search, "<?php echo htmlspecialchars($parameters); ?>", $htmlRaw );
    }
    preg_match_all('/{!([$\w ]+)!}/', $htmlRaw, $allEcho);
    foreach ($allEcho[0]??[] as $key => $search) {
        $parameters = $allEcho[1][$key] ?? "";
        $htmlRaw =  str_replace ($search, "<?php echo $parameters; ?>", $htmlRaw );
    }
}

function preg_ifelse(&$htmlRaw){
    preg_match_all('/<if\s+parameters\s*=\s*["|\']+([$\w \(\)=!><&|]+)["|\']+\s*>/', $htmlRaw, $allIf);
    foreach ($allIf[0]??[] as $key => $search) {
        $parameters = $allIf[1][$key] ?? "";
        $htmlRaw =  str_replace ($search, "<?php if($parameters): ?>", $htmlRaw );
    }
    preg_match_all('/<elseif\s+parameters\s*=\s*["|\']+([$\w \(\)=!><&|]+)["|\']+\s*>/', $htmlRaw, $allElseif);
    foreach ($allElseif[0]??[] as $key => $search) {
        $parameters = $allElseif[1][$key] ?? "";
        $htmlRaw =  str_replace ($search, "<?php elseif($parameters): ?>", $htmlRaw );
    }
    
    $htmlRaw =  preg_replace('/<else\s*>/', '<?php else: ?>', $htmlRaw);
    $htmlRaw =  preg_replace('/<\/if\s*>/', '<?php endif; ?>', $htmlRaw);
    $htmlRaw =  preg_replace('/<\/elseif\s*>/', '', $htmlRaw);
    $htmlRaw =  preg_replace('/<\/else\s*>/', '', $htmlRaw);
}