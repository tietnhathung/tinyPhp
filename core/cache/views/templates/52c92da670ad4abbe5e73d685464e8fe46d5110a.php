<?php echo "ahihi";  $i = 1; ?><?php while($i<=5): ?><h4>Tieest</h4><?php
        echo "ahihi";
        $i++;
    ?><?php endwhile; ?><?php for($i = 1; $i <= 10; $i++): ?><h3>Hưng</h3><?php endfor; ?><?php if(is_array($data)): ?><?php foreach($data as $key => $value): ?><h1><?php echo htmlspecialchars($value); ?></h1><?php endforeach; ?><?php else: ?><h1>Đây không phải mảng</h1><?php endif; ?><?php switch (3): ?><?php case 5: ?><?php echo htmlspecialchars("5"); ?><?php break; ?><?php case 2: ?><?php echo htmlspecialchars("2"); ?><?php break; ?><?php default: ?><?php echo htmlspecialchars("s default s"); ?><?php endswitch; ?><h1>
    Hưng dzai a
</h1>
