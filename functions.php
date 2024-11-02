<?php

function get_records($tbl_name) {
    global $conn;
    $query = "SELECT 
            id,   
            hotel_name,
            hotel_description,
            hotel_location,
            
            hotel_image,
           
            price,
            capacity,
            room_quantity,
            availability,
            time
        FROM 
            $tbl_name";
    $result = $conn->query($query); 
    $rows = [];
    if ($result) {
      while ($row = $result->fetch_assoc()) {  
        $rows[] = $row;
      }
    }
    return $rows; 
  }

  function fetch_profile_pic($tbl_name) 
{ 
  if(isset($_SESSION["id"])) 
  {
    $id = $_SESSION["id"];
    global $conn;
    $query = "SELECT * FROM $tbl_name WHERE id = $id ";
    $result = $conn->query($query);
    if ($result) 
    {
      $row = $result->fetch_assoc();
      
    }
    return $row;
  }
}


function fetch_record_by_id($tbl_name, $id) 
{ 
    global $conn;
    
    // Prepare the SQL statement to avoid SQL injection
    $query = "SELECT * FROM $tbl_name WHERE id = ?";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("i", $id); // Bind the $id parameter as an integer

    $stmt->execute(); // Execute the statement
    $result = $stmt->get_result(); // Get the result

    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        return $row; // Return the fetched record
    } 
    else 
    {
        return null; // No record found
    }
    
    $stmt->close(); // Close the statement
}
