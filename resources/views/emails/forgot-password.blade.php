<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<table>
		<tr>
			<td>Verify Your Email Address</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Please click on below link to get reset password link...</td>
		</tr>
		<tr>
			<td><a href="{{ url('/admin/reset-password/'.$mailData['token']) }}">Reset Password Link</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Thanks & Regards,</td>
		</tr>
		<tr>
			<td>E-commerce Website</td>
		</tr>
	</table>
</body>
</html>