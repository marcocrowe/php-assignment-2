<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table>
        <tr>
            <td>First name:</td>
            <td> <input name="<?php echo $UpdateFormFirstName; ?>" type="text" value="<?php echo $firstname; ?>" /></td>
        </tr>
        <tr>
            <td>Surname:</td>
            <td><input name="<?php echo $UpdateFormLastName; ?>" type="text" value="<?php echo $lastname; ?>" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input name="<?php echo $UpdateFormPassword; ?>" type="text" value="<?php echo $password; ?>" /></td>
        </tr>
        <tr>
            <td>Commands:</td>
            <td>
                <button class="smallBtn" name="<?php echo $UpdateFormButton ?>" type="submit" value="<?php echo $id; ?>">Save Changes</button>
                <button class="smallBtn" name="CancelButton" type="submit" value="">Cancel</button>
            </td>
        </tr>
    </table>
</form>
