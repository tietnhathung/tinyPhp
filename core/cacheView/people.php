<html>
    <head>

    </head>
    <body>
        <?php if(is_array($data)): ?>
            <?php foreach($data as $key => $value): ?>
                <h1><?php echo htmlspecialchars($value); ?></h1>
            <?php endforeach; ?>
            <?php else: ?>
                <h1>Đây không phải mảng</h1>
            
        <?php endif; ?>
    </body>
</html>
