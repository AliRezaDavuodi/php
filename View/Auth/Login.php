<form action="/login" method="post">
    <div><label for="email">email</label><input type="text" id="email" name="email"></div>
    <div><label for="password">password</label><input type="password" id="password" name="password"></div>
    <button type="submit">login</button>
    <a href="/register">register</a>
</form>


<?php if (isset($data['err'])) { ?>
    <div class="" style="color: red">
        <?php echo $data['err'] ?>
    </div>
<?php } ?>