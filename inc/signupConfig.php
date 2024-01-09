<?php
    require_once("database.php");

    class signupConfig
    {
        private $user_id;
        private $name;
        private $surname;
        private $address;
        protected $databaseConnection;

        public function __construct($user_id = 0, $name = "", $surname = "", $address = "", $databaseConnection = "")
        {
            $this->user_id = $user_id;
            $this->name = $name;
            $this->surname = $surname;
            $this->address = $address;

            $this->databaseConnection = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE =>
            PDO::FETCH_ASSOC]);
        }

        /**
         * @param int|mixed $user_id
         */
        public function setUserId($user_id)
        {
            $this->user_id = $user_id;
        }

        /**
         * @return int|mixed
         */
        public function getUserId()
        {
            return $this->user_id;
        }

        /**
         * @param mixed|string $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed|string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed|string $surname
         */
        public function setSurname($surname)
        {
            $this->surname = $surname;
        }

        /**
         * @return mixed|string
         */
        public function getSurname()
        {
            return $this->surname;
        }

        /**
         * @param mixed|string $address
         */
        public function setAddress($address)
        {
            $this->address = $address;
        }

        /**
         * @return mixed|string
         */
        public function getAddress()
        {
            return $this->address;
        }

        public function insertData()
        {
            try {
                $statement = $this->databaseConnection->prepare("INSERT INTO users(name, surname, address) VALUES (?, ?, ?)");
                $statement->execute([$this->name, $this->surname, $this->address]);
                echo "<script>alert('Data is saved successfully into the database'); document.location='allData.php'</script>";

            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        public function fetchAll()
        {
            try {
                $statement = $this->databaseConnection->prepare("SELECT * FROM users");
                $statement->execute();
                return $statement->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function fetchOnce()
        {
            try {
                $statement = $this->databaseConnection->prepare("SELECT FROM users WHERE user_id = ?");
                $statement->execute([$this->user_id]);
                return $statement->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function update()
        {
            try {
                $statement = $this->databaseConnection->prepare("Update users SET name = ?, surname = ?, address = ? WHERE user_id = ?");
                $statement->execute([$this->name, $this->surname, $this->address, $this->user_id]);
                return $statement->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }

        }

        public function delete()
        {
            try {
                $statement = $this->databaseConnection->prepare("DELETE * FROM users WHERE user_id = ?");
                $statement->execute([$this->user_id]);
                return $statement->fetchAll();
                echo "<script>alert('Data is deleted successfully from the database'); document.location='allData.php'</script>";
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }
?>