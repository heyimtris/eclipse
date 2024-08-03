<?php

session_start();

// connect to database
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// get call ID from params
$callID = $_GET['id'];

// split call id into sender and receiver 
$parts = explode('-', $callID);
$sender = $parts[0];
$receiver = $parts[1];

if ($sender !== $_SESSION['id'] && $receiver !== $_SESSION['id']) {
    die("You can't accept a call as someone else!");
}

if ($sender == $_SESSION['id']) {
    $otherUser = $receiver;
    $sql = "SELECT * FROM users WHERE id = '$receiver'";
} else {
    $otherUser = $sender;
    $sql = "SELECT * FROM users WHERE id = '$sender'";
}

$result = $conn->query($sql);
$userData = $result->fetch_assoc();
$currentUser = $userData['username'];
$peerID = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = '$otherUser'";
$result = $conn->query($sql);
$otherUserData = $result->fetch_assoc();

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
$result = $conn->query($sql);
$currentUser = $result->fetch_assoc();

if ($currentUser['verified'] === "0") {
    $_SESSION['email'] = $currentUser['email']; // Store email in session variable for use in verification page
    header("Location: /signup/confirmEmail.php"); // Redirect to verify page
    }

if ($otherUserData['calling']!== null) {
if ($otherUserData['calling'] !== $currentUser['id']) {
    echo "
    <script>
    alert('User is already calling someone else!');
    window.location.href = '/app'; // Redirect to home page
    </script>
    ";
}
}

?>
<html>
    <head>
        <title>@<?php echo $otherUserData['username'];?> - Eclipse</title>
        <link rel="stylesheet" type="text/css" href="/call.css">
    </head>
    <body>
        <div class="call-container">
            <div class="video-container">
                        <div class="profile-pic">
            <img src="<?php echo $currentUser['avatar']; ?>" width="100">
          </div>
        <video id="yourCamera" width="200" height="200" autoplay></video>
        <span id="yourInfo"><div class="muteIcon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">
<path d="M9 18.75C10.5913 18.75 12.1174 18.1179 13.2426 16.9926C14.3679 15.8674 15 14.3413 15 12.75V11.25M9 18.75C7.4087 18.75 5.88258 18.1179 4.75736 16.9926C3.63214 15.8674 3 14.3413 3 12.75V11.25M9 18.75V22.5M5.25 22.5H12.75M9 15.75C8.20435 15.75 7.44129 15.4339 6.87868 14.8713C6.31607 14.3087 6 13.5456 6 12.75V4.5C6 3.70435 6.31607 2.94129 6.87868 2.37868C7.44129 1.81607 8.20435 1.5 9 1.5C9.79565 1.5 10.5587 1.81607 11.1213 2.37868C11.6839 2.94129 12 3.70435 12 4.5V12.75C12 13.5456 11.6839 14.3087 11.1213 14.8713C10.5587 15.4339 9.79565 15.75 9 15.75Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17 1L1 23" stroke="#FF0000" stroke-linecap="round"/>
</svg></div> <?php echo $currentUser['username']; ?></span></div>
<div class="video-container theirCamera">
  <div class="profile-pic">
            <img src="<?php echo $otherUserData['avatar']; ?>" width="100">
          </div>
        <video id="theirCamera" width="200" height="200" autoplay></video>
        <span id="theirInfo"><div class="muteIcon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">
<path d="M9 18.75C10.5913 18.75 12.1174 18.1179 13.2426 16.9926C14.3679 15.8674 15 14.3413 15 12.75V11.25M9 18.75C7.4087 18.75 5.88258 18.1179 4.75736 16.9926C3.63214 15.8674 3 14.3413 3 12.75V11.25M9 18.75V22.5M5.25 22.5H12.75M9 15.75C8.20435 15.75 7.44129 15.4339 6.87868 14.8713C6.31607 14.3087 6 13.5456 6 12.75V4.5C6 3.70435 6.31607 2.94129 6.87868 2.37868C7.44129 1.81607 8.20435 1.5 9 1.5C9.79565 1.5 10.5587 1.81607 11.1213 2.37868C11.6839 2.94129 12 3.70435 12 4.5V12.75C12 13.5456 11.6839 14.3087 11.1213 14.8713C10.5587 15.4339 9.79565 15.75 9 15.75Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17 1L1 23" stroke="#FF0000" stroke-linecap="round"/>
</svg></div> <?php echo $otherUserData['username']; ?></span>
</div>
</div>
<div class="controls">
        <button onclick="toggleCam(this)"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="15" viewBox="0 0 21 15" fill="none">
<path d="M3 0C2.20435 0 1.44129 0.316071 0.87868 0.87868C0.316071 1.44129 0 2.20435 0 3V12C0 12.7956 0.316071 13.5587 0.87868 14.1213C1.44129 14.6839 2.20435 15 3 15H11.25C12.0456 15 12.8087 14.6839 13.3713 14.1213C13.9339 13.5587 14.25 12.7956 14.25 12V3C14.25 2.20435 13.9339 1.44129 13.3713 0.87868C12.8087 0.316071 12.0456 0 11.25 0H3ZM18.44 14.25L15.75 11.56V3.44L18.44 0.75C19.384 -0.195 21 0.474 21 1.81V13.19C21 14.526 19.384 15.195 18.44 14.25Z" fill="black"/>
</svg></button>
        <button onclick="toggleMic(this)"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="23" viewBox="0 0 14 23" fill="none">
<path d="M3 3.75C3 2.75544 3.39509 1.80161 4.09835 1.09835C4.80161 0.395088 5.75544 0 6.75 0C7.74456 0 8.69839 0.395088 9.40165 1.09835C10.1049 1.80161 10.5 2.75544 10.5 3.75V12C10.5 12.9946 10.1049 13.9484 9.40165 14.6517C8.69839 15.3549 7.74456 15.75 6.75 15.75C5.75544 15.75 4.80161 15.3549 4.09835 14.6517C3.39509 13.9484 3 12.9946 3 12V3.75Z" fill="black"/>
<path d="M0.75 9.75C0.948912 9.75 1.13968 9.82902 1.28033 9.96967C1.42098 10.1103 1.5 10.3011 1.5 10.5V12C1.5 13.3924 2.05312 14.7277 3.03769 15.7123C4.02226 16.6969 5.35761 17.25 6.75 17.25C8.14239 17.25 9.47774 16.6969 10.4623 15.7123C11.4469 14.7277 12 13.3924 12 12V10.5C12 10.3011 12.079 10.1103 12.2197 9.96967C12.3603 9.82902 12.5511 9.75 12.75 9.75C12.9489 9.75 13.1397 9.82902 13.2803 9.96967C13.421 10.1103 13.5 10.3011 13.5 10.5V12C13.5 13.6604 12.888 15.2626 11.7812 16.5003C10.6743 17.7379 9.15012 18.5243 7.5 18.709V21H10.5C10.6989 21 10.8897 21.079 11.0303 21.2197C11.171 21.3603 11.25 21.5511 11.25 21.75C11.25 21.9489 11.171 22.1397 11.0303 22.2803C10.8897 22.421 10.6989 22.5 10.5 22.5H3C2.80109 22.5 2.61032 22.421 2.46967 22.2803C2.32902 22.1397 2.25 21.9489 2.25 21.75C2.25 21.5511 2.32902 21.3603 2.46967 21.2197C2.61032 21.079 2.80109 21 3 21H6V18.709C4.34988 18.5243 2.82571 17.7379 1.71884 16.5003C0.611961 15.2626 2.41771e-05 13.6604 0 12V10.5C0 10.3011 0.0790175 10.1103 0.21967 9.96967C0.360322 9.82902 0.551088 9.75 0.75 9.75Z" fill="black"/>
</svg></button>
        <button onclick="hangUp()" class="hangUpBtn"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M13.72 1.72C13.8606 1.57955 14.0512 1.50066 14.25 1.50066C14.4488 1.50066 14.6394 1.57955 14.78 1.72L16.5 3.44L18.22 1.72C18.2887 1.64631 18.3715 1.58721 18.4635 1.54622C18.5555 1.50523 18.6548 1.48319 18.7555 1.48141C18.8562 1.47963 18.9562 1.49816 19.0496 1.53588C19.143 1.5736 19.2278 1.62974 19.299 1.70096C19.3703 1.77218 19.4264 1.85701 19.4641 1.9504C19.5018 2.04379 19.5204 2.14382 19.5186 2.24452C19.5168 2.34523 19.4948 2.44454 19.4538 2.53654C19.4128 2.62854 19.3537 2.71134 19.28 2.78L17.56 4.5L19.28 6.22C19.4125 6.36217 19.4846 6.55022 19.4812 6.74452C19.4777 6.93882 19.399 7.12421 19.2616 7.26162C19.1242 7.39903 18.9388 7.47775 18.7445 7.48118C18.5502 7.4846 18.3622 7.41248 18.22 7.28L16.5 5.56L14.78 7.28C14.7113 7.35369 14.6285 7.41279 14.5365 7.45378C14.4445 7.49477 14.3452 7.51682 14.2445 7.51859C14.1438 7.52037 14.0438 7.50184 13.9504 7.46412C13.857 7.4264 13.7722 7.37026 13.701 7.29904C13.6297 7.22782 13.5736 7.14299 13.5359 7.0496C13.4982 6.95621 13.4796 6.85618 13.4814 6.75548C13.4832 6.65478 13.5052 6.55546 13.5462 6.46346C13.5872 6.37146 13.6463 6.28866 13.72 6.22L15.44 4.5L13.72 2.78C13.5795 2.63937 13.5007 2.44875 13.5007 2.25C13.5007 2.05125 13.5795 1.86063 13.72 1.72ZM0 3C0 2.20435 0.316071 1.44129 0.87868 0.87868C1.44129 0.316071 2.20435 0 3 0H4.372C5.232 0 5.982 0.586 6.191 1.42L7.296 5.843C7.38554 6.201 7.36746 6.57746 7.24401 6.92522C7.12055 7.27299 6.89723 7.57659 6.602 7.798L5.309 8.768C5.174 8.869 5.145 9.017 5.183 9.12C5.74738 10.6549 6.6386 12.0487 7.79495 13.2051C8.9513 14.3614 10.3451 15.2526 11.88 15.817C11.983 15.855 12.13 15.826 12.232 15.691L13.202 14.398C13.4234 14.1028 13.727 13.8794 14.0748 13.756C14.4225 13.6325 14.799 13.6145 15.157 13.704L19.58 14.809C20.414 15.018 21 15.768 21 16.629V18C21 18.7956 20.6839 19.5587 20.1213 20.1213C19.5587 20.6839 18.7956 21 18 21H15.75C7.052 21 0 13.948 0 5.25V3Z" fill="black"/>
</svg></button>
</div>

<div id="disconnectMessage">
  <img src="<?php echo $otherUserData['avatar'] ?>" width="100" height="100" style="border-radius:100px;">
  <h2>Lost connection, attempting to reconnect...</h2>
  <p>Note, if your here for longer than 15 seconds, <?php echo $otherUserData['username']; ?> may have left the call.</p>
</div>
        <script src="https://unpkg.com/peerjs@1.5.4/dist/peerjs.min.js"></script>
        <script>
            var peer = new Peer('<?php echo $peerID; ?>');
            var localStream;

            // hide the "lost connection screen" when the call is connected
peer.on('open', function() {
    var disconnectMessage = document.querySelector('#disconnectMessage');
    disconnectMessage.style.display = "none";
});

            peer.on('error', function(err) {
                console.error('PeerJS error:', err);
            });

            navigator.mediaDevices.getUserMedia({video: true, audio: true})
            .then(function(stream) {
                localStream = stream;
                var yourVideo = document.getElementById('yourCamera');
                yourVideo.volume = 0;
                yourVideo.srcObject = stream;

                toggleCam();

                var call = peer.call('<?php echo $otherUser;?>', stream, {
                    metadata: {
                        id: '<?php echo $_SESSION['id']; ?>'
                    }
                });

                <?php

                // set calling to the username of the other user
                $query = "UPDATE users SET calling = '".$otherUserData['id']."' WHERE id = '".$_SESSION['id']."'";
                $result = $conn->query($query);
                if (!$result === TRUE) {
                    echo "Error updating calling status: ". $conn->error;
                }

                ?>
                call.on('stream', function(remoteStream) {
                    var theirVideo = document.getElementById('theirCamera');
                    theirVideo.parentElement.style.visibility = "visible";
                    theirVideo.srcObject = remoteStream;
                });

                call.on('error', function(err) {
                    console.error('Call error:', err);
                });
            })
            .catch(function(err) {
                console.error('Failed to get local stream:', err);
            });

            peer.on('call', function(call) {
                console.log('Received call from: ' + call.metadata.id);

                // check if peer is already in a call


                call.answer(localStream); // Answer the call with an A/V stream.

                call.on('stream', function(remoteStream) {
                    var disconnectMessage = document.querySelector('#disconnectMessage');
                disconnectMessage.style.display = "none";
                    var theirVideo = document.getElementById('theirCamera');
                    theirVideo.parentElement.style.visibility = "visible";
                    theirVideo.srcObject = remoteStream;
                });

                call.on('error', function(err) {
                    console.error('Call error:', err);
                });
            });

            function toggleMic(button) {
                var audioTracks = localStream.getAudioTracks();
                audioTracks[0].enabled = !audioTracks[0].enabled;
                if (audioTracks[0].enabled) {
                    button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="23" viewBox="0 0 14 23" fill="none">
<path d="M3 3.75C3 2.75544 3.39509 1.80161 4.09835 1.09835C4.80161 0.395088 5.75544 0 6.75 0C7.74456 0 8.69839 0.395088 9.40165 1.09835C10.1049 1.80161 10.5 2.75544 10.5 3.75V12C10.5 12.9946 10.1049 13.9484 9.40165 14.6517C8.69839 15.3549 7.74456 15.75 6.75 15.75C5.75544 15.75 4.80161 15.3549 4.09835 14.6517C3.39509 13.9484 3 12.9946 3 12V3.75Z" fill="black"/>
<path d="M0.75 9.75C0.948912 9.75 1.13968 9.82902 1.28033 9.96967C1.42098 10.1103 1.5 10.3011 1.5 10.5V12C1.5 13.3924 2.05312 14.7277 3.03769 15.7123C4.02225 16.6969 5.35761 17.25 6.75 17.25C8.14239 17.25 9.47775 16.6969 10.4623 15.7123C11.4469 14.7277 12 13.3924 12 12V10.5C12 10.3011 12.079 10.1103 12.2197 9.96967C12.3603 9.82902 12.5511 9.75 12.75 9.75C12.9489 9.75 13.1397 9.82902 13.2803 9.96967C13.421 10.1103 13.5 10.3011 13.5 10.5V12C13.5 13.6604 12.888 15.2626 11.7812 16.5003C10.6743 17.7379 9.15012 18.5243 7.5 18.709V21H10.5C10.6989 21 10.8897 21.079 11.0303 21.2197C11.171 21.3603 11.25 21.5511 11.25 21.75C11.25 21.9489 11.171 22.1397 11.0303 22.2803C10.8897 22.421 10.6989 22.5 10.5 22.5H3C2.80109 22.5 2.61032 22.421 2.46967 22.2803C2.32902 22.1397 2.25 21.9489 2.25 21.75C2.25 21.5511 2.32902 21.3603 2.46967 21.2197C2.61032 21.079 2.80109 21 3 21H6V18.709C4.34988 18.5243 2.82571 17.7379 1.71884 16.5003C0.611961 15.2626 2.41771e-05 13.6604 0 12V10.5C0 10.3011 0.0790175 10.1103 0.21967 9.96967C0.360322 9.82902 0.551088 9.75 0.75 9.75Z" fill="black"/>
</svg>`
                                } else {
                                    button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="17" height="24" viewBox="0 0 17 24" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M4.25 4.5C4.25 3.50544 4.64509 2.55161 5.34835 1.84835C6.05161 1.14509 7.00544 0.75 8 0.75C8.99456 0.75 9.94839 1.14509 10.6517 1.84835C11.3549 2.55161 11.75 3.50544 11.75 4.5V12.568L4.25 5.06802V4.5ZM4.25 11.432V12.75C4.25 13.7446 4.64509 14.6984 5.34835 15.4017C6.05161 16.1049 7.00544 16.5 8 16.5C8.39066 16.5 8.77504 16.439 9.14041 16.3224L4.25 11.432ZM10.2915 17.4735C9.58391 17.8168 8.8014 18 8 18C6.60761 18 5.27225 17.4469 4.28769 16.4623C3.30312 15.4777 2.75 14.1424 2.75 12.75V11.25C2.75 11.0511 2.67098 10.8603 2.53033 10.7197C2.38968 10.579 2.19891 10.5 2 10.5C1.80109 10.5 1.61032 10.579 1.46967 10.7197C1.32902 10.8603 1.25 11.0511 1.25 11.25V12.75C1.25002 14.4104 1.86196 16.0126 2.96884 17.2503C4.07571 18.4879 5.59988 19.2743 7.25 19.459V21.75H4.25C4.05109 21.75 3.86032 21.829 3.71967 21.9697C3.57902 22.1103 3.5 22.3011 3.5 22.5C3.5 22.6989 3.57902 22.8897 3.71967 23.0303C3.86032 23.171 4.05109 23.25 4.25 23.25H11.75C11.9489 23.25 12.1397 23.171 12.2803 23.0303C12.421 22.8897 12.5 22.6989 12.5 22.5C12.5 22.3011 12.421 22.1103 12.2803 21.9697C12.1397 21.829 11.9489 21.75 11.75 21.75H8.75V19.459C9.69244 19.3535 10.5938 19.0518 11.3998 18.5818L10.2915 17.4735ZM14.3153 15.1333C14.6004 14.3778 14.75 13.571 14.75 12.75V11.25C14.75 11.0511 14.671 10.8603 14.5303 10.7197C14.3897 10.579 14.1989 10.5 14 10.5C13.8011 10.5 13.6103 10.579 13.4697 10.7197C13.329 10.8603 13.25 11.0511 13.25 11.25V12.75C13.25 13.1514 13.204 13.5481 13.115 13.933L14.3153 15.1333Z" fill="black"/>
<path d="M1 5L16 20" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>`
                                                }
            }

            function toggleCam() {
                var videoTracks = localStream.getVideoTracks();
                videoTracks[0].enabled = !videoTracks[0].enabled;
            }

            function hangUp() {
                // disconnect
                localStream.getTracks().forEach(track => {
                    track.stop();
                });
                peer.destroy();

                <?php 

                // set calling to null
                $sql = "UPDATE users SET calling = NULL WHERE id = '".$currentUser['id']."'";
                mysqli_query($conn, $sql);
                $conn->close();
                ?>

                // close tab
                window.close();
            }

            // detect when peer connection is lost
           call.on('close', function() {
                var disconnectMessage = document.querySelector('#disconnectMessage');
                disconnectMessage.style.display = "flex";
            });

            setInterval(function() {
           // check if their stream is muted
const video = document.getElementById('theirCamera');
if (video.srcObject) {
    const audioTracks = video.srcObject.getAudioTracks();
    if (audioTracks.length > 0 && audioTracks[0].enabled) {
        document.querySelector('#theirInfo .muteIcon').style.visibility = "hidden";
    } else {
        document.querySelector('#theirInfo .muteIcon').style.visibility = "visible";
    }
}

            }, 2000)

            // when the current user leaves the page
            window.onbeforeunload = function() {
                hangUp();
            }

            
        </script>
    </body>
</html>