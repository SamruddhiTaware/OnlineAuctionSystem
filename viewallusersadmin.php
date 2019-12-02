<?php
?>

<php
    if(isUserLoggedIn()) {
<ul>
    <li><a href='myaccount.php'>Account Home</a></li>
</ul>


<?php require_once("config.php");

$allUsers = fetchAllUsers();
?>

<!-- Table goes in the document BODY -->
<table border="1px">
    <thead style="border-width: thick">
        <!-- display user details header  -->
        <th>UserID</th>
        <th>UserName</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>
        <th>MemberSince</th>
        <th>Active</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?php

        foreach($allUsers as $displayRecords) { ?>
            <tr>
                <td><?php print $displayRecords['UserID']; ?></td>
                <td><?php print $displayRecords['UserName']; ?></td>
                <td><?php print $displayRecords['FirstName']; ?></td>
                <td><?php print $displayRecords['LastName']; ?></td>
                <td><?php print $displayRecords['Email']; ?></td>
                <td><?php print $displayRecords['MemberSince']; ?></td>
                <td><?php print $displayRecords['Active']; ?></td>
                <td><a href="deleteuseradmin.php?UserID=<?php print $displayRecords['UserID']; ?>"> Delete </a>

                </td>


            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
