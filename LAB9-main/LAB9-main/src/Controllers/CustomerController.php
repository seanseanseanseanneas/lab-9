<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomerController extends BaseController
{
    public function list()
    {
        $customerModel = new Customer();
        $customers = $customerModel->all();
        $data = [
            'title' => 'Customers List',
            'items' => $customers
        ];

        return $this->render('customers', $data);
    }

    public function show($id)
    {
        $customerModel = new Customer();
        $customer = $customerModel->getCustomer($id);

        if (!$customer) {
            return $this->render('404');
        }

        $data = [
            'title' => 'Customer Details',
            'customer' => $customer
        ];

        return $this->render('customer_detail', $data);
    }

    public function update($id)
    {
        $customerModel = new Customer();
        $customer = $customerModel->getCustomer($id);

        if (!$customer) {
            return $this->render('404');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer->company = $_POST['company'];
            $customer->first_name = $_POST['first_name'];
            $customer->last_name = $_POST['last_name'];
            $customer->job_title = $_POST['job_title'];

            $customerModel->update();
            return $this->render('customer_updated', ['customer' => $customer]);
        }

        return $this->render('update_customer', ['customer' => $customer]);
    }
}
