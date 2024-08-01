<?php
  session_start();

if (!$_SESSION['logged_in'] || $_SESSION['logged_in'] !== true) {
    header("Location:./login/index.php");  // Redirect to login page
}
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="friend_req.css">
        <link rel="icon" type="image/png" href="/Eclipse/icons/eclipseicon.png">
        <title>Home - Eclipse</title>
        <style>
 @media screen and (max-width: 900px) {
        .app-container {
            width:100vw;
            flex-direction: row;
            height: 100vh;
            padding: 0;
            justify-content: center;
            background: #320D6D;
        }

        .app-container .sidebar {
            display:none;
            width:0%;
        }


        .sidebar .join-auto-horizontal:has(.user-info) {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 20px;
            flex: 1 0 0;
            align-self: stretch;
        }
        .sidebar .join-auto-horizontal .user-info {
            position:static;
            background:#320D6D;
            width:100%;
            display:flex;
            justify-content: space-between;
align-items: center;
        }

        .sidebar ul {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 24px;
            align-self: stretch;
        }
    }

            </style>
    </head>
    <body>
        <div class="app-container">
            <div class="sidebar">
                <div class="join-vert">
                    <div class="join-auto-horizontal">
                    <button class="btn btn-primary w-fill active" onclick="window.location.assign('./app')"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.47 1.84099C10.6106 1.70054 10.8013 1.62165 11 1.62165C11.1988 1.62165 11.3894 1.70054 11.53 1.84099L20.22 10.531C20.2892 10.6026 20.372 10.6597 20.4635 10.699C20.5551 10.7382 20.6535 10.7589 20.7531 10.7597C20.8526 10.7605 20.9514 10.7415 21.0435 10.7037C21.1357 10.666 21.2194 10.6102 21.2898 10.5398C21.3602 10.4693 21.4158 10.3856 21.4535 10.2934C21.4912 10.2012 21.5101 10.1024 21.5092 10.0028C21.5083 9.90325 21.4875 9.80484 21.4482 9.71336C21.4088 9.62187 21.3517 9.53914 21.28 9.46999L12.591 0.779991C12.3821 0.571056 12.134 0.40532 11.861 0.292245C11.5881 0.179171 11.2955 0.120972 11 0.120972C10.7045 0.120972 10.4119 0.179171 10.139 0.292245C9.86598 0.40532 9.61794 0.571056 9.409 0.779991L0.719004 9.46999C0.647405 9.53921 0.590308 9.622 0.551045 9.71352C0.511782 9.80504 0.491139 9.90346 0.490321 10.003C0.489503 10.1026 0.508526 10.2014 0.54628 10.2935C0.584034 10.3857 0.639763 10.4694 0.710215 10.5398C0.780668 10.6102 0.864433 10.6658 0.956622 10.7035C1.04881 10.7412 1.14758 10.7601 1.24716 10.7592C1.34675 10.7583 1.44515 10.7375 1.53664 10.6982C1.62812 10.6588 1.71085 10.6017 1.78 10.53L10.47 1.84099Z" fill="white"/>
<path d="M11 3.43201L19.159 11.591C19.189 11.621 19.219 11.649 19.25 11.677V17.875C19.25 18.91 18.41 19.75 17.375 19.75H14C13.8011 19.75 13.6103 19.671 13.4697 19.5303C13.329 19.3897 13.25 19.1989 13.25 19V14.5C13.25 14.3011 13.171 14.1103 13.0303 13.9697C12.8897 13.829 12.6989 13.75 12.5 13.75H9.5C9.30109 13.75 9.11032 13.829 8.96967 13.9697C8.82902 14.1103 8.75 14.3011 8.75 14.5V19C8.75 19.1989 8.67098 19.3897 8.53033 19.5303C8.38968 19.671 8.19891 19.75 8 19.75H4.625C4.12772 19.75 3.65081 19.5525 3.29917 19.2008C2.94754 18.8492 2.75 18.3723 2.75 17.875V11.677C2.78111 11.6492 2.81146 11.6205 2.841 11.591L11 3.43201Z" fill="white"/>
</svg></button>

<button class="btn btn-primary w-fill" onclick="window.location.assign('./search.php')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M18.9998 19L13.8028 13.803M13.8028 13.803C15.2094 12.3965 15.9996 10.4887 15.9996 8.49955C15.9996 6.51035 15.2094 4.60262 13.8028 3.19605C12.3962 1.78947 10.4885 0.999268 8.49931 0.999268C6.51011 0.999268 4.60238 1.78947 3.19581 3.19605C1.78923 4.60262 0.999023 6.51035 0.999023 8.49955C0.999023 10.4887 1.78923 12.3965 3.19581 13.803C4.60238 15.2096 6.51011 15.9998 8.49931 15.9998C10.4885 15.9998 12.3962 15.2096 13.8028 13.803Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></button>
                        <button class="btn btn-primary w-fill" onclick="askToAddFriend()"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M3.5 4.125C3.5 3.03098 3.9346 1.98177 4.70818 1.20818C5.48177 0.434597 6.53098 0 7.625 0C8.71902 0 9.76823 0.434597 10.5418 1.20818C11.3154 1.98177 11.75 3.03098 11.75 4.125C11.75 5.21902 11.3154 6.26823 10.5418 7.04182C9.76823 7.8154 8.71902 8.25 7.625 8.25C6.53098 8.25 5.48177 7.8154 4.70818 7.04182C3.9346 6.26823 3.5 5.21902 3.5 4.125ZM0.5 16.875C0.5 14.9853 1.25067 13.1731 2.58686 11.8369C3.92306 10.5007 5.73533 9.75 7.625 9.75C9.51467 9.75 11.3269 10.5007 12.6631 11.8369C13.9993 13.1731 14.75 14.9853 14.75 16.875V16.878L14.749 16.997C14.7469 17.1242 14.7124 17.2487 14.6489 17.3589C14.5854 17.4691 14.495 17.5614 14.386 17.627C12.3452 18.856 10.0073 19.5036 7.625 19.5C5.153 19.5 2.839 18.816 0.865 17.627C0.755851 17.5615 0.665167 17.4693 0.601487 17.3591C0.537806 17.2489 0.503225 17.1243 0.501 16.997L0.5 16.875ZM17 5.25C17 5.05109 16.921 4.86032 16.7803 4.71967C16.6397 4.57902 16.4489 4.5 16.25 4.5C16.0511 4.5 15.8603 4.57902 15.7197 4.71967C15.579 4.86032 15.5 5.05109 15.5 5.25V7.5H13.25C13.0511 7.5 12.8603 7.57902 12.7197 7.71967C12.579 7.86032 12.5 8.05109 12.5 8.25C12.5 8.44891 12.579 8.63968 12.7197 8.78033C12.8603 8.92098 13.0511 9 13.25 9H15.5V11.25C15.5 11.4489 15.579 11.6397 15.7197 11.7803C15.8603 11.921 16.0511 12 16.25 12C16.4489 12 16.6397 11.921 16.7803 11.7803C16.921 11.6397 17 11.4489 17 11.25V9H19.25C19.4489 9 19.6397 8.92098 19.7803 8.78033C19.921 8.63968 20 8.44891 20 8.25C20 8.05109 19.921 7.86032 19.7803 7.71967C19.6397 7.57902 19.4489 7.5 19.25 7.5H17V5.25Z" fill="white"/>
                        </svg></button>
<button class="btn btn-primary w-fill" onclick="window.location.assign('./friend_requests.php')"><svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        $sql = "SELECT * FROM users WHERE username = '". $_SESSION['username']. "'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        // display all friends
                        $friends = json_decode($row["friends"]);
                        foreach ($friends as $friend) {
                            $sql = "SELECT * FROM users WHERE id = '$friend'";
                            $friendResult = $conn->query($sql);
                            $friendRow = $friendResult->fetch_assoc();
                            if ($friendRow['id'] == $_SESSION["id"]) {
                                continue;
                            }
                            $liArray = [
                                '<li onclick="window.location.assign(`./messages.php?user=' .
                                $friendRow["id"] .
                                '`)">',
                                '<div class="avatar">',
                                '<img src="' .
                                $friendRow["avatar"] .
                                '" width="40" height="40" style="border-radius:50px;"/>',
                                '<div class="status"><img src="./icons/' .
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
  $sql = "SELECT * FROM users WHERE username = '". $_SESSION['username']. "'";
  $result = $conn->query($sql);
  $userData = $result->fetch_assoc();
  
  if ($userData["custom_status"]) {
        echo '<p style="color:white;" class="custom-status" onclick="changeCustomStatus()">'.$userData["custom_status"].'</p>';
    } else {
        echo '<p style="color:white;" onclick="changeCustomStatus()">No custom status set.</p>';

    } 
    ?>
    <p style="color:white; display:flex;flex-direction:row;gap:5px; align-items:center;" onclick="changeStatus()"><img src="./icons/<?php echo $userData['status'] ?>.png" width="15" height="15"> <?php
    $statuses = array("online" => "Online", "away" => "Away", "dnd" => "Do Not Disturb", "offline" => "Offline");
    echo $statuses[$userData["status"]];
    ?></p>
</div>
<div class="button-group">
<div class="text-btn" onclick="window.location.assign('./settings')">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.0779 2.25C10.1609 2.25 9.37893 2.913 9.22793 3.817L9.04993 4.889C9.02993 5.009 8.93494 5.149 8.75293 5.237C8.41028 5.40171 8.08067 5.59226 7.76693 5.807C7.60093 5.922 7.43293 5.933 7.31693 5.89L6.29993 5.508C5.88418 5.35224 5.42663 5.34906 5.00875 5.49904C4.59087 5.64901 4.23976 5.94241 4.01793 6.327L3.09593 7.924C2.87402 8.30836 2.79565 8.75897 2.87475 9.19569C2.95385 9.6324 3.18531 10.0269 3.52793 10.309L4.36793 11.001C4.46293 11.079 4.53793 11.23 4.52193 11.431C4.49344 11.8101 4.49344 12.1909 4.52193 12.57C4.53693 12.77 4.46293 12.922 4.36893 13L3.52793 13.692C3.18531 13.9741 2.95385 14.3686 2.87475 14.8053C2.79565 15.242 2.87402 15.6926 3.09593 16.077L4.01793 17.674C4.23992 18.0584 4.59109 18.3516 5.00896 18.5014C5.42683 18.6512 5.88429 18.6478 6.29993 18.492L7.31893 18.11C7.43393 18.067 7.60193 18.079 7.76893 18.192C8.08093 18.406 8.40993 18.597 8.75393 18.762C8.93593 18.85 9.03093 18.99 9.05093 19.112L9.22893 20.183C9.37993 21.087 10.1619 21.75 11.0789 21.75H12.9229C13.8389 21.75 14.6219 21.087 14.7729 20.183L14.9509 19.111C14.9709 18.991 15.0649 18.851 15.2479 18.762C15.5919 18.597 15.9209 18.406 16.2329 18.192C16.3999 18.078 16.5679 18.067 16.6829 18.11L17.7029 18.492C18.1184 18.6472 18.5755 18.6501 18.993 18.5002C19.4104 18.3502 19.7612 18.0571 19.9829 17.673L20.9059 16.076C21.1278 15.6916 21.2062 15.241 21.1271 14.8043C21.048 14.3676 20.8166 13.9731 20.4739 13.691L19.6339 12.999C19.5389 12.921 19.4639 12.77 19.4799 12.569C19.5084 12.1899 19.5084 11.8091 19.4799 11.43C19.4639 11.23 19.5389 11.078 19.6329 11L20.4729 10.308C21.1809 9.726 21.3639 8.718 20.9059 7.923L19.9839 6.326C19.7619 5.94159 19.4108 5.6484 18.9929 5.49861C18.575 5.34883 18.1176 5.35215 17.7019 5.508L16.6819 5.89C16.5679 5.933 16.3999 5.921 16.2329 5.807C15.9195 5.5923 15.5902 5.40175 15.2479 5.237C15.0649 5.15 14.9709 5.01 14.9509 4.889L14.7719 3.817C14.699 3.37906 14.473 2.98122 14.1343 2.69427C13.7955 2.40732 13.3659 2.24989 12.9219 2.25H11.0789H11.0779ZM11.9999 15.75C12.9945 15.75 13.9483 15.3549 14.6516 14.6517C15.3548 13.9484 15.7499 12.9946 15.7499 12C15.7499 11.0054 15.3548 10.0516 14.6516 9.34835C13.9483 8.64509 12.9945 8.25 11.9999 8.25C11.0054 8.25 10.0515 8.64509 9.34828 9.34835C8.64502 10.0516 8.24993 11.0054 8.24993 12C8.24993 12.9946 8.64502 13.9484 9.34828 14.6517C10.0515 15.3549 11.0054 15.75 11.9999 15.75Z" fill="white"/>
</svg>
</div>
<div class="text-btn" onclick="window.location.assign('./logout')">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none">
<path d="M11.75 7V3.25C11.75 2.65326 11.5129 2.08097 11.091 1.65901C10.669 1.23705 10.0967 1 9.5 1H3.5C2.90326 1 2.33097 1.23705 1.90901 1.65901C1.48705 2.08097 1.25 2.65326 1.25 3.25V16.75C1.25 17.3467 1.48705 17.919 1.90901 18.341C2.33097 18.7629 2.90326 19 3.5 19H9.5C10.0967 19 10.669 18.7629 11.091 18.341C11.5129 17.919 11.75 17.3467 11.75 16.75V13M14.75 13L17.75 10M17.75 10L14.75 7M17.75 10H5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                    </div>
    </div>
                </div>
            </div>
</div>
            <div class="messages"><div class="header">
            <button class="btn text mobile-back" onclick="window.history.back()"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M7 13L1 7M1 7L7 1M1 7H13C14.5913 7 16.1174 7.63214 17.2426 8.75736C18.3679 9.88258 19 11.4087 19 13C19 14.5913 18.3679 16.1174 17.2426 17.2426C16.1174 18.3679 14.5913 19 13 19H10" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></button>
                <h2>Message Requests</h2>
</div>
                <ul>
                    <?php

                        // connect to database
                        $conn = new mysqli("localhost", "root", "", "eclipse");
                        
                        // check connection
                        if ($conn -> connect_error) {
                            die("Connection failed: ". $conn -> connect_error);
                        }

                    
                        // Fetch incoming and outgoing friend requests from database
                        $id = $_SESSION['id'];
                        $sql = "SELECT * FROM friend_requests WHERE recipient = '$id' OR sender = '$id'";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                if ($row["sender"] == $_SESSION['id']) {
                                    // Fetch user's details from database
                                    
                                    $sender_id = $row["sender"];
                                    $sql2 = "SELECT * FROM users WHERE id = '$sender_id'";
                                    $result2 = $conn->query($sql2);
                                    $row2 = $result2->fetch_assoc();

                                    // get other persons username
                                    $sql3 = "SELECT username FROM users WHERE id = '".$row['recipient']."'";
                                    
                                    $sender_username = $conn->query($sql3)->fetch_assoc()['username'];
                                    echo '<li>
                                    <span class="username">'.$sender_username.' (ongoing)</span>
                                </li>';
                                } else {
                                    // Fetch user's details from database
                                    
                                    $recipient_id = $row["sender"];
                                    $sql2 = "SELECT * FROM users WHERE id = '$recipient_id'";
                                    $result2 = $conn->query($sql2);
                                    $row2 = $result2->fetch_assoc();
                                    echo '<li>
                                    <span class="username">'.$row2["username"].' (pending)</span>
                                    <button class="options-btn btn-primary" onclick="acceptUser(`'.$row["sender"].'`)">Accept</button>
                                    <button class="options-btn btn-secondary" onclick="declineUser(`'.$row["sender"].'`)">Decline</button>
                                </li>';
                                }
                            }
                        } else {
                            echo '<li>You have no message requests.</li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
        <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
        <script>
            function askToAddFriend() {
                var requestedUser = prompt("Enter the username of the person you want to add:");

                if (requestedUser === null || requestedUser === "") {
                    alert("You must enter a username.");
                    return;
                }

                $.post('./addFriend.php', { requestedUser }, function(result) { 
                    alert(result); 
                });
            }

            function acceptUser(username) {
                $.post('./acceptUser.php', { username }, function(result) { 
                    alert(result); 
                    location.reload();
                });
            }

            function declineUser(username) {
                $.post('./declineUser.php', { username }, function(result) { 
                    alert(result); 
                    if (result.includes("Friend removed successfully")) {
                    location.reload();
                    }
                });
            }

            function changeStatus() {
                var status = prompt("Enter your new status (online, away, offline, dnd):");
                if (status === null || status === "") {
                    alert("You must enter a status.");
                    return;
                }

                var acceptableStatuses = ["online", "away", "offline", "dnd"];

                if (!acceptableStatuses.includes(status)) {
                    alert("Invalid status. Choose from: online, away, offline, dnd.");
                    return;
                }

                $.post('./changeStatus.php', { id: "<?php echo $_SESSION["id"];?>", status }, function(result) { 
                    alert(result);
                });
            }

            function changeCustomStatus() {
                var customStatus = prompt("Enter your new custom status:");
                if (customStatus === null || customStatus === "") {
                    alert("You must enter a custom status.");
                    return;
                }

                // replace ' with &#39; in the custom status to avoid SQL injection
                customStatus = customStatus.replace(/'/g, "&#39;");

                $.post('./changeCustomStatus.php', { id: "<?php echo $_SESSION["id"];?>", customStatus }, function(result) { 
                    alert(result);
                });
            }


        </script>
    </body>
</html>