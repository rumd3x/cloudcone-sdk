# cloudcone-sdk

Unofficial Cloudcone PHP SDK

## Install

```sh
composer require rumd3x/cloudcone-sdk
```

## Examples

Listing my instances

```php
require 'vendor/autoload.php';
use Rumd3x\CloudCone\Api\V1\Compute;

$compute = new Compute('Api-Key-Here', 'App-Hash-Here');

$instances = $compute->getInstances(); // Returns an iterable collection with your instances

echo $instances->count(); // Display number of instances
$firstInstance = $instances->first(); // Retrieves first instance on collection

$allInstances = $instances->all(); // Retrieves all instances
$instancesOnH15 = $instances->where('nomename', '=', 'H15')->all(); // Retrieves all instances on Node H15

$instancesArray = $instances->toArray(); // Converts the collection to array

```

## Todo

- Dedicated Servers API
- Docs
- Unit Tests
- CI
