<?php
	session_start();
	require_once('new-connection.php');

	if (isset($_POST['action']))
	{
		if($_POST['action'] == 'register')
		{
			registerUser($_POST);
		}
		elseif($_POST['action'] == 'login')
		{
			loginUser($_POST);
		}
		elseif($_POST['action'] == 'post_message')
		{
			postMessage($_POST);
		}
		elseif($_POST['action'] == 'post_comment')
		{
			postComment($_POST);
		}
	}
	else
	{
		session_destroy();
		header('Location: index.php');
		exit;
	}

	function registerUser($post)
	{
		// Do form validation and report any errors
		$_SESSION['errors'] = array();

		if (empty($post['first_name']))
		{
			$_SESSION['errors'][] = "First name cannot be blank.";
		}
		if (empty($post['last_name']))
		{
			$_SESSION['errors'][] = "Last name cannot be blank.";
		}
		if (empty($post['email'])){
			$_SESSION['errors'][] = "Email address cannot be blank.";
		}
		elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['errors'][] = "Email address is invalid!";
		}
		if (empty($post['password']))
		{
			$_SESSION['errors'][] = "Password cannot be blank.";
		}
		elseif ($post['password'] != $post['confirm_password'])
		{
			$_SESSION['errors'][] = "Password and Confirm password do not match.";
		}

		if (empty($_SESSION['errors']))
		{
			// Validation passed so now we try to register the user
			// First see if the user is already registered
			if (isRegistered($post['email']))
			{
				$_SESSION['errors'][] = "A user with the email address " . $post['email'] . " is already registered";
			}
			else
			{
				// User's email is not in the database so let's add all the user data
				$esc_first_name = escape_this_string($post['first_name']);
				$esc_last_name = escape_this_string($post['last_name']);
				$esc_email = escape_this_string($post['email']);
				$esc_password = escape_this_string($post['password']);
				$esc_created_at = escape_this_string(NOW());
				$esc_updated_at = escape_this_string(NOW());

				$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) 
									VALUES('{$esc_first_name}', '{$esc_last_name}', '{$esc_email}',
													'{$esc_last_password}', $esc_created_at,$esc_updated_at)";
													
				$user_id = run_mysql_query($query);													
				if($user_id)
				{
					$user = array(
						'user_id' => $user_id,
						'first_name' => $post['first_name'],
						'last_name' => $post['last_name'],
						'email' => $post['email'],
						'is_logged_in' => true
					);

					$_SESSION['user'] = $user;
					header('Location: wallpage.php');
					exit;
				}
				else
				{
					$_SESSION['errors'] = "There was a problem with registering this user in the database.";
				}
			}
		}

		header('Location: index.php');
		exit;
	}

	function loginUser($post)
	{
		$_SESSION['errors'] = array();

		if (empty($post['email']))
		{
			$_SESSION['errors'][] = "You must provide an email address.";
		}
		elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['errors'][] = "The email address provided is not valid.";
		}
		if (empty($post['password']))
		{
			$_SESSION['errors'][] = "You must provide a password.";
		}

		if (empty($_SESSION['errors']))
		{
			// Log the user in
			$query = "SELECT id as user_id, first_name, last_name FROM users WHERE email = '{$post['email']}' AND password = '{$post['password']}'";
			$user = fetch_record($query);

			if (!$user)
			{
				$_SESSION['errors'][] = "Could not login the specified user. Invalid email or password.";
			}
			else
			{
				$user['is_logged_in'] = true;
				$_SESSION['user'] = $user;
				header('Location: wallpage.php');
				exit;
			}
		}

		header('Location: index.php');
		exit;
	}

	function isRegistered($email)
	{
		$query = "SELECT * FROM users WHERE email = '{$email}'";
		return fetch_record($query);
	}

	function postMessage($post)
	{
		$_SESSION['errors'] = array();

		if (empty($post['message']))
		{
			$_SESSION['errors'][] = "You must enter a message.";
		}
		else
		{
			$esc_message = escape_this_string($post['message']);
			$esc_user_id = escape_this_string($_SESSION['user']['user_id']);
			$query = "INSERT INTO messages (message, user_id, created_at, updated_at)
								VALUES ('{$esc_message}', {$esc_user_id}, NOW(), NOW())";
								echo $query;
								die();
			if(!run_mysql_query($query))
			{
				$_SESSION['errors'][] = "Could not insert message into database. Please check connection and try again.";
			}
			else
			{
				$_SESSION['messages'][] = "Successfully added new message.";
			}
		}

		header('Location: wallpage.php');
		exit;
	}

	function postComment($post)
	{
		$_SESSION['errors'] = array();

		if (empty($post['comment']))
		{
			$_SESSION['errors'][] = "You must enter a comment.";
		}
		else
		{
			$esc_comment = escape_this_string($post['comment']);
			$esc_message_id = escape_this_string($post['message_id']);
			$esc_user_id = escape_this_string($_SESSION['user']['user_id']);

			$query = "INSERT INTO comments (comment, user_id, message_id, created_at, updated_at)
								VALUES ('{$esc_comment}', {$esc_user_id}, {$esc_message_id}, NOW(), NOW())";
			if(!run_mysql_query($query))
			{
				$_SESSION['errors'][] = "Could not insert comment into database. Please check connection and try again.";
			}
			else
			{
				$_SESSION['messages'][] = "Successfully added new comment.";
			}
		}

		header('Location: wallpage.php');
		exit;
	}
?>