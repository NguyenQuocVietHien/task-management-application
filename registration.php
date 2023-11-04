<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>User Registration | Task Management Application</title>
    
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- Add your CSS and JavaScript links here if needed -->
</head>
<?php 
include('db_connect.php');
session_start();
// Check if 'id' is set in the GET parameters
if(isset($_GET['id'])){
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']); // 'i' suggests that id is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        foreach($user as $k => $v){
            $meta[$k] = $v;
        }
    } else {
        // Handle the case when no data is returned
        echo "No user found with that ID.";
        // Redirect or handle the logic here if user not found
    }
}
?>
<?php include 'header.php' ?>
<body class="hold-transition login-page bg-black">
<div class="card">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body registration-card">
                <form action="" id="manage_user">
                    <!-- Input field for storing the user ID -->
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <!-- First Name Input -->
                            <div class="form-group">
                                <label for="firstname" class="control-label">First Name</label>
                                <input type="text" name="firstname" class="form-control" required value="<?php echo isset($firstname) ? $firstname : ''; ?>">
                            </div>
                            <!-- Last Name Input -->
                            <div class="form-group">
                                <label for="lastname" class="control-label">Last Name</label>
                                <input type="text" name "lastname" class="form-control" required value="<?php echo isset($lastname) ? $lastname : ''; ?>">
                            </div>
                            <!-- Avatar Input -->
                            <div class="form-group">
							<label for="" class="control-label">Avatar</label>
							    <div class="custom-file">
		                            <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
		                            <label class="custom-file-label" for="customFile">Choose file</label>
		                        </div>
						    </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Email Input -->
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" required value="<?php echo isset($email) ? $email : ''; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                </div>
                                <small class="text-danger" id="email-error"></small>
                            </div>
                            <!-- Password Input -->
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                </div>
                                <small class="text-danger" id="password-error"></small>
                            </div>
                            <!-- Confirm Password Input -->
                            <div class="form-group">
                                <label for="cpass" class="control-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="cpass" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                </div>
                                <small class="text-danger" id="cpass-error"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    img#cimg {
        height: 15vh;
        width: 15vh;
        object-fit: cover;
        border-radius: 100% 100%;
    }

    /* CSS to change label text color to black */
    label.control-label {
        color: black;
    }
</style>
<script>
    // Check if password and confirm password match
    $('[name="password"],[name="cpass"]').keyup(function(){
        var pass = $('[name="password"]').val();
        var cpass = $('[name="cpass"]').val();
        if(cpass == '' || pass == ''){
            $('#pass_match').attr('data-status','');
        } else {
            if(cpass == pass){
                $('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>');
            } else {
                $('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>');
            }
        }
    })
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Submit the user management form using AJAX
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=update_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					// Display a success message and reload the page
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})
</script>
</body>
</html>
