<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/Database.php");
include_once($filepath . "/../helpers/Format.php");
?>
<?php
class Customer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data)
    {
        //data validation
        $name = $this->fm->validation($data['name']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $country = $this->fm->validation($data['country']);
        $zip = $this->fm->validation($data['zip']);
        $phone = $this->fm->validation($data['phone']);
        $email = $this->fm->validation($data['email']);
        $pass = $this->fm->validation($data['password']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = mysqli_real_escape_string($this->db->link, md5($pass));

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $pass == "") {
            $msg = "<span class='error'> Fields must not be empty! </span>";
            return $msg;
        }
        $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        if ($mailchk) {
            $msg = "<span class='error'>Email already exist!</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass) 
                      VALUES('$name','$address','$city','$country','$zip', '$phone', '$email','$pass')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Customer data inserted successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Customer data not inserted.</span>";
                return $msg;
            }
        }
    }

    public function customerLogin($data)
    {
        $email = $this->fm->validation($data['email']);
        $pass = $this->fm->validation($data['password']);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = mysqli_real_escape_string($this->db->link, md5($pass));

        if (empty($email) || empty($pass)) {
            $msg = "<span class='error'> Fields must not be empty! </span>";
            return $msg;
        }
        $query = "SELECT * FROM tbl_customer WHERE email='$email' AND pass='$pass'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("cuslogin", true);
            Session::set("cmrId", $value['id']);
            Session::set("cmrName", $value['name']);
            header("Location:cart.php");
        } else {
            $msg = "<span class='error'> User doesn't exist! </span>";
            return $msg;
        }
    }

    public function getCustomerData($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function customerUpdate($data, $cmrId)
    {
        //data validation
        $name = $this->fm->validation($data['name']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $country = $this->fm->validation($data['country']);
        $zip = $this->fm->validation($data['zip']);
        $phone = $this->fm->validation($data['phone']);
        $email = $this->fm->validation($data['email']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "") {
            $msg = "<span class='error'> Fields must not be empty! </span>";
            return $msg;
        } else {
            $query = "UPDATE tbl_customer 
                    SET name = '$name',
                        address = '$address',
                        city = '$city',
                        country = '$country',
                        zip = '$zip',
                        phone = '$phone',
                        email = '$email'
                    WHERE id = '$cmrId'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $msg = "<span class='success'>Customer data updated successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Customer data not updated.</span>";
                return $msg;
            }
        }
    }

    public function getAllCustomer(){
        $query = "SELECT * FROM tbl_customer";
        $result = $this->db->select($query);
        return $result;
    }
}
?>