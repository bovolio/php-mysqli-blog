// // example for reusable method to get data from `accounts` table
            // function selectFromAccounts ($connection, $columns = ['*'], $wheres = []) {
            //     $joinWhere = implode(',', $wheres);
            //     $joinCol = implode(',', $columns);
                
            //     if ($stmt = $connection->prepare("SELECT {$joinCol} FROM accounts WHERE {$joinWhere} = ?")){
            //         $stmt->bind_param('s', $joinWhere); // this should use a loop over $wheres
            //         $stmt->execute(); 
            //         $stmt->store_result(); 
            //     }

            //     return $results; // return the query results
            // }

            // $result = selectFromAccounts($conn, ['id', 'password'], ['email' => $_POST['email']]);
            // echo $result;
            