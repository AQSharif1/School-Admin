<?php
function getButton() {
    if (isset($_SESSION['first_name'])) {
        $label = 'Log Off ' . $_SESSION['first_name'];
        $action = 'logoff.php';
    } else {
        $label = 'Log On';
        $action = 'loginAction.php';
    }

    echo '<form action="'.$action.'" method="post">
          <input class="login-button"  type="submit" value="' . $label . '"/>
      </form>';
}

?>
