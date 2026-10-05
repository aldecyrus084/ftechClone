<?php
require_once("../dbconnection/dbcon.php");

class MODEL extends DBConnection{
    function loginx($username, $password)
    {
        $query = "SELECT username,`password` from settings where username = '$username' and `password` = '$password'";
        $data = $this->conn->query($query);

        if($data->num_rows > 0 )
        {
            $row = $data->fetch_assoc();
            return $row;
        }
        else
        {
            return false;
        }
    }

	function determineTypes($params)
	{
		$types = '';
		foreach ($params as $param) {
			if (is_int($param)) {
				$types .= 'i'; // Integer
			} elseif (is_double($param)) {
				$types .= 'd'; // Double
			} elseif (is_string($param)) {
				$types .= 's'; // String
			} else {
				$types .= 'b'; // Blob (for other types like binary data)
			}
		}
		return $types;
	}

	function sqlquery($sql, $param = [])
	{
		// Prepare the statement
		$stmt = $this->conn->prepare($sql);

		// Check for errors in preparation
		if ($stmt === false) {
			error_log("Prepare failed: " . $this->conn->error);
			return false;
		}

		// Bind parameters dynamically if there are any
		if (!empty($param)) {
			// Determine the correct parameter types based on the input
			$types = $this->determineTypes($param);
			$stmt->bind_param($types, ...$param); // Bind parameters dynamically
		}

		// Execute the query
		if (!$stmt->execute()) {
			error_log("SQL query execution failed: " . $stmt->error);
			return false;
		}

		// Initialize data as an empty string
		$data = '';

		// If there are result sets, get the first one
		$result = $stmt->get_result();

		if ($result) {
			if ($result->num_rows > 0) {
				$data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array
			}
			$result->free();  // Free the result set
		}

		// Check for multiple result sets, useful if using multi-query or stored procedures
		// Only call next_result() if there are more result sets
		while ($this->conn->more_results()) {
			if ($this->conn->next_result()) {
				// If there's another result set, process it (e.g., freeing memory)
				if ($res = $this->conn->use_result()) {
					$res->free();  // Free any unused result set
				}
			}
		}

		return $data;
	}




    function sqlnonquery($sql, $param = [])
    {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }

        if (!empty($param)) {
            // Bind parameters
            $types = str_repeat('s', count($param)); // assuming all parameters are strings
            $stmt->bind_param($types, ...$param);
        }

        $result = $stmt->execute();

        if ($result && $stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>