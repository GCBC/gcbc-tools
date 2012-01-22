<?= form_open_multipart('itemised_bill_emailer/upload') ?>

<p><input type="file" name="userfile" size="20" /></p>

<p><input type="submit" value="Upload" /></p>

<p class="error"><?= $errors ?></p>

</form>
