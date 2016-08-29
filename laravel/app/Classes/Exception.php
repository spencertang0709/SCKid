<?php

namespace App\Classes;

class Exception extends \Exception {}

class LogicException extends Exception {}
class RuntimeException extends Exception {}

class illegalApiKeyException extends LogicException {}
class NonRecipientException extends LogicException {}
class TooManyRecipientsException extends LogicException {}
class TooBigPayloadException extends LogicException {}
class WrongGCMIdException extends LogicException {}

class HttpException extends RuntimeException {}
class AuthenticationException extends RuntimeException {}