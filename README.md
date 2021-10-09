##Composer asset installer
    
**Asset installer** its composer installer plugin. 

Makes it possible to install the dependency package directory vendor/npm-asset or vendor/bower-asset
Useful to provide assets compatible yii2 php framework.      

Destination package must have type **composer-asset**

### Extra options
Provide extra options in package  section "extra"

| Option | Default | Info |
| --- | --- | --- |
| **installer-asset-type**: string | 'npm' | npm or bower. Installer use this value to make destination folder |    
| **installer-asset-suffix**: string | '-asset' | The suffix of asset type |    
| **installer-asset-name**: string | '' | If provided value. Installer replace package name |

    
### Example composer.json 
```json
{
    "name": "somov/composer-asset-installer-test-asset",
    "type": "composer-asset",
    "require": {
        "somov/composer-asset-installer": "*"
    },
    "extra": {
         "installer-asset-type": "bower",
        "installer-asset-name": "test-asset"       
    }
}
``` 
The install path is vendor/bower-asset/test-asset/ 

