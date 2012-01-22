<?php echo form_open('tracker/participants'); ?>

<h3>Add New Participant</h3>

<p><label>Name</label><input type="text" name="name" size="30" /></p>

<p><label>Team</label><select name="team">
    {teams}
        <option value="{TeamID}">{Name}</option>
    {/teams}
</select></p>

<p><input type="submit" value="Add" /></p>

<h3>Current Participants</h3>

<table>
    {participants}
    <tr>
        <td>{ParticipantName}</td>
        <td>{TeamName}</td>
        <td>
            <input id="delete_{ParticipantID}" type="checkbox" name="delete_{ParticipantID}" value="{ParticipantID}" /> <label for="delete_{ParticipantID}">Delete</label>
        </td>
    </tr>
    {/participants}
</table>

<p><input type="submit" value="Make Changes" /></p>

</form>
