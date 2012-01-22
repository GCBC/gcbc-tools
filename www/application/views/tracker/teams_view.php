<?php echo form_open('tracker/teams'); ?>

<h3>Add New Team</h3>

<p><label>Name</label><input type="text" name="name" size="30" /></p>

<p><input type="submit" value="Add" /></p>

<h3>Current Teams</h3>

<table>
    {teams}
    <tr>
        <td>{Name}</td>
        <td>
            <input id="delete_{TeamID}" type="checkbox" name="delete_{TeamID}" value="{TeamID}" /> <label for="delete_{TeamID}">Delete</label>
        </td>
    </tr>
    {/teams}
</table>

<p><input type="submit" value="Make Changes" /></p>

</form>
