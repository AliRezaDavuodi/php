<form action="/register" method="post">
    <div>
        <label for="name">name</label>
        <input autocomplete="off" type="text" id="name" name="name">
    </div>
    <div>
        <label for="email">email</label>
        <input autocomplete="" type="text" id="email" name="email">
    </div>
    <div>
        <label for="password">password</label>
        <input autocomplete="off" type="password" id="password" name="password">
    </div>
    <button type="submit">sign up</button>
    <a href="/login">login</a>
</form>


<?php if (isset($data['err'])) { ?>
    <div class="" style="color: red">
        <?php echo $data['err'] ?>
    </div>
<?php } ?>