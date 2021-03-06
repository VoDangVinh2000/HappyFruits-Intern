<?php
    /* Old version
    $shipping_table = array(
        '21' => array('10.1' => 35, '7' => 28, '5' => 24, '3' => 17, '1.5' => 13, '0' => 8),
        '11' => array('10.1' => 30, '7' => 24, '5' => 20, '3' => 14, '1.5' => 10, '0' => 5),
        '0' => array('10.1' => 25, '7' => 20, '5' => 16, '3' => 12, '1.5' => 8, '0' => 3)
    );
    */
    
    /* New version 
    ** This is for calculating salary
    ** e.g number_of_dishes = 12, distance = 5.5 =>  row['10']['5'] = 15
    
    $shipping_cost = array(
        '20' => array('9' => 35, '8' => 28, '6' => 23, '5' => 21, '3' => 14, '2' => 11, '0' => 7),
        '10' => array('9' => 29, '8' => 24, '6' => 19, '5' => 15, '3' => 12, '2' => 9, '0' => 5),
        '0' => array('9' => 25, '8' => 20, '6' => 15, '5' => 13, '3' => 10, '2' => 7, '0' => 3)
    );
    */
    
    /* New version 06/05/2016
    $shipping_cost = array(
        '20' => array('9' => 42, '7' => 38, '5' => 30, '3' => 24, '2' => 18, '0' => 12),
        '10' => array('9' => 38, '7' => 32, '5' => 24, '3' => 18, '2' => 14, '0' => 8),
        '0' => array('9' => 30, '7' => 25, '5' => 20, '3' => 14, '2' => 10, '0' => 5)
    );
    */

    /* New version 08/04/2017
    $shipping_cost = array(
        '50' => array('9' => 50, '7' => 42, '5' => 36, '3' => 27, '2' => 21, '0' => 15),
        '20' => array('9' => 42, '7' => 35, '5' => 28, '3' => 21, '2' => 17, '0' => 10),
        '0' => array('9' => 38, '7' => 29, '5' => 22, '3' => 16, '2' => 12, '0' => 7)
    );
    */

    /* New version 14/10/2020 */
    $shipping_cost = array(
        '51' => array('0' => 45),
        '36' => array('0' => 35),
        '26' => array('0' => 25),
        '16' => array('0' => 15),
        '9' => array('0' => 10),
        '0' => array('0' => 5)
    );
    $shipping_cost2 = array(
        '3500' => 45,
        '2500' => 35,
        '1800' => 25,
        '950' => 15,
        '510' => 10,
        '0' => 5
    );

    /* Do not use this more - 2019-12-13 */
    $shipping_fees = array(
        array(
            '1000' => array('12' => -1, '9' => 0, '7' => 0, '6' => 0, '5' => 0, '4' => 0, '3' => 0, '2' => 0, '0' => 0),
            '800' => array('12' => -1, '9' => 20, '7' => 0, '6' => 0, '5' => 0, '4' => 0, '3' => 0, '2' => 0, '0' => 0),
            '600' => array('12' => -1, '9' => 30, '7' => 20, '6' => 0, '5' => 0, '4' => 0, '3' => 0, '2' => 0, '0' => 0),
            '400' => array('12' => -1, '9' => 35, '7' => 30, '6' => 20, '5' => 0, '4' => 0, '3' => 0, '2' => 0, '0' => 0),
            '300' => array('12' => -1, '9' => 35, '7' => 30, '6' => 20, '5' => 10, '4' => 0, '3' => 0, '2' => 0, '0' => 0),
            '200' => array('12' => -1, '9' => -1, '7' => 30, '6' => 20, '5' => 15, '4' => 10, '3' => 0, '2' => 0, '0' => 0),
            '100' => array('12' => -1, '9' => -1, '7' => -1, '6' => 30, '5' => 20, '4' => 15, '3' => 10, '2' => 0, '0' => 0),
            '60' => array('12' => -1, '9' => -1, '7' => -1, '6' => -1, '5' => -1, '4' => 20, '3' => 20, '2' => 15, '0' => 10)
        ),
        array(
            '700' => array('12' => -1, '9' => 0, '8' => 0, '7' => 0, '6' => 0, '5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0, '0' => 0),
            '500' => array('12' => -1, '9' => 20, '8' => 10, '7' => 0, '6' => 0, '5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0, '0' => 0),
            '400' => array('12' => -1, '9' => 25, '8' => 20, '7' => 15, '6' => 10, '5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0, '0' => 0),
            '300' => array('12' => -1, '9' => 35, '8' => 28, '7' => 20, '6' => 15, '5' => 10, '4' => 5, '3' => 0, '2' => 0, '1' => 0, '0' => 0),
            '220' => array('12' => -1, '9' => -1, '8' => 30, '7' => 25, '6' => 20, '5' => 15, '4' => 10, '3' => 0, '2' => 0, '1' => 0, '0' => 0),
            '180' => array('12' => -1, '9' => -1, '8' => -1, '7' => 28, '6' => 20, '5' => 15, '4' => 15, '3' => 10, '2' => 5, '1' => 0, '0' => 0),
            '120' => array('12' => -1, '9' => -1, '8' => -1, '7' => -1, '6' => 30, '5' => 20, '4' => 15, '3' => 15, '2' => 10, '1' => 0, '0' => 0),
            '65' => array('12' => -1, '9' => -1, '8' => -1, '7' => -1, '6' => -1, '5' => -1, '4' => 20, '3' => 15, '2' => 10, '1' => 5, '0' => 5)
        )
    );
    
    define('MAX_DISTANCE', 50); /* km */
    define('MIN_TOTAL', 50); /* 50.000 VND */