<?php
// LDAP server settings
$ldap_host = 'ldap://127.0.0.1';
$ldap_port = 389;
$ldap_base_dn = 'ou=users,dc=webAbderrahim,dc=cat';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldap_conn = ldap_connect($ldap_host, $ldap_port);

    if ($ldap_conn) {
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);



        $ldap_bind = @ldap_bind($ldap_conn, 'cn=' . $username . ',' . $ldap_base_dn, $password);

        if ($ldap_bind) {
            echo "<h1 style='color:green; text-align:center;'>Login successful! Welcome $username</h1>";
        } else {
            echo "<h1 style='color:red; text-align:center;'>Invalid username or password.</h1>";
        }
    } else {
        echo "Failed to connect to LDAP server.";
    }
    ldap_close($ldap_conn);
}
?>

<div style="margin: 50px auto; width: 300px; padding: 20px; border: 1px solid #ccc; font-family: sans-serif;">
    <h2>LDAP Login Test</h2>
    <form method="POST" action="">
      Username (cn): <input type="text" name="username" placeholder="e.g. user1" required><br><br>
      Password: <input type="password" name="password" required><br><br>
      <input type="submit" value="Login">
    </form>
</div>
