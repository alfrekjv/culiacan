

<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Hi <?=$toUser->getFullName();?>,</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<p>A new user has signed up, their info is below:</p>
            <p>Name: <?=$toUser->getFullName();?></p>
            <p>Email: <?=$toUser->getEmail();?></p>
            <p>Username: <?=$toUser->getUsername();?></p>
            
            <p>Profile URL: <?=$accountLink;?></p>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			Many thanks,<br>
			The Talentize Team
		</td>
	</tr>
</table>
