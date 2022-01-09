<?php   
    /*
        -- Old discount
        array(
            'start_date' => '2014-10-28',
            'end_date' => '2014-10-31',
            'description' => 'Đặt hàng online được giảm 10% đến hết ngày 31/10/2014',
            'priority' => '10',
            'table' => array(
                '0' => 0.1
            )
        ),
    */
    $discount_table = array(
        array(
            'start_date' => '2016-02-24',
            'end_date' => '2016-02-28',
            'description' => 'Đặt hàng online được giảm 10% đến hết ngày 28/02/2016',
            'en_description' => 'Booking online for 10% discount until Feb 28 2016',
            'priority' => '10',
            'table' => array(
                '0' => 0.1
            )
        ),
        array(
            'start_date' => '2104-01-01',
            'end_date' => '2015-07-24',
            'description' => 'Giảm 5% với đơn hàng trên 500.000đ, 10% với đơn hàng trên 1.000.000đ',
            'en_description' => 'Discount 5% for orders with total over 500.000đ, 10% for orders with total over 1.000.000đ',
            'priority' => '0',
            'table' => array(
                '1000' => 0.1,
                '500' => 0.05 
            )
        )
    );