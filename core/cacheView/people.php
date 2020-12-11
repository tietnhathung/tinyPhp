<html>
    <head>

    </head>
    <body>
        <?php foreach($data as $key => $value): ?>
            <h1><?php echo htmlspecialchars($value); ?></h1>
        <?php endforeach; ?>
        <?php foreach($data as $key => $value): ?>
            <h2><?php echo $key; ?></h2>
        <?php endforeach; ?>
    </body>
</html>
