<?php 

// connect to database
$conn = new mysqli("localhost", "root", "", "eclipse");
                // set calling to null
                $sql = "SELECT calling FROM users WHERE id = '". $_GET["id"] . "'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $sql = "UPDATE users SET calling = NULL WHERE id = '". $_GET["id"] . "'";
                    $conn->query($sql);

                    if ($conn->query($sql) === TRUE) {
                        echo "Calling status updated successfully";
                        http_response_code(200);

                    } else {
                        echo "Error updating calling status: ". $conn->error;
                        http_response_code(500);
                    }
                }
                $conn->close();
                ?>