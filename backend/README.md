
# VCAdmin: Visibilitycheck admin

This project is the admin module fo the visibility check.


# Changelog

### 15/3/2023
- Updated php to 8.2
- Updated Laravel to version 9
- Updated dependency management
- Laravel-Simplesaml version 1.19.7.0
### 18/3/2022
- Fixed  results for topics without questions
- Added explanation on results calculation
### 13/02/2022
- Updated php to 8.2
- Updated Laravel Version from 8 to 9
- Updated Simplesaml to 1.19.7


# DEV NOTES
This project uses the Laravael framework. The project dependencies are managed by composer.


## Configuration for UU Environment

This project makes use of IAM auth.  
Two libraries are needed for the integration:
- Simplesamlphp
- Laravel - Simplesaml connector: https://git.its.uu.nl/UBU-developers/laravel-simplesaml


##Integration with Simplesamlphp
The Simplesaml connection is made possible with the use of a custom library and loading the simplesaml
class within the **Laravel autoloader**
- custom module: loaded in composer.json from  **git.its.uu.nl/ubu-developers/laravel-simplesam**
- Simplesaml classes are loaded with composer autoloader:
  ```json
   "autoload": {
       "psr-4": {
           ...
           "SimpleSAML\": "../simplesamlphp/lib/"
       },
       "files": [
           "../simplesamlphp/lib/_autoload_modules.php"
       ],
   },
   ```

- Simplersaml Saml2 classes are loads as vendor dependency
  ```json     
  "require": {
        ...
        "simplesamlphp/saml2": "^3.4 || ^4.0"
    },
  ```

##Laravel - Simplesamlphp connector
Library url: https://git.its.uu.nl/UBU-developers/laravel-simplesaml

To integrate this library with Laravel the library source code is copied in `lib/laravel-simplesaml` and linked in **composer.json** as a dependency

```json
    "repositories": [
        {
            "type": "path",
            "url": "lib/laravel-simplesaml"
        }
    ],
```

You can find more information on the right version of laravel-simplesaml to use in the lib's repository

## Other dependencies
The other dependencies are loaded by composer during build, see the dockerfile

