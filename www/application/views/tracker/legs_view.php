<?php echo form_open('tracker/legs'); ?>

<h3>Start Leg</h3>

<p>
    <label>Participant</label>
    <select name="participant">
        <option value="0">-- CHOOSE --</option>
    {participants}
        <option value="{ParticipantID}">{ParticipantName} - {TeamName}</option>
    {/participants}
    </select>
</p>
<p>
    <input type="submit" value="Start" />
</p>

<h3>Running Legs</h3>

<table>
    <tr>
        <th>Participant</th>
        <th>Team</th>
        <th>Start</th>
        <th>Duration</th>
        <th>Distance / metres</th>
    </tr>
    {running_legs}
    <tr>
        <td>{ParticipantName}</td>
        <td>{TeamName}</td>
        <td>{Start}</td>
        <td>{Duration}</td>
        <td><input type="text" name="distance_{LegID}" size="10" /></td>
        <td>
            <input id="finish_{LegID}" type="checkbox" name="finish_{LegID}" value="{LegID}" /> <label for="finish_{LegID}">Finish</label>
        </td>
        <td>
            <input id="delete_{LegID}" type="checkbox" name="delete_{LegID}" value="{LegID}" /> <label for="delete_{LegID}">Delete</label>
        </td>
    </tr>
    {/running_legs}
</table>

<p><input type="submit" value="Make Changes" /></p>

<h3>Completed Legs</h3>

<table>
    <tr>
        <th>Participant</th>
        <th>Team</th>
        <th>Start</th>
        <th>Finish</th>
        <th>Duration</th>
        <th>Distance / metres</th>
    </tr>
    {completed_legs}
    <tr>
        <td>{ParticipantName}</td>
        <td>{TeamName}</td>
        <td>{Start}</td>
        <td>{Finish}</td>
        <td>{Duration}</td>
        <td>{Distance}</td>
        <td>
            <input id="delete_{LegID}" type="checkbox" name="delete_{LegID}" value="{LegID}" /> <label for="delete_{LegID}">Delete</label>
        </td>
    </tr>
    {/completed_legs}
</table>

<p><input type="submit" value="Make Changes" /></p>

</form>
