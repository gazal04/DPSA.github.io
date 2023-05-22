<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<?php include 'header.php' ?>



<body>

  <div >
      <div class="form">      
        <form  action="" id="login-form">
      
          <input type="email"  name="email" required placeholder="Email">  
        
          <input type="password"  name="password" required placeholder="Password">

          <button type="submit" >Sign In</button>
            <p class="message">Welcome To Login Portal <a href="#">NIT SILCHAR</a>
      
       </form>
     </div>

  </div>


<!-- <div class="login-page">
  <div class="form">
    <form class="login-form"  action="" id="login-form">
      <input type="email" class="form-control" name="email" required placeholder="Email">
       
      <input type="password" placeholder="password" />
       <button type="submit" class="btn btn-primary btn-block">Sign In</button>
 
    </form>
  </div>
</div> -->

<!-- /.login-box -->
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          end_load();
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
