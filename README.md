# http-emitter - PSR-7 response emitter

[![PHP Version Require](http://poser.pugx.org/tomrf/http-emitter/require/php?style=flat-square)](https://packagist.org/packages/tomrf/http-emitter) [![Latest Stable Version](http://poser.pugx.org/tomrf/http-emitter/v?style=flat-square)](https://packagist.org/packages/tomrf/http-emitter) [![License](http://poser.pugx.org/tomrf/http-emitter/license?style=flat-square)](https://packagist.org/packages/tomrf/http-emitter)

Simple PSR-7 response emitter with sensible CLI SAPI output

📔 [Go to documentation](#documentation)

## Installation
Installation via composer:

```bash
composer require tomrf/http-emitter
```

## Usage
```php
$httpEmitter = new HttpEmitter();
$httpEmitter->emit($response); // PSR-7 response object
```

## Testing
```bash
composer test
```

## License
This project is released under the MIT License (MIT).
See [LICENSE](LICENSE) for more information.

## Documentation
 - [Tomrf\HttpEmitter\HttpEmitter](#-tomrfhttpemitterhttpemitterclass)
   - [emit](#emit)
 - [Tomrf\HttpEmitter\Sapi\SapiCliEmitter](#-tomrfhttpemittersapisapicliemitterclass)
   - [emit](#emit)
 - [Tomrf\HttpEmitter\Sapi\SapiEmitter](#-tomrfhttpemittersapisapiemitterclass)
   - [emit](#emit)


***

### 📂 Tomrf\HttpEmitter\HttpEmitter::class

PSR-7 message response emitter.

#### emit()

Emits the response using SapiEmitter or SapiCliEmitter based on
current PHP SAPI.

```php
public function emit(
    Psr\Http\Message\ResponseInterface $response
): void

```


***

### 📂 Tomrf\HttpEmitter\Sapi\SapiCliEmitter::class

PSR-7 message response emitter for SAPI cli.

#### emit()

Emits the response to terminal.

```php
public function emit(
    Psr\Http\Message\ResponseInterface $response
): void

```


***

### 📂 Tomrf\HttpEmitter\Sapi\SapiEmitter::class

Generic PSR-7 message response emitter for SAPI.

#### emit()

Emits the response to standard output.

```php
public function emit(
    Psr\Http\Message\ResponseInterface $response
): void

```



***

_Generated 2022-06-15T23:05:29+02:00 using 📚[tomrf/readme-gen](https://packagist.org/packages/tomrf/readme-gen)_
