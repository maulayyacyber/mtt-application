<!DOCTYPE html>
<html lang="id">
<head>
    <title>Password baru anda di Medical Top Team</title>
</head>
<body style="margin:0;padding:0;">
<div style="background: #ECECEC;margin: 0 auto;padding: 1em;">
    <div style="border-bottom: 2px solid #ccc;padding-bottom: 1em;">
    
    </div>
    <div style="padding-right: 3em;">
        <h3 style="color:#458ac6;text-align: center;text-decoration: none;font-family: monospace;font-size: 15px;margin:10px 0;padding:0;">
            Password baru anda di Medical Top Team
        </h3>
        <p style="font-family: Sans-serif;line-height: 22px;">
            Anda telah mengubah password anda.<br>
            Tolong, di simpan baik-baik password baru anda, sehingga anda tidak lupa.<br>
            -----------------------------------------------------------------<br>
            <?php echo $message; ?><br>
            -----------------------------------------------------------------<br>
            Anda menerima pesan ini, karena dari salah satu user kami di <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $this->config->item('website_name'); ?></a> meminta password baru melalu email ini. Ini adalah bagian dari prosedur untuk membuat password baru pada sistem kami.<br>
        </p>
    </div>
    <div style="border-top: 1px solid #ccc;padding-top: 1em;text-align: center;">
        <h4 style="color:#564f8a;text-align: center;text-decoration: none;font-family: monospace;font-size: 20px;margin:0;padding:0;">
            Medical Top Team
        </h4>
    </div>
</div>
</body>
</html>