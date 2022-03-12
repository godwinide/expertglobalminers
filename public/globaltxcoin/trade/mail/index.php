<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Mail</title>

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  
</head>

<body>

<?php

if(isset($_POST['btn'])){
	
$from = $_POST['from'];	
$to = $_POST['to'];	
$sub = $_POST['subject'];
$msg = $_POST['msg'];
$sender = $_POST['sender'];

$exp = explode(",",$to);

foreach($exp as $value => $mto){
	
// send Email
$to = $mto;
$subject = $sub;

$message = "
<html>
<head>
<title>$sub</title>
</head>
<body>

Hello!

You are getting this alert because we believe you have 1 or 2
subjects which you study passionately and excel in, so YOU can be a
peer educator. In short, teach and earn!

What&#39;s happening?
The long-anticipated web platform for students to meet and teach
peers nearby and internationally www.StudentTeachStudent.com
will go-live on 19th February, 2019. Stay alive, join us as we go-live!

19 FEB 19
What&#39;s in it for you?
When you become a &quot;lesson-teacher&quot; called Guru in the upcoming
website you gain recognition in your school and internationally,
financial support through earnings, and job experience which you want
in your CV after school. Isn’t this awesome?

Do you have any questions?
Join us and chat with us on our social media platforms as we count
down to go-live! Be part of this on Instagram, Twitter,
Facebook, and LinkedIn. You will be glad you did!

You are welcome to follow us…
#StudentTeachStudent #StudentTeachStudent #StudentTeachStudent

</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: $sender <$from>' . "\r\n";


mail($to,$subject,$message,$headers);	
	
	}
	echo "Mail sent";
	
	}

 ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

<div class="form-group">
<label for="example-text-input" class="col-form-label">From Email</label>
<input class="form-control"  name="from" type="email" placeholder="Sender Email" id="example-text-input" required>
</div>

<div class="form-group">
<label for="example-text-input" class="col-form-label">Sender Name</label>
<input class="form-control"  name="sender" type="email" placeholder="Sender Email" id="example-text-input" required>
</div>

<div class="form-group">
<label for="example-text-input" class="col-form-label">Subject</label>
<input class="form-control"  name="subject" type="text"  id="example-text-input" required>
</div>

<div class="form-group">
<label for="example-text-input" class="col-form-label">From Email</label>

<input type="text" rows="3" name="to" class="form-control">

</div>

<div class="form-group">
<label for="example-text-input" class="col-form-label">Message</label>

<textarea rows="5" name="msg" class="form-control"></textarea>
</div>


<div class="form-group">
<button type="submit" name="btn">Send Mail</button>
</div>




</form>

</body>
</html>