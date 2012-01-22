<?= form_open('user/login') ?>

<p>

    <label>Username:</label>

    <input name="username" type="text" value="<?= set_value('username') ?>" size="10" />

</p>

<p>

    <label>Password:</label>

    <input name="password" type="password" value="" size="10" />

</p>

<?php echo validation_errors('<p class="error">','</p>'); ?>

<p><input type="submit" value="Login" /></p>

</form>
