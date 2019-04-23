$sql = "SELECT * FROM io_employees ORDER BY userid DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {

// if Update display the data in a form
     if($row['userid'] == $_GET['usertoupdate']) {
     ?>
     <form action="admin.php" method="POST">
     <tr>
        <td><?=$row['userid']?><input type="hidden" name="userid"
value="<?=$row['userid']?>"></td>
        <td><input type="text" name="user" value="<?=$row['user']?>"></td>
        <td class="text-center">
          <select name="io">
            <option value="0" <?if($row['io'] == '0') { echo 'selected'; }?>>Out</option>
            <option value="1" <? if($row['io'] == '1') { echo 'selected';}?>>In</option>
          </select>
        </td>
        <td>
          <input type="text" name="message" value="<?=$row['message']?>">
        </td>
        <td class="text-center">
          <input type="submit" class="btn btn-outline-info btn-sm" name="action" value="Update">
      </form>
        <a class="btn btn-outline-secondary btn-sm" href="admin.php" role="button">Cancel</a></td>
        <td class="text-center">
          <a href="admin.php?action=delete&userid=<?=$row["userid"]?>"><i class="fas fa-times" style="color:red;"></i>
        </td>
     </tr>
     <? } else { ?>
        <tr>
        <td><?=$row['userid']?></td>
        <td><?=$row['user']?></td>
        <td class="text-center"><?=$row['io']?></td>
        <td><?=$row['message']?></td>
        <td class="text-center"><a
href="admin.php?usertoupdate=<?=$row["userid"]?>"><i class="fas fa-edit"
style="color:green;"></i></td>
        <td class="text-center"><a
href="admin.php?action=delete&userid=<?=$row["userid"]?>"><i class="fas
fa-times" style="color:red;"></i> </td>
     </tr>

     <?
     }
     }
