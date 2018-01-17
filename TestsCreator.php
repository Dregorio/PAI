<?php

class TestsCreator
{
    private static $test_title = "DOMYŚLNY TYTUŁ";
    private static $questions = array();
    private static $conn = null;
    //const SQL_TEST_NAME_QUERY = "SELECT t.id_test FROM test t WHERE t.name = '%s'";
    //const SQL_TEST_TO_SHOW = "SELECT * FROM test t INNER JOIN questions q ON "
    //const SQL_INSERT_QUESTION = "INSERT INTO question VALUES (NULL, )";
    //const SQL_INSERT_TEST = "INSERT INTO test VALUES(NULL, )";

    function __construct()
    {
        self::$conn = ConnectionSQL::connection();
    }

    static function createTest(){

        if ($result = self::$conn->query(self::SQL_TEST_NAME_QUERY)){

            $how_many_results = $result->num_rows;

            if ($how_many_results > 0){
                $_SESSION['message'] = "Test o takiej nazwie już istnieje";
            }
            else {
                self::$test_title = $_POST['test_title'];

                for ($i = 0; $i < $_POST['iter']; ++$i){

                    self::$questions[$i] = $_POST['question'];
                }

            }
        }
    }

    static function showTest($test_title){

        if ($result = self::$conn->query(sprintf(self::SQL_TEST_NAME_QUERY), mysqli_real_escape_string(self::$conn, $test_title))){
            $how_many_results = $result->num_rows;
            if ($how_many_results > 0){

                $row = $result->fetch_assoc();
                $_SESSION['login'] = $row['login'];

                unset($_SESSION['error']);
                if ($row['rights'] == 0) {
                    header('Location: admin.php');
                }
                else{
                    header('Location: main.php');
                }
                $result->close();
            }
        }
    }
}