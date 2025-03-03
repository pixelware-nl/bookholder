<?php

namespace App\Enums;

enum MethodType
{
    case GET;
    case POST;
    case PUT;
    case DELETE;
    case PATCH;
}
