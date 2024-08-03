<?php
session_start();

if ($_SESSION["logged_in"] !== true) {
    header("Location:/login/index.php"); // Redirect to login page
}


if ($_GET["user"] === null) {
    die("User not specified.");
} else {
    // check if user exists in the database
    $conn = new mysqli("localhost", "root", "", "eclipse");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

$sql = "SELECT username FROM users WHERE id = '".$_GET['user']."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$currentUser = $row['username'];

    $sql = "SELECT * FROM users WHERE id = '" . $_GET["user"] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows === 0) {
        die("User not found.");
    } else {
        // check if user is current user
        if ($_GET["user"] === $_SESSION["id"]) {
            die("Cannot message your own profile.");
        }

        $thisUser = $result->fetch_assoc();
        if ($thisUser['verified'] === "0") {
            $_SESSION['email'] = $thisUser['email']; // Store email in session variable for use in verification page
            header("Location: /signup/confirmEmail.php"); // Redirect to verify page
            }
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="icon" type="image/png" href="/appicons/eclipseicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="eclipse is a secure & private messaging platform for all. it connects all your friends, family, clubs — everyone’s here." />
        <meta name="keywords" content="eclipse, messaging, chat, group, friends, family, clubs" />
        <meta name="author" content="eclipse team" />
        <meta name="image" content="/appicons/eclipseicon.png" />        
        <title>@<?php echo $currentUser; ?> - Eclipse</title>
    </head>
    <body>
    <div class="app-container">
            <div class="sidebar">
            <div class="join-vert">
                    <div class="join-auto-horizontal">
                    <button class="btn btn-primary w-fill active" onclick="window.location.assign('/app')"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.47 1.84099C10.6106 1.70054 10.8013 1.62165 11 1.62165C11.1988 1.62165 11.3894 1.70054 11.53 1.84099L20.22 10.531C20.2892 10.6026 20.372 10.6597 20.4635 10.699C20.5551 10.7382 20.6535 10.7589 20.7531 10.7597C20.8526 10.7605 20.9514 10.7415 21.0435 10.7037C21.1357 10.666 21.2194 10.6102 21.2898 10.5398C21.3602 10.4693 21.4158 10.3856 21.4535 10.2934C21.4912 10.2012 21.5101 10.1024 21.5092 10.0028C21.5083 9.90325 21.4875 9.80484 21.4482 9.71336C21.4088 9.62187 21.3517 9.53914 21.28 9.46999L12.591 0.779991C12.3821 0.571056 12.134 0.40532 11.861 0.292245C11.5881 0.179171 11.2955 0.120972 11 0.120972C10.7045 0.120972 10.4119 0.179171 10.139 0.292245C9.86598 0.40532 9.61794 0.571056 9.409 0.779991L0.719004 9.46999C0.647405 9.53921 0.590308 9.622 0.551045 9.71352C0.511782 9.80504 0.491139 9.90346 0.490321 10.003C0.489503 10.1026 0.508526 10.2014 0.54628 10.2935C0.584034 10.3857 0.639763 10.4694 0.710215 10.5398C0.780668 10.6102 0.864433 10.6658 0.956622 10.7035C1.04881 10.7412 1.14758 10.7601 1.24716 10.7592C1.34675 10.7583 1.44515 10.7375 1.53664 10.6982C1.62812 10.6588 1.71085 10.6017 1.78 10.53L10.47 1.84099Z" fill="white"/>
<path d="M11 3.43201L19.159 11.591C19.189 11.621 19.219 11.649 19.25 11.677V17.875C19.25 18.91 18.41 19.75 17.375 19.75H14C13.8011 19.75 13.6103 19.671 13.4697 19.5303C13.329 19.3897 13.25 19.1989 13.25 19V14.5C13.25 14.3011 13.171 14.1103 13.0303 13.9697C12.8897 13.829 12.6989 13.75 12.5 13.75H9.5C9.30109 13.75 9.11032 13.829 8.96967 13.9697C8.82902 14.1103 8.75 14.3011 8.75 14.5V19C8.75 19.1989 8.67098 19.3897 8.53033 19.5303C8.38968 19.671 8.19891 19.75 8 19.75H4.625C4.12772 19.75 3.65081 19.5525 3.29917 19.2008C2.94754 18.8492 2.75 18.3723 2.75 17.875V11.677C2.78111 11.6492 2.81146 11.6205 2.841 11.591L11 3.43201Z" fill="white"/>
</svg></button>

<button class="btn btn-primary w-fill" onclick="window.location.assign('/search.php')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M18.9998 19L13.8028 13.803M13.8028 13.803C15.2094 12.3965 15.9996 10.4887 15.9996 8.49955C15.9996 6.51035 15.2094 4.60262 13.8028 3.19605C12.3962 1.78947 10.4885 0.999268 8.49931 0.999268C6.51011 0.999268 4.60238 1.78947 3.19581 3.19605C1.78923 4.60262 0.999023 6.51035 0.999023 8.49955C0.999023 10.4887 1.78923 12.3965 3.19581 13.803C4.60238 15.2096 6.51011 15.9998 8.49931 15.9998C10.4885 15.9998 12.3962 15.2096 13.8028 13.803Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></button>
                        <button class="btn btn-primary w-fill" onclick="askToAddFriend()"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M3.5 4.125C3.5 3.03098 3.9346 1.98177 4.70818 1.20818C5.48177 0.434597 6.53098 0 7.625 0C8.71902 0 9.76823 0.434597 10.5418 1.20818C11.3154 1.98177 11.75 3.03098 11.75 4.125C11.75 5.21902 11.3154 6.26823 10.5418 7.04182C9.76823 7.8154 8.71902 8.25 7.625 8.25C6.53098 8.25 5.48177 7.8154 4.70818 7.04182C3.9346 6.26823 3.5 5.21902 3.5 4.125ZM0.5 16.875C0.5 14.9853 1.25067 13.1731 2.58686 11.8369C3.92306 10.5007 5.73533 9.75 7.625 9.75C9.51467 9.75 11.3269 10.5007 12.6631 11.8369C13.9993 13.1731 14.75 14.9853 14.75 16.875V16.878L14.749 16.997C14.7469 17.1242 14.7124 17.2487 14.6489 17.3589C14.5854 17.4691 14.495 17.5614 14.386 17.627C12.3452 18.856 10.0073 19.5036 7.625 19.5C5.153 19.5 2.839 18.816 0.865 17.627C0.755851 17.5615 0.665167 17.4693 0.601487 17.3591C0.537806 17.2489 0.503225 17.1243 0.501 16.997L0.5 16.875ZM17 5.25C17 5.05109 16.921 4.86032 16.7803 4.71967C16.6397 4.57902 16.4489 4.5 16.25 4.5C16.0511 4.5 15.8603 4.57902 15.7197 4.71967C15.579 4.86032 15.5 5.05109 15.5 5.25V7.5H13.25C13.0511 7.5 12.8603 7.57902 12.7197 7.71967C12.579 7.86032 12.5 8.05109 12.5 8.25C12.5 8.44891 12.579 8.63968 12.7197 8.78033C12.8603 8.92098 13.0511 9 13.25 9H15.5V11.25C15.5 11.4489 15.579 11.6397 15.7197 11.7803C15.8603 11.921 16.0511 12 16.25 12C16.4489 12 16.6397 11.921 16.7803 11.7803C16.921 11.6397 17 11.4489 17 11.25V9H19.25C19.4489 9 19.6397 8.92098 19.7803 8.78033C19.921 8.63968 20 8.44891 20 8.25C20 8.05109 19.921 7.86032 19.7803 7.71967C19.6397 7.57902 19.4489 7.5 19.25 7.5H17V5.25Z" fill="white"/>
                        </svg></button>
<button class="btn btn-primary w-fill" onclick="window.location.assign('/friend_requests.php')"><svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M4.478 3.559C4.57233 3.25232 4.76251 2.98398 5.02062 2.79337C5.27872 2.60276 5.59114 2.49994 5.912 2.5H8C8.19891 2.5 8.38968 2.42098 8.53033 2.28033C8.67098 2.13968 8.75 1.94891 8.75 1.75C8.75 1.55109 8.67098 1.36032 8.53033 1.21967C8.38968 1.07902 8.19891 1 8 1H5.912C5.27029 0.999875 4.64544 1.20552 4.12924 1.58674C3.61303 1.96795 3.23266 2.50465 3.044 3.118L0.633 10.956C0.544964 11.2417 0.500135 11.539 0.5 11.838V16C0.5 16.7956 0.816071 17.5587 1.37868 18.1213C1.94129 18.6839 2.70435 19 3.5 19H18.5C19.2956 19 20.0587 18.6839 20.6213 18.1213C21.1839 17.5587 21.5 16.7956 21.5 16V11.838C21.5 11.539 21.455 11.242 21.367 10.956L18.955 3.118C18.7664 2.50481 18.3862 1.96823 17.8702 1.58703C17.3542 1.20583 16.7295 1.00009 16.088 1H14C13.8011 1 13.6103 1.07902 13.4697 1.21967C13.329 1.36032 13.25 1.55109 13.25 1.75C13.25 1.94891 13.329 2.13968 13.4697 2.28033C13.6103 2.42098 13.8011 2.5 14 2.5H16.088C16.4089 2.49994 16.7213 2.60276 16.9794 2.79337C17.2375 2.98398 17.4277 3.25232 17.522 3.559L19.735 10.75H16.89C16.3328 10.7498 15.7865 10.9049 15.3125 11.1977C14.8384 11.4906 14.4553 11.9096 14.206 12.408L13.95 12.921C13.8254 13.1702 13.6338 13.3797 13.3968 13.5261C13.1597 13.6726 12.8866 13.7501 12.608 13.75H9.39C9.11129 13.75 8.83808 13.6723 8.60104 13.5257C8.364 13.3791 8.17249 13.1694 8.048 12.92L7.792 12.408C7.54274 11.9096 7.1596 11.4906 6.68554 11.1977C6.21148 10.9049 5.66522 10.7498 5.108 10.75H2.265L4.478 3.559Z" fill="white"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M11 0.25C11.1989 0.25 11.3897 0.329018 11.5303 0.46967C11.671 0.610322 11.75 0.801088 11.75 1V7.44L13.47 5.72C13.5387 5.64631 13.6215 5.58721 13.7135 5.54622C13.8055 5.50523 13.9048 5.48319 14.0055 5.48141C14.1062 5.47963 14.2062 5.49816 14.2996 5.53588C14.393 5.5736 14.4778 5.62974 14.549 5.70096C14.6203 5.77218 14.6764 5.85701 14.7141 5.9504C14.7518 6.04379 14.7704 6.14382 14.7686 6.24452C14.7668 6.34522 14.7448 6.44454 14.7038 6.53654C14.6628 6.62854 14.6037 6.71134 14.53 6.78L11.53 9.78C11.3894 9.92045 11.1988 9.99934 11 9.99934C10.8012 9.99934 10.6106 9.92045 10.47 9.78L7.47 6.78C7.33752 6.63782 7.2654 6.44978 7.26882 6.25548C7.27225 6.06118 7.35097 5.87579 7.48838 5.73838C7.62579 5.60097 7.81118 5.52225 8.00548 5.51883C8.19978 5.5154 8.38782 5.58752 8.53 5.72L10.25 7.44V1C10.25 0.801088 10.329 0.610322 10.4697 0.46967C10.6103 0.329018 10.8011 0.25 11 0.25Z" fill="white"/>
</svg></button>
            
</div>
                    <ul>
            <h3>Your Friends</h3>
                        <?php 

                        // connect to Eclipse database
                        $conn = new mysqli("localhost", "root", "", "eclipse");
                        if ($conn->connect_error) {
                            die("Connection failed: ". $conn->connect_error);
                        }

                        // get all friends from database
                        $sql = "SELECT * FROM users WHERE id = '". $_SESSION['id']. "'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        // display all friends
                        $friends = json_decode($row["friends"]);
                        foreach ($friends as $friend) {
                            $sql = "SELECT * FROM users WHERE id = '$friend'";
                            $friendResult = $conn->query($sql);
                            $friendRow = $friendResult->fetch_assoc();
                            if ($friendRow['username'] == $_SESSION["username"]) {
                                continue;
                            }
                            if ($_GET["user"] == $friendRow["id"]) {
                                $liArray = [
                                    '<li name="'.$friendRow["username"].'" onclick="window.location.assign(`/messages.php?user=' .
                                    $friendRow["id"] .
                                    '`)" class="active">',
                                    '<div class="avatar">',
                                    '<img src="' .
                                    $friendRow["avatar"] .
                                    '" width="40" height="40" style="border-radius:50px;"/>',
                                    '<div class="status"><img src="/appicons/' .
                                    $friendRow["status"] .
                                    '.png" width="20" height="20"/>',
                                    "</div></div>",
                                    '<div class="info">',
                                    "<h3>" .
                                    $friendRow["username"] .
                                    "</h3>",
                                    "<p>" .
                                    $friendRow["custom_status"] .
                                    "</p>",
                                    "</div>",
                                    "</li>",
                                ]; 
                            } else {
                            $liArray = [
                                '<li name="'.$friendRow["username"].'" onclick="window.location.assign(`/messages.php?user=' .
                                $friendRow["id"] .
                                '`)">',
                                '<div class="avatar">',
                                '<img src="' .
                                $friendRow["avatar"] .
                                '" width="40" height="40" style="border-radius:50px;"/>',
                                '<div class="status"><img src="/appicons/' .
                                $friendRow["status"] .
                                '.png" width="20" height="20"/>',
                                "</div></div>",
                                '<div class="info">',
                                "<h3>" .
                                $friendRow["username"] .
                                "</h3>",
                                "<p>" .
                                $friendRow["custom_status"] .
                                "</p>",
                                "</div>",
                                "</li>",
                            ];
                        }
                            echo implode("", $liArray);
                        }
                        ?>
                    </ul>
                    
                       
                    <div class="join-auto-horizontal">
                    <div class="user-info">
<img src="<?php echo $_SESSION[
    "avatar"
]; ?>" width="40" style="border-radius: 100%" />
<div class="user-info-details">
    <h3 style="color: white;"><?php echo $_SESSION["username"]; ?></h3>
  <?php 

  // connect to database
  $conn = new mysqli("localhost", "root", "", "eclipse");

  // check connection
  if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
  }
  $sql = "SELECT * FROM users WHERE id = '". $_SESSION['id']. "'";
  $result = $conn->query($sql);
  $userData = $result->fetch_assoc();
  
  if ($userData["custom_status"]) {
        echo '<p id="customStatus" style="color:white;" class="custom-status" onclick="changeCustomStatus()">'.$userData["custom_status"].'</p>';
    } else {
        echo '<p id="customStatus" style="color:white;" onclick="changeCustomStatus()">No custom status set.</p>';

    } 
    ?>
    <p id="status" style="color:white; display:flex;flex-direction:row;gap:5px; align-items:center;" onclick="changeStatus()"><img src="/appicons/<?php echo $userData['status'] ?>.png" width="15" height="15"> <?php
    $statuses = array("online" => "Online", "away" => "Away", "dnd" => "Do Not Disturb", "offline" => "Offline");
    echo $statuses[$userData["status"]];
    ?></p>
</div>
<div class="button-group">
<div class="text-btn" onclick="window.location.assign('/settings')"onclick="window.location.assign('/settings')">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.0779 2.25C10.1609 2.25 9.37893 2.913 9.22793 3.817L9.04993 4.889C9.02993 5.009 8.93494 5.149 8.75293 5.237C8.41028 5.40171 8.08067 5.59226 7.76693 5.807C7.60093 5.922 7.43293 5.933 7.31693 5.89L6.29993 5.508C5.88418 5.35224 5.42663 5.34906 5.00875 5.49904C4.59087 5.64901 4.23976 5.94241 4.01793 6.327L3.09593 7.924C2.87402 8.30836 2.79565 8.75897 2.87475 9.19569C2.95385 9.6324 3.18531 10.0269 3.52793 10.309L4.36793 11.001C4.46293 11.079 4.53793 11.23 4.52193 11.431C4.49344 11.8101 4.49344 12.1909 4.52193 12.57C4.53693 12.77 4.46293 12.922 4.36893 13L3.52793 13.692C3.18531 13.9741 2.95385 14.3686 2.87475 14.8053C2.79565 15.242 2.87402 15.6926 3.09593 16.077L4.01793 17.674C4.23992 18.0584 4.59109 18.3516 5.00896 18.5014C5.42683 18.6512 5.88429 18.6478 6.29993 18.492L7.31893 18.11C7.43393 18.067 7.60193 18.079 7.76893 18.192C8.08093 18.406 8.40993 18.597 8.75393 18.762C8.93593 18.85 9.03093 18.99 9.05093 19.112L9.22893 20.183C9.37993 21.087 10.1619 21.75 11.0789 21.75H12.9229C13.8389 21.75 14.6219 21.087 14.7729 20.183L14.9509 19.111C14.9709 18.991 15.0649 18.851 15.2479 18.762C15.5919 18.597 15.9209 18.406 16.2329 18.192C16.3999 18.078 16.5679 18.067 16.6829 18.11L17.7029 18.492C18.1184 18.6472 18.5755 18.6501 18.993 18.5002C19.4104 18.3502 19.7612 18.0571 19.9829 17.673L20.9059 16.076C21.1278 15.6916 21.2062 15.241 21.1271 14.8043C21.048 14.3676 20.8166 13.9731 20.4739 13.691L19.6339 12.999C19.5389 12.921 19.4639 12.77 19.4799 12.569C19.5084 12.1899 19.5084 11.8091 19.4799 11.43C19.4639 11.23 19.5389 11.078 19.6329 11L20.4729 10.308C21.1809 9.726 21.3639 8.718 20.9059 7.923L19.9839 6.326C19.7619 5.94159 19.4108 5.6484 18.9929 5.49861C18.575 5.34883 18.1176 5.35215 17.7019 5.508L16.6819 5.89C16.5679 5.933 16.3999 5.921 16.2329 5.807C15.9195 5.5923 15.5902 5.40175 15.2479 5.237C15.0649 5.15 14.9709 5.01 14.9509 4.889L14.7719 3.817C14.699 3.37906 14.473 2.98122 14.1343 2.69427C13.7955 2.40732 13.3659 2.24989 12.9219 2.25H11.0789H11.0779ZM11.9999 15.75C12.9945 15.75 13.9483 15.3549 14.6516 14.6517C15.3548 13.9484 15.7499 12.9946 15.7499 12C15.7499 11.0054 15.3548 10.0516 14.6516 9.34835C13.9483 8.64509 12.9945 8.25 11.9999 8.25C11.0054 8.25 10.0515 8.64509 9.34828 9.34835C8.64502 10.0516 8.24993 11.0054 8.24993 12C8.24993 12.9946 8.64502 13.9484 9.34828 14.6517C10.0515 15.3549 11.0054 15.75 11.9999 15.75Z" fill="white"/>
</svg>
</div>
<div class="text-btn" onclick="window.location.assign('/logout')">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none">
<path d="M11.75 7V3.25C11.75 2.65326 11.5129 2.08097 11.091 1.65901C10.669 1.23705 10.0967 1 9.5 1H3.5C2.90326 1 2.33097 1.23705 1.90901 1.65901C1.48705 2.08097 1.25 2.65326 1.25 3.25V16.75C1.25 17.3467 1.48705 17.919 1.90901 18.341C2.33097 18.7629 2.90326 19 3.5 19H9.5C10.0967 19 10.669 18.7629 11.091 18.341C11.5129 17.919 11.75 17.3467 11.75 16.75V13M14.75 13L17.75 10M17.75 10L14.75 7M17.75 10H5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                    </div>
    </div>
                </div>
</div>
</div>
            <div class="messages">
            <div class="nav">
                <button class="btn text mobile-back" onclick="window.history.back()"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M7 13L1 7M1 7L7 1M1 7H13C14.5913 7 16.1174 7.63214 17.2426 8.75736C18.3679 9.88258 19 11.4087 19 13C19 14.5913 18.3679 16.1174 17.2426 17.2426C16.1174 18.3679 14.5913 19 13 19H10" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></button>
                <div class="user">
                    <?php

                    // connect to the database
                    $conn = mysqli_connect("localhost", "root", "", "eclipse");
                    if (!$conn) {
                        die("Connection failed: ". mysqli_connect_error());
                    }
                    // get user information from the database
                    $sql = "SELECT * FROM users WHERE id = '".$_GET["user"]."'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>
                <img src="<?php echo $row['avatar'] ?>" width="40" height="40" />
                <div class="info">
                    <h3><?php echo $row['username'];?></h3>
                    <p><?php if ($row['custom_status'] == null) { echo $row['status']; } else { echo $row['custom_status']; } ?></p>
                </div>
            </div>
            <div class="btn-group">
            <button class="btn btn-primary" onclick="window.open('/call.php?id=<?php echo $_SESSION['id'].'-'.$_GET['user']; ?>&video=false', '_blank')"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 3.5C0.5 2.70435 0.816071 1.94129 1.37868 1.37868C1.94129 0.816071 2.70435 0.5 3.5 0.5H4.872C5.732 0.5 6.482 1.086 6.691 1.92L7.796 6.343C7.88554 6.701 7.86746 7.07746 7.74401 7.42522C7.62055 7.77299 7.39723 8.07659 7.102 8.298L5.809 9.268C5.674 9.369 5.645 9.517 5.683 9.62C6.24738 11.1549 7.1386 12.5487 8.29495 13.7051C9.4513 14.8614 10.8451 15.7526 12.38 16.317C12.483 16.355 12.63 16.326 12.732 16.191L13.702 14.898C13.9234 14.6028 14.227 14.3794 14.5748 14.256C14.9225 14.1325 15.299 14.1145 15.657 14.204L20.08 15.309C20.914 15.518 21.5 16.268 21.5 17.129V18.5C21.5 19.2956 21.1839 20.0587 20.6213 20.6213C20.0587 21.1839 19.2956 21.5 18.5 21.5H16.25C7.552 21.5 0.5 14.448 0.5 5.75V3.5Z" fill="white"/>
</svg></button>
<button class="btn btn-primary" onclick="window.open('/call.php?id=<?php echo $_SESSION['id'].'-'.$_GET['user']; ?>&video=true', '_blank')"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 22 16" fill="white">
<path d="M14.75 6.5L19.47 1.78C19.5749 1.67524 19.7085 1.60392 19.8539 1.57503C19.9993 1.54615 20.15 1.561 20.2869 1.61771C20.4239 1.67442 20.541 1.77045 20.6234 1.89367C20.7058 2.01688 20.7499 2.16176 20.75 2.31V13.69C20.7499 13.8382 20.7058 13.9831 20.6234 14.1063C20.541 14.2295 20.4239 14.3256 20.2869 14.3823C20.15 14.439 19.9993 14.4538 19.8539 14.425C19.7085 14.3961 19.5749 14.3248 19.47 14.22L14.75 9.5M3.5 14.75H12.5C13.0967 14.75 13.669 14.5129 14.091 14.091C14.5129 13.669 14.75 13.0967 14.75 12.5V3.5C14.75 2.90326 14.5129 2.33097 14.091 1.90901C13.669 1.48705 13.0967 1.25 12.5 1.25H3.5C2.90326 1.25 2.33097 1.48705 1.90901 1.90901C1.48705 2.33097 1.25 2.90326 1.25 3.5V12.5C1.25 13.0967 1.48705 13.669 1.90901 14.091C2.33097 14.5129 2.90326 14.75 3.5 14.75Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></button>
<button class="btn btn-primary" onclick="openPopup('user')">
<svg xmlns="http://www.w3.org/2000/svg" width="4" height="16" viewBox="0 0 4 16" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 2C0.5 1.60218 0.658035 1.22064 0.93934 0.93934C1.22064 0.658035 1.60218 0.5 2 0.5C2.39782 0.5 2.77936 0.658035 3.06066 0.93934C3.34196 1.22064 3.5 1.60218 3.5 2C3.5 2.39782 3.34196 2.77936 3.06066 3.06066C2.77936 3.34196 2.39782 3.5 2 3.5C1.60218 3.5 1.22064 3.34196 0.93934 3.06066C0.658035 2.77936 0.5 2.39782 0.5 2ZM0.5 8C0.5 7.60218 0.658035 7.22064 0.93934 6.93934C1.22064 6.65804 1.60218 6.5 2 6.5C2.39782 6.5 2.77936 6.65804 3.06066 6.93934C3.34196 7.22064 3.5 7.60218 3.5 8C3.5 8.39782 3.34196 8.77936 3.06066 9.06066C2.77936 9.34196 2.39782 9.5 2 9.5C1.60218 9.5 1.22064 9.34196 0.93934 9.06066C0.658035 8.77936 0.5 8.39782 0.5 8ZM0.5 14C0.5 13.6022 0.658035 13.2206 0.93934 12.9393C1.22064 12.658 1.60218 12.5 2 12.5C2.39782 12.5 2.77936 12.658 3.06066 12.9393C3.34196 13.2206 3.5 13.6022 3.5 14C3.5 14.3978 3.34196 14.7794 3.06066 15.0607C2.77936 15.342 2.39782 15.5 2 15.5C1.60218 15.5 1.22064 15.342 0.93934 15.0607C0.658035 14.7794 0.5 14.3978 0.5 14Z" fill="white"/>
</svg>
                </button>
                </div>
         
                </div>
        <div class="chat">
        <?php

            // get all messages with the sender_id and receiver_id from the database
            $sender_id = $_SESSION["id"];
            $receiver_id = $_GET["user"];
            $sql =
                "SELECT * FROM messages WHERE sender = '" .
                $sender_id .
                "' AND recipient = '" .
                $receiver_id .
                "' OR sender = '" .
                $receiver_id .
                "' AND recipient = '" .
                $sender_id .
                "' ORDER BY timestamp ASC";
            $result = mysqli_query($conn, $sql);

            // check if there are any messages
            if (mysqli_num_rows($result) === 0) {
                // get users username
                $sql = "SELECT username FROM users WHERE id = '$receiver_id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $currentUser = $row['username'];
                echo "<p style=\"color:white;\">There aren't any messages. Try starting a conversation with " .$row['username']. "! If you <i>have</i> sent messages, there may be a problem with the database.</p>";
            } else {
                // for each message
                while ($row = mysqli_fetch_assoc($result)) {
                    $message = $row["content"];
                    $sender = $row["sender"];
                    $id = $row['id'];
                    $timestamp = $row["timestamp"];
                    $attachments = json_decode($row["attachments"]);
                    // turn unix timestamp to human-readable format
                    // turn timestamp into a integer
                    $timestamp = (int) $timestamp;
                    if ($timestamp > time() - 60) {    // if message is within the last minute
                        $timestamp = "just now";
                    } else {    // if message is more than a minute ago
                        if ($timestamp > time() - 3600) {    // if message is within the last hour
                            // calculate minutes since the message was sent
                            $minutes = floor((time() - $timestamp) / 60);
                            $timestamp = $minutes. "m ago";
                        } else {    // if message is more than an hour ago
                            if ($timestamp > time() - 86400) {    // if message is within the last day
                        // convert timestamp to HH:MM:SS format
                        $timestamp = date("H:i:s", $timestamp);
                            } else {    // if message is more than a day ago
                            
                        $timestamp = date("F j, Y, g:i a", $timestamp);    
                            }

                    }
                }


                    // remove any html tags, but check if the message has any image tag before replacing the tag
                    $message = strip_tags($message, array('<img>', '<a>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>', '<p>', '<ul>', '<ol>', '<li>', '<strong>', '<b>'));

                    // replace https links with a tags, but make sure the regex doesnt have any href class before the link
                    $message = preg_replace('/(https?:\/\/[^\s]+)/i', '<a href="$1">$1</a>', $message);
    

                    if ($sender !== $sender_id) {
                        echo "<div class='bubble-incoming' id='".$id."'>";
                        echo "<div class='message'><span onmouseover='this.innerText = \"".$message." (".$timestamp.")\"' onmouseout='this.innerText = \"".$message."\"'>$message</span></div>";
                        echo "</div>";

                        // check if attachments are countable
                        if ($attachments !== null) {
                            if (count($attachments) > 0) {
                                // for each attachment, display it as an image tag
                                foreach ($attachments as $attachment) {
                            echo "<div class='bubble-incoming'>";
                            echo "<img src='$attachment' class='attachment' alt='Attachment' />";
                            echo "</div>"; 
                                }
                        }
                    }
                    } else {
                        echo "<div class='bubble-outgoing' id='".$id."'>";
                        echo "<div class='message'><span onmouseover='this.innerText = \"".$message." (".$timestamp.")\"' onmouseout='this.innerText = \"".$message."\"'>$message</span></div>";
                        echo "</div>";

                        
                        // check if attachments are countable
                        if ($attachments !== null) {
                            if (count($attachments) > 0) {
                                foreach ($attachments as $attachment) {
                            echo "<div class='bubble-outgoing'>";
                            echo "<img class='attachment' src='$attachment' alt='Attachment'/>";
                            echo "</div>"; 
                                }
                        }
                    }
                }
                }
            }
        ?>
</div>
<p style="color: #fcfcfc; margin-left:30px;" class="typing-text"></p>

<p style="color: #fcfcfc; margin-left:30px; display:none;" class="attachment-text"><button class="send-btn" onclick="messageAttachments = []; this.parentElement.children[1].innerText = '';$(this).hide();">undo</button><span></span></p>
<div class="input">
        <input type="file" id="fileInput" accept="image/*, video/*" style="display:none;" multiple="multiple" />
        <button class="send-btn" onclick="document.getElementById('fileInput').click()"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
<path d="M9 1.5V16.5M16.5 9H1.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></button>
        <input type="text" placeholder="Message <?php echo $currentUser; ?>...">
        <span class="charAmount">200/400</span>
        <button class="send-btn" onclick="sendMessage()"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
<path d="M0.924373 0.253243C0.799132 0.216859 0.666379 0.215042 0.540189 0.247984C0.413999 0.280926 0.299074 0.3474 0.207598 0.440358C0.116122 0.533316 0.051503 0.649294 0.0205927 0.775997C-0.0103177 0.9027 -0.00636781 1.03541 0.0320234 1.16005L2.37565 8.77778H10.5822C10.7739 8.77778 10.9577 8.85393 11.0932 8.98947C11.2288 9.12501 11.3049 9.30884 11.3049 9.50053C11.3049 9.69221 11.2288 9.87605 11.0932 10.0116C10.9577 10.1471 10.7739 10.2233 10.5822 10.2233H2.37565L0.0320234 17.841C-0.00614097 17.9656 -0.00991716 18.0982 0.0210947 18.2247C0.0521065 18.3513 0.116753 18.4671 0.208192 18.5599C0.299632 18.6527 0.414464 18.7191 0.540536 18.752C0.666609 18.7849 0.799232 18.7831 0.924373 18.7469C7.29896 16.8931 13.3102 13.9645 18.6991 10.0874C18.7922 10.0205 18.8681 9.93233 18.9204 9.83029C18.9727 9.72824 19 9.61521 19 9.50053C19 9.38585 18.9727 9.27282 18.9204 9.17077C18.8681 9.06872 18.7922 8.98059 18.6991 8.91366C13.3103 5.03617 7.29903 2.10728 0.924373 0.253243Z" fill="white"/>
</svg>
</button>
    </div>
        </div>
        <div class="popup-container">

        </div>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script>
            function eclipsePrompt(text, placeholder) {
const popupCont = document.querySelector('.popup-container')
 document.querySelector('.popup-container').style.visibility = "visible"
     document.querySelector('.popup-container').classList.add('show')
popupCont.insertAdjacentHTML("beforeend", '<div class="popup user-popup"><h3>' + text + '</h3><div class="join-hori"><input type="text" placeholder="' + placeholder + '"><button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none"><path d="M6.83333 1.5L11 5.66667M11 5.66667L6.83333 9.83333M11 5.66667H1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button></div></div>')
const popup = document.querySelector('.user-popup')
popup.style.visibility = "visible"
return new Promise((resolve, reject) => {
 popup.children[1].children[0].onkeydown = function(event) {
   if (event.key == "Enter") {
      popup.children[1].children[1].click()
   }
 }
 popup.children[1].children[1].onclick = function() {
    
    document.querySelector('.popup-container').style.visibility = "hidden"
    popup.remove()
    const value = popup.children[1].children[0].value
    resolve(value)
  }
});
}
            
        
                            $.post('/updateTypingStatus.php', { id: "<?php echo $_SESSION["id"];?>", typing: null });
            // check if input is unfocused, and if so, reset the typing status 
            $(document).on("blur", "input", function() {
                $.post('/updateTypingStatus.php', { id: "<?php echo $_SESSION["id"];?>", typing: null });
            });

            // get id from url param (ex. #14)
            var msgId = window.location.hash.substr(1);
            if (msgId) {
                $(".chat").animate({ scrollTop: $("#" + msgId).offset().top - 80 }, 500);
                $("#" + msgId).css("background-color", "#320d6d");
                setTimeout(function() { $("#" + msgId).css("background-color", "") }, 3000);
            }



            let messageAttachments = [];
            $(".charAmount").hide();
            $(".attachment-text").hide();

            // on window focus, reset the unread messages count and update the title
            window.addEventListener("focus", function() {
                unreadMsgCount = 0;
                document.title = "@<?php echo $currentUser; ?> - Eclipse"
            });

            // scroll to bottom of chat
            $(".chat").scrollTop($(".chat")[0].scrollHeight);

            async function askToAddFriend() {
                var requestedUser = await eclipsePrompt("Add Friend", "Enter username (ex. tris)");

                if (requestedUser === null || requestedUser === "") {
                    alert("You must enter a username.");
                    return;
                }

                $.post('/addFriend.php', { requestedUser }, function(result) { 
                    alert(result); 
                });
            }

            function acceptUser(id) {
                $.post('/acceptUser.php', { id }, function(result) { 
                    alert(result); 
                    location.reload();
                });
            }

            function declineUser(id) {
                $.post('/declineUser.php', { id }, function(result) { 
                    alert(result); 
                    if (result.includes("Friend removed successfully")) {
                    location.reload();
                    }
                });
            }

            
 document.querySelector('.popup-container').addEventListener('click', function(event) {
   var element = document.querySelector('.popup');
if (element.matches(':hover')) {
    console.log('Mouse is over the element now.');
} else {
     document.querySelector('.popup-container').style.visibility = "hidden"
  document.querySelectorAll('.popup').forEach((child) => {
    child.remove()
  })
   document.querySelector('.popup-container').classList.remove('show')
}
 })



            async function changeStatus() {
                var status = await eclipsePrompt("Change Status", "Choose your status (ex. online, away, offline, dnd)");
                if (status === null || status === "") {
                    alert("You must enter a status.");
                    return;
                }

                var acceptableStatuses = ["online", "away", "offline", "dnd"];

                if (!acceptableStatuses.includes(status)) {
                    alert("Invalid status. Choose from: online, away, offline, dnd.");
                    return;
                }

                $.post('/changeStatus.php', { id: "<?php echo $_SESSION["id"];?>", status }, function(result) { 
                    let upperCaseStatus;
                    if (status === "online" || status === "away" || status === "offline") {
                        upperCaseStatus = status.charAt(0).toUpperCase() + status.slice(1);
                    } else {
                        upperCaseStatus = "Do Not Disturb";
                    }
                    document.querySelector('#status').innerHTML = `
                      <p id="status" style="color:white; display:flex;flex-direction:row;gap:5px; align-items:center;" onclick="changeStatus()"><img src="/appicons/` + status + `.png" width="15" height="15">` + upperCaseStatus + `</p>
                    `

                });
            }


            async function changeCustomStatus() {
                var customStatus = await eclipsePrompt("Change Custom Status", "Enter your custom status (ex. 'I am working on a new project')");
                if (customStatus === null || customStatus === "") {
                    alert("You must enter a custom status.");
                    return;
                }

                // replace ' with &#39; in the custom status to avoid SQL injection
                customStatus = customStatus.replace(/'/g, "&#39;");

                $.post('changeCustomStatus.php', { id: "<?php echo $_SESSION["id"];?>", customStatus }, function(result) { 
                   document.querySelector('#customStatus').innerText = customStatus;
                });
            }

            // when the user types in the input field, update the typing text
            $(".input input[type='text'] ").on("input", function() {
                $.post('/updateTypingStatus.php', { id: "<?php echo $_SESSION["id"];?>", typing: "<?php echo $_GET['user']; ?>" });
            });

            document.getElementById("fileInput").addEventListener("change", handleFileUpload);

            function handleFileUpload() {
                var fileInput = document.getElementById("fileInput");
                file = fileInput.files[0];
                if (!file) {
                    return console.log('no file selected');
                }
                
                console.log("File uploaded:", file);

                $(".attachment-text").show();
                
                var reader = new FileReader();
            
                reader.onload = function() {
                file = reader.result;
                console.log(file)
                messageAttachments.push(file);
                // remove file from the upload box
                fileInput.value = "";

                
                let attachmentNames = [];
                messageAttachments.forEach(attachment => {
                    attachmentNames.push(attachment.name);
                })
                document.getElementsByClassName("attachment-text")[0].children[1].innerText = "Attachments: " + attachmentNames.join(", ");
                }

                reader.readAsDataURL(file);
            }


            async function sendMessage() {
                var message = $(".input input[type='text'] ").val();
                var receiver = "<?php echo $_GET["user"]; ?>";
                var sender = "<?php echo $_SESSION["id"]; ?>";

                if (message.trim() === "") {
                    return;
                }

                if (message.trim() > 500) {
                    return;
                }

                const emojiArray = [
                    { name: ':skull:', unicode: '💀' },
                    { name: ':skull_crossbones:', unicode: '☠' },
                    { name: ':dizzy:', unicode: '😵' },
                    { name: ':blush:', unicode: '😊' },
                    { name: ':grinning:', unicode: '😁' },
                    { name: ':laughing:', unicode: '😂' },
                    { name: ':shocked_face:', unicode: '😲'},
                    { name: ':sob:', unicode: '😭'},
                    { name: ':joy:', unicode: '😂' },
                    { name: ':smiling_imp:', unicode: '😈' },
                    { name: ':blushing_face:', unicode: '😊' },
                    { name: ':heart_eyes:', unicode: '😍' },
                    { name: ':pizza:', unicode: '🍕' },
                    { name: ':hamburger:', unicode: '🍔' },
                    { name: ':taco:', unicode: '🌮' },
                    { name: ':burger:', unicode: '🍔' },
                    { name: ':fries:', unicode: '🍟' },
                ]

                // add emojis to the message
                emojiArray.forEach(emoji => {
                    message = message.replace(new RegExp(emoji.name, 'g'), emoji.unicode);
                });

                // replace all ' with html entities to prevent XSS attacks
                message = message.replace(/'/g, "&#39;");
                    // remove any html tags, but check if the message has any image tag before replacing the tag
                    message = message.replace(/<[^>]*>/g, function(match) {
                        const acceptableTags = ['img', 'a', 'b', 'br', 'code', 'div', 'em', 'i', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'strong', 'b'];
                        // if the message has an image tag, return the tag as it is
                        if (match.startsWith("<img")) {
                            return match;
                        }
                        // otherwise, replace the tag with an empty string
                        return "";
                    });


                $.post('/updateTypingStatus.php', { id: "<?php echo $_SESSION["id"];?>", typing: null });


                        if (messageAttachments.length > 0) {

                           // download each attachment to a temporary file
    let downloadedAttachments = [];
    let downloadPromises = messageAttachments.map(async (attachment) => {
        const response = await fetch(attachment);
        const blob = await response.blob();
        const file = new File([blob], attachment.name, { type: blob.type });
        const formData = new FormData();
        formData.append('file', file);

        // send the file to the server
        const serverResponse = await fetch('/uploadAttachment.php', {
            method: 'POST',
            body: formData
        });

        const serverData = await serverResponse.text();
        if (serverData.includes("Sorry")) {
            console.error(`Failed to download attachment: ${attachment.name}. Reasoning: ${serverData}`);
            return;
        }
        downloadedAttachments.push(serverData);
    });

    Promise.all(downloadPromises).then(() => {
        $.post('/sendMessage.php', { message, receiver, sender, attachments: downloadedAttachments }, function(result) {             $(".input input[type='text'] ").val("");
            $(".charAmount").hide();
        });
    });
            } else {
                $.post('/sendMessage.php', { message, receiver, sender, attachments: [] }, function(result) { 
                                    $(".input input[type='text'] ").val("");
                        $(".charAmount").hide();
                });
            }
            }

            let lastAmount = null;
            let unreadMsgCount = 0;
            setInterval(function() {
                // get amount of messages between these two from the database using a get request
                let amountOfMessages;
                $.post('/getAmountOfMessages.php', { sender: "<?php echo $_SESSION["id"];?>", receiver: "<?php echo $_GET["user"];?>"}, function(data) {
                try {
                amountOfMessages = parseInt(data);
                
                if (lastAmount !== null) {
                if (amountOfMessages > lastAmount) {
                    
            // check if the browser is out of focus and if the user is not looking at the page
            if (!document.hasFocus() || window.top!== window) {
                // if the user has an online status, play sound notification
                if ("<?php echo $_SESSION["status"];?>" == "online" || "<?php echo $_SESSION["status"];?>" == "away") {
                // play sound notification
                new Audio('sounds/notification.wav').play();
                }

                // add one to the unread messages count
                unreadMsgCount = unreadMsgCount + 1;
                // update the title with the unread messages count
                document.title = "(" + unreadMsgCount + ") @<?php echo $currentUser; ?> - Eclipse";
            }
                    let latestMessage;
                    $.get('/getMessage.php?id=' + amountOfMessages + "&sender=" + "<?php echo $_SESSION["id"];?>" + "&receiver=" + "<?php echo $_GET["user"];?>", function(data) {

                        if (data.includes("Error")) {
                         return alert(data);
                        }
                      latestMessage = JSON.parse(data);

                      
                    let msg = latestMessage;
                    msg.attachments = JSON.parse(msg.attachments);
                   // get the current timestamp
                    var currentTimestamp = Math.floor(new Date().getTime() / 1000);

                    


var messageTimestamp = parseInt(msg.timestamp);

// calculate the time difference between the current timestamp and the message timestamp
var timeDifference = currentTimestamp - messageTimestamp;

// check the time difference and update the timestamp accordingly
if (timeDifference <= 60) {    // if message is within the last minute
    timestamp = "just now";
} else {    // if message is more than a minute ago
    if (timeDifference <= 3600) {    // if message is within the last hour
        // calculate minutes since the message was sent
        var minutes = Math.floor(timeDifference / 60);
        timestamp = minutes + "m ago";
    } else {    // if message is more than an hour ago
        if (timeDifference <= 86400) {    // if message is within the last day
            // convert timestamp to HH:MM:SS format
            timestamp = new Date(messageTimestamp * 1000).toTimeString().replace(/:\d{2}$/, '');
        } else {    // if message is more than a day ago
            timestamp = new Date(messageTimestamp * 1000).toLocaleString();
        }
    }
}


                    if (msg.sender == '<?php echo $_SESSION["id"];?>') {


                    $(".chat").append(' <div class="bubble-outgoing" id="' + msg.id + '"> <div class="message"><span onmouseover="this.innerText = `' + msg.content + '` ('+ timestamp +')`; this.innerHTML = this.innerHTML" onmouseout="this.innerText = `' + msg.content + '`">' + msg.content + '</span></div> </div>');

                  
                    if (!msg.attachments == null) {
                    if (msg.attachments.length > 0) {
                        msg.attachments.forEach(attachment => {
                        $(".chat").append(`
                                            <div class='bubble-outgoing'><img class="attachment" src="${attachment}" alt="Attachment" width="400" height="auto" />
                                                 </div>
                                                 `)
                        });
                    }
                }
                    } else {
                        $(".chat").append(`
                    <div class='bubble-incoming' id='${msg.id}'>
                    <div class='message'><span onmouseover="this.innerText = '${msg.content} (${timestamp})'; this.innerHTML = this.innerHTML" onmouseout="this.innerText = '${msg.content}'">${msg.content}</span></div>
                    </div>
                    `)

                    if (!msg.attachments == null) {
                    if (msg.attachments.length > 0) {
                        msg.attachments.forEach(attachment => {
                        $(".chat").append(`
                                            <div class='bubble-incoming'><img class="attachment" src="${attachment}" alt="Attachment" width="400" height="auto" />
                                                 </div>
                                                 `)
                        });
                    }
                }
                    }
                    
                    // if scrolled to bottom, scroll to bottom
                    $(".chat").animate({ scrollTop: $(".chat").prop("scrollHeight")}, 100);
                    
                    lastAmount = amountOfMessages;

            console.log(amountOfMessages);
                });
            }
        } else {
            lastAmount = amountOfMessages;
        }
    } catch(error) {
        console.error(error);
        alert(error);
    }
                });

                // get typing status
                $.get('/getTypingStatus.php?user=' + "<?php echo $_GET["user"];?>", function(data) {
                    console.log(data);
                    if (data !== null) {
                        if (data == '<?php echo $_SESSION["id"];?>') {
                            // change inner html of the typing text to show the user who is typing
                            $(".typing-text").show();
                            $(".typing-text").html('<img src="/appicons/typing.gif" width="12" /> <?php echo $currentUser; ?>' + " is typing")
                        } else {
                            $(".typing-text").hide();                        }
                    } else {
                        $(".typing-text").hide();
                    }
                })



                }, 900);

            // on enter key press, send message
            $(".input input[type='text'] ").keyup(function(event) {
                if (event.key === "Enter") {
                    sendMessage();
                }
            });

            // when input field increases
            $(".input input[type='text'] ").on("input", function() {
                // if the input field's value is greater than 400 characters, show the character limit warning
                if ($(this).val().length > 400) {
                    if ($(this).val().length > 500) {
                        // prevent the user from entering any more characters
                         event.preventDefault();
                         $(".charAmount").text((500 - $(this).val().length) + "/500");

                    } else {
                    $(".charAmount").show();
                    $(".charAmount").text((500 - $(this).val().length) + "/500");
                    }
                } else {
                    $(".charAmount").hide();
                }

                // continue the keydown event
                
            });

            const messages = document.getElementsByClassName('message');

            setInterval(function () {
                for (let i = 0; i < messages.length; i++) {
                var text = messages[i].innerText;
                const regexEmoji = /\p{Emoji}/u;
                if (regexEmoji.test(text)) {
                    // check text using regex for latin characters
                    const regexLatin = /[\u0000-\u007F]/;
                    if (regexLatin.test(text)) {
                        
                        messages[i].style.fontSize = "16px";
                    } else {
                        
                       if (text.includes(" ")) {
                        messages[i].style.fontSize = "24px";

                       } else {
                        messages[i].style.fontSize = "24px";

                       }
                    }
                                }
                            }

        }, 100);



        </script>
        <script src="/main.js"></script>
    </body>
</html>