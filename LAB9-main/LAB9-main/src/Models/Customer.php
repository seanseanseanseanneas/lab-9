<?php

namespace App\Models;

use App\Models\BaseModel;
use \PDO;

class Customer extends BaseModel
{
    public function all()
    {
        $sql = "SELECT * FROM customers";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, '\App\Models\Customer');
        return $result;
    }

    public function getCustomer($id)
    {
        $sql = "SELECT * FROM customers WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        $result = $statement->fetchObject('\App\Models\Customer');
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE customers
            SET
                company=:company,
                first_name=:first_name,
                last_name=:last_name,
                job_title=:job_title
            WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $result = $statement->execute([
            'company' => $this->company,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'job_title' => $this->job_title,
            'id' => $this->id
        ]);
        return $result;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getFullName($format = "{first_name} {last_name}")
    {
        $full_name = $format;
        $full_name = str_replace('{first_name}', $this->getFirstName(), $full_name);
        $full_name = str_replace('{last_name}', $this->getLastName(), $full_name); // Correct method name
        return $full_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }
}
