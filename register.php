<?php
require_once("initialize.php");
// require_SSL();

//when form is submitted
if(is_post_request()&&isset($_POST['create'])) {
  $subject = [];
  $admin['first_name'] = $_POST['first_name'] ?? '';
  $admin['last_name'] = $_POST['last_name'] ?? '';
  $admin['email'] = $_POST['email'] ?? '';
  $admin['phone_number'] = $_POST['phone_number'] ?? '';
  $admin['country'] = $_POST['country'] ?? '';
  $admin['password'] = $_POST['password'] ?? '';
  $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

  $result = insert_admin($admin);
  if($result === true) {
    $new_id = mysqli_insert_id($db); //insert id to database
    $_SESSION['message'] = 'Account created.';
    $_SESSION['admin_id']=$new_id; //login new account
    $_SESSION['email'] = $admin['email']; //set session email
    // redirect_to($_SESSION['callback_url']); //return to previous page
    if(isset($_SESSION['callback_url'])){
        $callback_url = $_SESSION['callback_url'];
        header("Location: http://". $_SERVER['SERVER_NAME'] . ":8080". $callback_url);
    }
  } else {
    $errors = $result; //error message
  }

} else {
  // display the blank form
  $admin = [];
  $admin["first_name"] = '';
  $admin["last_name"] = '';
  $admin["email"] = '';
  $admin["phone_number"] = '';
  $admin["country"] = '';
  $admin['password'] = '';
  $admin['confirm_password'] = '';
}

?>

<?php $page_title = 'Register'; ?>
<?php include('header.php'); ?>

<div class="register">

    <h1>Create Account</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('register.php'); ?>" method="post">
     
  
      <div class="create">  First name<br />
      <input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>" />
    </div>      

      <div class="create">
        Last name<br />
        <input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>" />
      </div>

      <div class="create">
        Email<br />
        <input type="text" name="email" value="<?php echo h($admin['email']); ?>" /><br />
      </div>

      <div class="create">
      Avatar<br />
      <ul>
      <li><input type="radio" id="avatar1" name="avatar">
        <label for="avatar1"><img src="images/avatar1.jpg" style="width:200px"/></label>
      </li>
      
      <li>
       <input type="radio" id="avatar2" name="avatar" >
      <label for="avatar2"><img src="images/avatar2.jpg" style="width:200px"/></label>
     </li>

     <li>
      <input type="radio" id="avatar3" name="avatar" >
      <label for="avatar3"><img src="images/avatar3.jpg" style="width:200px"/></label>   
    </li>
      </div>

      <div class="create">
      Phone Number<br />
      <input type="text" name="phone_number" value="<?php echo h($admin['phone_number']); ?>" /><br />
    </div>
    
    <div class="create">
        Country<br />
        <input type="text" name="country" value="<?php echo h($admin['country']); ?>" /><br />
    </div>

       <div class="create">  
        Password<br />
        <input type="password" name="password" value="" />
      </div>

       <div class="create">
        Confirm Password<br />
        <input type="password" name="confirm_password" value="" />
      </div>
      
      <br />

      <input type="submit" name="create" value="Create Account" />
  
    <br />

      Already a member? <button type="button"><a class="back-link" href="<?php echo url_for('login.php'); ?>">Login here</a></button>  

    </form>

</div>

<?php include('footer.php'); ?>
