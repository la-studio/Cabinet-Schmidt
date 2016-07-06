<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Mail envoyé depuis le formulaire de contact du Cabinet Schmidt </title> 
		<style type="text/css">
		  table{
		    width:100%;
		  }
		</style>
	</head>

	<body>
		<p>Cliquez ici pour réinitialiser votre mot de passe : <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a><p>
		<br>
		<p>Ce lien de réinitialisation permet de modifier le mot de passe pour accéder au panneau d'administration du <a href="https://cabinet-schmidt.com">Cabinet Schmidt</a><p>
	</body>
</html>