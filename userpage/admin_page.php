<?php
session_start();
require '../init/config.php';
require "../init/header.php";
include '../init/sidebar.php';
?>

<div id="maincontent" class="admin_page_main">

  <table id='admin_user_list'>
  <tr>
  <th>
    id
  </th>
  <th>
    användarnamn
  </th>
  <th>
    email
  </th>
  <th>
    post permission
  </th>
  <th>
    admin
  </th>
  </tr>

<?php
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) >= 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $email = $row['email'];
    $post_permission = $row['post_permission'];
    $admin = $row['admin'];

    echo "
    <tr>
    <td class='center'>
      $user_id
    </td>
    <td>
      <a class='links' href='../userpage/user.php?username=$username'>$username</a>
    </td>
    <td>
      $email
    </td>
    <td class='center'>
      $post_permission
    </td>
    <td class='center'>
    "
    ?>
    <form method="post" action="edit_user.php?mod=<?php echo $username; ?>">
      <input type="submit" value="<?php echo $admin; ?>" name="user"><br>
    </form>
    <?php
    echo " </td> <td> ";
    ?>
      <form method="post" action="edit_user.php?delete=<?php echo $username; ?>">
        <input class="last_col" type="submit" value="ta bort användare" name="user"><br>
      </form>
    <?php
    echo "
    </td>
    </tr>";
  }
}
mysqli_close($conn);
?>
</table>
</div>
