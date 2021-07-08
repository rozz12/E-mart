
function pwdcheck(){
			var userpwd = document.getElementById('password').value;
			var confirm_pwd = document.getElementById('confupwd').value;

			if (confirm_pwd === userpwd) {
				document.getElementById('pmatch').style.visibility = 'visible';
				document.getElementById('pmatch').style.color = 'green';
				document.getElementById('pmatch').innerHTML = 'Password Match';
			}
			else{
				document.getElementById('pmatch').style.visibility = 'visible';
				document.getElementById('pmatch').style.color = 'red';
				document.getElementById('pmatch').innerHTML = 'Password Mismatch';
			}
		}
