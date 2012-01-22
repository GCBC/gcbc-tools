<?php echo form_open('itemised_bill_emailer/send'); ?>

<p><label>From:</label><input type="text" name="from" value="<?= set_value('from','treasurer@girtoncollegeboatclub.com') ?>" size="40" /></p>
<p><label>BCC:</label><input type="text" name="bcc" value="<?= set_value('bcc','treasurer@girtoncollegeboatclub.com') ?>" size="40" /></p>
<p><label>Confirm:</label><input type="checkbox" name="confirm" /></p>

<?= validation_errors('<p class="error">','</p>') ?>

<p><input type="submit" value="Send" /></p>

</form>
