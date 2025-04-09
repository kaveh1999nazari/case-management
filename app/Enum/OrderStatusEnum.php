<?php

namespace App\Enum;

enum OrderStatusEnum
{
    const NOT_PAID = 'پرداخت نشده';
    const ORDER_REGISTRATION = 'ثبت سفارش';
    CONST SEND_ORDER = 'ارسال شده';
    CONST PREPARE_ORDER = 'در حال آماده سازی';
    CONST CANCEL_ORDER = 'لغو سفارش';
    CONST RECEIVE_ORDER = 'اتمام';

}
