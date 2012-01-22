<?php echo form_open('tracker/delete'); ?>

<p><label>Confirm:</label><input type="checkbox" name="confirm" /></p>

<?= validation_errors('<p class="error">','</p>') ?>

<p><input type="submit" value="Delete" /></p>

</form>
