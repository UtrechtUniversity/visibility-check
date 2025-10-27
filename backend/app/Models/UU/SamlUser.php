<?php

namespace App\Models\UU;



class SamlUser extends \SimplerSaml\User
{
    /**
     * Map Saml properties to internal properties
     * ie. cn => name or mail => email
     * @var array
     */
    protected $property_map = [
        'uuShortID' => 'solisid',
        'givenName' => 'name',
        'mail' => 'email',
        'uuPrefixedSn' => 'surname',
    ];
}
