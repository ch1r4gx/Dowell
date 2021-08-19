<?php

include_once("$path_prefix/db/db_conn.php");
include_once("$path_prefix/others/functions.php");

// $join_type, $join_on, $match_col
function get_table_data($conn, $table_name, $table_cols, $where, $joins_arr)
{
    $sql = "SELECT " . join(',', $table_cols) . " FROM $table_name";

    // If JOIN is present => Update query
    if (count($joins_arr)) {
        // (INNER) JOIN (Customers) ON Orders.CustomerID=Customers.CustomerID;
        foreach ($joins_arr as $join) {
            $sql .= " " . $join['join_type'] . " JOIN " . $join['join_on'] . " ON " . $join['match_col'];
        }
    }


    // If WHERE is present => Update query
    if ($where) {
        $sql .= " WHERE $where";
    }

    // echo '$sql: ' . $sql;
    // exit;

    $result = $conn->query($sql);

    // If query failed => Redirect to error page
    if ($result === false) {
        $_SESSION["errors"] = ["Error: " . $sql . " - " . $conn->error];
        redirect('/assignment-2/pages/error.php');
    }

    // `num_rows` is > 0 then user exist in DB
    if ($result->num_rows > 0) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function edit_table_data($conn, $table_name, $table_cols, $where)
{
    $sql = "UPDATE $table_name SET $table_cols WHERE $where";

    // echo '$sql: ' . $sql;
    // exit;

    $result = $conn->query($sql);

    // If query failed => Redirect to error page
    if ($result === false) {
        $_SESSION["errors"] = ["Error: " . $sql . " - " . $conn->error];
        redirect('/assignment-2/pages/error.php');
    }
}

function add_new_record($conn, $table_name, $table_cols)
{

    $sql = "INSERT INTO $table_name (";
    $sql .= join(", ", array_keys($table_cols));
    $sql .= ') VALUES (';

    // Thanks: https://stackoverflow.com/questions/34440610/php-add-single-quotes-to-comma-separated-list
    $temp = array_values($table_cols);
    $result = "'" . implode("', '", $temp) . "'";

    $sql .= $result;

    $sql .= ')';

    // echo '$sql: ' . $sql;
    // exit;

    $result = $conn->query($sql);

    // If query failed => Redirect to error page
    if ($result === false) {
        $_SESSION["errors"] = ["Error: " . $sql . " - " . $conn->error];
        redirect('/assignment-2/pages/error.php');
    }

    return $result;
}

function check_access($roles_arr)
{
    $can_view = false;

    if (array_key_exists("user", $_SESSION)) {
        $curr_user_role = $_SESSION["user"]['role'];
        $can_view = in_array($curr_user_role, $roles_arr);
    }

    if (!$can_view) {
        $_SESSION["errors"] = ["Error: You don't have enough permissions to view the page!"];
        redirect('/assignment-2/pages/error.php');
    }
}

function check_is_owner($id)
{

    $can_view = false;

    if (array_key_exists("user", $_SESSION)) {
        $can_view = $_SESSION["user"]['id'] === $id;
    }

    if (!$can_view) {
        $_SESSION["errors"] = ["Error: You don't have enough permissions to view the page!"];
        redirect('/assignment-2/pages/error.php');
    }
}

function is_role($roles_arr)
{
    return array_key_exists("user", $_SESSION) && in_array($_SESSION["user"]['role'], $roles_arr);
}
