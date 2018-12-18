<?php
session_start();
if ($_SESSION['loggedin'] !== TRUE) {
  header('Location: ../landingpage/login.php');
}
if ($_SESSION['admin'] !== 1) {
  header('Location: ../home/index.php');
}
require '../init/config.php';
require "../init/header.php";
include '../init/sidebar.php';
?>

<div id="maincontent" class="admin_page_main">
<div id="admin_users">

  <table class='admin_list'>
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
  ?>
</table>
</div>

<div id="admin_reports">

</div>
<div id="admin_categories">
  <table class='admin_list'>
  <tr>
  <th>
    id
  </th>
  <th>
    kategori
  </th>
  </tr>
  <?php
    $sql3 = "SELECT * FROM categories";
    $result3 = mysqli_query($conn, $sql3);
    if(mysqli_num_rows($result3) > 0) {
      while ($rows = mysqli_fetch_assoc($result3)) {
        $cat_id = $rows['cat_id'];
        $category = $rows['category'];
        echo "<tr>
        <td>
        $cat_id
        </td>
        <td>
        $category
        </td>
        <td>
        <form method='post' action='../posts/edit_categories.php?delete=$category'>
          <input class='delete_cat' type='submit' name='remove_cat' value='ta bort kategori' />
        </form>
        </td>
        </tr>";
      }
      echo "</table>";
    }
    echo "<form id='new_cat' method='post' action='../posts/edit_categories.php?add=category'>
      <input type='text' id='new_cat_text' name='new_cat' placeholder='ny kategori...'/>
      <input type='submit' id='new_cat_submit' class='add_cat' name='add_cat' value='lägg till kategori' />
    </form>";
   ?>
</div>

</div>
