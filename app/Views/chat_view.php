<!-- chat_view.php -->

<!-- Tampilkan pesan chat yang ada di database -->
<?php foreach ($chats as $chat) : ?>
    <div>
        <strong><?= $chat['user_id'] ?>:</strong> <?= $chat['message'] ?>
    </div>
<?php endforeach; ?>

<!-- Form input untuk pengguna memasukkan pesan baru -->
<form action="/chat/process" method="post">
    <input type="text" name="message" placeholder="Masukkan pesan Anda">
    <button type="submit">Kirim</button>
</form>
